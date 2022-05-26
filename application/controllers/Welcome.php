<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("SystemOperations_model", "systemoperations");
    }

    public function index()
    {
        $data['title'] = "Home";
        $data["anouncement"]    =  $this->systemoperations->getTableData("announcements","announcements.*, (SELECT CONCAT(lastname,', ',firstname,' ',middlename) FROM users WHERE user_id = '1' ) as fullname","is_deleted = '0'");
        $this->load->view("website_template/header", $data);
        $this->load->view("welcome/index",$data);
        $this->load->view("website_template/footer");
    }


    public function verify_account($code){
        // $this->encryption->initialize(
        //     array(
        //             'cipher' => 'aes-256',
        //             'mode'   => 'ctr',
        //             'key'    => '<a 32-character random string>'
        //     )
        // );
        // $this->encryption->initialize(array('driver' => 'mcrypt'));
        // $patientEmail   = $this->encryption->decrypt($code);
        $patientEmail       = $code;
        $this->db->update("patients", ["is_verified"=> "1"], ["email" => $patientEmail]);
        redirect('', 'refresh');
    }
}

