<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Dashboard_model", "dashboard");
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/dashboard/index");
        $this->load->view("admin/template/footer");
    }

    public function getDashboardData() 
    {
        echo json_encode($this->dashboard->getDashboardData());
    }

}

