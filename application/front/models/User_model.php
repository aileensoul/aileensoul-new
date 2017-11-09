<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function getCountry() {
        $this->db->select('country_id,countryName')->from('countries');

        $query = $this->db->get();

        return $query->result();
    }

    public function getStateByCountryId($id) {

        $this->db->select('state_id,state_name')->from('states');

        $this->db->where(array('country_id' => $id));

        $query = $this->db->get();

        return $query->result();
    }

    public function getCityByStateId($id) {

        $this->db->select('city_id,city_name')->from('cities');

        $this->db->where(array('state_id' => $id));

        $query = $this->db->get();

        return $query->result();
    }

}
