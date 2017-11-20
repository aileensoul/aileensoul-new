<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //AWS access info start
        $this->load->library('S3');
        //AWS access info end
        $this->load->library('form_validation');
        $this->load->model('email_model');

        include ('include.php');
    }

    public function index() {
        $this->data['login_header'] = $this->load->view('login_header', $this->data, TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data, TRUE);
        $this->load->view('feedback/feedback', $this->data);
    }

    public function feedback_insert() {
        $feedback_firstname = $_POST['feedback_firstname'];
        $feedback_lastname = $_POST['feedback_lastname'];
        $feedback_email = $_POST['feedback_email'];
        $subject = $_POST['feedback_subject'];
        $message = $_POST['feedback_message'];
        $toemail = "dshah1341@gmail.com";
        $touser =  $_POST['feedback_email']; 
        

        $data = array(
            'first_name' => $feedback_firstname,
            'last_name' => $feedback_lastname,
            'user_email' => $feedback_email,
            'subject' => $subject,
            'description' => $message,
            'created_date' => date('Y-m-d h:i:s', time()),
            'is_delete' => 0
        );
        $insert_id = $this->common->insert_data_getid($data, 'feedback');
        if ($insert_id) {

                    $email_html = '';
                     $email_html .= '<table  width="100%" cellpadding="0" cellspacing="0" style="font-family:arial;font-size:13px;">
                    <tr><td style="padding-left:20px;">Hi admin!<br><br>
                         <p style="padding-left:70px;"> You have recevied a new feedback  from user  while you were away..</p><br></td></tr>';
                     $email_html .= '<tr><td style="padding-bottom: 3px;padding-left:20px;">';
                     $email_html .= 'The user feedback detail follows:';
                     $email_html .= '</td></tr>';
                     $email_html .= '<tr><td style="padding-bottom: 3px;padding-left:20px;">';
                     $email_html .= '<b>Name</b> :'. $feedback_firstname .' '. $feedback_lastname;
                     $email_html .= '<br></td></tr>';
                     $email_html .= '<tr><td style="padding-bottom: 3px;padding-left:20px;">';
                     $email_html .= '<b>Email-Address</b> : '. $feedback_email;
                     $email_html .= '</td></tr>';
                     $email_html .= '<tr><td style="padding-bottom: 3px;padding-left:20px;">';
                     $email_html .= '<b>Message</b> : '. $message;
                     $email_html .= '</td></tr>';

                     $email_html .= '</tr></table>';
                
                   // echo $email_html;

                    $send_email = $this->email_model->send_email($subject = $subject, $templ = $email_html, $to_email = $toemail);


                    $email_user = '';
                     $email_user .= '<table  width="100%" cellpadding="0" cellspacing="0" style="font-family:arial;font-size:13px;">
                    <tr><td style="padding-left:20px;">Thank you. Your Feedback is important for us.!!<br><br>
                         <p style="padding-left:0px; padding-bottom: 20px;"> Your Message has been  received and will be reviewed by the aileensoul team. We appreciate your assistance in making the aileensoul better.</p><br></td></tr>';                    
                     $email_user .= '<tr><td style="padding-bottom: 3px;padding-left:20px;">';
                     $email_user .= 'Thanks & regards,';
                      $email_user .= '<br></td></tr>';
                       $email_user .= '<tr><td style="padding-bottom: 3px;padding-left:20px;">';
                     $email_user .= 'Aileensoul team.';
                      $email_user .= '</td></tr>';
                     $email_user .= '</table>';

                     $send_user = $this->email_model->send_email($subject = $subject, $templ = $email_user, $to_email = $touser);

            echo "ok";
        }
    }
}
