<?php

include("../MMAPI_Client.php");

// Create our API object
$mmapi = new MMAPI_Client('861d353cdf5cacc06d91d4e7136450e4');

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
