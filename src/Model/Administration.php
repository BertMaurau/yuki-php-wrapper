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

/**
 * Description of Administration
 *
 * @author Bert Maurau
 */
class Administration
{

    private $id;
    private $name;
    private $addressLine;
    private $postcode;
    private $city;
    private $country;
    private $startDate;

    public function getId()
    {
        return $this -> id;
    }

    public function getName()
    {
        return $this -> name;
    }

    public function getAddressLine()
    {
        return $this -> addressLine;
    }

    public function getPostcode()
    {
        return $this -> postcode;
    }

    public function getCity()
    {
        return $this -> city;
    }

    public function getCountry()
    {
        return $this -> country;
    }

    public function getStartDate()
    {
        return $this -> startDate;
    }

    public function setId($id)
    {
        $this -> id = $id;
        return $this;
    }

    public function setName($name)
    {
        $this -> name = $name;
        return $this;
    }

    public function setAddressLine($addressLine)
    {
        $this -> addressLine = $addressLine;
        return $this;
    }

    public function setPostcode($postcode)
    {
        $this -> postcode = $postcode;
        return $this;
    }

    public function setCity($city)
    {
        $this -> city = $city;
        return $this;
    }

    public function setCountry($country)
    {
        $this -> country = $country;
        return $this;
    }

    public function setStartDate($startDate)
    {
        $this -> startDate = $startDate;
        return $this;
    }

}
