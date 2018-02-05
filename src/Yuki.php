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

    public function __construct($service)
    {
        $this -> soap = new \SoapClient(self::WS_URL . $service);
    }

    /**
     * List all active administrations that are available for the given Session ID
     * @return array List of Administrations
     * @throws InvalidSessionIDException
     * @throws \Exception
     */
    public function administrations()
    {
        // Check for sessionId first
        if (!$this -> getSessionID()) {
            throw new Exception\InvalidSessionIDException();
        }

        $request = array(
            "sessionID" => $this -> getSessionID());

        try {
            $result = $this -> soap -> Administrations($request);
        } catch (\Exception $ex) {
            // Just pass the exception through and let the index handle the exception
            throw $ex;
        }

        // Return the list of Administrations
        return $this -> getModelsFromXML($result -> AdministrationsResult -> any, 'Administration');
    }

    /**
     * List all active administrations
     * @return array
     * @throws Exception\InvalidSessionIDException
     * @throws \Exception
     */
    public function companies()
    {
        // Check for sessionId first
        if (!$this -> getSessionID()) {
            throw new Exception\InvalidSessionIDException();
        }

        $request = array(
            "sessionID" => $this -> getSessionID());

        try {
            $result = $this -> soap -> Companies($request);
        } catch (\Exception $ex) {
            // Just pass the exception through and let the index handle the exception
            throw $ex;
        }

        $responseArray = $this -> parseXMLResponse($result -> CompaniesResult -> any);
        $return = array();
        foreach ($responseArray as $key => $value) {
            if ($value['tag'] === 'Name') {
                array_push($return, $value['value']);
            }
        }

        // Return the list of Administrations
        return $return;
    }

    /**
     * Get the Administration ID from Name
     * @param string $administrationName
     * @return string
     * @throws Exception\InvalidAdministrationNameException
     * @throws \Exception
     */
    public function getAdministrationIDByName($administrationName)
    {
        // Check for sessionId first
        if (!$administrationName) {
            throw new Exception\InvalidAdministrationNameException();
        }

        $request = array(
            "sessionID"          => $this -> getSessionID(),
            "administrationName" => $administrationName);

        try {
            $result = $this -> soap -> AdministrationID($request);
        } catch (\Exception $ex) {
            // Just pass the exception through and let the index handle the exception
            throw $ex;
        }

        // Return the list of Administrations
        return $result -> AdministrationIDResult;
    }

    /**
     * List all active domains that are available for the given access Token
     * @return List of Domains
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

        // Return the list of Administrations
        return $this -> getModelsFromXML($result -> DomainsResult -> any, 'Domain');
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

        // Return the Model
        return $this -> getModelsFromXML($result -> GetCurrentDomainResult -> any, 'Domain', true);
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
     * Authenticate with the Web service, using a username and password, to get
     * the current Session ID and store the result for future usage.
     * @param string $userName
     * @param string $password
     * @return $this
     * @throws InvalidCredentialsException
     * @throws \Exception
     */
    public function authenticateByUserName($userName, $password)
    {
        // Check for sessionId first
        if (!$userName || !$password) {
            throw new Exception\InvalidCredentialsException();
        }

        $request = array(
            "userName" => $userName,
            "password" => $password);

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
     * Authenticate with the Web service, using the accessKey, to get the current
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
     * Parse the XML response to an accessible object
     * @param string $response
     * @return array
     */
    protected function parseXMLResponse($response)
    {
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $response, $vals, $index);
        xml_parser_free($parser);

        return $vals;
    }

    /**
     * Parse the given XML to list of requested models and their properties
     * @param string $response
     * @param string $model
     * @param boolean $returnOne
     * @return array|\Yuki\Model
     * @throws Exception\ModelNotFoundException
     */
    protected function getModelsFromXML($response, $model, $returnOne = false)
    {
        $return = array();

        // Parse the XML to an itterable array first
        $responseArray = $this -> parseXMLResponse($response);

        $parentnode = $model . 's';
        $childnode = $model;

        $modelFactory = new ModelFactory();
        if (!$modelFactory -> checkModel($model)) {
            throw new Exception\ModelNotFoundException($model);
        } else {
            // Loop the items
            foreach ($responseArray as $key => $value) {
                if ($value['tag'] === $parentnode) {
                    // Do nothing with the open/close type
                } else if ($value['tag'] === $childnode) {
                    // Get the ID from the attributes only from the 'open' type
                    if ($value['type'] === 'open') {

                        // Initiate a new Model
                        $modelobj = $modelFactory -> getModel($model);
                        // Set the ID
                        $modelobj -> setId($value['attributes']['ID']);
                    } else if ($value['type'] === 'close') {

                        // End of the model, add the finished one to the list or return
                        if ($returnOne) {
                            return $modelobj;
                        } else {
                            array_push($return, $modelobj);
                        }
                    }
                } else {
                    // Set the value based on the tag
                    $modelobj -> {'set' . $value['tag']}($value['value']);
                }
            }
        }

        return $return;
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
