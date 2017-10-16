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

use Yuki\Exception as Exception;

require_once __DIR__ . '\Exception\NoAuthenticationResultException.php';

/**
 * Description of the main Yuki Class
 *
 * @author Bert Maurau
 */
class Yuki
{

    const WS_URL = 'https://api.yukiworks.be/ws/';

    protected $sessionID;
    protected $administrationID;
    protected $accessKey;
    protected $soap;
    protected $missingSessionValues = array();

    public function __construct($service)
    {
        $this -> soap = new \SoapClient(self::WS_URL . $service);
    }

    /**
     * Authenticate with the Webservice, using the accessKey, to get the current
     * active Session and store the result for future usage.
     * @return self
     */
    public function authenticate()
    {
        $request = array(
            "accessKey" => $this -> getAccessKey());

        try {
            $result = $this -> soap -> Authenticate($request);
        } catch (\Exception $ex) {
            // Just pass the exception through and let the index handle the exception
            throw $ex;
        }
        if (!property_exists($result, 'AuthenticateResult')) {
            // Catch/Handle exceptions here
            throw new Exception\NoAuthenticationResultException();
        }
        // Set the returned sessionID for future usage
        $this -> setSessionID($result -> AuthenticateResult);

        return $this;
    }

    /**
     * Get the Session ID
     * @return string
     */
    function getSessionID()
    {
        return $this -> sessionID;
    }

    /**
     * Get the AdministrationID
     * @return string
     */
    function getAdministrationID()
    {
        return $this -> administrationID;
    }

    /**
     * Get the main API Token (Access Key)
     * @return string
     */
    function getAccessKey()
    {
        return $this -> accessKey;
    }

    /**
     * Set the Session ID (used for future requests)
     * @param string $sessionID
     * @return $this
     */
    function setSessionID($sessionID)
    {
        $this -> sessionID = $sessionID;
        return $this;
    }

    /**
     * Set the AdministrationID
     * @param string $administrationID
     * @return $this
     */
    function setAdministrationID($administrationID)
    {
        $this -> administrationID = $administrationID;
        return $this;
    }

    /**
     * Set the main API Token (Access Key)
     * @param string $accessKey
     * @return $this
     */
    function setAccessKey($accessKey)
    {
        $this -> accessKey = $accessKey;
        return $this;
    }

}
