<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Chat extends MY_Controller {

  public function __construct() {
        parent::__construct();

        $this->load->helper('smiley');

        if (!$this->session->userdata('aileenuser')) {
            redirect('login', 'refresh');
        }

       include('include.php');

      }

  public function index()
  {  
   $this->data['userid'] =  $userid = $this->session->userdata('aileenuser');

    $loginuser = $this->common->select_data_by_id('user', 'user_id', $userid, $data = 'first_name,last_name');
    
    $this->data['logfname'] = $loginuser[0]['first_name'];
    $this->data['loglname'] = $loginuser[0]['last_name'];
   
    // last message user fetch
    
    $contition_array = array('id !=' => '');

    $search_condition = "(message_from = '$userid' OR message_to = '$userid')";

    $lastuser = $this->common->select_data_by_search('messages', $search_condition,$contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');
    
    if($lastuser[0]['message_from'] == $userid){
     
  $lstusr =    $this->data['lstusr'] = $lastuser[0]['message_to'];
    }else{
    
  $lstusr =  $this->data['lstusr'] = $lastuser[0]['message_from'];
    }

// last user first name last name
    if($lstusr){
    $lastuser = $this->common->select_data_by_id('user', 'user_id', $lstusr, $data = 'first_name,last_name');
    
    $this->data['lstfname'] = $lastuser[0]['first_name'];
    $this->data['lstlname'] = $lastuser[0]['last_name'];
    }
    //khyati changes starrt 20-4

    // khyati 24-4 start 
     
     // slected user chat to

    
     $contition_array = array('is_delete' => '0' , 'status' => '1');

     $join_str1[0]['table'] = 'messages';
     $join_str1[0]['join_table_id'] = 'messages.message_to';
     $join_str1[0]['from_table_id'] = 'user.user_id';
     $join_str1[0]['join_type'] = '';
    
    $search_condition = "((message_from = '$lstusr' OR message_to = '$lstusr') && (message_to != '$userid'))";

     $seltousr = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');


     // slected user chat from

    
     $contition_array = array('is_delete' => '0' , 'status' => '1');

     $join_str2[0]['table'] = 'messages';
     $join_str2[0]['join_table_id'] = 'messages.message_from';
     $join_str2[0]['from_table_id'] = 'user.user_id';
     $join_str2[0]['join_type'] = '';

     
     
    $search_condition = "((message_from = '$lstusr' OR message_to = '$lstusr') && (message_from != '$userid'))";

     $selfromusr = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.id,message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');


$selectuser = array_merge($seltousr,$selfromusr);
$selectuser =  $this->aasort($selectuser,"id");


// replace name of message_to in user_id in select user

   $return_arraysel = array();
$i=0;
    foreach($selectuser as $k => $sel_list){
        $return = array();
       $return = $sel_list;

if($sel_list['message_to']){ 
     
       $return['user_id'] = $sel_list['message_to'];
       $return['first_name'] = $sel_list['first_name'];
       $return['user_image'] = $sel_list['user_image'];
       $return['message'] = $sel_list['message'];
      
       unset($return['message_to']);
      
}else{ 

       $return['user_id'] = $sel_list['message_from'];
       $return['first_name'] = $sel_list['first_name'];
       $return['user_image'] = $sel_list['user_image'];
       $return['message'] = $sel_list['message'];

      
       unset($return['message_from']);
      }
array_push($return_arraysel, $return);
$i++;
if($i==1) break;
    } 


    // khyati 24-4 end 

     // message to user
    


 $contition_array = array('is_delete' => '0' , 'status' => '1','message_to !=' => $userid);

     $join_str3[0]['table'] = 'messages';
     $join_str3[0]['join_table_id'] = 'messages.message_to';
     $join_str3[0]['from_table_id'] = 'user.user_id';
     $join_str3[0]['join_type'] = '';
     
$search_condition = "((message_from = '$userid') && (message_to != '$lstusr'))";

     $tolist = $this->common->select_data_by_search('user',$search_condition,$contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str3, $groupby = '');

 

// uniq array of tolist  
foreach($tolist as $k => $v) 
{
    foreach($tolist as $key => $value) 
    {
        if($k != $key && $v['message_to'] == $value['message_to'])
        {
             unset($tolist[$k]);
        }
    }
}

 // replace name of message_to in user_id

   $return_arrayto = array();

    foreach($tolist as $to_list){
if($to_list['message_to'] != $lstusr){
      $return = array();
      $return = $to_list;

      $return['user_id'] = $to_list['message_to'];
      $return['first_name'] = $to_list['first_name'];
      $return['user_image'] = $to_list['user_image'];
      $return['message'] = $to_list['message'];
      
      unset($return['message_to']);
     array_push($return_arrayto, $return);
}
    } 

    // message from user
    $contition_array = array('is_delete' => '0' , 'status' => '1','message_from !=' => $userid);

    $join_str4[0]['table'] = 'messages';
    $join_str4[0]['join_table_id'] = 'messages.message_from';
    $join_str4[0]['from_table_id'] = 'user.user_id';
    $join_str4[0]['join_type'] = '';

    $search_condition = "((message_to = '$userid') && (message_from != '$lstusr'))";
     
   
    $fromlist = $this->common->select_data_by_search('user',$search_condition,$contition_array, $data = 'messages.id,messages.message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str4, $groupby = '');
      

  // uniq array of fromlist  
      foreach($fromlist as $k => $v) 
{
    foreach($fromlist as $key => $value) 
    {
        if($k != $key && $v['message_from'] == $value['message_from'])
        {
             unset($fromlist[$k]);
        }
    }
}

// replace name of message_to in user_id

   $return_arrayfrom = array();

    foreach($fromlist as $from_list){
if($to_list['message_from'] != $lstusr){
      $return = array();
      $return = $from_list;

      $return['user_id'] = $from_list['message_from'];
      $return['first_name'] = $from_list['first_name'];
      $return['user_image'] = $from_list['user_image'];
      $return['message'] = $from_list['message'];

      
      unset($return['message_from']);
     array_push($return_arrayfrom, $return);
}
    } 

 $userlist = array_merge($return_arrayto,$return_arrayfrom);
 


   // uniq array of fromlist  
foreach($userlist as $k => $v) 
{
    foreach($userlist as $key => $value) 
    {
        if($k != $key && $v['user_id'] == $value['user_id'])
        {
             unset($userlist[$k]);
        }
    }
}

$userlist =  $this->aasort($userlist,"id");

$this->data['userlist'] = array_merge($return_arraysel,$userlist);
    // khyati changes end 20-4

// smily start
$smileys = _get_smiley_array();
$this->data['smiley_table'] = $smileys;
// smily end
//die();
    $this->load->view('chat',$this->data);
  }

  public function abc($id)
  { 
      
   // khyati 25-4 changes start
$this->data['userid'] = $userid = $this->session->userdata('aileenuser');
   
   // last user if $id is null

    $contition_array = array('id !=' => '');

    $search_condition = "(message_from = '$userid' OR message_to = '$userid')";

    $lastchat = $this->common->select_data_by_search('messages', $search_condition,$contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');
      
  if($id){     
  
  $toid =  $this->data['toid'] = $id;
  
  }elseif($lastchat[0]['message_from'] == $userid){
     
  $toid =    $this->data['toid'] = $lastchat[0]['message_to'];
  }else{
    
  $toid =  $this->data['toid'] = $lastchat[0]['message_from'];
    }

   // khyati 22-4 changes end

    $loginuser = $this->common->select_data_by_id('user', 'user_id', $userid, $data = 'first_name,last_name');
    
    $this->data['logfname'] = $loginuser[0]['first_name'];
    $this->data['loglname'] = $loginuser[0]['last_name'];
   
    // last message user fetch
    
    $contition_array = array('id !=' => '');

    $search_condition = "(message_from = '$id' OR message_to = '$id')";

    $lastuser = $this->common->select_data_by_search('messages', $search_condition,$contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');
    
    if($lastuser[0]['message_from'] == $userid){
     
  $lstusr =    $this->data['lstusr'] = $lastuser[0]['message_to'];
    }else{
    
  $lstusr =  $this->data['lstusr'] = $lastuser[0]['message_from'];
    }

// last user first name last name
    if($lstusr){
    $lastuser = $this->common->select_data_by_id('user', 'user_id', $lstusr, $data = 'first_name,last_name');
    
    $this->data['lstfname'] = $lastuser[0]['first_name'];
    $this->data['lstlname'] = $lastuser[0]['last_name'];
    }
    //khyati changes starrt 20-4
    
    // slected user chat to

    
     $contition_array = array('is_delete' => '0' , 'status' => '1');

     $join_str1[0]['table'] = 'messages';
     $join_str1[0]['join_table_id'] = 'messages.message_to';
     $join_str1[0]['from_table_id'] = 'user.user_id';
     $join_str1[0]['join_type'] = '';

     
     
    $search_condition = "((message_from = '$id' OR message_to = '$id') && (message_to != '$userid'))";

     $seltousr = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');


     // slected user chat from

    
     $contition_array = array('is_delete' => '0' , 'status' => '1');

     $join_str2[0]['table'] = 'messages';
     $join_str2[0]['join_table_id'] = 'messages.message_from';
     $join_str2[0]['from_table_id'] = 'user.user_id';
     $join_str2[0]['join_type'] = '';

     
     
    $search_condition = "((message_from = '$id' OR message_to = '$id') && (message_from != '$userid'))";

     $selfromusr = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.id,message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');


$selectuser = array_merge($seltousr,$selfromusr);
$selectuser =  $this->aasort($selectuser,"id");
//echo '<pre>';print_r($selectuser); die();

// replace name of message_to in user_id in select user

   $return_arraysel = array();
$i=0;
    foreach($selectuser as $k => $sel_list){
        $return = array();
       $return = $sel_list;

if($sel_list['message_to']){
     if($sel_list['message_to'] == $id){ 
       $return['user_id'] = $sel_list['message_to'];
       $return['first_name'] = $sel_list['first_name'];
       $return['user_image'] = $sel_list['user_image'];
       $return['message'] = $sel_list['message'];
      
       unset($return['message_to']);
       
        $i++;
if($i==1) break;
     }
     
    
}else{ 
if($sel_list['message_from'] == $id){ 
       $return['user_id'] = $sel_list['message_from'];
       $return['first_name'] = $sel_list['first_name'];
       $return['user_image'] = $sel_list['user_image'];
       $return['message'] = $sel_list['message'];
       
        $i++;
if($i==1) break;
}
      
       unset($return['message_from']);
        
      }


    } array_push($return_arraysel, $return); 

     // message to user
     $contition_array = array('is_delete' => '0' , 'status' => '1','message_to !=' => $userid);

     $join_str3[0]['table'] = 'messages';
     $join_str3[0]['join_table_id'] = 'messages.message_to';
     $join_str3[0]['from_table_id'] = 'user.user_id';
     $join_str3[0]['join_type'] = '';
     
$search_condition = "((message_from = '$userid') && (message_to != '$id'))";

     $tolist = $this->common->select_data_by_search('user',$search_condition,$contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str3, $groupby = '');

     // uniq array of tolist  
      foreach($tolist as $k => $v) 
{ 
    foreach($tolist as $key => $value) 
    { 
      
        if($k != $key && $v['message_to'] == $value['message_to'])
        {
             unset($tolist[$k]);
        }
    }
}

 // replace name of message_to in user_id

   $return_arrayto = array();

    foreach($tolist as $to_list){
if($to_list['message_to'] != $id){
      $return = array();
      $return = $to_list;

      $return['user_id'] = $to_list['message_to'];
      $return['first_name'] = $to_list['first_name'];
      $return['user_image'] = $to_list['user_image'];
       $return['message'] = $to_list['message'];

      
      unset($return['message_to']);
     array_push($return_arrayto, $return);
}
    } 

    // message from user
    $contition_array = array('is_delete' => '0' , 'status' => '1','message_from !=' => $userid);

    $join_str4[0]['table'] = 'messages';
    $join_str4[0]['join_table_id'] = 'messages.message_from';
    $join_str4[0]['from_table_id'] = 'user.user_id';
    $join_str4[0]['join_type'] = '';
     
   $search_condition = "((message_to = '$userid') && (message_from != '$id'))";

    $fromlist = $this->common->select_data_by_search('user',$search_condition,$contition_array, $data = 'messages.id,messages.message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str4, $groupby = '');
    

  // uniq array of fromlist  
      foreach($fromlist as $k => $v) 
{  
    foreach($fromlist as $key => $value) 
   { 
         if($k != $key && $v['message_from'] == $value['message_from'] )
         { 
              unset($fromlist[$k]);
         }

       }
}

// replace name of message_to in user_id

   $return_arrayfrom = array();

    foreach($fromlist as $from_list){
if($from_list['message_from'] != $id){
      $return = array();
      $return = $from_list;

      $return['user_id'] = $from_list['message_from'];
      $return['first_name'] = $from_list['first_name'];
      $return['user_image'] = $from_list['user_image'];
       $return['message'] = $from_list['message'];

      
      unset($return['message_from']);
     array_push($return_arrayfrom, $return);
}
    } 

   

 $userlist = array_merge($return_arrayto,$return_arrayfrom);
 

   // uniq array of fromlist  
foreach($userlist as $k => $v) 
{
    foreach($userlist as $key => $value) 
    {
        if($k != $key && $v['user_id'] == $value['user_id'])
        {
             unset($userlist[$k]);
        }
    }
}


$userlist =  $this->aasort($userlist,"id");

$this->data['userlist'] = array_merge($return_arraysel,$userlist);

//echo '<pre>'; print_r($this->data['userlist']); die();

   // khytai changes 22-4 end
    
  
// smily start
$smileys = _get_smiley_array();
$this->data['smiley_table'] = $smileys;
// smily end
   // khytai changes end 22-4
    
    $this->load->view('chat2',$this->data);
  }

  public function user_list($id)
  { 
    $userid = $this->session->userdata('aileenuser');
    $usrsearchdata = trim($_POST['search_user']); 
    
    if($usrsearchdata != ""){
   // message to user
     $contition_array = array('is_delete' => '0' , 'status' => '1','message_to !=' => $userid);

     $join_str5[0]['table'] = 'messages';
     $join_str5[0]['join_table_id'] = 'messages.message_to';
     $join_str5[0]['from_table_id'] = 'user.user_id';
     $join_str5[0]['join_type'] = '';
     
    
     $search_condition = "(first_name LIKE '" . trim($usrsearchdata) . "%')";

     $tolist = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'message_to,first_name,user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5, $groupby = '');
   
    // uniq array of tolist  
      foreach($tolist as $k => $v) 
{
    foreach($tolist as $key => $value) 
    {
        if($k != $key && $v['message_to'] == $value['message_to'])
        {
             unset($tolist[$k]);
        }
    }
}

 // replace name of message_to in user_id

   $return_arrayto = array();

    foreach($tolist as $to_list){

      $return = array();
      $return = $to_list;

      $return['user_id'] = $to_list['message_to'];
      $return['first_name'] = $to_list['first_name'];
      $return['user_image'] = $to_list['user_image'];
      
      unset($return['message_to']);
     array_push($return_arrayto, $return);

    } 

  
 // message from user
    $contition_array = array('is_delete' => '0' , 'status' => '1','message_from !=' => $userid);

    $join_str6[0]['table'] = 'messages';
    $join_str6[0]['join_table_id'] = 'messages.message_from';
    $join_str6[0]['from_table_id'] = 'user.user_id';
    $join_str6[0]['join_type'] = '';
     
    $search_condition = "(first_name LIKE '$usrsearchdata%')";

    $fromlist = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.message_from,first_name,user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str6, $groupby = '');
    
    // uniq array of fromlist  
      foreach($fromlist as $k => $v) 
{
    foreach($fromlist as $key => $value) 
    {
        if($k != $key && $v['message_from'] == $value['message_from'])
        {
             unset($fromlist[$k]);
        }
    }
}

// replace name of message_to in user_id

   $return_arrayfrom = array();

    foreach($fromlist as $from_list){

      $return = array();
      $return = $from_list;

      $return['user_id'] = $from_list['message_from'];
      $return['first_name'] = $from_list['first_name'];
      $return['user_image'] = $from_list['user_image'];
      
      unset($return['message_from']);
     array_push($return_arrayfrom, $return);

    } 

 $userlist = array_merge($return_arrayto,$return_arrayfrom);
   
   // uniq array of fromlist  
foreach($userlist as $k => $v) 
{
    foreach($userlist as $key => $value) 
    {
        if($k != $key && $v['user_id'] == $value['user_id'])
        {
             unset($userlist[$k]);
        }
    }
}
  //echo '<pre>'; print_r($userlist); die();
   if($userlist){

    foreach($userlist as $user){ 
  $usrsrch =  '<li class="clearfix">';

  if ($user['user_image']) {
    $usrsrch .=' <div class="chat_heae_img">';
$usrsrch .=  '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $user['user_image']) . '" alt="avatar" height="50px" weight="50px" />';
  $usrsrch .='</div>'; 
 } else { 
 $usrsrch .=' <div class="chat_heae_img">';
  $usrsrch .= '<img src="' . base_url(NOIMAGE) . '" alt="" height="50px" weight="50px">';
    $usrsrch .='</div>'; 
 } 

    $usrsrch .= '<div class="about">';
    $usrsrch  .= '<div class="name">'; 
  $usrsrch .= '<a href="' . base_url() . 'chat/abc/' . $user['user_id'] . '">' . $user['first_name'] . ' ' . $user['last_name'] . '<br></a>'; 
$usrsrch .= '</div><div class="status">Current Work</div></div></li>';
 } 

   }else{
    
    $usrsrch .= '<div class="notac_a">No user available.. !!</div>';

   }

 }else{
     
     // 17-5-2017
  //$usrsrch .= '<div class="notac_a">No user available.. !!</div>';
  
  $this->data['userid'] =  $userid = $this->session->userdata('aileenuser');

    $loginuser = $this->common->select_data_by_id('user', 'user_id', $userid, $data = 'first_name,last_name');
    
    $this->data['logfname'] = $loginuser[0]['first_name'];
    $this->data['loglname'] = $loginuser[0]['last_name'];
   
    // last message user fetch
    
    $contition_array = array('id !=' => '');

    $search_condition = "(message_from = '$userid' OR message_to = '$userid')";

    $lastuser = $this->common->select_data_by_search('messages', $search_condition,$contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');
    
    if($lastuser[0]['message_from'] == $userid){
     
  $lstusr =    $this->data['lstusr'] = $lastuser[0]['message_to'];
    }else{
    
  $lstusr =  $this->data['lstusr'] = $lastuser[0]['message_from'];
    }

// last user first name last name
    if($lstusr){
    $lastuser = $this->common->select_data_by_id('user', 'user_id', $lstusr, $data = 'first_name,last_name');
    
    $this->data['lstfname'] = $lastuser[0]['first_name'];
    $this->data['lstlname'] = $lastuser[0]['last_name'];
    }
    //khyati changes starrt 20-4

    // khyati 24-4 start 
     
     // slected user chat to

    
     $contition_array = array('is_delete' => '0' , 'status' => '1');

     $join_str1[0]['table'] = 'messages';
     $join_str1[0]['join_table_id'] = 'messages.message_to';
     $join_str1[0]['from_table_id'] = 'user.user_id';
     $join_str1[0]['join_type'] = '';
    
    $search_condition = "((message_from = '$lstusr' OR message_to = '$lstusr') && (message_to != '$userid'))";

     $seltousr = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');


     // slected user chat from

    
     $contition_array = array('is_delete' => '0' , 'status' => '1');

     $join_str2[0]['table'] = 'messages';
     $join_str2[0]['join_table_id'] = 'messages.message_from';
     $join_str2[0]['from_table_id'] = 'user.user_id';
     $join_str2[0]['join_type'] = '';

     
     
    $search_condition = "((message_from = '$lstusr' OR message_to = '$lstusr') && (message_from != '$userid'))";

     $selfromusr = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.id,message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');


$selectuser = array_merge($seltousr,$selfromusr);
$selectuser =  $this->aasort($selectuser,"id");


// replace name of message_to in user_id in select user

   $return_arraysel = array();
$i=0;
    foreach($selectuser as $k => $sel_list){
        $return = array();
       $return = $sel_list;

if($sel_list['message_to']){ 
     
       $return['user_id'] = $sel_list['message_to'];
       $return['first_name'] = $sel_list['first_name'];
       $return['user_image'] = $sel_list['user_image'];
       $return['message'] = $sel_list['message'];
      
       unset($return['message_to']);
      
}else{ 

       $return['user_id'] = $sel_list['message_from'];
       $return['first_name'] = $sel_list['first_name'];
       $return['user_image'] = $sel_list['user_image'];
       $return['message'] = $sel_list['message'];

      
       unset($return['message_from']);
      }
array_push($return_arraysel, $return);
$i++;
if($i==1) break;
    } 


    // khyati 24-4 end 

     // message to user
    


 $contition_array = array('is_delete' => '0' , 'status' => '1','message_to !=' => $userid);

     $join_str3[0]['table'] = 'messages';
     $join_str3[0]['join_table_id'] = 'messages.message_to';
     $join_str3[0]['from_table_id'] = 'user.user_id';
     $join_str3[0]['join_type'] = '';
     
$search_condition = "((message_from = '$userid') && (message_to != '$lstusr'))";

     $tolist = $this->common->select_data_by_search('user',$search_condition,$contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str3, $groupby = '');

 

// uniq array of tolist  
foreach($tolist as $k => $v) 
{
    foreach($tolist as $key => $value) 
    {
        if($k != $key && $v['message_to'] == $value['message_to'])
        {
             unset($tolist[$k]);
        }
    }
}

 // replace name of message_to in user_id

   $return_arrayto = array();

    foreach($tolist as $to_list){
if($to_list['message_to'] != $lstusr){
      $return = array();
      $return = $to_list;

      $return['user_id'] = $to_list['message_to'];
      $return['first_name'] = $to_list['first_name'];
      $return['user_image'] = $to_list['user_image'];
      $return['message'] = $to_list['message'];
      
      unset($return['message_to']);
     array_push($return_arrayto, $return);
}
    } 

    // message from user
    $contition_array = array('is_delete' => '0' , 'status' => '1','message_from !=' => $userid);

    $join_str4[0]['table'] = 'messages';
    $join_str4[0]['join_table_id'] = 'messages.message_from';
    $join_str4[0]['from_table_id'] = 'user.user_id';
    $join_str4[0]['join_type'] = '';

    $search_condition = "((message_to = '$userid') && (message_from != '$lstusr'))";
     
   
    $fromlist = $this->common->select_data_by_search('user',$search_condition,$contition_array, $data = 'messages.id,messages.message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str4, $groupby = '');
      

  // uniq array of fromlist  
      foreach($fromlist as $k => $v) 
{
    foreach($fromlist as $key => $value) 
    {
        if($k != $key && $v['message_from'] == $value['message_from'])
        {
             unset($fromlist[$k]);
        }
    }
}

// replace name of message_to in user_id

   $return_arrayfrom = array();

    foreach($fromlist as $from_list){
if($to_list['message_from'] != $lstusr){
      $return = array();
      $return = $from_list;

      $return['user_id'] = $from_list['message_from'];
      $return['first_name'] = $from_list['first_name'];
      $return['user_image'] = $from_list['user_image'];
      $return['message'] = $from_list['message'];

      
      unset($return['message_from']);
     array_push($return_arrayfrom, $return);
}
    } 

 $userlist = array_merge($return_arrayto,$return_arrayfrom);
 


   // uniq array of fromlist  
foreach($userlist as $k => $v) 
{
    foreach($userlist as $key => $value) 
    {
        if($k != $key && $v['user_id'] == $value['user_id'])
        {
             unset($userlist[$k]);
        }
    }
}

$userlist =  $this->aasort($userlist,"id");

$userdata = array_merge($return_arraysel,$userlist);
  
   

if(count($userdata) > 0){
 foreach($userdata as $user){ 
 $usrsrch .= '<a href="' . base_url() . 'chat/abc/' . $user['user_id'] . '">';
 $usrsrch .= '<li class="clearfix">';
                  if ($user['user_image']) {
   $usrsrch .= '<div class="chat_heae_img">';
$usrsrch .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $user['user_image']) . '" alt="" >';
$usrsrch .= '</div>';
  } else { 
 $usrsrch .= '<div class="chat_heae_img">';
 $usrsrch .= '<img src="' . base_url(NOIMAGE) . '" alt="" >';
 $usrsrch .= '</div>';
 } 
  $usrsrch .= '<div class="about">';
  $usrsrch .= '<div class="name">'; 
  $usrsrch .= '' . $user['first_name'] . ' ' . $user['last_name'] . '<br> </div>';
  $usrsrch .= '<div class="status' . $user['user_id'] . '" style=" width: 145px;    max-height: 19px;
    color: #003;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; ">';
    $usrsrch .= '' . $user['message'] . '';
    $usrsrch .= '</div>';
    $usrsrch .= '</div>';
    $usrsrch .= '</li>';
    $usrsrch .= '</a>';
 }}else{
  $usrsrch .= 'No user available...';
  } 
  // 17-5-2017 end
 }
   
echo $usrsrch;
  }


  //khyati 22-4 changes start 


public function userlisttwo($id='')
  {
    $userid = $this->session->userdata('aileenuser');
    $usrsearchdata = trim($_POST['search_user']); 
    $usrid = trim($_POST['user']); 
    
    if($usrsearchdata != ""){
   // message to user
     $contition_array = array('is_delete' => '0' , 'status' => '1','message_to !=' => $userid);

     $join_str7[0]['table'] = 'messages';
     $join_str7[0]['join_table_id'] = 'messages.message_to';
     $join_str7[0]['from_table_id'] = 'user.user_id';
     $join_str7[0]['join_type'] = '';
     
    
     $search_condition = "((first_name LIKE '" . trim($usrsearchdata) . "%') AND (message_to !='" . $usrid . "' ))";

     $tolist = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'message_to,first_name,user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str7, $groupby = '');
   
    // uniq array of tolist  
      foreach($tolist as $k => $v) 
{
    foreach($tolist as $key => $value) 
    {
        if($k != $key && $v['message_to'] == $value['message_to'])
        {
             unset($tolist[$k]);
        }
    }
}

 // replace name of message_to in user_id

   $return_arrayto = array();

    foreach($tolist as $to_list){

      $return = array();
      $return = $to_list;

      $return['user_id'] = $to_list['message_to'];
      $return['first_name'] = $to_list['first_name'];
      $return['user_image'] = $to_list['user_image'];
      
      unset($return['message_to']);
     array_push($return_arrayto, $return);

    } 

  
 // message from user
    $contition_array = array('is_delete' => '0' , 'status' => '1','message_from !=' => $userid);

    $join_str[0]['table'] = 'messages';
    $join_str[0]['join_table_id'] = 'messages.message_from';
    $join_str[0]['from_table_id'] = 'user.user_id';
    $join_str[0]['join_type'] = '';
     
    $search_condition = "((first_name LIKE '" . trim($usrsearchdata) . "%') AND (message_from !='" . $usrid . "' ))";

    $fromlist = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.message_from,first_name,user_image', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
    
    // uniq array of fromlist  
      foreach($fromlist as $k => $v) 
{
    foreach($fromlist as $key => $value) 
    {
        if($k != $key && $v['message_from'] == $value['message_from'])
        {
             unset($fromlist[$k]);
        }
    }
}

// replace name of message_to in user_id

   $return_arrayfrom = array();

    foreach($fromlist as $from_list){

      $return = array();
      $return = $from_list;

      $return['user_id'] = $from_list['message_from'];
      $return['first_name'] = $from_list['first_name'];
      $return['user_image'] = $from_list['user_image'];
      
      unset($return['message_from']);
     array_push($return_arrayfrom, $return);

    } 

 $userlist = array_merge($return_arrayto,$return_arrayfrom);
   
   // uniq array of fromlist  
foreach($userlist as $k => $v) 
{
    foreach($userlist as $key => $value) 
    {
        if($k != $key && $v['user_id'] == $value['user_id'])
        {
             unset($userlist[$k]);
        }
    }
}
  //echo '<pre>'; print_r($userlist); die();
   if($userlist){

    foreach($userlist as $user){ 
  $usrsrch =  '<li class="clearfix">';

  if ($user['user_image']) {
    $usrsrch .='    <div class="chat_heae_img">';
$usrsrch .=  '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $user['user_image']) . '" alt="avatar" height="50px" weight="50px" />';
  $usrsrch .='</div>';

 } else { 
 $usrsrch .='    <div class="chat_heae_img">';
  $usrsrch .= '<img src="' . base_url(NOIMAGE) . '" alt="" height="50px" weight="50px">'; 
  $usrsrch .='</div>';
 } 

    $usrsrch .= '<div class="about">';
    $usrsrch  .= '<div class="name">'; 
  $usrsrch .= '<a href="' . base_url() . 'chat/abc/' . $user['user_id'] . '">' . $user['first_name'] . '<br></a>'; 
$usrsrch .= '</div><div class="status">Current Work</div></div></li>';
 } 

   }else{
    
    $usrsrch .= '<div class="notac_a">No user available.. !!</div>';

   }

 }else{
   
    // 17-5-2017 start
  $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
        
   // last user if $id is null

    $contition_array = array('id !=' => '');

    $search_condition = "(message_from = '$userid' OR message_to = '$userid')";

    $lastchat = $this->common->select_data_by_search('messages', $search_condition,$contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');
      
  if($id){     
  
  $toid =  $this->data['toid'] = $id;
  
  }elseif($lastchat[0]['message_from'] == $userid){
     
  $toid =    $this->data['toid'] = $lastchat[0]['message_to'];
  }else{
    
  $toid =  $this->data['toid'] = $lastchat[0]['message_from'];
    }

   // khyati 22-4 changes end

    $loginuser = $this->common->select_data_by_id('user', 'user_id', $userid, $data = 'first_name,last_name');
    
    $this->data['logfname'] = $loginuser[0]['first_name'];
    $this->data['loglname'] = $loginuser[0]['last_name'];
   
    // last message user fetch
    
    $contition_array = array('id !=' => '');

    $search_condition = "(message_from = '$id' OR message_to = '$id')";

    $lastuser = $this->common->select_data_by_search('messages', $search_condition,$contition_array, $data = 'messages.message_from,message_to,id', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');
    
    if($lastuser[0]['message_from'] == $userid){
     
  $lstusr =    $this->data['lstusr'] = $lastuser[0]['message_to'];
    }else{
    
  $lstusr =  $this->data['lstusr'] = $lastuser[0]['message_from'];
    }

// last user first name last name
    if($lstusr){
    $lastuser = $this->common->select_data_by_id('user', 'user_id', $lstusr, $data = 'first_name,last_name');
    
    $this->data['lstfname'] = $lastuser[0]['first_name'];
    $this->data['lstlname'] = $lastuser[0]['last_name'];
    }
    //khyati changes starrt 20-4
    
    // slected user chat to

    
     $contition_array = array('is_delete' => '0' , 'status' => '1');

     $join_str1[0]['table'] = 'messages';
     $join_str1[0]['join_table_id'] = 'messages.message_to';
     $join_str1[0]['from_table_id'] = 'user.user_id';
     $join_str1[0]['join_type'] = '';

     
     
    $search_condition = "((message_from = '$id' OR message_to = '$id') && (message_to != '$userid'))";

     $seltousr = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str1, $groupby = '');


     // slected user chat from

    
     $contition_array = array('is_delete' => '0' , 'status' => '1');

     $join_str2[0]['table'] = 'messages';
     $join_str2[0]['join_table_id'] = 'messages.message_from';
     $join_str2[0]['from_table_id'] = 'user.user_id';
     $join_str2[0]['join_type'] = '';

     
     
    $search_condition = "((message_from = '$id' OR message_to = '$id') && (message_from != '$userid'))";

     $selfromusr = $this->common->select_data_by_search('user', $search_condition,$contition_array, $data = 'messages.id,message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str2, $groupby = '');


$selectuser = array_merge($seltousr,$selfromusr);
$selectuser =  $this->aasort($selectuser,"id");


// replace name of message_to in user_id in select user

   $return_arraysel = array();
$i=0;
    foreach($selectuser as $k => $sel_list){
        $return = array();
       $return = $sel_list;

if($sel_list['message_to']){ 
     
       $return['user_id'] = $sel_list['message_to'];
       $return['first_name'] = $sel_list['first_name'];
       $return['user_image'] = $sel_list['user_image'];
       $return['message'] = $sel_list['message'];
      
       unset($return['message_to']);
      
}else{ 

       $return['user_id'] = $sel_list['message_from'];
       $return['first_name'] = $sel_list['first_name'];
       $return['user_image'] = $sel_list['user_image'];
       $return['message'] = $sel_list['message'];

      
       unset($return['message_from']);
      }
array_push($return_arraysel, $return);
$i++;
if($i==1) break;
    } 

     // message to user
     $contition_array = array('is_delete' => '0' , 'status' => '1','message_to !=' => $userid);

     $join_str3[0]['table'] = 'messages';
     $join_str3[0]['join_table_id'] = 'messages.message_to';
     $join_str3[0]['from_table_id'] = 'user.user_id';
     $join_str3[0]['join_type'] = '';
     
$search_condition = "((message_from = '$userid') && (message_to != '$id'))";

     $tolist = $this->common->select_data_by_search('user',$search_condition,$contition_array, $data = 'messages.id,message_to,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str3, $groupby = '');

     // uniq array of tolist  
      foreach($tolist as $k => $v) 
{ 
    foreach($tolist as $key => $value) 
    { 
      
        if($k != $key && $v['message_to'] == $value['message_to'])
        {
             unset($tolist[$k]);
        }
    }
}

 // replace name of message_to in user_id

   $return_arrayto = array();

    foreach($tolist as $to_list){
      if($to_list['message_to'] != $id){
      $return = array();
      $return = $to_list;

      $return['user_id'] = $to_list['message_to'];
      $return['first_name'] = $to_list['first_name'];
      $return['user_image'] = $to_list['user_image'];
       $return['message'] = $to_list['message'];

      
      unset($return['message_to']);
     array_push($return_arrayto, $return);
}
    } 

    // message from user
    $contition_array = array('is_delete' => '0' , 'status' => '1','message_from !=' => $userid);

    $join_str4[0]['table'] = 'messages';
    $join_str4[0]['join_table_id'] = 'messages.message_from';
    $join_str4[0]['from_table_id'] = 'user.user_id';
    $join_str4[0]['join_type'] = '';
     
   $search_condition = "((message_to = '$userid') && (message_from != '$id'))";

    $fromlist = $this->common->select_data_by_search('user',$search_condition,$contition_array, $data = 'messages.id,messages.message_from,first_name,user_image,message', $sortby = 'messages.id', $orderby = 'DESC', $limit = '', $offset = '', $join_str4, $groupby = '');
    

  // uniq array of fromlist  
      foreach($fromlist as $k => $v) 
{  
    foreach($fromlist as $key => $value) 
   { 
         if($k != $key && $v['message_from'] == $value['message_from'] )
         { 
              unset($fromlist[$k]);
         }

       }
}

// replace name of message_to in user_id

   $return_arrayfrom = array();

    foreach($fromlist as $from_list){
if($from_list['message_from'] != $id){
      $return = array();
      $return = $from_list;

      $return['user_id'] = $from_list['message_from'];
      $return['first_name'] = $from_list['first_name'];
      $return['user_image'] = $from_list['user_image'];
       $return['message'] = $from_list['message'];

      
      unset($return['message_from']);
     array_push($return_arrayfrom, $return);
}
    } 

   

 $userlist = array_merge($return_arrayto,$return_arrayfrom);
 

   // uniq array of fromlist  
foreach($userlist as $k => $v) 
{
    foreach($userlist as $key => $value) 
    {
        if($k != $key && $v['user_id'] == $value['user_id'])
        {
             unset($userlist[$k]);
        }
    }
}


$userlist =  $this->aasort($userlist,"id");

$userlist = array_merge($return_arraysel,$userlist);
  //echo '<pre>'; print_r($userlist); die();
 if(in_array($toid,$userlist)){ 
  foreach($userlist as $user){ 
 $usrsrch .= '<li class="clearfix">'; 
 if($user['user_id'] == $toid){ 
     $usrsrch .= 'active'; 
     
 } 
$usrsrch .= '">';
          if ($user['user_image']) {
   $usrsrch .= '<div class="chat_heae_img">';
$usrsrch .= '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $user['user_image']) . '" alt="" height="50px" weight="50px">';
$usrsrch .= '</div>';
   } else { 
 
 $usrsrch .= '<div class="chat_heae_img">';
 $usrsrch .= '<img src="' . base_url(NOIMAGE) . '" alt="" height="30px" weight="30px">';
 $usrsrch .= '</div>';
  } 
          $usrsrch .= '<div class="about">';
            $usrsrch .= '<div class="name">'; 
    $usrsrch .= '<a href="' . base_url() . 'chat/abc/' . $user['user_id'] . '">' . $user['first_name'] . ' ' . $user['last_name'] . '<br></a> </div>';
    $usrsrch .= '<div class="status' . $user['user_id'] . '" style=" width: 145px;    max-height: 25px;
    color: #003;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
">';
         $usrsrch .= '' .  $user['message'] . '';
        $usrsrch .=  '</div>';
        $usrsrch .=  '</div>';
        $usrsrch .=  '</li>';
 }
 }else{ 

  $lstusrdata = $this->common->select_data_by_id('user', 'user_id', $toid, $data = '*');


if($lstusrdata){

  $usrsrch .=  '<li class="clearfix '; if($lstusrdata[0]['user_id'] == $toid){ $usrsrch .= 'active'; } $usrsrch .= '">';
              if ($lstusrdata[0]['user_image']) {
    $usrsrch .=  '<div class="chat_heae_img">';
$usrsrch .=  '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $lstusrdata[0]['user_image']) . '" alt="" height="50px" weight="50px">';
$usrsrch .=  '</div>';
  } else { 
  $usrsrch .=  '<div class="chat_heae_img">';
 $usrsrch .=  '<img src="' . base_url(NOIMAGE) . '" alt="" height="50px" weight="50px">';
 $usrsrch .=  '</div>';
  } 
       $usrsrch .=  '<div class="about">';
         $usrsrch .=  '<div class="name">'; 
    $usrsrch .=  '<a href="' . base_url() . 'chat/abc/' . $lstusrdata[0]['user_id'] . '">' . $lstusrdata[0]['first_name'] . ' ' . $lstusrdata[0]['last_name'] .  '<br></a> </div>';
    $usrsrch .=  '<div class="status' . $lstusrdata[0]['user_id'] . '" style=" width: 145px;    max-height: 25px;
    color: #003;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
">';
    $search_condition = "((message_from = '$userid' AND message_to = '$toid') OR (message_to = '$userid' AND message_from = '$toid'))";
    $contition_array = array('id !=' => '');
    $messages = $this->common->select_data_by_search('messages', $search_condition,$contition_array, $data = '*', $sortby = 'id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = '', $groupby = '');
    
    
         $usrsrch .= '' .   $messages[0]['message'] . '';   
          
      $usrsrch .=  '</div>
          </div>
        </li>';

  }  
foreach($userlist as $user){
if($user['user_id'] != $toid){
 
 $usrsrch .=  '<a href="' . base_url() . 'chat/abc/' . $user['user_id'] . '">';
 $usrsrch .=  '<li class="clearfix">'; if($user['user_id'] == $toid){ $usrsrch .=  'class ="active"'; } 
          if ($user['user_image']) {
    $usrsrch .=  '<div class="chat_heae_img">';
$usrsrch .=  '<img src="' . base_url($this->config->item('user_thumb_upload_path') . $user['user_image']) . '" alt="" height="50px" weight="50px">';
$usrsrch .=  '</div>';
  } else { 
 $usrsrch .=  '<div class="chat_heae_img">';
 $usrsrch .=  '<img src="' . base_url(NOIMAGE) . '" alt="" height="50px" weight="50px">';
 $usrsrch .=  '</div>';
  } 
     $usrsrch .=  '<div class="about">';
      $usrsrch .=  '<div class="name">'; 
    $usrsrch .= '' .   $user['first_name'] . ' ' . $user['last_name'] . '<br></div>';
    $usrsrch .= '<div class="status' . $user['user_id'] .'" style=" width: 145px;
    color: #003;    max-height: 25px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
">';
        $usrsrch .= '' .   $user['message'] . ''; 
        $usrsrch .= '</div>';
        $usrsrch .= '</div>';
       $usrsrch .= '</li></a>'; 
 }}


  }
  // 17-5-2017 end
 }
   
echo $usrsrch;
  }

  //khyati 22-4 changes end 

  //  sort an array start

  // khyati changes start 7-4
    public  function aasort(&$array, $key) {
      $sorter=array();    $ret=array();    reset($array); 

         foreach ($array as $ii => $va) {       

          $sorter[$ii]=$va[$key];    

        }   

         arsort($sorter);  

           foreach ($sorter as $ii => $va) {    

               $ret[$ii]=$array[$ii];   

                }  

     return  $array=$ret;
}
 
  public  function scroll(&$array, $key) {
     $this->load->view('scroll');
  
  }

}

