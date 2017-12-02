<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message_model extends CI_Model {

    function add_message($message, $userid, $id, $message_from_profile, $message_from_profile_id, $message_to_profile, $message_to_profile_id) {
        date_default_timezone_set('Asia/Kolkata');
        $data1 = array(
            'message' => (string) $message,
            'message_from' => (string) $userid,
            'message_to' => (string) $id,
            'message_from_profile' => (int) $message_from_profile,
            'message_from_profile_id' => (int) $message_from_profile_id,
            'message_to_profile' => (int) $message_to_profile,
            'message_to_profile_id' => (int) $message_to_profile_id,
            'timestamp' => time() + 92,
        );

        $this->db->insert('messages', $data1);
        $msg_insert_id = $this->db->insert_id();

        if ($message_from_profile == 1) {
            $not_from = 2;
        } elseif ($message_from_profile == 2) {
            $not_from = 1;
        } elseif ($message_from_profile == 3) {
            $not_from = 5;
        } elseif ($message_from_profile == 4) {
            $not_from = 4;
        } elseif ($message_from_profile == 5) {
            $not_from = 6;
        } else {
            $not_from = 3;
        }
        if ($this->uri->segment(3) == $id) {
            $not_active = 1;
        } else {
            $not_active = 1;
        }
        $data2 = array(
            'not_type' => '2',
            'not_from_id' => $userid,
            'not_to_id' => $id,
            'not_read' => '2',
            'not_img' => '0',
            'not_active' => $not_active,
            'not_from' => $not_from,
            'not_product_id' => $msg_insert_id,
            'not_created_date' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('notification', $data2);
        return $msg_insert_id;
    }

    function getBusinessUserChatList($business_profile_id = '') {
        $this->db->select("b.business_profile_id,b.company_name,b.business_user_image,b.user_id,m.message,m.id")->from("business_profile  b");
        $this->db->join('messages m', 'b.business_profile_id = (CASE WHEN m.message_from_profile_id='.$business_profile_id.' THEN m.message_to_profile_id ELSE m.message_from_profile_id END)');
        $this->db->where("m.message_from_profile_id='".$business_profile_id."' OR m.message_to_profile_id='".$business_profile_id."' AND b.status = '1' AND b.business_step = '4' AND m.is_deleted = '0' and m.message_from_profile = '5' AND m.message_to_profile = '5'");
        $this->db->order_by("m.id", "DESC");
        $this->db->group_by("(CASE WHEN m.message_from_profile_id='".$business_profile_id."' THEN m.message_to_profile_id ELSE m.message_from_profile_id END)");
        $query = $this->db->get();
        $result_array = $query->result_array();
//        echo '<pre>';
//        print_r($result_array);
//        exit;
        return $result_array;
    }

}
