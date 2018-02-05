<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artistic_model extends CI_Model {

    public function getArtUserData($user_id = '') {
        $this->db->select("a.art_id,a.art_name,a.art_lastname,a.art_city,a.art_country,a.art_skill,a.other_skill,a.user_id,a.status,a.is_delete,a.art_step,a.art_user_image,a.profile_background,a.designation,a.slug")->from("art_reg a");
        $this->db->where(array('a.user_id' => $user_id, 'a.is_delete' => '0', 'a.status' => '1'));
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    public function artistCategory($limit = '') {
        $this->db->select('category_id,art_category,category_slug')->from('art_category ac');
        $this->db->where('ac.status', '1');
        $this->db->where('ac.category_id !=', '26');
        $query = $this->db->get();
        $art_category = $query->result_array();
        $return_array = array();
        foreach ($art_category as $key => $value) {
            $return = array();
            $category_id = $value['category_id'];
            $this->db->select('count(art_id) as count')->from('art_reg ar');
            $this->db->where('FIND_IN_SET(ar.art_skill, ' . $category_id . ')');
            $this->db->where('ar.status', '1');
            $this->db->where('ar.art_step', '4');
            $this->db->where('ar.is_delete', '0');
            $query = $this->db->get();
            $cat_count = $query->row_array();

            $return['count'] = $cat_count['count'];
            $return['category_id'] = $value['category_id'];
            $return['art_category'] = $value['art_category'];
            $return['category_slug'] = $value['category_slug'];

            array_push($return_array, $return);
        }
        array_multisort(array_column($return_array, 'count'), SORT_DESC, $return_array);
        array_splice($return_array, $limit);

        return $return_array;
    }

    function artistAllCategory() {
        $this->db->select('category_id,art_category,category_slug')->from('art_category ac');
        $this->db->where('ac.status', '1');
        $this->db->where('ac.category_id !=', '26');
        $query = $this->db->get();
        $art_category = $query->result_array();
        $return_array = array();
        foreach ($art_category as $key => $value) {
            $return = array();
            $category_id = $value['category_id'];
            $this->db->select('count(art_id) as count')->from('art_reg ar');
            $this->db->where('FIND_IN_SET(ar.art_skill, ' . $category_id . ')');
            $this->db->where('ar.status', '1');
            $this->db->where('ar.art_step', '4');
            $this->db->where('ar.is_delete', '0');
            $query = $this->db->get();
            $cat_count = $query->row_array();

            $return['count'] = $cat_count['count'];
            $return['category_id'] = $value['category_id'];
            $return['art_category'] = $value['art_category'];
            $return['category_slug'] = $value['category_slug'];

            array_push($return_array, $return);
        }
        array_multisort(array_column($return_array, 'count'), SORT_DESC, $return_array);

        return $return_array;
    }

    function otherCategoryCount() {
        $category_id = '26';
        $this->db->select('count(art_id) as count')->from('art_reg ar');
        $this->db->where('FIND_IN_SET(ar.art_skill, ' . $category_id . ')');
        $this->db->where('ar.status', '1');
        $this->db->where('ar.art_step', '4');
        $this->db->where('ar.is_delete', '0');
        $query = $this->db->get();
        $cat_count = $query->row_array();
        return $cat_count['count'];
    }

    function artistListByCategory($id = '') {
        $this->db->select("ar.art_user_image,ar.profile_background,ar.slug,ar.other_skill,CONCAT(ar.art_name,' ',ar.art_lastname) as fullname,ar.art_country,ar.art_city,ar.art_desc_art,ac.art_category,ct.city_name as city,cr.country_name as country")->from("art_reg ar");
        $this->db->join('art_category ac', 'ac.category_id = ar.art_skill', 'left');
        $this->db->join('cities ct', 'ct.city_id = ar.art_city', 'left');
        $this->db->join('countries cr', 'cr.country_id = ar.art_country', 'left');
        $this->db->where('ar.art_skill', $id);
        $this->db->where('ar.status', '1');
        $this->db->where('ar.is_delete', '0');
        $this->db->where('ar.art_step', '4');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    function findArtistCategory($keyword = '') {
        $this->db->select('category_id')->from('art_category ac');
        if ($keyword != '') {
            $this->db->where("(ac.art_category LIKE '%$keyword%')");
        }
        $this->db->where('ac.status', '1');
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array['category_id'];
    }

    function searchArtistData($keyword = '', $location = '') {
        $keyword = str_replace('%20', ' ', $keyword);
        $location = str_replace('%20', ' ', $location);

        $artCat = $this->findArtistCategory($keyword);

        $this->db->select("ar.art_user_image,ar.profile_background,ar.slug,ar.other_skill,CONCAT(ar.art_name,' ',ar.art_lastname) as fullname,ar.art_country,ar.art_city,ar.art_desc_art,ac.art_category,ct.city_name as city,cr.country_name as country")->from("art_reg ar");
        $this->db->join('art_category ac', 'ac.category_id = ar.art_skill', 'left');
        $this->db->join('cities ct', 'ct.city_id = ar.art_city', 'left');
        $this->db->join('countries cr', 'cr.country_id = ar.art_country', 'left');
        $this->db->join('states s', 's.state_name = ar.art_state', 'left');
        if ($keyword != '' && $artCat == '') {
            $this->db->where("(ar.art_name LIKE '%$keyword%' OR ar.art_lastname LIKE '%$keyword%' OR CONCAT(ar.art_name, ' ',ar.art_lastname) LIKE '%$keyword%' OR ar.art_email LIKE '%$keyword%' OR ar.art_phnno LIKE '%$keyword%' OR ar.art_address LIKE '%$keyword%' OR ar.art_yourart LIKE '%$keyword%' OR ar.art_desc_art LIKE '%$keyword%' OR ar.art_inspire LIKE '%$keyword%' OR ar.art_bestofmine LIKE '%$keyword%' OR ar.art_portfolio LIKE '%$keyword%' OR ar.other_skill LIKE '%$keyword%' OR ar.slug LIKE '%$keyword%')");
        } elseif ($keyword != '' && $artCat != '') {
            $this->db->where("(ar.art_name LIKE '%$keyword%' OR ar.art_lastname LIKE '%$keyword%' OR CONCAT(ar.art_name, ' ',ar.art_lastname) LIKE '%$keyword%' OR ar.art_email LIKE '%$keyword%' OR ar.art_phnno LIKE '%$keyword%' OR ar.art_address LIKE '%$keyword%' OR ar.art_yourart LIKE '%$keyword%' OR ar.art_desc_art LIKE '%$keyword%' OR ar.art_inspire LIKE '%$keyword%' OR ar.art_bestofmine LIKE '%$keyword%' OR ar.art_portfolio LIKE '%$keyword%' OR ar.other_skill LIKE '%$keyword%' OR ar.slug LIKE '%$keyword%' OR ar.art_skill = '$artCat')");
        }
        if ($location != '') {
            $this->db->where("(ct.city_name = '$location' OR cr.country_name = '$location' OR s.state_name = '$location')");
        }
        
        $this->db->where('ar.status', '1');
        $this->db->where('ar.is_delete', '0');
        $this->db->where('ar.art_step', '4');

        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

}
