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
            "fullname"  => "Mary Francessca N. Villafuerte, RN",
            "data"  => $this->quarterlyreport->getQuarterlyReport($year, $quarter)
        ];
        $this->load->view("admin/quarterly_report/print", $data);
    }

    public function printmedcert(){
        $checkupid    = $this->input->get('checkupid');
        $sql          = "SELECT cu.*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname FROM check_ups AS cu
                                LEFT JOIN patients AS p ON cu.patient_id = p.patient_id
                            WHERE cu.is_deleted = 0
                                AND cu.service_id = 1 AND cu.check_up_id = '$checkupid' ";
        $query        = $this->db->query($sql);
        $result       = $query->row();
        $dateDiagnosed=date_create($result->created_at);
        $data         = [   
                            "title"         => "Medical Certificate",
                            "date"          => date("F d, Y"),
                            "dateDiagnosed" => date_format($dateDiagnosed,"F d, Y"),
                            "patientName"   => $result->fullname,
                            "fullname"      => "Mary Francessca N. Villafuerte, RN",
                        ];

        $this->load->view("admin/quarterly_report/print_cert", $data);

    }
}

