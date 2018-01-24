<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userprofile_model extends CI_Model {

    public function getDashboardData($user_id = '', $select_data = '') {
        $this->db->select($select_data)->from("user u");
        $this->db->join('art_reg a', 'a.user_id = u.user_id', 'left');
        $this->db->join('recruiter r', 'r.user_id = u.user_id', 'left');
        $this->db->join('job_reg jr', 'jr.user_id = u.user_id', 'left');
        $this->db->join('business_profile bp', 'bp.user_id = u.user_id', 'left');
        $this->db->join('freelancer_post_reg fp', 'fp.user_id = u.user_id', 'left');
        $this->db->join('freelancer_hire_reg fh', 'fh.user_id = u.user_id', 'left');
        $this->db->where("u.user_id =" . $user_id);
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    public function getContactData($user_id = '', $select_data = '') {

        $where = "((from_id = '" . $user_id . "' OR to_id = '" . $user_id . "'))";

        $this->db->select("u.user_id,u.first_name,u.last_name,ui.user_image,jt.name as title_name,d.degree_name,u.user_slug")->from("user_contact  uc");
        $this->db->join('user u', 'u.user_id = (CASE WHEN uc.from_id=' . $user_id . ' THEN uc.to_id ELSE uc.from_id END)', 'left');
        $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
        $this->db->join('user_profession up', 'up.user_id = u.user_id', 'left');
        $this->db->join('job_title jt', 'jt.title_id = up.designation', 'left');
        $this->db->join('user_student us', 'us.user_id = u.user_id', 'left');
        $this->db->join('degree d', 'd.degree_id = us.current_study', 'left');
        $this->db->where('u.user_id !=', $user_id);
        $this->db->where('uc.status', 'confirm');
        $this->db->where($where);
        $this->db->order_by("uc.id", "DESC");

        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    public function getFollowersData($user_id = '', $select_data = '') {

        $where = "((uf.follow_to = '" . $user_id . "'))";

        $this->db->select("u.user_id,u.first_name,u.last_name,ui.user_image,jt.name as title_name,d.degree_name,u.user_slug")->from("user_follow  uf");
        $this->db->join('user u', 'u.user_id = uf.follow_from', 'left');
        $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
        $this->db->join('user_profession up', 'up.user_id = u.user_id', 'left');
        $this->db->join('job_title jt', 'jt.title_id = up.designation', 'left');
        $this->db->join('user_student us', 'us.user_id = u.user_id', 'left');
        $this->db->join('degree d', 'd.degree_id = us.current_study', 'left');
//        $this->db->where('u.user_id !=', $user_id);
        $this->db->where('uf.status', '1');
        $this->db->where($where);
        $this->db->order_by("uf.id", "DESC");

        $query = $this->db->get();
        $result_array = $query->result_array();
        $user_follow_array = array();
        // echo '<pre>'; print_r($result_array); die();
        $new_follow_array = array();
        foreach ($result_array as $result) {
            $condition = "((uf.follow_from = '" . $user_id . "' AND uf.follow_to = '" . $result['user_id'] . "'))";
            $this->db->select("uf.id as follow_user_id")->from("user_follow uf");
            $this->db->where('uf.status', '1');
            $this->db->where($condition);
            $querry = $this->db->get();
            $result_query = $querry->result_array();
            $result['follow_user_id'] = $result_query[0]['follow_user_id'];

            array_push($new_follow_array, $result);
        }

        return $new_follow_array;
    }
    
    public function getFollowingData($user_id = '', $select_data = '') {

        $where = "((uf.follow_from = '" . $user_id . "'))";

        $this->db->select("u.user_id,u.first_name,u.last_name,ui.user_image,jt.name as title_name,d.degree_name,u.user_slug")->from("user_follow  uf");
        $this->db->join('user u', 'u.user_id = uf.follow_to', 'left');
        $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
        $this->db->join('user_profession up', 'up.user_id = u.user_id', 'left');
        $this->db->join('job_title jt', 'jt.title_id = up.designation', 'left');
        $this->db->join('user_student us', 'us.user_id = u.user_id', 'left');
        $this->db->join('degree d', 'd.degree_id = us.current_study', 'left');
//        $this->db->where('u.user_id !=', $user_id);
        $this->db->where('uf.status', '1');
        $this->db->where($where);
        $this->db->order_by("uf.id", "DESC");

        $query = $this->db->get();
        $result_array = $query->result_array();
       
        return $result_array;
    }
    
    public function userContactStatus($user_id = '', $id = '') {
        $this->db->select("uc.status,uc.id")->from("user_contact as uc");
        $where = "((from_id = '" . $user_id . "' AND to_id = '" . $id . "') OR (from_id = '" . $id . "' AND to_id = '" . $user_id . "'))";
        $this->db->where($where);
        $this->db->order_by("uc.id", "DESC");
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    public function userFollowStatus($user_id = '', $id = '') {
        $this->db->select("uf.status,uf.id")->from("user_follow as uf");
        $where = "((follow_from = '" . $user_id . "' AND follow_to = '" . $id . "'))";
        $this->db->where($where);
        $this->db->order_by("uf.id", "DESC");
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    function getUserBackImage($user_id = '') {
        $this->db->select("profile_background,profile_background_main")->from("user_info");
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }
    
    public function getContactCount($user_id = '', $select_data = '') {

        $where = "((from_id = '" . $user_id . "' OR to_id = '" . $user_id . "'))";

        $this->db->select("count(*) as total")->from("user_contact  uc");
        $this->db->where('uc.status', 'confirm');
        $this->db->where($where);
        $this->db->order_by("uc.id", "DESC");
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }
    
    public function getFollowingCount($user_id = '', $select_data = '') {

        $where = "((uf.follow_from = '" . $user_id . "'))";

        $this->db->select("count(*) as total")->from("user_follow  uf");
     
        $this->db->where('uf.status', '1');
        $this->db->where($where);
        $this->db->order_by("uf.id", "DESC");
        $query = $this->db->get();
        $result_array = $query->result_array();
       
        return $result_array;
    }
}
