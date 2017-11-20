<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function getCountry() {
        $this->db->select('country_id,country_name')->from('countries');

        $this->db->where(array('status' => '1'));

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getStateByCountryId($id) {

        $this->db->select('state_id,state_name')->from('states');

        $this->db->where(array('country_id' => $id, 'status' => '1'));

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getCityByStateId($id) {

        $this->db->select('city_id,city_name')->from('cities');

        $this->db->where(array('state_id' => $id, 'status' => '1'));

        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function getBusinessType(){
        
        $this->db->select('type_id,business_name')->from('business_type');

        $this->db->where(array('status' => '1', 'is_delete' => '0'));

        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function getCategory(){
        
        $this->db->select('industry_id,industry_name')->from('industry_type');

        $this->db->where(array('status' => '1', 'is_delete' => '0'));

        $query = $this->db->get();

        return $query->result_array();
    }

}
