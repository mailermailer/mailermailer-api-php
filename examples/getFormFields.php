<?php

include("../MMAPI_Client.php");

// Create our API object
$mmapi = new MMAPI_Client('api key');

// Get form fields
$response = $mmapi->getFormFields();

// Evaluate response
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

?>
