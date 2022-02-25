<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quarterly_report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/QuarterlyReport_model", "quarterlyreport");
    }

    public function index()
    {
        $data['title'] = "Quarterly Report";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/quarterly_report/index");
        $this->load->view("admin/template/footer");
    }

    public function getQuarterlyReport()
    {
        $year    = $this->input->post('year');
        $quarter = $this->input->post('quarter');
        echo json_encode($this->quarterlyreport->getQuarterlyReport($year, $quarter));
    }

    public function print()
    {
        $year    = $this->input->get('year');
        $quarter = $this->input->get('quarter');
        $data = [
            "title" => "Quarterly Report",
            "year"  => $year,
            "data"  => $this->quarterlyreport->getQuarterlyReport($year, $quarter)
        ];
        $this->load->view("admin/quarterly_report/print", $data);
    }

}

