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
 * Description of StatementLine
 *
 * @author Bert Maurau
 */
class StatementLine
{

    private $accountGlCode; // string
    private $transactionCode; // string
    private $offsetAccount; // string
    private $offsetName; // string
    private $transactionDate; // datetime
    private $transactionDescription; // string
    private $amount; // decimal

    public function getAccountGlCode()
    {
        return $this -> accountGlCode;
    }

    public function getTransactionCode()
    {
        return $this -> transactionCode;
    }

    public function getOffsetAccount()
    {
        return $this -> offsetAccount;
    }

    public function getOffsetName()
    {
        return $this -> offsetName;
    }

    public function getTransactionDate()
    {
        return $this -> transactionDate;
    }

    public function getTransactionDescription()
    {
        return $this -> transactionDescription;
    }

    public function getAmount()
    {
        return $this -> amount;
    }

    public function setAccountGlCode($accountGlCode)
    {
        $this -> accountGlCode = $accountGlCode;
        return $this;
    }

    public function setTransactionCode($transactionCode)
    {
        $this -> transactionCode = $transactionCode;
        return $this;
    }

    public function setOffsetAccount($offsetAccount)
    {
        $this -> offsetAccount = $offsetAccount;
        return $this;
    }

    public function setOffsetName($offsetName)
    {
        $this -> offsetName = $offsetName;
        return $this;
    }

    public function setTransactionDate($transactionDate)
    {
        try {
            $transactionDate = new \DateTime($transactionDate);
        } catch (Exception $exc) {
            throw new Exception\InvalidValueTypeException(__CLASS__, 'transactionDate', gettype($transactionDate), 'valid date');
        }
        $this -> transactionDate = $transactionDate -> format('Y-m-d\TH:i:s');
        return $this;
    }

    public function setTransactionDescription($transactionDescription)
    {
        $this -> transactionDescription = $transactionDescription;
        return $this;
    }

    public function setAmount($amount)
    {
        if (!is_float($amount) && !is_integer($amount)) {
            throw new Exception\InvalidValueTypeException(__CLASS__, 'amount', gettype($amount), 'float');
        }
        $this -> amount = $amount;
        return $this;
    }

}
