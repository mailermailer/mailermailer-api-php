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
 * @version   1.0.0
 * @link      http://www.mailermailer.com/api/index.rwp
 */

require_once('mmapi_rpc_call.php');

/**
 * Class that implements all the method calls available through
 * the mailermailer API.
 */
class mmapi_rpc
{

    private $mmapi_rpc_call;

    public function __construct($apikey)
    {
        $this->mmapi_rpc_call = new mmapi_rpc_call($apikey);
    }

    /**
     * Returns the fields needed to populate signup form.
     *
     * @return formfields_struct | mmapi_rpc_error
     */
    public function getFormFields()
    {
        $params = array();
        $response = $this->mmapi_rpc_call->executeMethod('getFormFields', $params);
        return mmapi_rpc::getResult($response);
    }

    /**
     * Add the specified subscriber record.
     *
     * @param array   $subscriber a subscriber struct
     * @param boolean $send_invite flag to send double opt-in confirmation message, defaults to true
     * @param boolean $send_welcome flag to send welcome message, defaults to false
     * @return true | mmapi_rpc_error
     */
    public function addSubscriber($subscriber, $send_invite = true, $send_welcome = false)
    {
        $params                     = array();
        $params['subscriber']       = php_xmlrpc_encode($subscriber);
        $params['send_invite']      = php_xmlrpc_encode($send_invite);
        $params['send_welcome']     = php_xmlrpc_encode($send_welcome);
        $response = $this->mmapi_rpc_call->executeMethod('addSubscriber', $params);
        return mmapi_rpc::getResult($response);
    }

    /**
     * Unsubscribe subscriber from the account email list.
     *
     * @param string $subscriber_email email of the subscriber to unsubscribe
     * @return true | mmapi_rpc_error
     */
    public function unsubSubscriber($subscriber_email)
    {
        $params                       = array();
        $params['subscriber_email']   = php_xmlrpc_encode($subscriber_email);
        $response = $this->mmapi_rpc_call->executeMethod('unsubSubscriber', $params);
        return mmapi_rpc::getResult($response);
    }
    
    /**
     * Format the response as necessary
     *
     * @param  mixed $response xmlrpc encoded response from server
     * @return mixed
     * @static
     */
    static function getResult($response)
    {        
        if (!mmapi_rpc_error::isError($response)) {
            return php_xmlrpc_decode($response);
        } else {
            return $response;
        }
    }
}


?>