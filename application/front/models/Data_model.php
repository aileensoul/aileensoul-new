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

    function getJobTitle() {
        $this->db->select('jt.title_id,jt.name')->from('job_title jt');
        $this->db->where('jt.status', 'publish');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function findJobTitle($search_keyword = '') {
        $this->db->select('jt.title_id')->from('job_title jt');
        $this->db->where('jt.name', $search_keyword);
        $this->db->where('jt.status', 'publish');
        $query = $this->db->get();
        $result_array = $query->row_array();
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

    function cityList() {
        $this->db->select('c.city_id,c.city_name')->from('cities c');
        $this->db->where('c.status', '1');
        $this->db->where('c.state_id !=', '0');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function findCityList($search_keyword = '') {
        $this->db->select('c.city_id')->from('cities c');
        $this->db->where('c.city_name', $search_keyword);
        $this->db->where('c.status', '1');
        $this->db->where('c.state_id !=', '0');
        $query = $this->db->get();
        $result_array = $query->row_array();
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

    function universityList() {
        $this->db->select('u.university_id,u.university_name')->from('university u');
        $this->db->where('u.status', '1');
        $this->db->where('u.is_delete', '0');
        $this->db->where('u.is_other', '0');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function findUniversityList($search_keyword = '') {
        $this->db->select('u.university_id')->from('university u');
        $this->db->where('u.university_name', $search_keyword);
        $this->db->where('u.status', '1');
        $this->db->where('u.is_delete', '0');
        $this->db->where('u.is_other', '0');
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    function searchUniversityList($search_keyword = '') {
        $this->db->select('u.university_id,u.university_name')->from('university u');
        if ($search_keyword != '') {
            $this->db->like('u.university_name', $search_keyword);
        }
        $this->db->where('u.status', '1');
        $this->db->where('u.is_delete', '0');
        $this->db->where('u.is_other', '0');
        $query = $this->db->get();
        if ($search_keyword != '') {
            $result_array = $query->result_array();
        } else {
            $result_array = array();
        }
        return $result_array;
    }

    function degreeList() {
        $this->db->select('d.degree_id,d.degree_name')->from('degree d');
        $this->db->where('d.status', '1');
        $this->db->where('d.is_delete', '0');
        $this->db->where('d.is_other', '0');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function findDegreeList($search_keyword = '') {
        $this->db->select('d.degree_id')->from('degree d');
        $this->db->where('d.degree_name', $search_keyword);
        $this->db->where('d.status', '1');
        $this->db->where('d.is_delete', '0');
        $this->db->where('d.is_other', '0');
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    function searchDegreeList($search_keyword = '') {
        $this->db->select('d.degree_id,d.degree_name')->from('degree d');
        if ($search_keyword != '') {
            $this->db->like('d.degree_name', $search_keyword);
        }
        $this->db->where('d.status', '1');
        $this->db->where('d.is_delete', '0');
        $this->db->where('d.is_other', '0');
        $query = $this->db->get();
        if ($search_keyword != '') {
            $result_array = $query->result_array();
        } else {
            $result_array = array();
        }
        return $result_array;
    }
    
    function searchQueList($search_keyword = '') {
        $this->db->select('q.id,q.question')->from('user_ask_question q');
        if ($search_keyword != '') {
            $this->db->like('q.question', $search_keyword);
        }
        $this->db->join('user_post up', 'up.post_id = q.post_id', 'left');
        $this->db->where('up.status', 'publish');
        $this->db->where('up.is_delete', '0');
        $query = $this->db->get();
        if ($search_keyword != '') {
            $result_array = $query->result_array();
        } else {
            $result_array = array();
        }
        return $result_array;
    }

}
