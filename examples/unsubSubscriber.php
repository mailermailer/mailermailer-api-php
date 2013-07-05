<?php

include("../mmapi_rpc.php");

// Create our API object
$MMAPI_RPC = new mmapi_rpc('api key');

// Unsubscribe user
$response = $MMAPI_RPC->unsubSubscriber('email to unsubscribe');

// Evaluate response
if (mmapi_rpc_error::isError($response)) {
    echo "Error \n";
    echo "Code: " . $response->getErrorCode() . "\n";
    echo "Message: ". $response->getErrorMessage() . "\n";
} else {
    echo "Success\n";
}

?>
