<?php

/**
 * Refer to license.php for file headers and license
 */

require_once('MAILAPI_Call.php');

/**
 * Class that implements all the method calls available through
 * the Mail API.
 */
class MAILAPI_Client
{

    private $mailapi_call;

    public function __construct($apikey)
    {
        $this->mailapi_call = new MAILAPI_Call($apikey);
    }

    /**
     * Ping the Mail API. This simple method will return "true"
     * if you can connect with the API, or an exception if you cannot.
     *
     * @return true | MAILAPI_Error
     */
    public function ping()
    {
        $params = array();
        $result = $this->mailapi_call->executeMethod('ping', $params);
        return $result;
    }

    /**
     * Returns the fields needed to create a list member or to create/populate a signup form.
     *
     * @return formfields_struct | MAILAPI_Error
     */
    public function getFormFields()
    {
        $params = array();
        $result = $this->mailapi_call->executeMethod('getFormFields', $params);
        return $result;
    }

    /**
     * Add a collection of members records to the account email list.
     *
     * @param array   $member a member struct
     * @param boolean $send_invite flag to send double opt-in confirmation message, defaults to true
     * @param boolean $send_welcome flag to send welcome message, defaults to false
     * @param boolean $update_existing flag to control whether existing list members should be updated rather than throwing an exception, defaults to false
     * @param boolean $enforce_required flag to control whether missing required fields as specified by account configuration should throw an exception, defaults to true
     * @return true | MAILAPI_Error
     */
    public function addBulkMembers($members, $send_invite = true, $send_welcome = false, $update_existing = false, $enforce_required = true)
    {
        $params                     = array();
        $params['members']          = php_xmlrpc_encode($members);
        $params['send_invite']      = php_xmlrpc_encode($send_invite);
        $params['send_welcome']     = php_xmlrpc_encode($send_welcome);
        $params['update_existing']  = php_xmlrpc_encode($update_existing);
        $params['enforce_required'] = php_xmlrpc_encode($enforce_required);
        $result = $this->mailapi_call->executeMethod('addBulkMembers', $params);
        return $result;
    }

    /**
     * Add the specified member record to the account email list.
     *
     * @param array   $member a member struct
     * @param boolean $send_invite flag to control if double opt-in confirmation message is sent, defaults to true
     * @param boolean $send_welcome flag to send welcome message, defaults to false
     * @param boolean $update_existing flag to control whether existing list members should be updated rather than throwing an exception, defaults to false
     * @param boolean $enforce_required flag to control whether missing required fields as specified by account configuration should throw an exception, defaults to true
     * @return true | MAILAPI_Error
     */
    public function addMember($member, $send_invite = true, $send_welcome = false, $update_existing = false, $enforce_required = true)
    {
        $params                     = array();
        $params['member']           = php_xmlrpc_encode($member);
        $params['send_invite']      = php_xmlrpc_encode($send_invite);
        $params['send_welcome']     = php_xmlrpc_encode($send_welcome);
        $params['update_existing']  = php_xmlrpc_encode($update_existing);
        $params['enforce_required'] = php_xmlrpc_encode($enforce_required);
        $result = $this->mailapi_call->executeMethod('addMember', $params);
        return $result;
    }

    /**
    * Return a collection of member records.
    * 
    * @param int       $limit The maximum number of records to return, defaults to the maximum of 200
    * @param int       $offset The starting point within the paginated results (use in combination with limit), defaults to 0
    * @param timestamp $signup_after The starting signup time from which to return records, in UTC, e.g., 2016-03-30 14:15:30
    * @param timestamp $singup_before The ending signup time from which to return records, in UTC, e.g., 2016-03-30 14:15:30
    * @param timestamp $updated_after The starting last updated time from which to return records, in UTC, e.g., 2016-03-30 14:15:30
    * @param timestamp $updated_before The ending last updated time from which to return records, in UTC, e.g., 2016-03-30 14:15:30
    * @param timestamp $unsubscribed_after The starting unsubscribed time from which to return records, in UTC, e.g., 2016-03-30 14:15:30
    * @param timestamp $unsubscribed_before The ending unsubscribed time from which to return records, in UTC, e.g., 2016-03-30 14:15:30 
    * @return export_struct | MAILAPI_Error
    */
    public function getBulkMembers($limit = 200, $offset = 0, $signup_after, $signup_before, $updated_after, $updated_before, $unsubscribed_after, $unsubscribed_before)
    {
        $params                        = array();
        $params['limit']               = php_xmlrpc_encode($limit);
        $params['offset']              = php_xmlrpc_encode($offset);
        $params['signup_after']        = php_xmlrpc_encode($signup_after);
        $params['singup_before']       = php_xmlrpc_encode($signup_before);
        $params['updated_after']       = php_xmlrpc_encode($updated_after);
        $params['updated_before']      = php_xmlrpc_encode($updated_before);
        $params['unsubscribed_after']  = php_xmlrpc_encode($unsubscribed_after);
        $params['unsubscribed_before'] = php_xmlrpc_encode($unsubscribed_before);
        $result = $this->mailapi_call->executeMethod('getBulkMembers', $params);
        return $result;
    }

