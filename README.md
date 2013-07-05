# mmapi_rpc

A PHP wrapper using the [PHPXMLRPC](http://phpxmlrpc.sourceforge.net/) library to connect to the MailerMailer API.

##Requirements

PHP 5

## Installation

Just place mmapi_rpc in a directory accessible by your application

## Usage

Create a mmapi_rpc instance:

    $MMAPI_RPC = new mmapi_rpc('api key');
  
Start making calls

    $response = $MMAPI_RPC->getFormFields();

Handle the response appropriately

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
Checking the success or failure of any call can be easily done by invoking `mmapi_rpc_error::isError` on the response.
If the call encountered an error then the response will be of type Error and `isError` will return true, otherwise the call succeeded.
Every error will have an associated error code and message which can be retrieved through the Error class getter methods as seen in the example above.

For the official documentation of the Mailermailer XML-RPC API please visit [here](http://www.mailermailer.com/api/index.rwp).

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request
