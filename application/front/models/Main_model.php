<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main_model extends CI_Model {

    function checkUserVisitor($ip = '', $date = '') {
        $this->db->select("count(*) as total")->from("user_visit");
        $this->db->where("ip", $ip);
        $this->db->where('insert_date1 BETWEEN "'. date('Y-m-d H:i:s', strtotime($date)). '" and "'. date('Y-m-d H:i:s', strtotime($date)).'"');
        $query = $this->db->get();
        $result_array = $query->row_array();
        echo '<pre>';
        print_r($result_array);
        exit;
        return $result_array;
    }

}
