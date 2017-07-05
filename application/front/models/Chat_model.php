<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Chat_model extends CI_Model {  
  
	function add_message($message, $nickname, $guid,$userid,$id)
	{
		$data1 = array(
			'message'	=> (string) $message,
			'nickname'	=> (string) $nickname,
			'message_from'	=> (string) $userid,
			'message_to'	=> (string) $id,
			'guid'		=> (string)	$guid,
			'timestamp'	=> time(),
		);
		  
		$this->db->insert('messages', $data1);
                $msg_insert_id = $this->db->insert_id();
               
                $data2 = array(
			'not_type'	=> 2,
			'not_from_id'	=> $userid,
			'not_to_id'	=> $id,
                        'not_read' => 2,
                        'not_img' => 0,                       
                        'not_active' => 1,
                        'not_product_id' => $msg_insert_id,
                        'not_created_date' => date('y-m-d h:i:s'),
			
		);
		  
		$this->db->insert('notification', $data2);
	}
 
	function get_messages($timestamp,$userid,$id)
	{ 

	// khyati start 
        
       $this->db->where('timestamp >', $timestamp);
       $where = '((message_from="' . $userid . '"AND message_to ="' . $id . '") OR (message_to="' . $userid . '" AND message_from ="' . $id . '"))';
       $this->db->where($where);

		// khyati end
		
		//$this->db->where('message_from', $userid);
		//$this->db->where('message_to', $id);
		$this->db->order_by('timestamp', 'DESC');
	//	$this->db->limit(10); 
		$query = $this->db->get('messages');
		//echo $this->db->last_query(); die();
		return array_reverse($query->result_array());
	}
 
}