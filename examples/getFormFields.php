<?php

include("../mmapi_rpc.php");

// Create our API object
$MMAPI_RPC = new mmapi_rpc('api key');

// Get form fields
$response = $MMAPI_RPC->getFormFields();

// Evaluate response
if (mmapi_rpc_error::isError($response)) {
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
