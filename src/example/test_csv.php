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

require_once 'src/PettyCash.php';

// This part is optional and is just for loading config variables into session
require __DIR__ . '/vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv -> load();

// Init new Yuki pettycash object
try {
    $yuki = (new \Yuki\PettyCash())
            -> setAccessKey(getenv('API_TOKEN'))
            -> setAdministrationID(getenv('ADMINISTRATION_ID'))
            -> authenticate();
} catch (\Exception $ex) {
    echo $ex -> getMessage();
    exit;
}

// Load CSV data from file or do some other magic
$data = "CSV;Content;Here;..";

$result = $yuki -> import($data);
