<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_opportunity extends CI_Model {

    public function getContactSuggetion($user_id = '') {
        $this->db->select("u.user_id,u.first_name,u.last_name,ui.user_image")->from("user u");
        $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
        $this->db->join('user_login ul', 'ul.user_id = u.user_id', 'left');
        $this->db->where('u.user_id !=', $user_id);
        $this->db->order_by('u.user_id', 'DESC');
        $this->db->limit('30');
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

}
