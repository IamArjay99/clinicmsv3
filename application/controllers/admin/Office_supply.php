<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Office_supply extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Office Supply";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/office_supply/index");
        $this->load->view("admin/template/footer");
    }

}

