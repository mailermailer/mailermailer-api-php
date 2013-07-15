<?php
/**
 * MailerMailer API RPC Wrapper
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

require_once('xmlrpc/xmlrpc.inc');
require_once('MMAPI_Error.php');

/**
 * Class that performs all the required work to
 * connect to the mailermailer API.
 */
class MMAPI_Call
{

    private $apikey;

    public function __construct($apikey)
    {
        $this->apikey = $apikey;
    }

    /**
     * Connects to the mailermailer API and calls the desired
     * function with the specified parameters
     * 
     * @param  method to invoke and parameters for the method
     * @return mixed
     */
    public function executeMethod($method, $params)
    {
        $host = getenv("MMAPI_URL");

        $params['apikey'] = new xmlrpcval($this->apikey);
        
        $xmlrpcmsg = new xmlrpcmsg($method, array(new xmlrpcval($params, 'struct')));
        $xmlrpc_client = new xmlrpc_client($host);
        $xmlrpc_client->SetUserAgent("MM/PHP/v1.0");

        $response = $xmlrpc_client->send($xmlrpcmsg);

        if (!$response->faultCode()) {
            return $response->value();
        } else {
            $value = $response->value();
            return new MMAPI_Error($response->faultCode(), $response->faultString());
        }
    }   
}

?>