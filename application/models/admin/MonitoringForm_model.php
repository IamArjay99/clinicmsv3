<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringForm_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function monitorPatient($checkUpID = 0, $patientID = 0)
    {
        $data = [
            'check_up_id' => $checkUpID,
            'patient_id'  => $patientID,
            'status'      => 0
        ];
        $query = $this->db->insert("monitoring_forms", $data);
        return $query ? "true" : "false";
    }

    public function updateMonitorPatient($monitoringFormID = 0)
    {
        $data = ['status' => 1];
        $query = $this->db->update("monitoring_forms", $data, ['monitoring_form_id' => $monitoringFormID]);
        return $query ? "true" : "false";
    }

}

