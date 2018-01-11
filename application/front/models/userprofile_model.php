<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userprofile_model extends CI_Model {

    public function getDashboardData($user_id = '',$select_data = '') {
        $this->db->select($select_data)->from("user u");
        $this->db->join('art_reg a', 'a.user_id = u.user_id', 'left');
        $this->db->join('recruiter r', 'r.user_id = u.user_id', 'left');
        $this->db->join('job_reg jr', 'jr.user_id = u.user_id', 'left');
        $this->db->join('business_profile bp', 'bp.user_id = u.user_id', 'left');
        $this->db->join('freelancer_post_reg fp', 'fp.user_id = u.user_id', 'left');
        $this->db->join('freelancer_hire_reg fh', 'fh.user_id = u.user_id', 'left');
        $this->db->where("u.user_id =" . $user_id);
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }
    
     public function getContactData($user_id = '173',$select_data = '') {
       
        $this->db->select("u.user_id")->from("user  u");
        $this->db->join('user_contact uc', 'u.user_id = (CASE WHEN uc.from_id=' . $user_id . ' THEN uc.from_id ELSE uc.from_id END)');
        $this->db->join('user_contact uc', 'u.user_id = (CASE WHEN uc.from_id=' . $user_id . ' THEN uc.from_id ELSE uc.from_id END)');
        $this->db->join('user_contact uc', 'u.user_id = (CASE WHEN uc.from_id=' . $user_id . ' THEN uc.from_id ELSE uc.from_id END)');
     
//        $this->db->where("ul.is_delete",'0');
//        $this->db->where("ul.status",'1');
        $this->db->order_by("u.user_id", "DESC");
        
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

  
}
