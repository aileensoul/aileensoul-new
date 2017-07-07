    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seo extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();


        // Get Site Information
        $site_settings = $this->common->select_data_by_id('site_settings', 'site_id', 1, $data = '*', $join_str = array());
        $main_site_name = $this->data['main_site_name'] = $site_settings[0]['site_name'];
        $main_site_url = $this->data['main_site_url'] = $site_settings[0]['site_url'];

        $this->data['title'] = "Search Engine Optimization | $main_site_name ";
        $this->data['module_name'] = "Search Engine Optimization";
        $this->load->model('settings');

        include('include.php');
        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $this->data['section_title'] = "View Search Engine Optimization";

        $this->data['seo_list'] = $this->settings->getSeoDetails();
        $this->data['limit'] = $this->data['total_rows'] = count($this->settings->getSeoDetails());
        
        $this->data['offset'] = 0;
        $this->load->view('seo/index', $this->data);
    }

    public function edit() {
        if ($this->input->post()) {
            $seoid = $this->input->post('seoid');
            $seofieldvalue = $this->input->post('seofieldvalue');

            $data = array('seofieldvalue' => $seofieldvalue, 'timestamp' => date('Y-m-d h:i:s'));
            
            $update = $this->common->update_data($data, 'seo', 'seoid', $seoid);
            if ($update) {
                $this->session->set_flashdata('success', 'SEO data successfully updated');
                redirect('seo', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Sorry something not right');
            redirect('seo', 'refresh');
        }
    }
   
}
