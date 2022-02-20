<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Record_model", "record");
    }

    public function index()
    {
        $data['title'] = "Record";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/record/index");
        $this->load->view("admin/template/footer");
    }

    public function view_service()
    {
        $checkUpID   = $this->input->get("id");
        $type        = $this->input->get("type");
        $medicalData = $this->record->getMedicalRecord($checkUpID);

        if ($medicalData && !empty($medicalData))
        {
            $data = [
                "title" => $type == "medical" ? "View Medical" : "View Dispensing Medicine",
                "data"  => $medicalData
            ];
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/record/view_service", $data);
            $this->load->view("admin/template/footer");
        }
        else 
        {
            redirect(base_url('admin/record'),'refresh');
        }
    }

    public function view_inventory()
    {
        $id   = $this->input->get("id");
        $type = $this->input->get("type");
        
        $data = [
            "title" => $type == "medicine" ? "View Medicine" : "View Care Equipment",
            "type"  => $type,
            "data"  => $this->record->getInventoryRecord($type, $id)
        ];
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/record/view_inventory", $data);
        $this->load->view("admin/template/footer");
        
    }

    public function view_patient()
    {
        $patientID   = $this->input->get("id");
        $patientData = $this->record->getPatientRecord($patientID);

        if ($patientData && !empty($patientData))
        {
            $data = [
                "title" => "View Patient Record",
                "data"  => $patientData
            ];

            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/record/view_patient", $data);
            $this->load->view("admin/template/footer");
        }
        else 
        {
            redirect(base_url('admin/record'),'refresh');
        }
    }

}