    /**
    * Return the member record.
    *
    * @param string $user_token Either user_email, which is the member's email (e.g., johnsmith@email.com) or user_enc, which is the member's permanent id (e.g., 01234a-56789b)
    * @return export_struct | MAILAPI_Error
    */
    public function getMember($user_token)
    {
        $params               = array();
        $params['user_token'] = php_xmlrpc_encode($user_token);
        $result = $this->mailapi_call->executeMethod('getMember', $params);
        return $result;
    }

    /**
     * Unsubscribe a collection of member email addresses from the account list.
     *
     * @param array $user_tokens emails of the members to unsubscribe
     * @return true | MAILAPI_Error
     */
    public function unsubBulkMembers($user_tokens)
    {
        $params                 = array();
        $params['user_tokens']   = php_xmlrpc_encode($user_tokens);
        $result = $this->mailapi_call->executeMethod('unsubBulkMembers', $params);
        return $result;
    }

    /**
     * Unsubscribe the email address from the account email list.
     *
     * @param string $user_token Either user_email, which is the member's email (e.g., johnsmith@email.com) or user_enc, which is the member's permanent id (e.g., 01234a-56789b)
     * @return true | MAILAPI_Error
     */
    public function unsubMember($user_token)
    {
        $params                 = array();
        $params['user_token']   = php_xmlrpc_encode($user_token);
        $result = $this->mailapi_call->executeMethod('unsubMember', $params);
        return $result;
    }

    /**
     * Suppress the member email address.
     *
     * @param string $user_token Either user_email, which is the member's email (e.g., johnsmith@email.com) or user_enc, which is the member's permanent id (e.g., 01234a-56789b)
     * @return true | MAILAPI_Error
     */
    public function suppressMember($user_token)
    {
        $params                 = array();
        $params['user_token']   = php_xmlrpc_encode($user_token);
        $result = $this->mailapi_call->executeMethod('suppressMember', $params);
        return $result;
    }

    /**
     * Unsuppress the member email address.
     *
     * @param string $user_token Either user_email, which is the member's email (e.g., johnsmith@email.com) or user_enc, which is the member's permanent id (e.g., 01234a-56789b)
     * @return true | MAILAPI_Error
     */
    public function unsuppressMember($user_token)
    {
        $params                 = array();
        $params['user_token']   = php_xmlrpc_encode($user_token);
        $result = $this->mailapi_call->executeMethod('unsuppressMember', $params);
        return $result;
    }

    /**
    * Update an existing specified list member.
    *
    * @param string $user_token Either user_email, which is the member's email (e.g., johnsmith@email.com) or user_enc, which is the member's permanent id (e.g., 01234a-56789b) 
    * @param member_struct $member A single member record
    * @param boolean $enforce_required Flag to control whether missing required fields as specified by account configuration should throw an exception, defaults to true
    * @param boolean $send_invite Flag to control if double opt-in confirmation message is sent, defaults to true
    * @return true | MAILAPI_Error
    */
    public function updateMember($user_token, $member, $enforced_required = true, $send_invite = true)
    {
        $params                     = array();
        $params['user_token']       = php_xmlrpc_encode($user_token);
        $params['member']           = php_xmlrpc_encode($member);
        $params['enforce_required'] = php_xmlrpc_encode($enforce_required);
        $params['send_invite']      = php_xmlrpc_encode($send_invite);
        $result = $this->mailapi_call->executeMethod('unsuppressMember', $params);
        return $result;
    }
}

?>
