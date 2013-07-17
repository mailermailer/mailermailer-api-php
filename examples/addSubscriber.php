<?php

include("../MMAPI_Client.php");

// Make sure we have an api key
if (getenv('MMAPI_KEY') == null) {
  exit('Set setenv("MMAPI_KEY") to use this example');
}

// Make sure we have an email address
if (getenv('MMAPI_TEST_EMAIL') == null) {
  exit('Set setenv("MMAPI_TEST_EMAIL") to use this example');
}

$subscriber = array();

// Open text fields
$subscriber['user_email'] = getenv('MMAPI_TEST_EMAIL');
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
$mmapi = new MMAPI_Client(getenv('MMAPI_KEY'));

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
