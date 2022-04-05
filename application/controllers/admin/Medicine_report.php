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
        $month      = $this->input->get('month');
        $monthName  = $this->input->get('monthName');
        $data = [
            "title" => "Medicine Report",
            "monthName" => $monthName,
            "year"      => $year,
            "month"     => $month,
            "fullname"  => "Mary Francessca N. Villafuerte, RN",
            "data"  => $this->surveyreport->getMedicineReport($year)
        ];
        $this->load->view("admin/survey_report/print", $data);
    }



    public function getMedicineReport($year){

    }



}

