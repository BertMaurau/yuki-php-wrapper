# yuki-import-pettycash
Yuki PettyCash CSV import using the SOAP Webservice

## Installation with Composer

    curl -s http://getcomposer.org/installer | php
    php composer.phar require "bertmaurau/yuki-pettycash"
    
## Usage

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

    // Import the data
    $result = $yuki -> import($data);
