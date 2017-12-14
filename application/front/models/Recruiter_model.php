<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recruiter_model extends CI_Model {

    function getRecruiterDataBySlug($recruiter_slug='',$select_data='*'){ 
        $this->db->select($select_data)->from('recruiter');
        $this->db->where("rec_id='$recruiter_slug'");
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

}
