<?php

/*
 * Copyright 2017 Bert Maurau.
 *
 */


require __DIR__ . '/Sales.php';


session_start();

try {
    $yuki = new \Yuki\Sales();

    $yuki -> setAccessKey("72d11cb4....")
            -> setAdministrationID('7ba4c1cf....');
    if (!isset($_SESSION['id'])) {

        $yuki -> authenticate();
        $_SESSION['id'] = $yuki -> getSessionID();
    } else {
        $yuki -> setSessionID($_SESSION['id']);
    }

    echo $yuki -> getSessionID() . '<br>';
    echo $yuki -> getAdministrationID() . '<br>';


    $product_1 = (new \Yuki\Model\Product())
            -> setDescription('Product 1')
            -> setReference('123456')
            -> setSalesPrice(14.88)
            -> setVATPercentage(21)
            -> setVATIncluded(true)
            -> setVATType(1);
    $invoiceLine_1 = (new \Yuki\Model\InvoiceLine())
            -> setDescription('Product 1')
            -> setProductQuantity(1)
            -> setProduct($product_1);
    $product_2 = (new \Yuki\Model\Product())
            -> setDescription('Product 2')
            -> setReference('78910112')
            -> setSalesPrice(20.11)
            -> setVATPercentage(21)
            -> setVATIncluded(true)
            -> setVATType(1);
    $invoiceLine_2 = (new \Yuki\Model\InvoiceLine())
            -> setDescription('Product 2')
            -> setProductQuantity(1)
            -> setProduct($product_2);
    $contact = (new \Yuki\Model\Contact())
            -> setContactCode(123)
            //-> setFullName('Bert Maurau')
            -> setFirstName('Bert')
            -> setLastName('Maurau')
            -> setContactType('Person')
            -> setCountryCode('BE');

    $salesInvoice = (new \Yuki\Model\SalesInvoice())
            -> setReference('20170004')
            -> setSubject("Test Invoice")
            -> setPaymentMethod('Cash')
            -> setProcess(true)
            -> setEmailTocustomer(false)
            -> setDate('2018-01-01')
            -> setDueDate('2018-02-01')
            -> setContact($contact)
            -> addInvoiceLine($invoiceLine_1)
            -> addInvoiceLine($invoiceLine_2);

    $invoices = array($salesInvoice);


    print_r($yuki -> processSalesInvoices($invoices));
} catch (\Exception $ex) {
    echo $ex -> getMessage();
    exit;
}