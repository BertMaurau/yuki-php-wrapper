<?php

/*
 * Copyright 2017 Bert Maurau.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Yuki;

require_once __DIR__ . '\Yuki.php';

require_once __DIR__ . '\Exception\InvalidAdministrationIDException.php';
require_once __DIR__ . '\Exception\InvalidSalesInvoiceException.php';

require_once __DIR__ . '\Model\SalesInvoice.php';
require_once __DIR__ . '\Model\Contact.php';
require_once __DIR__ . '\Model\InvoiceLine.php';
require_once __DIR__ . '\Model\Product.php';

/**
 * Description of the Yuki Sales Sub service
 *
 * @author Bert Maurau
 */
class Sales extends Yuki
{

    const WS_SERVICE = 'Sales.asmx?WSDL';

    public function __construct()
    {
        parent::__construct(self::WS_SERVICE);
    }

    /**
     * Process Sales Invoice
     * @param string $salesInvoice
     * @return stdclass
     * @throws \Exception
     */
    public function processSalesInvoices($salesInvoices)
    {
        // Check for sessionId first
        if (!$this -> getSessionID()) {
            throw new Exception\InvalidSessionIDException();
        }
        // Check for sessionId first
        if (!$this -> getAdministrationID()) {
            throw new Exception\InvalidAdministrationIDException();
        }
        // Check for given domain
        if (!$salesInvoices) {
            throw new Exception\InvalidSalesInvoiceException();
        } else {
            $xmlDoc = '<SalesInvoices>';
            foreach ($salesInvoices as $key => $salesInvoice) {
                $xmlDoc .= $salesInvoice -> renderXml();
            }
            $xmlDoc .= '</SalesInvoices>';
        }

        $xmlvar = new \SoapVar('<ns1:xmlDoc>' . $xmlDoc . '</ns1:xmlDoc>', \XSD_ANYXML);

        $request = array(
            "sessionId"        => $this -> getSessionID(),
            "administrationId" => $this -> getAdministrationID(),
            "xmlDoc"           => $xmlvar);

        try {
            $result = $this -> soap -> ProcessSalesInvoices($request);
        } catch (\Exception $ex) {
            // Just pass the exception through and let the index handle the exception
            throw $ex;
        }

        $responseArray = $this -> parseXMLResponse($result -> ProcessSalesInvoicesResult -> any);

        // Response should always contain the next items
        $invoiceCounter = 0;
        $invoiceResponse = array();
        $response = array();

        foreach ($responseArray as $key => $value) {

            // Check if start of invoice, init a new array for that invoice
            if ($value['tag'] === 'Invoice' && $value['type'] === 'open') {
                $invoiceResponse[$invoiceCounter] = array();
            }

            // check if tag is the level of the invoice
            if ($value['level'] === 3) {
                // Add the value to the current invoice
                $invoiceResponse[$invoiceCounter][$value['tag']] = $value['value'];
            }

            // increase the counter to start next invoice
            if ($value['tag'] === 'Invoice' && $value['type'] === 'close') {
                $invoiceCounter++;
            }

            // other tags
            if ($value['level'] === 2 && $value['type'] !== 'open' && $value['type'] !== 'close') {
                $response[$value['tag']] = $value['value'];
            }
        }

        $response['Invoices'] = $invoiceResponse;

        return (object) $response;
    }

}
