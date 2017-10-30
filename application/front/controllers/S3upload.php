<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class S3upload extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('S3');
        //AWS access info end
    }

    public function index() {
        $s3 = new S3(awsAccessKey, awsSecretKey);

        $s3 = new S3(awsAccessKey, awsSecretKey);
        $s3->putBucket(bucket, S3::ACL_PUBLIC_READ);

        $main_image = $this->config->item('bus_post_main_upload_path') . 'file_1506596466_HMnrY.png';
        $abc = $s3->putObjectFile($main_image, bucket, $main_image, S3::ACL_PUBLIC_READ);
    }

}
