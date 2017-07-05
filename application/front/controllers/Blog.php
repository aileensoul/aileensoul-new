<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('category_model', 'Blog_model' => 'blog_model'));
    }

    // Meta Array Define
    public function index()
    {   
     //   $meta_title = $this->sitefunction->getSettings('meta_title');
     ///   $meta_keywords = $this->sitefunction->getSettings('meta_keywords');
     //   $meta_description = $this->sitefunction->getSettings('meta_description');
       //   echo "hello"; die();
        $data['meta_title'] = '';
        $data['meta_keywords'] ='';
        $data['meta_description'] = '';
      
        $data['blogdata'] = $this->blog_model->AllBlog();
        $data['blogolddata'] = $this->blog_model->Oldblog();


    
       $this->load->view('blog/index', $data);
    }


    // Meta Array Define
    public function blogdetail($id="")
    {   
        // $meta_title = $this->sitefunction->getSettings('meta_title');
        // $meta_keywords = $this->sitefunction->getSettings('meta_keywords');
        // $meta_description = $this->sitefunction->getSettings('meta_description');
        
       $data['meta_title'] = '';
       $data['meta_keywords'] ='';
       $data['meta_description'] = '';
        
        $data['blogdata'] = $this->blog_model->Blogdetail($id);
        $data['blogolddata'] = $this->blog_model->Oldblogdetail($id);
 

        $data['blogid'] = $data['blogdata'][0]->blog_id; 
        $data['title'] = $data['blogdata'][0]->title;
        $data['date'] = $data['blogdata'][0]->date;
        $data['author'] = $data['blogdata'][0]->author;
        $data['image'] = $data['blogdata'][0]->blog_image;
        $data['description'] = $data['blogdata'][0]->description;
        $data['image_title'] = $data['blogdata'][0]->image_title;
        $data['image_description'] = $data['blogdata'][0]->image_description;
    
       $this->load->view('blog/blogdetail', $data);
    }

    public function blog_captcha() {
    
                $this->load->view('blog/captcha',$data);           
    }
    
        
     public function add_blog(){ 
    $this->load->helper('url');
     
    
    //Send Inquiry to Database
     if ($this->input->post('contactemail') && $this->input->post('g-recaptcha-response') != '') {
   
    //read parameters from $_POST using input class
    $name = $this->input->post('contactname');  
    $email = $this->input->post('contactemail'); 
    $message = $this->input->post('contactmessage');  
    $blogid = $this->input->post('blogid');  

    $this->form_validation->set_rules('contactname', 'Contact Name', 'required');
    $this->form_validation->set_rules('contactemail', 'Contact Email', 'required');
    $this->form_validation->set_rules('contactmessage', 'Contact Message', 'required');
  
            $insert_array = array(
                'review_comment' => $message,
                'user_name' => $name,
                'user_email' => $email,
                'blog_id' => $blogid,
                'is_delete' => '0',
                'created_date' => date('y-m-d h:i:s'),
                'approve_status' => '0'
                
            );
    
            
       $insertdata =  $this->db->insert('blog_review', $insert_array);

        
   
    if ($insertdata) {
            $this->session->set_flashdata('success', 'Inquiry Successfully Submitted !!!');
             redirect(base_url() . 'blog', 'refresh');
        } else {
            //show_error($this->email->print_debugger());  
            $this->session->set_flashdata('error', 'Emmrror Occurred. Try Again!');
             redirect(base_url() . 'blog', 'refresh');
        }
    } else {
        
        if ($this->input->post('g-recaptcha-response') == '') {
        $this->session->set_flashdata('captcha_error', 'Invalid Captcha!');
        $this->data['captcha_error'] = $this->session->flashdata('captcha_error');

         redirect(base_url() . 'blog', 'refresh');
    } else {
        $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
         redirect(base_url() . 'blog', 'refresh');
    }
         
    }
    
  }

   
    
}