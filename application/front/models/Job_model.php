<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job_model extends CI_Model {
 
   public function isJobAvailable($user_id = '') {
       $this->db->select("count(*) as total")->from("job_reg j");
        $this->db->where(array('j.user_id' => $user_id, 'j.status' => '1', 'j.is_delete' => '0', 'j.job_step' => '10'));
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array; 
    }
}
