<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function getUserData($user_id = '') {
        $this->db->select("u.user_id,u.first_name,u.last_name,u.user_dob,u.user_gender,u.user_agree,u.created_date,u.verify_date,u.user_verify,u.user_slider,u.user_slug,ui.user_image,ui.modify_date,ui.edit_ip,ui.profile_background,ui.profile_background_main,ul.email,ul.password,ul.is_delete,ul.status,ul.password_code")->from("user u");
        $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
        $this->db->join('user_login ul', 'ul.user_id = u.user_id', 'left');
        $this->db->where("u.user_id =" . $user_id);
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    public function is_userBasicInfo($user_id = '') {
        $this->db->select("COUNT(*) as total")->from("user_profession up");
        $this->db->where("up.user_id", $user_id);
        $query = $this->db->get();
        $result_array = $query->row('total');
        return $result_array;
    }

    public function is_userStudentInfo($user_id = '') {
        $this->db->select("COUNT(*) as total")->from("user_student us");
        $this->db->where("us.user_id", $user_id);
        $query = $this->db->get();
        $result_array = $query->row('total');
        return $result_array;
    }

    public function getUserSelectedData($user_id = '', $select_data = '') {
        $this->db->select($select_data)->from("user u");
        $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
        $this->db->join('user_login ul', 'ul.user_id = u.user_id', 'left');
        $this->db->where("u.user_id =" . $user_id);
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    public function getLeftboxData($user_id = '') {
        $this->db->select('u.first_name,u.last_name,ui.user_image,ui.profile_background')->from("user u");
        $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
        $this->db->join('user_login ul', 'ul.user_id = u.user_id', 'left');
        $this->db->where("u.user_id", $user_id);
        $query = $this->db->get();
        $result_array = $query->row_array();
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
        $this->db->select("ul.user_id,ul.email")->from("user_login ul");
        $this->db->where(array('ul.email' => $user_email, 'is_delete' => '0', 'status' => '1'));
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    public function getUserPassword($userid = '', $oldpassword = '') {
        $this->db->select("ul.user_id")->from("user_login ul");
        $this->db->where(array('ul.user_id' => $userid, 'password' => $oldpassword));
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    public function getUserDataByEmail($user_email = '') {
        $this->db->select("u.user_id,u.first_name,u.last_name,u.user_dob,u.user_gender,u.user_agree,u.created_date,u.verify_date,u.user_verify,u.user_slider,u.user_slug,ui.user_image,ui.modify_date,ui.edit_ip,ui.profile_background,ui.profile_background_main,ul.email,ul.password,ul.is_delete,ul.status,ul.password_code")->from("user u");
        $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
        $this->db->join('user_login ul', 'ul.user_id = u.user_id', 'left');
        $this->db->where('ul.email', $user_email);
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }
    
    
    public function getUserProfessionData($user_id = '', $select_data = '') {
        $this->db->select($select_data)->from("user_profession up");
        $this->db->join('cities c', 'c.city_id = up.city', 'left');
        $this->db->join('user usr', 'usr.user_id = up.user_id', 'left');
        $this->db->join('job_title jt', 'jt.title_id = up.designation', 'left');
        $this->db->join('industry_type it', 'it.industry_id = up.field', 'left');
        $this->db->where("up.user_id =" . $user_id);
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }
    
    public function getUserStudentData($user_id = '', $select_data = '') {
        $this->db->select($select_data)->from("user_student us");
        $this->db->join('cities c', 'c.city_id = us.city', 'left');
        $this->db->join('user usr', 'usr.user_id = us.user_id', 'left');
        $this->db->join('university u', 'u.university_id = us.university_name', 'left');
        $this->db->join('degree d', 'd.degree_id = us.current_study', 'left');
        $this->db->where("us.user_id =" . $user_id);
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

}
