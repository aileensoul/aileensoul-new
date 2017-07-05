<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');







class Email_model extends CI_Model

{

    

    /*	

	 *	Developed by: Active IT zone

	 *	Date	: 14 July, 2015

	 *	Active Supershop eCommerce CMS

	 *	http://codecanyon.net/user/activeitezone

	 */

    

    function __construct()

    {

        parent::__construct();

    }

    

    

    function password_reset_email($account_type = '', $id = '', $pass = '')

    {

        $this->load->database();

        $system_name  = $this->db->get_where('general_settings', array(

            'type' => 'system_name'

        ))->row()->value;

        $system_email = $this->db->get_where('general_settings', array(

            'type' => 'system_email'

        ))->row()->value;

        

        $query = $this->db->get_where($account_type, array(

            $account_type . '_id' => $id

        ));

        if ($query->num_rows() > 0) {

            $email_msg = "Your account type is : " . $account_type . "<br />";

            $email_msg .= "Your password is : " . $pass . "<br />";

            $email_sub = "Password reset request";

            $from      = $system_email;

            $from_name = $system_name;

            $email_to  = $query->row()->email;

            $this->do_email($email_msg, $email_sub, $email_to, $from);

            return true;

        } else {

            return false;

        }

    }

    function status_email($account_type = '', $id = '')

    {

        $this->load->database();

        $system_name  = $this->db->get_where('general_settings', array(

            'type' => 'system_name'

        ))->row()->value;

        $system_email = $this->db->get_where('general_settings', array(

            'type' => 'system_email'

        ))->row()->value;

        

        $query = $this->db->get_where($account_type, array(

            $account_type . '_id' => $id

        ));

        if ($query->num_rows() > 0) {

            $email_msg = "Your account type is : " . $account_type . "<br />";

            if($query->row()->status == 'approved'){

                $email_msg .= "Your account is : Approved<br />";

            } else {

                $email_msg .= "Your account is : Postponed<br />";

            }

            $email_sub = "Account Status Change";

            $from      = $system_email;

            $from_name = $system_name;

            $email_to  = $query->row()->email;

            $this->do_email($email_msg, $email_sub, $email_to, $from);

            return true;

        } else {

            return false;

        }

    }

    

    

    function membership_upgrade_email($vendor)

    {

        $this->load->database();

        $account_type = 'vendor';

        $system_name  = $this->db->get_where('general_settings', array(

            'type' => 'system_name'

        ))->row()->value;

        $system_email = $this->db->get_where('general_settings', array(

            'type' => 'system_email'

        ))->row()->value;

        

        $query = $this->db->get_where($account_type, array(

            $account_type . '_id' => $id

        ));

        if ($query->num_rows() > 0) {

            if($query->row()->membership == '0'){

                $email_msg = "Your Membership Type is reduced to : Default <br />";

            } else {

                $email_msg = "Your Membership Type is upgraded to : " . $this->db->get_where('membership',array('membership_id'=>$query->row()->membership))->row()->title . "<br />";

            }

            $email_sub = "Membership Upgrade";

            $from      = $system_email;

            $from_name = $system_name;

            $email_to  = $query->row()->email;

            $this->do_email($email_msg, $email_sub, $email_to, $from);

            return true;

        } else {

            return false;

        }

    }

    

    function account_opening($account_type = '', $email = '', $pass = '')

    {

        $this->load->database();

        $system_name  = $this->db->get_where('general_settings', array(

            'type' => 'system_name'

        ))->row()->value;

        $system_email = $this->db->get_where('general_settings', array(

            'type' => 'system_email'

        ))->row()->value;

        

        $query = $this->db->get_where($account_type, array(

            'email' => $email

        ));

        if ($query->num_rows() > 0) {

            $password  = $pass;

            $email_msg = "Thanks for your registration in : " . $system_name . "<br />";

            $email_msg = "Your account type is : " . $account_type . "<br />";

            $email_msg .= "Your password is : " . $pass . "<br />";

            if($account_type == 'vendor'){

                $email_msg .= "login here: <a href='".base_url()."index.php/vendor/'>".base_url()."index.php/vendor</a>";

                $email_msg .= "<br>Your account is now being reviewed. Please wait for Admin approval.";

            }

            if($account_type == 'user'){



            }

            if($account_type == 'admin'){

                $email_msg .= "login here: <a href='".base_url()."index.php/admin/'>".base_url()."index.php/admin</a>";

            }

            $email_sub = "Account Opening";

            if ($account_type == 'admin') {

                $to_name = $query->row()->name;

            } elseif ($account_type == 'user') {

                $to_name = $query->row()->username;

            } elseif ($account_type == 'user') {

                $to_name = $query->row()->dispaly_name;

            }

            $from      = $system_email;

            $from_name = $system_name;

            $email_to  = $email;

            

            $this->do_email($email_msg, $email_sub, $email_to, $from);

            return true;

        } else {

            return false;

        }

    }

    

    

    

    function newsletter($title = '', $text = '', $email = '', $from = '')

    {

        $this->do_email($text, $title, $email, $from);

    }

    

    

    

    /***custom email sender****/

    

  /*  function do_email($msg = NULL, $sub = NULL, $to = NULL, $from = NULL)

    {    echo $to; '<br>'; echo $from; die();
        $this->load->database();

        $system_name = $this->db->get_where('general_settings', array(

            'type' => 'system_name'

        ))->row()->value;

        if ($from == NULL)

            $from = $this->db->get_where('general_settings', array(

                'type' => 'system_email'

            ))->row()->value;

      

        

        // Always set content-type when sending HTML email

        

        $headers = "MIME-Version: 1.0" . "\r\n";

        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: ' . $system_name . '<' . $from . '>' . "\r\n";

        $headers .= "Reply-To: " . $system_name . '<' . $from . '>' . "\r\n";

        $headers .= "Return-Path: " . $system_name . '<' . $from . '>' . "\r\n";

        $headers .= "X-Priority: 3\r\n";

        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

        $headers .= "Organization: " . $system_name . "\r\n";

		

        @mail($to, $sub, $msg, $headers, "-f " . $from);

      //  show_error($this->email->print_debugger()); die();

        

    }*/
	
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL, $attachment_url=NULL)
    { 
        
       $this->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "mail.wwsptech.com";
        $config['smtp_port'] = "587";
        $config['smtp_user'] = "test@wwsptech.com";
        $config['smtp_pass'] = "test123";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $this->email->initialize($config);

        // $system_name    =   $this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
        // if ($from == NULL)
        //     $from       =   $this->db->get_where('settings' , array('type' => 'system_email'))->row()->description;
        $system_name ="khyati";
        // attachment
        //if ($attachment_url != NULL)
        //  $this->email->attach( $attachment_url );
            
         $this->email->from('test@wwsptech.com', 'Aileensolution');
        $this->email->to($to);
        $this->email->reply_to('no-replay@winspirewebsolution.com', 'Explendid Videos');
        $this->email->subject($sub);
        $this->email->message($msg);
        $this->email->send();
   
        //echo $this->email->print_debugger();
    }
    

    

    

}