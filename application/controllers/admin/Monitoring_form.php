<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_form extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Monitoring Form";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/monitoring_form/index");
        $this->load->view("admin/template/footer");
    }

}

