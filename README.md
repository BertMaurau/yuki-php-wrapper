# yuki-wrapper
PHP Wrapper for the Yuki SOAP Webservice

Currently available
 - Common Functions
 - PettyCash Import

## Installation with Composer

    curl -s http://getcomposer.org/installer | php
    php composer.phar require "bertmaurau/yuki-php-wrapper"
    
## Usage

    try {
        $yuki = (new \Yuki())
                -> setAccessKey(getenv('API_TOKEN'))
                -> setAdministrationID(getenv('ADMINISTRATION_ID'))
                -> authenticate();
    } catch (\Exception $ex) {
        echo $ex -> getMessage();
        exit;
    }

    // Do stuffs here

## Methods

### Common

 - Administrations
 
   **Required**: Session ID  
   **Throws**: InvalidSessionIDException  
   **Returns**: List of active administration models  
 
       $yuki -> administrations();
       
 - GetAdministrationIDByName
 
   **Required**: Session ID 1 Administration Name
   **Throws**: InvalidAdministrationNameException  
   **Returns**: The ID of th administration   
 
       $yuki -> getAdministrationIDByName($administrationName);

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
   **Returns**: List of active domain models  
 
       $yuki -> domains();

 - GetCurrentDomain
 
   **Required**: Session ID  
   **Throws**: InvalidSessionIDException  
   **Returns**: Returns current domain model    
 
       $yuki -> getCurrentDomain();

 - SetCurrentDomain
 
   **Required**: Session ID  
   **Throws**: InvalidSessionIDException  
 
       $yuki -> setCurrentDomain();


### PettyCash

 - Import
 
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
 - **InvalidAdministrationNameException**: When there is no Administration Name provided to get the ID.
 - **InvalidCredentialsException**: When there is no UserName or Password given (Deprecated).
 - **InvalidDomainIDException**: When there is no Domain ID set.
 - **InvalidSessionIDException**: When there is no Session ID set (Gets set after Authentication).
 - **InvalidStatementTextException**: When there is no Statement Text provided for import.
 - **ModelNotFoundException**: When the requested model was not found.
 - **NoAuthenticationResultException**: When the Authenticate didn't return the expected results
