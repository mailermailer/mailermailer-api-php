<?php

include("../mmapi_rpc.php");

$subscriber = array();

// Open text fields
$subscriber['user_email'] = 'a@a.com';
$subscriber['user_fname'] = 'John';
$subscriber['user_lname'] = 'Doe';

// Country
$subscriber['user_country'] = 'us';

// State
$subscriber['user_state'] = 'md';

// Category fields with multiple selection (checkboxes)
$subscriber['user_attr1'] = array('a','b','c','d');

// Category fields with single selection (dropdown menu)
$subscriber['user_attr2'] = array('a');

// Create our API object
$MMAPI_RPC = new mmapi_rpc('api key');

// Add the subscriber
$response = $MMAPI_RPC->addSubscriber($subscriber);

// Evaluate response
if (mmapi_rpc_error::isError($response)) {
    echo "Error \n";
    echo "Code: " . $response->getErrorCode() . "\n";
    echo "Message: ". $response->getErrorMessage() . "\n";
} else {
    echo "Success added subscriber\n";
}

?>
