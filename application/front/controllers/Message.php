<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Message extends MY_Controller {

    public $data;

    
    public function __construct() 
    {
        parent::__construct();    
        
        // if ($this->session->userdata('aileensoul_front') == '') {
        //     redirect('login', 'refresh');
        // }
        $this->load->library('form_validation');
          $this->load->model('email_model');
        if (!$this->session->userdata('aileenuser')) {
          redirect('login', 'refresh');
        }
        include ('include.php');
    }

    public function message_user_list() {

    	$userid  = $this->session->userdata('aileenuser');
    	$contition_array = array('user_id !=' => $userid);
    	$this->data['user_list'] =  $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
       
    	 $this->load->view('message/message_user_list',$this->data); 
    }

    public function message_chat($id) { //echo "hii";die();

     $this->data['id'] = $id;
      $this->data['userid'] = $userid  = $this->session->userdata('aileenuser');

      

      $contition_array = array('user_id !=' => $userid, 'is_delete' => '0', 'status' => '1');

      $userlist =$this->data['user_list'] =  $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

  $this->data['lastid'] = $userlist[0]['user_id'];
   $this->data['name'] =  $this->common->select_data_by_id('user', 'user_id', $userlist[0]['user_id'], $data = '*', $join_str = array());


    //echo '<pre>'; print_r($this->data['user_list']); die();
     $search_condition="(message_from ='" .  $userlist[0]['user_id'] . "' AND message_to = '" .  $userid . " ') OR (message_from ='" .  $userid . "' AND message_to ='" .  $userlist[0]['user_id'] . "')";
      
        $this->data['msg_chat'] = $this->common->select_data_by_search('message', $search_condition, $contition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str='');
        
        //echo '<pre>'; print_r($this->data['msg_chat']); die();
      $this->data['toname'] =  $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

       $this->load->view('message/message_chat',$this->data); 
    }

     public function message_insert($id){ 
      
          $userid = $this->session->userdata('aileenuser');
          

           $data_message = array(
              'message_to'   => $id,
              'message'      => $this->input->post('msg_chat'),
              'message_from' =>$userid,
              'message_create_date' => date('Y-m-d h:i:s',time()),
              'message_modify_date' =>date('Y-m-d h:i:s',time()),
              'message_status' =>1,
              'is_delete' =>0
            );    
            //echo "<pre>"; print_r($data_message); die();  
      $insert_id_message =   $this->common->insert_data_getid($data_message,'message'); 


          $data_notification = array(
                 
                 'not_type' => 2,
                 'not_from_id' => $userid,
                 'not_to_id' => $id,
                 'not_read' => 2,
                 'not_product_id' => $insert_id_message
       
        ); 
             
            $insert_id_notification=   $this->common->insert_data_getid($data_notification,'notification');

           
        if( $insert_id_notification && $insert_id_message)
            {
                  //redirect('Friendrequest/index',$this->data);
                   redirect('message/message_chat/'.$id, 'refresh');
              
            }
           else
            { //echo "sdkjslkd"; die();
                    $this->session->flashdata('error','Sorry!! Your data not inserted');
                   redirect('message/message_chat', 'refresh', $this->data);
            }
   }
   // public function ajax_data(){
   //  echo"hii";
   // }

    public function message_chats($id) { //echo "hii";die();

    // $this->data['id'] = $id;
      $this->data['userid'] = $userid  = $this->session->userdata('aileenuser');

    $this->data['name'] =  $this->common->select_data_by_id('user', 'user_id', $id, $data = '*', $join_str = array());
    
    //echo '<pre>'; print_r($name); die();
      $contition_array = array('user_id !=' => $userid, 'is_delete' => '0', 'status' => '1');

      $userlist =$this->data['user_list'] =  $this->common->select_data_by_condition('user', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

  $this->data['lastid'] = $id;


    //echo '<pre>'; print_r($this->data['user_list']); die();
     $search_condition="(message_from ='" .  $id . "' AND message_to = '" .  $userid . " ') OR (message_from ='" .  $userid . "' AND message_to ='" .  $id . "')";
      
        $this->data['msg_chat'] = $this->common->select_data_by_search('message', $search_condition, $contition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str='');
        
        //echo '<pre>'; print_r($this->data['msg_chat']); die();
      $this->data['toname'] =  $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

       $this->load->view('message/message_chats',$this->data); 
    }


    public function messages_insert($id){ 
      
          $userid = $this->session->userdata('aileenuser');



           $data_message = array(
              'message_to'   => $id,
              'message'      => $this->input->post('msg_chat'),
              'message_from' =>$userid,
              'message_create_date' => date('Y-m-d h:i:s',time()),
              'message_modify_date' =>date('Y-m-d h:i:s',time()),
              'message_status' =>1,
              'is_delete' =>0
            );    
            //echo "<pre>"; print_r($data_message); die();  
      $insert_id_message=   $this->common->insert_data_getid($data_message,'message'); 


          $data_notification = array(
                 
                 'not_type' => 2,
                 'not_from_id' => $userid,
                 'not_to_id' => $id,
                 'not_read' => 2,
                 'not_product_id' => $insert_id_message
                 
        ); 
             //echo "<pre>"; print_r($data_notification);
            $insert_id_notification=   $this->common->insert_data_getid($data_notification,'notification');

           
   

        if($insert_id_notification && $insert_id_message)
            {
                  //redirect('Friendrequest/index',$this->data);
                   redirect('message/message_chats/'.$id, 'refresh');
              
            }
           else
            { //echo "sdkjslkd"; die();
                    $this->session->flashdata('error','Sorry!! Your data not inserted');
                   redirect('message/message_chats/'.$id, 'refresh', $this->data);
            }
   }

  //User automatic retrieve controller start
public function search_user()
    {
        $userid = $this->session->userdata('aileenuser');
        $json = [];

        //$this->load->database('aileensoul');
        $where = "user_id != $userid";

        if(!empty($this->input->get("q"))){
            $this->db->like('CONCAT(first_name ," ",last_name)', $this->input->get("q"));
            $query = $this->db->select('user_id as id,CONCAT(first_name ," ",last_name) as text')
                        ->where($where)
                        ->limit(10)
                        ->get("user");
            $json = $query->result();
        }

        //echo "<pre>";print_r($json);
        echo json_encode($json);
        
    }
//User automatic retrieve controller End
}