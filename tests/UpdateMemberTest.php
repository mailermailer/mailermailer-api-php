<?php

require_once("test_config.php");

class UpdateMember extends PHPUnit_Framework_TestCase
{
    protected $mailapi;
    protected $email;
    protected $member;

    protected function setUp()
    {
        include 'test_vars.php';

        $this->mailapi = new MAILAPI_Client($test_apikey);
        $this->email = $test_email1;

        $formfields = $this->mailapi->getFormFields();

        foreach ($formfields as $formfield) {
            $value;
            if ($formfield["type"] == 'select') {
                if ($formfield["attributes"]["select_type"] == 'multi') {
                    $value = array("a","b","c","d");            
                } else {
                    $value = array("a");
                }
            } elseif ($formfield["type"] == 'open_text') {
                $value = "ANYTHING";
            } elseif ($formfield["type"] == 'state') {
                $value = "md";
            } elseif ($formfield["type"] == 'country') {
                $value = "us";
            }
            $this->member[$formfield["fieldname"]] = $value;
        }

        $this->member["user_email"] = $this->email;

        $response = $this->mailapi->addMember($this->member);
        $this->assertEquals(1, $response);
        
        sleep(2);
    }

    public function testSuccess()
    {
        $response = $this->mailapi->updateMember($this->email, $this->member);
        $this->assertNotInstanceOf('MAILAPI_Error', $response);
    }

    public function testBadUpdate()
    {
        $bad_member = $this->member;
        $bad_member["user_email"] = "bad value";
        $response = $this->mailapi->updateMember($this->email, $bad_member);
        $this->assertEquals(302, $response->getErrorCode());
    }
}

?>