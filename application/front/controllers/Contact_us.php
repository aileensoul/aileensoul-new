<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_us extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //AWS access info start
        $this->load->library('S3');
        $this->load->library('form_validation');
        $this->load->model('email_model');
        //AWS access info end
        include ('include.php');
    }

    public function index() {
        $contition_array = array('site_id' => 1);
        $this->data['cnt'] = $this->common->select_data_by_condition('site_settings', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $this->data['login_header'] = $this->load->view('login_header', $this->data,TRUE);
        $this->data['login_footer'] = $this->load->view('login_footer', $this->data,TRUE);
        $this->load->view('contact/contact_us', $this->data);
    }

    public function contact_us_insert() {

        $name = $_POST['contact_name'];
        $contactlast_name = $_POST['contactlast_name'];
        $email = $_POST['contact_email'];
        $subject = $_POST['contact_subject'];
        $message = $_POST['contact_message'];

        $toemail = "dshah1341@gmail.com";

        $this->form_validation->set_rules('contact_name', 'contact name', 'required');
        $this->form_validation->set_rules('contactlast_name', 'contact name', 'required');

        $this->form_validation->set_rules('contact_email', 'contact email', 'required|valid_email');
        $this->form_validation->set_rules('contact_subject', 'contact subject', 'required');
        $this->form_validation->set_rules('contact_message', 'contact message', 'required');


        $data = array(
            'contact_name' => $name,
            'contact_lastname' => $contactlast_name,
            'contact_email' => $email,
            'contact_subject' => $subject,
            'contact_message' => $message,
            'created_date' =>date('Y-m-d', time()),
            'is_delete' => 0
        );
        $insert_id = $this->common->insert_data_getid($data, 'contact_us');
        if ($insert_id) {

             $email_html = '';

                    $email_html .= '<table width="100%" cellpadding="0" cellspacing="0">
                    <tr><td>Hi admin!
        You have received a message from visitor while you were away.</td><td>The user message detail follows:</td>';
                     
                     $email_html .= '<td>';
                     $email_html .= 'Name:'. $name .' '. $contactlast_name;
                      $email_html .= '</td>';
                       $email_html .= '<td>';
                     $email_html .= 'Email Address:'. $email;
                      $email_html .= '</td>';
                       $email_html .= '<td>';
                     $email_html .= 'Subject:'. $subject;
                      $email_html .= '</td>';
                       $email_html .= '<td>';
                     $email_html .= 'Message:'. $message;
                      $email_html .= '</td>';

                    $email_html .= '</tr>
                                    </table>';
                   // $subject = $name.' '.$contactlast_name. 'Contact you in Aileensoul.';

                   // echo $email_html;

                    $send_email = $this->email_model->send_email($subject = $subject, $templ = $email_html, $to_email = $toemail);

            echo "ok";
        }
    }

}
