<?php

include("../MMAPI_Client.php");

// Make sure we have an api key
if (getenv('MMAPI_KEY') == null) {
  exit('Set setenv("MMAPI_KEY") to use this example');
}

// Create our API object
$mmapi = new MMAPI_Client(getenv('MMAPI_KEY'));

// Ping the server
$response = $mmapi->ping();

// Evaluate response
if (MMAPI_Error::isError($response)) {
    echo "Error \n";
    echo "Code: " . $response->getErrorCode() . "\n";
    echo "Message: ". $response->getErrorMessage() . "\n";
} else {
    echo "Success\n";
}

?>
