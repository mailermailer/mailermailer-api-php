<?php

include("../MAILAPI_Client.php");

// Make sure we have an api key
if (getenv('MAILAPI_KEY') == null) {
  exit('Set setenv("MAILAPI_KEY") to use this example');
}

// Make sure we have an email address
if (getenv('MAILAPI_TEST_EMAIL') == null) {
  exit('Set setenv("MAILAPI_TEST_EMAIL") to use this example');
}

date_default_timezone_set('America/New_York');

// Create our API object
$mailapi = new MAILAPI_Client(getenv('MAILAPI_KEY'));

// Get bulk members who signed up in the past year
$date_after = date('Y-m-d H:i:s', time() - (365 * 24 * 60 * 60));
$date_before = date('Y-m-d H:i:s', time());
$response = $mailapi->getBulkMembers(10, 0, $date_after, $date_before, null, null, null, null);

if (MAILAPI_Error::isError($response)) {
    echo "Error \n";
    echo "Code: " . $response->getErrorCode() . "\n";
    echo "Message: ". $response->getErrorMessage() . "\n";
} else {
  echo "Got " . sizeof($response) . " members\n";
  echo "Here are the members:\n";
  var_dump($response);
}

?>
