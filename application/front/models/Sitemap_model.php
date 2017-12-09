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

}
