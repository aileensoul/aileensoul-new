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

    function jobCategory($limit = '') {
        $this->db->select('count(rp.post_id) as count,ji.industry_id,ji.industry_name,ji.industry_slug')->from('job_industry ji');
        $this->db->join('rec_post rp', 'rp.industry_type = ji.industry_id', 'left');
        $this->db->where('ji.status', '1');
        $this->db->where('ji.is_delete', '0');
        $this->db->where('rp.status', '1');
        $this->db->where('rp.is_delete', '0');
        $this->db->group_by('rp.industry_type');
        $this->db->order_by('count', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function jobCity($limit = '') {
        $this->db->select('count(rp.post_id) as count,c.city_id,c.city_name,c.slug')->from('cities c');
        $this->db->join('rec_post rp', 'rp.city = c.city_id', 'left');
        $this->db->where('c.status', '1');
        $this->db->where('rp.status', '1');
        $this->db->where('rp.is_delete', '0');
        $this->db->group_by('rp.city');
        $this->db->order_by('count', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function jobCompany($limit = '') {
        $this->db->select('count(rp.user_id) as count,r.user_id,r.re_comp_name as company_name')->from('recruiter r');
        $this->db->join('rec_post rp', 'rp.user_id = r.user_id', 'left');
        $this->db->where('r.re_status', '1');
        $this->db->where('rp.status', '1');
        $this->db->where('rp.is_delete', '0');
        $this->db->group_by('rp.user_id');
        $this->db->order_by('count', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function jobSkill($limit = '') {
        /*    $this->db->select('count(rp.user_id) as count,s.skill_id,s.skill,s.skill_slug')->from('skill s');
          $this->db->join('rec_post rp', 'rp.user_id = r.user_id', 'left');
          $this->db->where('FIND_IN_SET(ar.art_skill, ' . $category_id . ')');
          $this->db->where('s.type', '1');
          $this->db->where('s.status', '1');
          $this->db->where('rp.is_delete', '0');
          $this->db->group_by('rp.user_id');
          $this->db->order_by('count', 'desc');
          $this->db->limit($limit);
          $query = $this->db->get();
          $result_array = $query->result_array();
          return $result_array; */

        $this->db->select('s.skill_id,s.skill,s.skill_slug')->from('skill s');
        $this->db->where('s.status', '1');
        $this->db->where('s.type', '1');
        $query = $this->db->get();
        $art_category = $query->result_array();
        $return_array = array();
        foreach ($art_category as $key => $value) {
            $return = array();
            $skill_id = $value['skill_id'];
            $this->db->select('count(post_id) as count')->from('rec_post rp');
            $this->db->where('FIND_IN_SET(rp.post_skill, ' . $skill_id . ')');
            $this->db->where('rp.status', '1');
            $this->db->where('rp.is_delete', '0');
            $query = $this->db->get();
            $cat_count = $query->row_array();

            $return['count'] = $cat_count['count'];
            $return['skill_id'] = $value['skill_id'];
            $return['skill'] = $value['skill'];
            $return['skill_slug'] = $value['skill_slug'];

            array_push($return_array, $return);
        }
        array_multisort(array_column($return_array, 'count'), SORT_DESC, $return_array);
        array_splice($return_array, $limit);

        return $return_array;
    }

    function latestJob() {
        $this->db->select("rp.post_id,rp.post_name,jt.name as string_post_name,rp.post_description,DATE_FORMAT(rp.created_date,'%d-%M-%Y') as created_date,ct.city_name,cr.country_name,rp.min_year,rp.max_year,rp.fresher,CONCAT(r.rec_firstname,' ',r.rec_lastname) as fullname, r.re_comp_name,r.comp_logo")->from('rec_post rp');
        $this->db->join('recruiter r', 'r.user_id = rp.user_id', 'left');
        $this->db->join('cities ct', 'ct.city_id = rp.city', 'left');
        $this->db->join('countries cr', 'cr.country_id = rp.country', 'left');
        $this->db->join('job_title jt', 'jt.title_id = rp.post_name', 'left');
        $this->db->where('rp.status', '1');
        $this->db->where('rp.is_delete', '0');
        $this->db->order_by('rp.post_id', 'desc');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

}
