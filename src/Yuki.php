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
require_once __DIR__ . '\Exception\InvalidSessionIDException.php';
require_once __DIR__ . '\Exception\InvalidDomainIDException.php';
require_once __DIR__ . '\Exception\InvalidCredentialsException.php';
require_once __DIR__ . '\Exception\InvalidAccessKeyException.php';

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
     * List all active domains that are available for the given access Token
     * @return DomainsResult
     * @throws InvalidSessionIDException
     * @throws \Exception
     */
    public function domains()
    {
        // Check for sessionId first
        if (!$this -> getSessionID()) {
            throw new Exception\InvalidSessionIDException();
        }

        $request = array(
            "sessionID" => $this -> getSessionID());

        try {
            $result = $this -> soap -> Domains($request);
        } catch (\Exception $ex) {
            // Just pass the exception through and let the index handle the exception
            throw $ex;
        }

        return $result -> DomainsResult;
    }

    /**
     * Get the current set domain for given session
     * @return GetCurrentDomainResult
     * @throws InvalidSessionIDException
     * @throws \Exception
     */
    public function getCurrentDomain()
    {
        // Check for sessionId first
        if (!$this -> getSessionID()) {
            throw new Exception\InvalidSessionIDException();
        }

        $request = array(
            "sessionID" => $this -> getSessionID());

        try {
            $result = $this -> soap -> GetCurrentDomain($request);
        } catch (\Exception $ex) {
            // Just pass the exception through and let the index handle the exception
            throw $ex;
        }
        return $result -> GetCurrentDomainResult;
    }

    /**
     * Set which domain needs to be used for the current session
     * @param type $domainId
     * @return $this
     * @throws InvalidSessionIDException
     * @throws InvalidDomainIDException
     * @throws \Exception
     */
    public function setCurrentDomain($domainId)
    {
        // Check for sessionId first
        if (!$this -> getSessionID()) {
            throw new Exception\InvalidSessionIDException();
        }
        // Check for given domain
        if (!$domainId) {
            throw new Exception\InvalidDomainIDException();
        }

        $request = array(
            "sessionID" => $this -> getSessionID(),
            "domainID"  => $domainId);

        try {
            $result = $this -> soap -> SetCurrentDomain($request);
        } catch (\Exception $ex) {
            // Just pass the exception through and let the index handle the exception
            throw $ex;
        }

        return $this;
    }

    /**
     * DEPRECATED
     * Authenticate with the Webservice, using a username and password, to get
     * the current Session ID and store the result for future usage.
     * @return $this
     * @throws InvalidCredentialsException
     * @throws \Exception
     */
    public function authenticateByUserName()
    {
        // Check for sessionId first
        if (!$this -> getUserName() || !$this -> getPassword()) {
            throw new Exception\InvalidCredentialsException();
        }

        $request = array(
            "userName" => $this -> getUserName(),
            "password" => $this -> getPassword());

        try {
            $result = $this -> soap -> AuthenticateByUserName($request);
        } catch (\Exception $ex) {
            // Just pass the exception through and let the index handle the exception
            throw $ex;
        }

        // Set the returned sessionID for future usage
        $this -> setSessionID($result -> AuthenticateResult);

        return $this;
    }

    /**
     * Authenticate with the Webservice, using the accessKey, to get the current
     * active Session and store the result for future usage.
     * @return self
     * @throws InvalidAccessKeyException
     */
    public function authenticate()
    {
        // Check for given domain
        if (!$this -> getAccessKey()) {
            throw new Exception\InvalidAccessKeyException();
        }

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
