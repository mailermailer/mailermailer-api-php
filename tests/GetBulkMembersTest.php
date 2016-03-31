<?php

require_once("test_config.php");

class GetBulkMembers extends PHPUnit_Framework_TestCase
{
    protected $mailapi;
    
    protected $email1;
    protected $email2;
    protected $email3;

    protected $member1;
    protected $member2;
    protected $member3;


    protected function setUp()
    {
        include 'test_vars.php';

        $this->mailapi = new MAILAPI_Client($test_apikey);

        $this->email1 = $test_email1;
        $this->email2 = $test_email2;
        $this->email3 = $test_email3;

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
            $this->member1[$formfield["fieldname"]] = $value;
            $this->member2[$formfield["fieldname"]] = $value;
            $this->member3[$formfield["fieldname"]] = $value;
        }

        $this->member1["user_email"] = $this->email1;
        $this->member2["user_email"] = $this->email2;
        $this->member3["user_email"] = $this->email3;

        $response = $this->mailapi->addBulkMembers(array($this->member1, $this->member2, $this->member3));
        $expected = array('added' => 3, 'updated' => 0, 'errors' => array(), 'report' => $response);
        $this->assertEquals(1, $this->checkReport($expected));


        
        sleep(2);
    }

    public function testContainsNewMembers()
    {
        $date_after = date('Y-m-d H:i:s', time() - (60 * 60));
        $date_before = date('Y-m-d H:i:s', time() + (60 * 60));

        $response = $this->mailapi->getBulkMembers(200, 0, $date_after, $date_before, null, null, null, null);
        $collectEmails = array_map(function($member){
            return $member["user_email"];
        }, $response);

        $this->assertNotInstanceOf('MAILAPI_Error', $response);
        $this->assertContains($this->email1, $collectEmails);
        $this->assertContains($this->email2, $collectEmails);
        $this->assertContains($this->email3, $collectEmails);
    }

    ///////////////////////////////////////////////////////////////
    //
    // HELPER FUNCTION
    //
    ////////////////////////////////////////////////////////////////
    public function checkReport($params)
    {
        $added = $params["added"];
        $updated = $params["updated"];
        $errors = $params["errors"];

        $report = $params["report"];
        
        if (count($errors)) {
            foreach ($report["errors"] as $value) {
                if ($errors[$value["email"]]) {
                    if ($errors[$value["email"]] > 1) {
                        $errors[$value["email"]]--;
                    }
                    else {
                        unset($errors[$value["email"]]);
                    }
                }
            }
        }
        return ($added == $report["added"] && $updated == $report["updated"] && count($errors) == 0);
    }
}
?>