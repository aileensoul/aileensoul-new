<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sitemap_model extends CI_Model {

    function getBusinessDataByCategory() {
        $this->db->select('bc.industry_name,b.company_name,b.business_slug')->from('industry_type bc');
        $this->db->join('business_profile b', 'b.industriyal = bc.industry_id');
        $this->db->where(array('bc.status' => '1', 'bc.is_delete' => '0', 'b.status' => '1', 'b.is_deleted' => '0', 'b.business_step' => '4'));
        $query = $this->db->get();
        $result = $query->result_array();

        $newArray = array();
        foreach ($result as $key => $value) {
            $newArray[$value['industry_name']][] = $value; // sort as per category name
        }
        return $newArray;
    }

    function getArtistDataByCategory() {
        $this->db->select('a.art_name,a.art_lastname,a.art_skill,a.other_skill')->from('art_reg a');
        $this->db->where(array('a.status' => '1', 'a.is_delete' => '0', 'a.art_step' => '4'));
        $query = $this->db->get();
        $result = $query->result_array();

        foreach ($result as $key => $value) {
            $art_skill = $value['art_skill'];
            $other_skill = $value['other_skill'];
            if ($art_skill) {
                $art_skill = explode(',', $art_skill);
                $category_name = '';
                foreach ($art_skill as $key1 => $skill) {
                    $category_name .= $this->db->select('art_category')->get_where('art_category', array('category_id' => $skill))->row('art_category');
                    $category_name .= ',';
                }
                $category_name = trim($category_name, ',');
                $result[$key]['art_skill'] = $category_name;
            }
            if ($other_skill) {
                $other_name .= $this->db->select('other_category')->get_where('art_other_category', array('other_category_id' => $other_skill))->row('other_category');
                $other_name = trim($other_name, ',');
                $result[$key]['other_skill'] = $other_name;
            }
        }
        
        return $result;
    }

}
