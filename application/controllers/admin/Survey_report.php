<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Survey Report";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/survey_report/index");
        $this->load->view("admin/template/footer");
    }

}

