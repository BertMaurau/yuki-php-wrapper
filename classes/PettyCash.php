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

namespace BertMaurau\Integrations\Yuki;

require_once __DIR__ . '\Yuki.php';

/**
 * Description of the Yuki PettyCash Sub service
 *
 * @author Bert Maurau
 */
class PettyCash extends Yuki
{

    const WS_SERVICE = 'Pettycash.asmx?WSDL';

    public function __construct()
    {
        parent::__construct(self::WS_SERVICE);
    }

    /**
     * Send SOAP request for ImportStatement
     * @param string $statementText
     * @return stdclass
     * @throws \Exception
     */
    public function import($statementText)
    {
        $request = array(
            "sessionID"        => $this -> getSessionID(),
            "administrationID" => $this -> getAdministrationID(),
            "statementText"    => $this -> getSessionID());

        try {
            $result = $this -> soap -> ImportStatement($request);
        } catch (\Exception $ex) {
            // Just pss the exception through and let the index handle the exception
            throw $ex;
        }

        return $result;
    }

}
