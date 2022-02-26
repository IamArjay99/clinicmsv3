<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

    public function index()
    {
        $data['title'] = "Monitoring";
        $this->load->view("website_template/header", $data);
        $this->load->view("monitoring/index", $data);
        $this->load->view("website_template/footer");
    }

}

