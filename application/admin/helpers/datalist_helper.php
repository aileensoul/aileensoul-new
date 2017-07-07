<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_enum_values'))
{
 //for geting posiable value fo enum type pass the table name with it prefix   
    function get_enum_values( $table, $field )
    {
        $CI = get_instance();
        $CI->load->model('common');
        
        $type = $CI->db->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }
    
  
}


if ( ! function_exists('datalist_parent_cat'))
{
    function datalist_parent_cat($id=0){
        
        
        $CI = get_instance();
        $CI->load->model('common');
      
        $contition_array = array('is_deleted != ' => '1','parent_id'=>0);
        $arrays = $CI->common->select_data_by_condition('category', $contition_array, '*', 'category_title', 'asc');
        
        if($id>0){
            $contition_array = array('categoryid'=>$id);
        
            $pid=$CI->common->select_data_by_condition('category', $contition_array, 'parent_id');
         
            if($pid[0]['parent_id']>0){
                $id=$pid[0]['parent_id'];
            }
        }
        $str='';
        foreach ($arrays as $cat) { 
            //$str='';
            $str.= "<option value='" .$cat['categoryid']."'";
            if($id==$cat['categoryid']){
              $str.="selected='selected'";
             }
            
            $str.=">" .$cat['category_title'] ."</option>";
            
        }         
       echo $str;
    }

}


if ( ! function_exists('datalist_sub_cat'))
{
    function datalist_sub_cat($id=0,$subid=0){
        
        $CI = get_instance();
        $CI->load->model('common');
      
        $contition_array = array('is_deleted != ' => '1','parent_id'=>$id);
        $arrays = $CI->common->select_data_by_condition('category', $contition_array, '*', 'category_title', 'asc');
        
        //return $arrays;
        
        if($id>0){
            $contition_array = array('categoryid'=>$id);
        
            $pid=$CI->common->select_data_by_condition('category', $contition_array, 'parent_id');
            
            if($pid[0]['parent_id']>0){
                $id=$pid[0]['parent_id'];
            }
        }
        $str='';
        foreach ($arrays as $cat) { 
            //$str='';
            $str.= "<option value='" .$cat['categoryid']."'";
            if($subid==$cat['categoryid']){
              $str.="selected='selected'";
             }
            
            $str.=">" .$cat['category_title'] ."</option>";
            
        }         
       echo $str;
    }

}