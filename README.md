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

## Methods

### Common

 - Authenticate 
 
   **Required**: Access Key  
   **Throws**: InvalidAccessKeyException
 
       $yuki -> authenticate();
 
 - AuthenticateByUserName (deprecated)
 
   **Required**: UserName & Password  
   **Throws**: InvalidCredentialsException
 
       $yuki -> authenticateByUserName($userName, $password);

 - Domains
 
   **Required**: Session ID  
   **Throws**: InvalidSessionIDException
 
       $yuki -> domains();

 - GetCurrentDomain
 
   **Required**: Session ID  
   **Throws**: InvalidSessionIDException
 
       $yuki -> getCurrentDomain();

 - SetCurrentDomain
 
   **Required**: Session ID  
   **Throws**: InvalidSessionIDException
 
       $yuki -> setCurrentDomain();


### PettyCash

   **Required**: Session ID, Administration ID & Statement Text 
   **Throws**: Exception
 
       $yuki -> import($statementText);

### Getters & Setters

 - getSessionID() 
 - setSessionID() 
 - getAdministrationID() 
 - setAdministrationID() 
 - getAccessKey() 
 - setAccessKey() 

## Exceptions

The next Exceptions can be thrown:

 - **InvalidAccessKeyException**: When there is no Access Key set.
 - **InvalidAdministrationIDException**: When there is no Administration ID set.
 - **InvalidCredentialsException**: When there is no UserName or Password given (Deprecated).
 - **InvalidDomainIDException**: When there is no Domain ID set.
 - **InvalidSessionIDException**: When there is no Session ID set (Gets set after Authentication).
 - **InvalidStatementTextException**: When there is no Statement Text provided for import.
 - **NoAuthenticationResultException**: When the Authenticate didn't return the expected results
