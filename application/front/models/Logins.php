<?php

class Logins extends CI_Model {

    function check_login($user_name, $user_password) {
        $this->db->select("user_id,email,password,status");
        $this->db->where("email", $user_name);
        $this->db->where("password", md5($user_password));
        $this->db->where('is_delete', '0');
        $this->db->from("user_login");
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->row_array();
            return $result;
        } else {
            return array();
        }
    }

}
