<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/SurveyReport_model", "surveyreport");
    }

    public function index()
    {
        $data['title'] = "Survey Report";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/survey_report/index");
        $this->load->view("admin/template/footer");
    }

    public function print()
    {
        $year  = $this->input->get('year');
        $month = $this->input->get('month');
        $monthName = $this->input->get('monthName');
        $data = [
            "title" => "Survey Report",
            "monthName" => $monthName,
            "month"     => $month,
            "year"      => $year,
            "data"  => $this->surveyreport->getSurveyReport($year, $month)
        ];
        $this->load->view("admin/survey_report/print", $data);
    }

}

