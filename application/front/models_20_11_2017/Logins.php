<?php

class Logins extends CI_Model {

    function check_authentication($user_name, $user_password) { 
        $this->db->select('*');
        $this->db->where('user_password',md5($user_password));
       $this->db->where('is_delete','0');
       $this->db->where('status','1');
        $this->db->like('user_email', $user_name);
//         $this->db->like('user_name', $user_name);
// $this->db->or_like('user_email', $user_name);
       //$where = "(user_name LIKE'"  . $user_name . "'or  user_email ='" . $user_name .  "')";
      // $this->db->like($where);
      


        $result = $this->db->get('user')->result_array();

       if (!empty($result)) {
            // if ((strtolower($result[0]['user_name']) == strtolower($user_name) || $result[0]['user_email'] == $user_name) && $result[0]['user_password'] == md5($user_password)) {

           if (($result[0]['user_email'] == $user_name) && $result[0]['user_password'] == md5($user_password)) {
                return $result;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

}
