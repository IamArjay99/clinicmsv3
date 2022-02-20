<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral_form extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Referral Form";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/referral_form/index");
        $this->load->view("admin/template/footer");
    }

}

