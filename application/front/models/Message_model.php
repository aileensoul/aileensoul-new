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
        $this->db->select('b.business_profile_id,b.company_name,b.business_user_image,b.user_id,m.message')->from('business_profile b');
        $this->db->join('messages m', 'm.message_to_profile_id = b.business_profile_id');
        $this->db->where(array('b.status' => '1', 'b.business_step' => '4', 'm.is_deleted' => '0', 'm.message_from_profile' => '5', 'm.message_to_profile' => '5', 'm.message_from_profile_id' => $business_profile_id));
        $this->db->group_by('m.message_to_profile_id');
        $this->db->order_by('m.id', 'desc');
        $query1 = $this->db->get();
        $query1 = $query1->result_array();

        $this->db->select('bs.business_profile_id,bs.company_name,bs.business_user_image,bs.user_id,ms.message')->from('business_profile bs');
        $this->db->join('messages ms', 'ms.message_from_profile_id = bs.business_profile_id');
        $this->db->where(array('bs.status' => '1', 'bs.business_step' => '4', 'ms.is_deleted' => '0', 'ms.message_from_profile' => '5', 'ms.message_to_profile' => '5', 'ms.message_to_profile_id' => $business_profile_id));
        $this->db->group_by('ms.message_from_profile_id');
        $this->db->order_by('ms.id', 'desc');
        $query2 = $this->db->get();
        $query2 = $query2->result_array();

        $query = array_merge($query1, $query2);
        return $query;
    }

}
