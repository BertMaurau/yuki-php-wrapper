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

namespace Yuki\Model;

use Yuki\Exception as Exception;

require_once __DIR__ . '\..\Exception\InvalidValueTypeException.php';

/**
 * Description of Contact
 *
 * @author Bert Maurau
 */
class Contact
{

    private $contactCode;
    private $fullName;
    private $firstName;
    private $middleName;
    private $lastName;
    private $gender;
    private $countryCode;
    private $city;
    private $zipcode;
    private $addressLine_1;
    private $addressLine_2;
    private $emailAddress;
    private $website;
    private $CoCNumber;
    private $VATNumber;
    private $contactType;

    public function getContactCode()
    {
        return $this -> contactCode;
    }

    public function getFullName()
    {
        return $this -> fullName;
    }

    public function getFirstName()
    {
        return $this -> firstName;
    }

    public function getMiddleName()
    {
        return $this -> middleName;
    }

    public function getLastName()
    {
        return $this -> lastName;
    }

    public function getGender()
    {
        return $this -> gender;
    }

    public function getCountryCode()
    {
        return $this -> countryCode;
    }

    public function getCity()
    {
        return $this -> city;
    }

    public function getZipcode()
    {
        return $this -> zipcode;
    }

    public function getAddressLine_1()
    {
        return $this -> addressLine_1;
    }

    public function getAddressLine_2()
    {
        return $this -> addressLine_2;
    }

    public function getEmailAddress()
    {
        return $this -> emailAddress;
    }

    public function getWebsite()
    {
        return $this -> website;
    }

    public function getCoCNumber()
    {
        return $this -> CoCNumber;
    }

    public function getVATNumber()
    {
        return $this -> VATNumber;
    }

    public function getContactType()
    {
        return $this -> contactType;
    }

    public function setContactCode($contactCode)
    {
        $this -> contactCode = $contactCode;
        return $this;
    }

    public function setFullName($fullName)
    {
        $this -> fullName = $fullName;
        return $this;
    }

    public function setFirstName($firstName)
    {
        $this -> firstName = $firstName;
        return $this;
    }

    public function setMiddleName($middleName)
    {
        $this -> middleName = $middleName;
        return $this;
    }

    public function setLastName($lastName)
    {
        $this -> lastName = $lastName;
        return $this;
    }

    public function setGender($gender)
    {
        $this -> gender = $gender;
        return $this;
    }

    public function setCountryCode($countryCode)
    {
        $this -> countryCode = $countryCode;
        return $this;
    }

    public function setCity($city)
    {
        $this -> city = $city;
        return $this;
    }

    public function setZipcode($zipcode)
    {
        $this -> zipcode = $zipcode;
        return $this;
    }

    public function setAddressLine_1($addressLine_1)
    {
        $this -> addressLine_1 = $addressLine_1;
        return $this;
    }

    public function setAddressLine_2($addressLine_2)
    {
        $this -> addressLine_2 = $addressLine_2;
        return $this;
    }

    public function setEmailAddress($emailAddress)
    {
        $this -> emailAddress = $emailAddress;
        return $this;
    }

    public function setWebsite($website)
    {
        $this -> website = $website;
        return $this;
    }

    public function setCoCNumber($CoCNumber)
    {
        $this -> CoCNumber = $CoCNumber;
        return $this;
    }

    public function setVATNumber($VATNumber)
    {
        $this -> VATNumber = $VATNumber;
        return $this;
    }

    public function setContactType($contactType)
    {
        $this -> contactType = $contactType;
        return $this;
    }

}
