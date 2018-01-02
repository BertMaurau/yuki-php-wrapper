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
 * Description of InvoiceLine
 *
 * @author Bert Maurau
 */
class InvoiceLine
{

    public $description;
    public $productQuantity;
    public $product;

    public function getDescription()
    {
        return $this -> description;
    }

    public function getProductQuantity()
    {
        return $this -> productQuantity;
    }

    public function getProduct()
    {
        return $this -> product;
    }

    public function setDescription($description)
    {
        $this -> description = $description;
        return $this;
    }

    public function setProductQuantity($productQuantity)
    {
        $this -> productQuantity = $productQuantity;
        return $this;
    }

    public function setProduct(Product $product)
    {
        $this -> product = $product;
        return $this;
    }

}
