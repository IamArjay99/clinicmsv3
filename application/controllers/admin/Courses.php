<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Courses";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/courses/index");
        $this->load->view("admin/template/footer");
    }

}

