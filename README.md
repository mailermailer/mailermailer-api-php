# mailermailer-api-php

A PHP wrapper using the [PHPXMLRPC](http://phpxmlrpc.sourceforge.net/) library to connect to the MailerMailer API.

##Requirements

PHP 5

## Installation

Just place mailermailer-api-php in a directory accessible by your application

## Usage

Create a MMAPI_Client instance:

    $mmapi = new MMAPI_Client('api key');
  
Start making calls

    $response = $mmapi->getFormFields();

Handle the response appropriately

    if (MMAPI_Error::isError($response)) {
        echo "Error \n";
        echo "Code: " . $response->getErrorCode() . "\n";
        echo "Message: ". $response->getErrorMessage() . "\n";
    } else {
        echo "Success\n";
        foreach ($response as $formfield) {
            echo "Fieldname: " . $formfield["fieldname"] . "\n";
            echo "Description:" . $formfield["description"] . "\n";
            echo "Type: " . $formfield["type"] . "\n\n";
        }
    }
Checking the success or failure of any call can be easily done by invoking `MMAPI_Error::isError` on the response.
If the call encountered an error then the response will be of type Error and `isError` will return true, otherwise the call succeeded.
Every error will have an associated error code and message which can be retrieved through the Error class getter methods as seen in the example above.

For the official documentation of the Mailermailer XML-RPC API please visit [here](http://www.mailermailer.com/api/index.rwp).
