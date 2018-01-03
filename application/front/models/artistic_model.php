<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artistic_model extends CI_Model {
  
   public function getArtUserData($user_id = '') {
        $this->db->select("a.art_id,a.art_name,a.art_lastname,a.art_city,a.art_country,a.art_skill,a.other_skill,a.user_id,a.status,a.is_delete,a.art_step,a.art_user_image,a.profile_background,a.designation,a.slug")->from("art_reg a");
        $this->db->where(array('a.user_id' => $user_id,'a.is_delete' => '0', 'a.status' => '1'));
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

}
