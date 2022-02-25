<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_form extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/MonitoringForm_model", "monitoring");
    }

    public function index()
    {
        $data['title'] = "Monitoring Form";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/monitoring_form/index");
        $this->load->view("admin/template/footer");
    }

    public function monitorPatient()
    {
        $checkUpID = $this->input->post("checkUpID");
        $patientID = $this->input->post("patientID");
        echo $this->monitoring->monitorPatient($checkUpID, $patientID);
    }

    public function updateMonitorPatient()
    {
        $monitoringFormID = $this->input->post("monitoringFormID");
        echo $this->monitoring->updateMonitorPatient($monitoringFormID);
    }


}

