<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quarterly_report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Quarterly Report";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/quarterly_report/index");
        $this->load->view("admin/template/footer");
    }

}

