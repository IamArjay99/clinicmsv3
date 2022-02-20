<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_setup extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "System Setup";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/system_setup/index");
        $this->load->view("admin/template/footer");
    }

}

