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

/**
 * Description of Product
 *
 * @author Bert Maurau
 */
class Product
{

    public $description;
    public $reference;
    public $category;
    public $salesPrice;
    public $VATPercentage;
    public $VATIncluded;
    public $VATType;
    public $GLAccountCode;
    public $remarks;

    public function getDescription()
    {
        return $this -> description;
    }

    public function getReference()
    {
        return $this -> reference;
    }

    public function getCategory()
    {
        return $this -> category;
    }

    public function getSalesPrice()
    {
        return $this -> salesPrice;
    }

    public function getVATPercentage()
    {
        return $this -> VATPercentage;
    }

    public function getVATIncluded()
    {
        return $this -> VATIncluded;
    }

    public function getVATType()
    {
        return $this -> VATType;
    }

    public function getGLAccountCode()
    {
        return $this -> GLAccountCode;
    }

    public function getRemarks()
    {
        return $this -> remarks;
    }

    public function setDescription($description)
    {
        $this -> description = $description;
        return $this;
    }

    public function setReference($reference)
    {
        $this -> reference = $reference;
        return $this;
    }

    public function setCategory($category)
    {
        $this -> category = $category;
        return $this;
    }

    public function setSalesPrice($salesPrice)
    {
        $this -> salesPrice = $salesPrice;
        return $this;
    }

    public function setVATPercentage($VATPercentage)
    {
        $this -> VATPercentage = $VATPercentage;
        return $this;
    }

    public function setVATIncluded($VATIncluded)
    {
        if (!is_bool($VATIncluded)) {
            throw new Exception\InvalidValueTypeException(__CLASS__, 'VATIncluded', gettype($VATIncluded), 'boolean');
        }
        $this -> VATIncluded = ($VATIncluded) ? 'true' : 'false';
        return $this;
    }

    public function setVATType($VATType)
    {
        $this -> VATType = $VATType;
        return $this;
    }

    public function setGLAccountCode($GLAccountCode)
    {
        $this -> GLAccountCode = $GLAccountCode;
        return $this;
    }

    public function setRemarks($remarks)
    {
        $this -> remarks = $remarks;
        return $this;
    }

}
