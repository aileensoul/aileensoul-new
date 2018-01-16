<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_opportunity extends CI_Model {

    public function getContactSuggetion($user_id = '') {
        $this->db->select("u.user_id,u.first_name,u.last_name,ui.user_image,jt.name as title_name,d.degree_name")->from("user u");
        $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
        $this->db->join('user_login ul', 'ul.user_id = u.user_id', 'left');
        $this->db->join('user_profession up', 'up.user_id = u.user_id', 'left');
        $this->db->join('job_title jt', 'jt.title_id = up.designation', 'left');
        $this->db->join('user_student us', 'us.user_id = u.user_id', 'left');
        $this->db->join('degree d', 'd.degree_id = us.current_study', 'left');
        $this->db->where('u.user_id !=', $user_id);
        $this->db->where('u.user_id NOT IN (select from_id from ailee_user_contact where to_id=' . $user_id . ')', NULL, FALSE);
        $this->db->where('u.user_id NOT IN (select to_id from ailee_user_contact where from_id=' . $user_id . ')', NULL, FALSE);
        $this->db->order_by('u.user_id', 'DESC');
        $this->db->limit('30');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    public function checkContact($user_id = '', $to_user_id = '') {
        $this->db->select("count(*) as total,id,status")->from("user_contact uc");
        $this->db->where('(from_id =' . $user_id . ' and to_id =' . $to_user_id . ') OR ( to_id =' . $user_id . ' AND from_id =' . $to_user_id . ')');
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

//    public function get_jobtitle($search){
//        $this->db->select("name")->from("job_title jt");
//        $this->db->where('status','publish');
//        $this->db->like('name',$search);
//        $query = $this->db->get();
//        $result_array = $query->result_array();
//        return $result_array;
//    }
    public function get_jobtitle() {
        $this->db->select("name")->from("job_title jt");
        $this->db->where('status', 'publish');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    public function get_location() {
        $this->db->select("city_name")->from("cities c");
        $this->db->where('status', '1');
        $query = $this->db->get();
        $result_array = $query->result_array();
        return $result_array;
    }

    public function is_likepost($userid = '', $post_id = '') {
        $this->db->select("upl.id,upl.is_like")->from("user_post_like upl");
        $this->db->join('user_login ul', 'ul.user_id = upl.user_id', 'left');
        $this->db->where('upl.user_id', $userid);
        $this->db->where('upl.post_id', $post_id);
        $this->db->where('ul.status', '1');
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array;
    }

    public function likepost_count($post_id = '') {
        $this->db->select("COUNT(*) as like_count")->from("user_post_like upl");
        $this->db->join('user_login ul', 'ul.user_id = upl.user_id', 'left');
        $this->db->where('upl.post_id', $post_id);
        $this->db->where('ul.status', '1');
        $this->db->where('is_like', '1');
        $query = $this->db->get();
        $result_array = $query->row_array();
        return $result_array['like_count'];
    }

    public function userPost($user_id = '') {
        $result_array = array();
        $this->db->select("up.id,up.user_id,up.post_for,up.created_date,up.post_id")->from("user_post up");
        $this->db->where('up.user_id', $user_id);
        $this->db->where('up.status', 'publish');
        $this->db->where('up.is_delete', '0');
        $this->db->order_by('up.id', 'desc');
        $query = $this->db->get();
        $user_post = $query->result_array();

        foreach ($user_post as $key => $value) {

            $result_array[$key]['post_data'] = $user_post[$key];

            $this->db->select("count(*) as file_count")->from("user_post_file upf");
            $this->db->where('upf.post_id', $value['post_id']);
            $query = $this->db->get();
            $total_post_files = $query->row_array('file_count');
            $result_array[$key]['post_data']['total_post_files'] = $total_post_files['file_count'];

            $this->db->select("u.user_id,u.first_name,u.last_name,ui.user_image,jt.name as title_name,d.degree_name")->from("user u");
            $this->db->join('user_info ui', 'ui.user_id = u.user_id', 'left');
            $this->db->join('user_login ul', 'ul.user_id = u.user_id', 'left');
            $this->db->join('user_profession up', 'up.user_id = u.user_id', 'left');
            $this->db->join('job_title jt', 'jt.title_id = up.designation', 'left');
            $this->db->join('user_student us', 'us.user_id = u.user_id', 'left');
            $this->db->join('degree d', 'd.degree_id = us.current_study', 'left');
            $this->db->where('u.user_id', $value['user_id']);
            $query = $this->db->get();
            $user_data = $query->row_array();
            $result_array[$key]['user_data'] = $user_data;

            if ($value['post_for'] == 'opportunity') {
                $this->db->select("uo.post_id,GROUP_CONCAT(DISTINCT(jt.name)) as opportunity_for,GROUP_CONCAT(DISTINCT(c.city_name)) as location,uo.opportunity,it.industry_name as field")->from("user_opportunity uo, ailee_job_title jt, ailee_cities c");
                $this->db->join('industry_type it', 'it.industry_id = uo.field', 'left');
                $this->db->where('uo.id', $value['post_id']);
                $this->db->where('FIND_IN_SET(jt.title_id, uo.`opportunity_for`) !=', 0);
                $this->db->where('FIND_IN_SET(c.city_id, uo.`location`) !=', 0);
                $this->db->group_by('uo.opportunity_for', 'uo.location');
                $query = $this->db->get();
                $opportunity_data = $query->row_array();
                $result_array[$key]['opportunity_data'] = $opportunity_data;
            }

            $this->db->select("upf.file_type,upf.filename")->from("user_post_file upf");
            $this->db->where('upf.post_id', $value['post_id']);
            $query = $this->db->get();
            $post_file_data = $query->result_array();
            $result_array[$key]['post_file_data'] = $post_file_data;

            $this->db->select("CONCAT(u.first_name,' ',u.last_name) as username")->from("user_post_like upl");
            $this->db->join('user u', 'u.user_id = upl.user_id', 'left');
            $this->db->join('user_login ul', 'ul.user_id = upl.user_id', 'left');
            $this->db->where('upl.post_id', $value['post_id']);
            $this->db->where('upl.is_like', '1');
            $this->db->where('ul.status', '1');
            $this->db->order_by('upl.id','desc');
            $this->db->limit('1');
            $query = $this->db->get();
            $post_like_data = $query->row_array();
            $post_like_count = $this->likepost_count($value['post_id']);
            $result_array[$key]['post_like_count'] = $post_like_count;
            if($post_like_count > 1){
                $result_array[$key]['post_like_data'] = $post_like_data['username']. ' and ' . ($post_like_count-1) .' other' ;
            }
            elseif($post_like_count == 1){
                $result_array[$key]['post_like_data'] = $post_like_data['username'];   
            }
            
        }
        echo '<pre>';
        print_r($result_array);
        exit;
        return $result_array;
    }

}
