<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Unit";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/unit/index");
        $this->load->view("admin/template/footer");
    }

}

