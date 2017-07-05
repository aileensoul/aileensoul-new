<?php
Class Common extends CI_Model
{

    function __construct()  
      {  
         // Call the Model constructor  
         parent::__construct();  
      }  
      
    //This function get all records from table by name
    function getallrecordbytablename($tablename,$data,$limit = '', $offset = '', $sortby = '', $orderby = '',$conditionarray='')
    {
        
        $this->db->order_by($sortby,$orderby);
		
        //Setting Limit for Paging
        if( $limit != '' && $offset == 0)
        { $this->db->limit($limit); }
        else if( $limit != '' && $offset != 0)
        {	$this->db->limit($limit, $offset);	}

        //Executing Query
        $this->db->select($data);
        $this->db->from($tablename);
        if($conditionarray!='')
        {
        $this->db->where($conditionarray);
        }
        $query =  $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
        
    }

    // check email id

    function chkemail($id, $email) {

        if ($id != 0) {

            $option = array('store_id !=' => $id, 'store_email' => $email);

        } else {

            $option = array('store_email' => $email);

        }

        $query = $this->db->get_where('store', $option);

        if ($query->num_rows() > 0) {

            return 'old';

        } else {

            return 'new';

        }

    }
    
    //This function get Weekly records from table by name
    function getweeklydata($tablename,$data,$limit = '', $offset = '', $sortby = '', $orderby = '')
    {
        
        $this->db->order_by($sortby,$orderby);
		
        //Setting Limit for Paging
        if( $limit != '' && $offset == 0)
        { $this->db->limit($limit); }
        else if( $limit != '' && $offset != 0)
        {	$this->db->limit($limit, $offset);	
        
        }

        //Executing Query
        $this->db->select($data);
        $this->db->from($tablename);
        
        $this->db->where('eventstarttime BETWEEN DATE_SUB(NOW(), INTERVAL 1 WEEK) AND NOW()');
        
        $query =  $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
        
    }
    
    //This function get Monthly records from table by name
    function getmonthlydata($tablename,$data,$limit = '', $offset = '', $sortby = '', $orderby = '')
    {
        
        $this->db->order_by($sortby,$orderby);
		
        //Setting Limit for Paging
        if( $limit != '' && $offset == 0)
        { $this->db->limit($limit); }
        else if( $limit != '' && $offset != 0)
        {	
            $this->db->limit($limit, $offset);	
        }

        //Executing Query
        $this->db->select($data);
        $this->db->from($tablename);
        
        $this->db->where('eventstarttime BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW()');
        
        $query =  $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
        
    }
    
    // select data using multiple conditions and search keyword
    function select_data_by_search($tablename, $search_condition, $contition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str='') {
        $this->db->select($data);
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
            }
        }
        if(count($contition_array)!=0)
{
        $this->db->where($contition_array);
}
        $this->db->where($search_condition);

        //Setting Limit for Paging
        if ($limit != '' && $offset == 0) {
            $this->db->limit($limit);
        } else if ($limit != '' && $offset != 0) {
            $this->db->limit($limit, $offset);
        }
        //order by query
        if ($sortby != '' && $orderby != '') {
            $this->db->order_by($sortby, $orderby);
        }

        $query = $this->db->get($tablename);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    // insert database
    function insert_data($data,$tablename)
    {
        if($this->db->insert($tablename,$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // select data using colum id
    function select_data_by_id($tablename, $columnname, $columnid, $data = '*', $join_str = array()) {
       if($data!='*')
       
        $this->db->select($data);
       
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                if ($join['join_type'] == '') {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }
        $this->db->where($columnname, $columnid);
        $query = $this->db->get($tablename);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }


    function select_resume()
    {
        $userid = $this->session->userdata('user_id');
        $condition = "user_id =" . "'" . $userid . "'";
        $this->db->select('*');
        $this->db->from('job_reg');
        $this->db->where($condition);
        $query = $this->db->get();
        return $result = $query->result();
    }
    
    // insert database return id
    function insert_data_getid($data,$tablename)
    {
        if($this->db->insert($tablename,$data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }
    
    // update database
    function update_data($data,$tablename,$columnname,$columnid)
    {
        $this->db->where($columnname,$columnid);
        if($this->db->update($tablename,$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    // select data using colum id
   function select_database_id($tablename,$columnname,$columnid,$data='*',$condition_array=array())
    {
        $this->db->select($data);
        $this->db->where($columnname,$columnid);
        if(!empty($condition_array)){
            $this->db->where($condition_array);
        }
        $query = $this->db->get($tablename);
        
        if($query->num_rows()>0)
        {
            return $query->result_array();
            
        }
        else
        {
            return array();
           
        }
    }

    // delete data
    function delete_data($tablename,$columnname,$columnid)
    {
        $this->db->where($columnname,$columnid);
        if($this->db->delete($tablename))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    // change status
    function change_status($data,$tablename,$columnname,$columnid)
    {
        $this->db->where($columnname,$columnid);
        if($this->db->update($tablename,$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //get all record 
     function get_all_record($tablename,$data='*',$sortby='',$orderby='')
    {
        $this->db->select($data);
        $this->db->from($tablename);
        //$this->db->where('status','Enable');
        if($sortby != '' && $orderby != "")
        {
            $this->db->order_by($sortby,$orderby);
        }
        $query = $this->db->get();
        if($query ->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
    }
    
    //table records count
    function get_count_of_table($table)
    {
        $query = $this->db->count_all($table);
        return $query;
    }
    
   function get_sem_value($id)
   {
        $this->db->select('semvalue');
        $this->db->where('semid',$id);
        $query = $this->db->get('sem');
        if($query->num_rows()>0)
        {
            $res = $query->result_array();
            return $res[0]['semvalue'];
        }
        else
        {
            return array();
        }
   }

        
      
   public function get_news()
   {
        $this->db->order_by($sortby='insertdatetime',$orderby='DESC');
        $this->db->limit($limit='2');
        $this->db->where('status','Active');
        $query = $this->db->get('news');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_testimonials()
   {
        $this->db->order_by($sortby='insertdatetime',$orderby='DESC');
        $this->db->where('status','Active');
        $query = $this->db->get('testimonials');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
	
   public function get_page_bymenuurl($menuurl)
   {
        $this->db->where('pageurl',$menuurl);
        $query =  $this->db->get('pages');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_page_url($pageid)
   {
        $this->db->select('pageurl');
        $this->db->where('pageid',$pageid);
        $query =  $this->db->get('pages');
        if($query->num_rows()>0)
        {
            $res = $query->result_array();
            return $res[0]['pageurl'];
        }
        else
        {
            return '';
        }
   }
   public function get_seo_data($tablename,$select_field,$fieldname,$fieldvalue)
   {
        $this->db->select($select_field);
        $this->db->where($fieldname,$fieldvalue);
        $query =  $this->db->get($tablename);
        if($query->num_rows()>0)
        {
            $res = $query->result_array();
            return $res[0][$select_field];
        }
        else
        {
            return false;
        }
   }
   
   public function get_page_content($type)
   {
        $this->db->where('pageurl',$type);
        $query =  $this->db->get('pages');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
   }
   public function get_block()
   {
        $query =  $this->db->get('block');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_banner()
   {
        $this->db->where('status','Active');
        $query =  $this->db->get('banners');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_doctor()
   {
        $this->db->from('doctors d');
        $this->db->join('doctor_staff_type dst','dst.doctorid=d.doctorid','left');
        $this->db->join('staff_type st','st.staffid=dst.staffid','left');
        $this->db->where(array('st.staffid'=>'1'));
        $this->db->limit('4');
        $query =  $this->db->get();
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_all_doctorname()
   {
        $this->db->select('doctorname,doctorurl');
        $this->db->from('doctors d');
        $this->db->join('doctor_staff_type dst','dst.doctorid=d.doctorid','left');
        $this->db->join('staff_type st','st.staffid=dst.staffid','left');
        $this->db->where(array('st.staffid'=>'1'));
        $this->db->limit('7');
        $query =  $this->db->get();
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_doctor_detail($doctorurl)
   {
        $this->db->from('doctors d');
        $this->db->join('doctor_staff_type dst','dst.doctorid=d.doctorid','left');
        $this->db->join('staff_type st','st.staffid=dst.staffid','left');
        $this->db->where(array('doctorurl'=>$doctorurl));
        $this->db->group_by('d.doctorid');
        $query =  $this->db->get();
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_doctor_time($doctorid)
   {
        $this->db->from('doctors_timing');
        $this->db->where(array('doctorid'=>$doctorid));
        $query =  $this->db->get();
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_blog()
   {
        $this->db->where('status','Active');
        $query =  $this->db->get('blogs');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_information()
   {
        $this->db->where('status','Active');
        $query =  $this->db->get('informations');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_staff_by_type($staffid)
   {
        $this->db->from('doctors d');
        $this->db->join('doctor_staff_type dst','dst.doctorid = d.doctorid');
        $this->db->where('staffid',$staffid);
        $query =  $this->db->get();
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_all_staff()
   {
        $this->db->from('doctors d');
        $this->db->join('doctor_staff_type dst','dst.doctorid = d.doctorid');
        $this->db->group_by('d.doctorid');
        $query =  $this->db->get();
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_blog_detail($blogurl)
   {
        $this->db->from('blogs');
        $this->db->where('blogurl',$blogurl);
        $query =  $this->db->get();
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_block_byblockurl($blockurl)
   {
        $this->db->from('block');
        $this->db->where('blockurl',$blockurl);
        $query =  $this->db->get();
       //echo  $this->db->last_query();
        
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }
   public function get_information_detail($informationurl)
   {
        $this->db->from('informations');
        $this->db->where('informationurl',$informationurl);
        $query =  $this->db->get();
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
   }

   // select data using multiple conditions
    function select_data_by_condition($tablename, $contition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '') {
        //print_r($join_str);
        //die();
        $this->db->select($data);
        if (!empty($join_str)) {
           // pre($join_str);
            foreach ($join_str as $join) {
                if ($join['join_type'] == '') {
                $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                }
                else{
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }

        $this->db->where($contition_array);
        if(!empty($having)){
            $this->db->having($having);
        }
        //Setting Limit for Paging
        if ($limit != '' && $offset == 0) {
            $this->db->limit($limit);
        } else if ($limit != '' && $offset != 0) {
            $this->db->limit($limit, $offset);
        }
        //order by query
        if ($sortby != '' && $orderby != '') {
            $this->db->order_by($sortby, $orderby);
        }

        $this->db->group_by($groupby);
        $query = $this->db->get($tablename);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    
    // khyati added
    
    
    


function get_products()
{
	$store_id  = $_SESSION['ADMIN_STORE_ID'];
	$sql = "select * from products where product_status !=3 and product_store = ".$store_id." order by product_created_date desc";
	$results = get_results($sql);
	return $results;
}

//Accept terms & condition on registration page
    function checkbox()
    {
        //if (isset($_POST['accept_terms_checkbox']))
            if ($this->input->post('checkbox'))
        {
            return TRUE;
        }
        else
        {
            $error = 'Please read and accept our terms and conditions.';
            $this->form_validation->set_message('checkbox', $error);
            return FALSE;
        }
    }

    // Read data using username and password
        public function login($data) {

            // echo"hi";
            // die();

        //decrypt the passwolrd
        $hash = md5($data['password']);
        //echo $hash; die();

        $condition = "uname =" . "'" . $data['uname'] . "' AND " . "password =" . "'" .$hash. "'";

        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $query; die();

        if ($query->num_rows() == 1) {
        return true;
        } else {
        return false;
        }
        }

        // Read data from database to show data in admin page
        public function read_user_information($username) {

        $condition = "uname =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
        return $query->result();
        } else {
        return false;
        }
        }

}