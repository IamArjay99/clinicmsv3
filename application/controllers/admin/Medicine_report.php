<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicine_report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->model("admin/MedicineReport_model", "surveyreport");
    }

    public function index()
    {
        $data['title'] = "Medicine Report";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/medicine_report/index");
        $this->load->view("admin/template/footer");
    }

    public function print()
    {
        $sessionID  = $this->session->userdata('sessionID');
        $year       = $this->input->get('year');
        $data = [
            "title"     => "Medicine Report",
            "year"      => $year,
            "fullname"  => "Mary Francessca N. Villafuerte, RN",
        ];
        $this->load->view("admin/medicine_report/print", $data);
    }



}

