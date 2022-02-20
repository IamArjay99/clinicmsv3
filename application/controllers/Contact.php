<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("SystemOperations_model", "systemoperations");
    }

    public function index()
    {

        $data["setup"]    =  $this->systemoperations->getTableData("system_setup");
        
        $data['title'] = "Contact Us";
        $this->load->view("website_template/header", $data);
        $this->load->view("contact/index",$data);
        $this->load->view("website_template/footer");
    }

}

