<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_model extends CI_Model {

    function getFieldList() {
        $this->db->select('it.industry_id,it.industry_name')->from('industry_type it');
        $this->db->where('type_id', '');
        $this->db->where('status', '1');
        $this->db->where('is_delete', '0');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function getJobTitle($search_keyword = '') {
        $this->db->select('jt.title_id,jt.name')->from('job_title jt');
        $this->db->where('jt.status', 'publish');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function cityList($search_keyword = '') {
        $this->db->select('c.city_id,c.city_name')->from('cities c');
        $this->db->where('c.status', '1');
        $this->db->where('c.state_id !=', '0');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function searchJobTitle($search_keyword = '') {
        $this->db->select('jt.title_id,jt.name')->from('job_title jt');
        if ($search_keyword != '') {
            $this->db->like('jt.name', $search_keyword);
        }
        $this->db->where('jt.status', 'publish');
        $query = $this->db->get();
        if ($search_keyword != '') {
            $result_array = $query->result_array();
        } else {
            $result_array = array();
        }
        return $result_array;
    }

    function searchCityList($search_keyword = '') {
        $this->db->select('c.city_id,c.city_name')->from('cities c');
        if ($search_keyword != '') {
            $this->db->like('c.city_name', $search_keyword);
        }
        $this->db->where('c.status', '1');
        $this->db->where('c.state_id !=', '0');
        $query = $this->db->get();
        if ($search_keyword != '') {
            $result_array = $query->result_array();
        } else {
            $result_array = array();
        }
        return $result_array;
    }

}
