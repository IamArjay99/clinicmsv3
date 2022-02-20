<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Section";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/section/index");
        $this->load->view("admin/template/footer");
    }

}

