<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Chat_model');
        $this->load->model('common');
    }

    public function send_message($id = '') {

         $userid = $this->session->userdata('aileenuser');
        $message = $this->input->get('message', null);
        //$message = $this->common->make_links($message);
        $message = $message;
        $nickname = $this->input->get('nickname', '');
        $guid = $this->input->get('guid', '');

        $this->Chat_model->add_message($message, $nickname, $guid, $userid, $id);
        $this->_setOutput($message);
    }

    public function get_messages($id) {
        $userid = $this->session->userdata('aileenuser');

        $timestamp = $this->input->get('timestamp', null);

        $messages = $this->Chat_model->get_messages($timestamp, $userid, $id);
        $i = 0;
        foreach ($messages as $mes) {
            if (preg_match('/<img/', $mes['message'])) {
                $messages[$i]['message'] = $mes['message'];
            } else {
                $messages[$i]['message'] = $this->common->make_links($mes['message']);
            }
            $i++;
        }

        $this->_setOutput($messages);
    }

    private function _setOutput($data) {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        echo json_encode($data);
    }

}
