<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']) $this->redirect('/home');

class Khyati extends MY_Controller { 

    public $data;

    
   public function __construct() 
    {
        parent::__construct();

         $this->load->library('form_validation');
          $this->load->model('email_model');
        if (!$this->session->userdata('aileenuser')) {
          redirect('login', 'refresh');
        }
        
        include ('include.php');
    }

    //job seeker basic info controller start
    
    public function index()
    {

      $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());
      
       $this->load->view('Khyati/index',$this->data);

    }
//job user end

     public function ajaxpro()
    {  
        $userid = $this->session->userdata('aileenuser');
        
      $data = $_POST['image'];

//list($type, $data) = explode(';', $data);
//list(, $data)      = explode(',', $data);

//$data = base64_encode($data);
$imageName = time().'.png';

$data = array(
                'profile_background' => $data
                  ); 
       
        $update = $this->common->update_data($data,'user','user_id',$userid);

        $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

echo '<img src="' . $this->data['userdata'][0]['profile_background'] . '" />';
    }


     public function khyati1()
    {

      $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());
      
       $this->load->view('Khyati/index1',$this->data);

    }
//job user end

     public function ajaxpro1()
    {  
        $userid = $this->session->userdata('aileenuser');
        
      $data = $_POST['image'];

//list($type, $data) = explode(';', $data);
//list(, $data)      = explode(',', $data);

//$data = base64_encode($data);
$imageName = time().'.png';

$data = array(
                'profile_background' => $data
                  ); 
       
        $update = $this->common->update_data($data,'user','user_id',$userid);

        $this->data['userdata'] = $this->common->select_data_by_id('user', 'user_id', $userid, $data = '*', $join_str = array());

echo '<img src="' . $this->data['userdata'][0]['profile_background'] . '" />';
    }

public function image()
    {  //echo "ok"; die();
    //echo "<pre>";print_r($_FILES);die();
    // $file=$_FILES["image"]['name'];
    //  echo $file;
             $userid = $this->session->userdata('aileenuser');

                $config['upload_path'] = 'uploads/user_bg';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
               // $config['file_name'] = $_FILES['picture']['name'];
                $config['file_name'] = $_FILES['image']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                //echo $this->upload->do_upload('photo'); die();
                if($this->upload->do_upload('image'))
                {
                      
                    $uploadData = $this->upload->data();
                    //$picture = $uploadData['file_name']."-".date("Y_m_d H:i:s");
                    $image = $uploadData['file_name'];
                    //echo $certificate;die();
                }
                else
                {
                   // echo "welcome";die();
                    $image = '';
                }


        $data = array(
                  'profile_background_main' => $image,
                  'modified_date' => date('Y-m-d h:i:s',time())
                  
        ); 
     //  echo "<pre>"; print_r($data); die();
           
      $updatedata =   $this->common->update_data($data,'user','user_id',$userid);

      if($updatedata){ 
        echo $userid;
      }else{
       echo "welcome";
      }

    }

    public function khyatii(){
      $this->load->view('khyati/khyati1');
    }
  }