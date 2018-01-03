<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Business_model extends CI_Model {
    
    function business_like_comment(){
        
    }

    function business_followers($follow_to = '', $sortby = '', $orderby = '', $limit = '', $offset = '') {
        $this->db->select('*')->from('business_profile bp');
        $this->db->join('user_login ul', 'ul.user_id = bp.user_id');
        $this->db->join('follow f', 'f.follow_from = bp.business_profile_id');
        $this->db->where('f.follow_to', $follow_to);
        $this->db->where('f.follow_status', '1');
        $this->db->where('f.follow_type', '2');
        $this->db->where('bp.business_step', '4');
        $this->db->where('bp.is_deleted', '0');
        $this->db->where('bp.status', '1');
        $this->db->where('ul.status', '1');
        $this->db->where('ul.is_delete', '0');
        if ($orderby != '') {
            $this->db->order_by($sortby, $orderby);
        }
        if ($limit != '') {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }
    
    function business_following($follow_from = '', $sortby = '', $orderby = '', $limit = '', $offset = '') {
        $this->db->select('*')->from('business_profile bp');
        $this->db->join('user_login ul', 'ul.user_id = bp.user_id');
        $this->db->join('follow f', 'f.follow_to = bp.business_profile_id');
        $this->db->where('f.follow_from', $follow_from);
        $this->db->where('f.follow_status', '1');
        $this->db->where('f.follow_type', '2');
        $this->db->where('bp.business_step', '4');
        $this->db->where('bp.is_deleted', '0');
        $this->db->where('bp.status', '1');
        $this->db->where('ul.status', '1');
        $this->db->where('ul.is_delete', '0');
        if ($orderby != '') {
            $this->db->order_by($sortby, $orderby);
        }
        if ($limit != '') {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function business_userlist($user_id = '', $sortby = '', $orderby = '', $limit = '', $offset = '') {
        $this->db->select('*')->from('business_profile bp');
        $this->db->join('user_login ul', 'ul.user_id = bp.user_id');
        $this->db->where('bp.user_id !=', $user_id);
        $this->db->where('bp.business_step', '4');
        $this->db->where('bp.is_deleted', '0');
        $this->db->where('bp.status', '1');
        $this->db->where('ul.status', '1');
        $this->db->where('ul.is_delete', '0');
        if ($orderby != '') {
            $this->db->order_by($sortby, $orderby);
        }
        if ($limit != '') {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function getBusinessPostComment($post_id = '', $sortby = '', $orderby = '', $limit = '') {
        $this->db->select('bppc.*')->from('business_profile_post_comment bppc');
        $this->db->join('user_login ul', 'ul.user_id = bppc.user_id');
        $this->db->where('business_profile_post_id', $post_id);
        $this->db->where('bppc.status', '1');
        $this->db->where('bppc.is_delete', '0');
        $this->db->where('ul.is_delete', '0');
        $this->db->where('ul.status', '1');
        if ($orderby != '') {
            $this->db->order_by($sortby, $orderby);
        }
        if ($limit != '') {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function getBusinessDataBySlug($business_slug = '', $select_data = '*') {
        $this->db->select($select_data)->from('business_profile');
        $this->db->where("business_slug='$business_slug'");
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    function getBusinessTypeName($business_type = '') {
        $business_name = $this->db->select('business_name')->get_where('business_type', array('type_id' => $business_type, 'status' => '1', 'is_delete' => '0'))->row('business_name');
        return $business_name;
    }

    function getIndustriyalName($industriyal = '') {
        $industriyal_name = $this->db->select('industry_name')->get_where('industry_type', array('industry_id' => $industriyal, 'status' => '1', 'is_delete' => '0'))->row('industry_name');
        return $industriyal_name;
    }

}
