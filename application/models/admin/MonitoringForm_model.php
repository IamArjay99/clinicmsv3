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

    public function getPatientInformation($monitoringFormID = 0)
    {
        $sql = "
        SELECT 
            p.*,  
            CONCAT(firstname, ' ', middlename, ' ', lastname) AS fullname,
            pt.name AS patient_type_name
        FROM monitoring_forms AS mf
            LEFT JOIN patients AS p USING(patient_id)
            LEFT JOIN patient_type AS pt ON p.patient_type_id = pt.patient_type_id
        WHERE monitoring_form_id = $monitoringFormID";
        $query = $this->db->query($sql);
        return $query ? $query->row() : null;
    }

    public function updateMonitoring($monitoringFormID = 0, $items = [])
    {
        $deleteQuery = $this->db->delete('monitoring_form_items', ['monitoring_form_item_id <>' => 0, 'monitoring_form_id' => $monitoringFormID]);
        $insertQuery = $this->db->insert_batch('monitoring_form_items', $items);
        return $insertQuery ? 'true' : 'false';
    }

}

