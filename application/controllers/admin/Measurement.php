<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Measurement extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Measurement";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/measurement/index");
        $this->load->view("admin/template/footer");
    }

}

