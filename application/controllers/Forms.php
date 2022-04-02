<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {

    public function index()
    {
        $data['title'] = "Forms";
        $this->load->view("website_template/header", $data);
        $this->load->view("forms/index", $data);
        $this->load->view("website_template/footer");
    }

}

