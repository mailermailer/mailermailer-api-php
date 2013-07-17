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
 * @version   1.0.2
 * @link      http://www.mailermailer.com/api/index.rwp
 */

/**
 * Class that encapsulates errors that are returned from the mailermailer API
 */
class MMAPI_Error
{

    private $errorCode;
    private $errorMessage;
  
    public function __construct($errorCode, $errorMessage)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
    }
    
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    static function isError($MMAPI_OBJECT)
    {
        if ($MMAPI_OBJECT instanceof MMAPI_Error) {
            return true;
        }
        return false;
    }
}

?>