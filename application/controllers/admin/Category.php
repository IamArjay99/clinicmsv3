<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Category";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/category/index");
        $this->load->view("admin/template/footer");
    }

}

