<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Freelancer_apply_model extends CI_Model {
    
    public function getfreelancerapplydata($user_id, $select_data) {
        $this->db->select($select_data)->from('freelancer_post_reg');
        $this->db->where(array('user_id' => $user_id, 'is_delete' => '0', 'status' => '1'));
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }
    
    public function getfreelancerapplypost($user_id, $select_data="*") {
        $this->db->select($select_data)->from('freelancer_post');
        $this->db->where(array('is_delete' => '0', 'status' => '1'));
        $query = $this->db->get();
         $result_array = $query->result_array();
        return $result_array;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
