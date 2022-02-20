<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Year extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Year";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/year/index");
        $this->load->view("admin/template/footer");
    }

}

