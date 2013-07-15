<?php
/**
 * MailerMailer API XMLRPC Wrapper
 *
 * @author    MailerMailer <support@mailermailer.com>
 * @copyright 2001-2013 MailerMailer LLC
 * @license   This program is free software; you can redistribute it and/or modify
 *            it under the terms of the GNU General Public License as published by
 *            the Free Software Foundation; either version 2 of the License, or
 *            (at your option) any later version.
 *
 *            This program is distributed in the hope that it will be useful,
 *            but WITHOUT ANY WARRANTY; without even the implied warranty of
 *            MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *            GNU General Public License for more details.
 *
 *            You should have received a copy of the GNU General Public License
 *            along with this program; if not, write to the Free Software
 *            Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *            MA 02110-1301, USA.
 * @version   1.0.1
 * @link      http://www.mailermailer.com/api/index.rwp
 */

require_once('MMAPI_Call.php');

/**
 * Class that implements all the method calls available through
 * the mailermailer API.
 */
class MMAPI_Client
{

    private $mmapi_call;

    public function __construct($apikey)
    {
        $this->mmapi_call = new MMAPI_Call($apikey);
    }

    /**
     * Ping the MailerMailer API. This simple method will return "true"
     * if you can connect with the API, or an exception if you cannot.
     *
     * @return true | MMAPI_Error
     */
    public function ping()
    {
        $params = array();
        $response = $this->mmapi_call->executeMethod('ping', $params);
        return MMAPI_Client::getResult($response);
    }

    /**
     * Returns the fields needed to populate an add subscriber form.
     *
     * @return formfields_struct | MMAPI_Error
     */
    public function getFormFields()
    {
        $params = array();
        $response = $this->mmapi_call->executeMethod('getFormFields', $params);
        return MMAPI_Client::getResult($response);
    }

    /**
     * Add the specified subscriber record to the account email list.
     *
     * @param array   $subscriber a subscriber struct
     * @param boolean $send_invite flag to send double opt-in confirmation message, defaults to true
     * @param boolean $send_welcome flag to send welcome message, defaults to false
     * @return true | MMAPI_Error
     */
    public function addSubscriber($subscriber, $send_invite = true, $send_welcome = false)
    {
        $params                     = array();
        $params['subscriber']       = php_xmlrpc_encode($subscriber);
        $params['send_invite']      = php_xmlrpc_encode($send_invite);
        $params['send_welcome']     = php_xmlrpc_encode($send_welcome);
        $response = $this->mmapi_call->executeMethod('addSubscriber', $params);
        return MMAPI_Client::getResult($response);
    }

    /**
     * Unsubscribe the subscriber email address from the account email list.
     *
     * @param string $subscriber_email email of the subscriber to unsubscribe
     * @return true | MMAPI_Error
     */
    public function unsubSubscriber($subscriber_email)
    {
        $params                       = array();
        $params['subscriber_email']   = php_xmlrpc_encode($subscriber_email);
        $response = $this->mmapi_call->executeMethod('unsubSubscriber', $params);
        return MMAPI_Client::getResult($response);
    }
    
    /**
     * Formats the response as necessary.
     *
     * @param  mixed $response xmlrpc encoded response from server
     * @return mixed
     * @static
     */
    static function getResult($response)
    {        
        if (!MMAPI_Error::isError($response)) {
            return php_xmlrpc_decode($response);
        } else {
            return $response;
        }
    }
}


?>