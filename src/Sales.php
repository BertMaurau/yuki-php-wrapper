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
    public function processSalesInvoice($salesInvoice)
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
        if (!$salesInvoice) {
            throw new Exception\InvalidSalesInvoiceException();
        } else {
            $xmlDoc = '<SalesInvoices
                        xmlns="urn:xmlns:https://www.theyukicompany.com:salesinvoices"
                        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';
            $xmlDoc .= $salesInvoice -> renderXml();
            $xmlDoc .= '</SalesInvoices>';
        }
        $request = array(
            "sessionID"        => $this -> getSessionID(),
            "administrationID" => $this -> getAdministrationID(),
            "xmlDoc"           => $xmlDoc);

        try {
            $result = $this -> soap -> ProcessSalesInvoice($request);
        } catch (\Exception $ex) {
            // Just pss the exception through and let the index handle the exception
            throw $ex;
        }

        return $result;
    }

}
