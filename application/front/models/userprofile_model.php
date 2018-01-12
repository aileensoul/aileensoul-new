<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userprofile_model extends CI_Model {

    public function getDashboardData($user_id = '', $select_data = '') {
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

    public function getContactData($user_id = '173', $select_data = '') {
        $this->db->select("u.user_id,u.first_name,u.last_name,ui.user_image,jt.name as title_name,d.degree_name,u.user_slug")->from("user_contact  uc");
        $this->db->join('user u', 'u.user_id = (CASE WHEN uc.from_id=' . $user_id . ' THEN uc.to_id ELSE uc.from_id END)', 'left');
       $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
        $this->db->join('user_profession up', 'up.user_id = u.user_id', 'left');
        $this->db->join('job_title jt', 'jt.title_id = up.designation', 'left');
        $this->db->join('user_student us', 'us.user_id = u.user_id', 'left');
        $this->db->join('degree d', 'd.degree_id = us.current_study', 'left');
        $this->db->where('u.user_id !=', $user_id);
        $this->db->where('uc.status', 'confirm');
        $this->db->order_by("uc.id", "DESC");

        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }
    
     public function removeContact($user_id = '', $id = '') { 
        
       $this->db->select("id")->from("user_contact as uc");
         $where = "((from_id = '" .$user_id. "' AND to_id = '" .$id."') OR (from_id = '" .$user_id. "' AND to_id = '" .$id. "'))";
        $this->db->where($where);
        $this->db->order_by("uc.id", "DESC");
      $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
        
     }

}
