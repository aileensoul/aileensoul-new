<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function getUserData($user_id = '') {
        $this->db->select("u.user_id,u.first_name,u.last_name,u.user_dob,u.user_gender,u.user_agree,u.created_date,u.verify_date,u.user_verify,u.user_slider,u.user_slug,ui.user_image,ui.modify_date,ui.edit_ip,ui.profile_background,ui.profile_background_main,ul.email,ul.password,ul.is_delete,ul.status,ul.password_code")->from("user u");
        $this->db->join('user_info ui', 'ui.user_id = u.user_id','left');
        $this->db->join('user_login ul', 'ul.user_id = u.user_id','left');
        $this->db->where("u.user_id =" . $user_id);
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    public function getUserSlugById($user_id = '') {
        $this->db->select("u.user_slug")->from("user u");
        $this->db->where("u.user_id =" . $user_id);
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }
    
    public function getUserPasswordById($user_id = '') {
        $this->db->select("ul.password")->from("user_login ul");
        $this->db->where("ul.user_id =" . $user_id);
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

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

    public function getBusinessType() {
        $this->db->select('type_id,business_name')->from('business_type');
        $this->db->where(array('status' => '1', 'is_delete' => '0'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCategory() {
        $this->db->select('industry_id,industry_name')->from('industry_type');
        $this->db->where(array('status' => '1', 'is_delete' => '0'));
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getUserByEmail($user_email = '') {
        $this->db->select("ul.user_id")->from("user_login ul");
        $this->db->where(array('ul.email' => $user_email,'is_delete' => '0', 'status' => '1'));
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }
    
    public function getUserPassword($userid = '',$oldpassword = '') {
        $this->db->select("ul.user_id")->from("user_login ul");
        $this->db->where(array('ul.user_id' => $userid,'password' => $oldpassword));
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

}
