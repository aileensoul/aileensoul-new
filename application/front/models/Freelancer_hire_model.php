<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Freelancer_hire_model extends CI_Model {

    public function getfreelancerhiredata($user_id = '', $select_data = '') {
        $this->db->select($select_data)->from('freelancer_hire_reg');
        $this->db->where(array('user_id' => $user_id, 'is_delete' => '0', 'status' => '1'));
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    public function getprojectdatabypostid($postid = '', $userid = '', $selectdata = '') {
        $this->db->select($selectdata)->from("freelancer_post fp");
        $this->db->join('freelancer_hire_reg fr', 'fp.user_id = fr.user_id', 'left');
        $this->db->where(array('fp.post_id' => $postid, 'fp.is_delete' => '0', 'fr.user_id' => $userid, 'fr.status' => '1', 'fr.free_hire_step' => '3'));
        $query = $this->db->get();
//       $result_array = $query->row_array();
        return $query->result_array();
    }

    public function checkfreelanceruser($user_id = '') {
        $this->db->select("freelancer_hire_slug")->from("freelancer_hire_reg");
        $this->db->where(array('user_id' => $user_id, 'status' => '0','is_delete' => '0'));
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    public function getCountry() {
        $this->db->select('country_id,country_name')->from('countries');
        $this->db->order_by("country_name","ASC");
        $this->db->where(array('status' => '1'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getprojectlivedatabyuserid($userid = '') {
        $this->db->select('*')->from("freelancer_post_live pl");
        $this->db->where(array('status' => '1', 'is_delete' => '0', 'user_id' => $userid));
        $query = $this->db->get();
//       $result_array = $query->row_array();
        return $query->result_array();
    }

}
