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
        

        $data = array(
            'first_name' => $feedback_firstname,
            'last_name' => $feedback_lastname,
            'user_email' => $feedback_email,
            'subject' => $subject,
            'description' => $message,
            'created_date' => date('Y-m-d', time()),
            'is_delete' => 0
        );
        $insert_id = $this->common->insert_data_getid($data, 'feedback');
        if ($insert_id) {

                    $email_html = '';

                    $email_html .= '<table width="100%" cellpadding="0" cellspacing="0">
                    <tr><td>Hi admin!
                     You have recevied a new feedback  from user  while you were away..</td><td>The user feedback detail follows:</td>';
                     
                     $email_html .= '<td>';
                     $email_html .= 'Name:'. $feedback_firstname .' '. $feedback_lastname;
                      $email_html .= '</td>';
                       $email_html .= '<td>';
                     $email_html .= 'Email Address:'. $feedback_email;
                      $email_html .= '</td>';
                       $email_html .= '<td>';
                     $email_html .= 'Message:'. $message;
                      $email_html .= '</td>';

                    $email_html .= '</tr>
                                    </table>';
                
                   // echo $email_html;

                    $send_email = $this->email_model->send_email($subject = $subject, $templ = $email_html, $to_email = $toemail);

            echo "ok";
        }
    }

}
