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
    
    public function getfreelancerapplypost($user_id, $select_data) {
//        $select_data = "post_id,post_name,created_date,username,fullname,post_rate,post_rating_type,post_currency,city,country,post_skill,post_description,post_field_req";
        $select_data = "post_id,post_name,fp.created_date,post_rate,post_rating_type,currency_name as post_currency,ct.city_name as city,cr.country_name as country,post_skill,post_description,post_field_req";
        $this->db->select($select_data)->from('freelancer_post fp');
        $this->db->join('job_title jt', 'jt.title_id = fp.post_name', 'left');
        $this->db->join('currency c', 'c.currency_id = fp.post_currency', 'left');
         $this->db->join('cities ct', 'ct.city_id = fp.city', 'left');
        $this->db->join('countries cr', 'cr.country_id = fp.country', 'left');
        $this->db->where(array('fp.is_delete' => '0', 'fp.status' => '1'));
        $query = $this->db->get();
         $result_array = $query->result_array();
        return $result_array;
        
   
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
