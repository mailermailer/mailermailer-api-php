<?php

include("../MMAPI_Client.php");

$subscriber = array();

// Open text fields
$subscriber['user_email'] = 'johndoe@example.com';
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
$mmapi = new MMAPI_Client('api key');

// Add the subscriber
$response = $mmapi->addSubscriber($subscriber);

// Evaluate response
if (MMAPI_Error::isError($response)) {
    echo "Error \n";
    echo "Code: " . $response->getErrorCode() . "\n";
    echo "Message: ". $response->getErrorMessage() . "\n";
} else {
    echo "Success added subscriber\n";
}

?>
