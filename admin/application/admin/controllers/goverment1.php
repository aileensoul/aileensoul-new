<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Goverment extends MY_Controller {

    public $data;
 

    public function __construct() {

      parent::__construct();

        if (!$this->session->userdata('aileen_admin')) 
        {
            redirect('login', 'refresh');
        }
   
    
         //Loadin Pagination Custome Config File
         $this->config->load('paging', TRUE);
         $this->paging = $this->config->item('paging');
         include('include.php');
         $adminid =  $this->session->userdata('aileen_admin');
   
       // echo $this->profile->thumb();
    }


   public function edit_gov_post_insert($id ='') 
 {
        
        $date = $this->input->post('selday');
        $month = $this->input->post('selmonth');
        $year = $this->input->post('selyear');
        $last_date = $year . '-' . $month . '-' . $date;
        
        
        $config = array(
            'upload_path' => $this->config->item('gov_post_main_upload_path'),
            'max_size' => 2500000000000,
            'allowed_types' => $this->config->item('gov_post_main_allowed_types'),
            'file_name' => $_FILES['post_image']['name']
               
        );
        
         //Load upload library and initialize configuration
        $images = array();
        $files = $_FILES;

        //echo "<pre>"; print_r($files); die();
        $this->load->library('upload');

            $fileName = $_FILES['post_image']['name'];
            $images[] = $fileName;
            $config['file_name'] = $fileName;

         $this->upload->initialize($config);
        $this->upload->do_upload();     
        if ($this->upload->do_upload('post_image')) {

             $response['result']= $this->upload->data();
                $gov_post_thumb['image_library'] = 'gd2';
                $gov_post_thumb['source_image'] = $this->config->item('gov_post_main_upload_path') . $response['result']['file_name'];
                $gov_post_thumb['new_image'] = $this->config->item('gov_post_thumb_upload_path') . $response['result']['file_name'];
                $gov_post_thumb['create_thumb'] = TRUE;
                $gov_post_thumb['maintain_ratio'] = TRUE;
                $gov_post_thumb['thumb_marker'] = '';
                $gov_post_thumb['width'] = $this->config->item('gov_post_thumb_width');
                $gov_post_thumb['height'] = 2;
                $gov_post_thumb['master_dim'] = 'width';
                $gov_post_thumb['quality'] = "100%";
                $gov_post_thumb['x_axis'] = '0';
                $gov_post_thumb['y_axis'] = '0';
                $instanse = "image_$i";
                //Loading Image Library
                $this->load->library('image_lib', $gov_post_thumb, $instanse);
                $dataimage = $response['result']['file_name'];

               // echo "<pre>"; print_r($dataimage); die();

                //Creating Thumbnail
                $this->$instanse->resize();
                $response['error'][] = $thumberror = $this->$instanse->display_errors();
                
                
                $return['data'][] = $this->upload->data();
                $return['status'] = "success";
                $return['msg'] = sprintf($this->lang->line('success_item_added'), "Image", "uploaded");
        } 

        
        
        
        $data = array(
                'title' => $this->input->post('post_title'),
                'category_id' => $this->input->post('category'),
                'post_name' => $this->input->post('postname'),
                'no_vacancies' => $this->input->post('novacan'),
                'pay_scale' => $this->input->post('payscale'),
                'job_location' => $this->input->post('jobloc'),
                'req_exp' => $this->input->post('reqexp'),
                'post_image' => $dataimage,
                'sector' => $this->input->post('gov_sector'),
                'eligibility' => $this->input->post('gov_elg'),
                'last_date' => $last_date,
                'description' => $this->input->post('gov_des'),
                'apply_link' => $this->input->post('gov_link'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d H:i:s', time()),
                'is_delete' => '0',
                'modified_date'=> date('Y-m-d H:i:s', time())
            );
        
        
      //  echo "<pre>"; print_r($this->input->post()); die();
         

            $updatdata = $this->common->update_data($data, 'gov_post', 'id', $id);

            if ($updatdata) {
                $this->session->set_flashdata('success', 'Category updated successfully');
                 redirect('goverment/view_gov_post');
            } else {
                $this->session->flashdata('error', 'Sorry!! Your data not inserted');
                redirect('goverment/edit_gov_category/'.$id);
            }
           
}





}

?>