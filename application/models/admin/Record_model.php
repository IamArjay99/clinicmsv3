<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getMedicalRecord($checkUpID = 0)
    {
        $data = [];

        $sql = "
        SELECT 
            cu.*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS patient_name, c.name AS course_name, age, gender, section, y.name AS year_name, s.name AS service_name
        FROM check_ups AS cu 
            LEFT JOIN services AS s ON cu.service_id = s.service_id
            LEFT JOIN patients AS p USING(patient_id)
            LEFT JOIN courses AS c ON p.course_id = c.course_id
            LEFT JOIN years AS y ON p.year_id = y.year_id
        WHERE check_up_id = $checkUpID";
        $query  = $this->db->query($sql);
        $result = $query ? $query->row() : null;

        if ($result) 
        {
            $sqlMedicine = "
            SELECT 
                cum.*, m.name AS medicine_name, m.brand AS medicine_brand, u.name AS unit_name, m2.name AS measurement_name
            FROM check_up_medicines AS cum 
                LEFT JOIN medicines AS m USING(medicine_id)
                LEFT JOIN category AS c ON m.category_id = c.category_id
                LEFT JOIN units AS u ON m.unit_id = u.unit_id
                LEFT JOIN measurements AS m2 ON m.measurement_id = m2.measurement_id
            WHERE cum.check_up_id = $checkUpID";
            $queryMedicine  = $this->db->query($sqlMedicine);
            $resultMedicine = $queryMedicine ? $queryMedicine->result_array() : [];

            $sqlCareEquipment = "
            SELECT 
                cuce.*, ce.name AS care_equipment_name, u.name AS unit_name
            FROM check_up_care_equipments AS cuce 
                LEFT JOIN care_equipments AS ce USING(care_equipment_id)
                LEFT JOIN units AS u ON ce.unit_id = u.unit_id
            WHERE cuce.check_up_id = $checkUpID";
            $queryCareEquipment  = $this->db->query($sqlCareEquipment);
            $resultCareEquipment = $queryCareEquipment ? $queryCareEquipment->result_array() : [];

            $sqlClinicalCase = "
            SELECT 
                ccr.*
            FROM clinical_case_records AS ccr 
            WHERE ccr.check_up_id = $checkUpID";
            $queryClinicalCase  = $this->db->query($sqlClinicalCase);
            $resultClinicalCase = $queryClinicalCase ? $queryClinicalCase->result_array() : [];

            $data = [
                'check_up_id'        => $checkUpID,
                'service_name'       => $result->service_name,
                'service_id'         => $result->service_id,
                'patient_name'       => $result->patient_name,
                'gender'             => $result->gender,
                'age'                => $result->age,
                'course_name'        => $result->course_name,
                'year_name'          => $result->year_name,
                'section'            => $result->section,
                'temperature'        => $result->temperature,
                'pulse_rate'         => $result->pulse_rate,
                'respiratory_rate'   => $result->respiratory_rate,
                'blood_pressure'     => $result->blood_pressure,
                'random_blood_sugar' => $result->random_blood_sugar,
                'others'             => $result->others,
                'recommendation'     => $result->recommendation,
                'created_at'         => $result->created_at,
                'medicine'           => $resultMedicine,
                'care_equipment'     => $resultCareEquipment,
                'clinical_case'      => $resultClinicalCase,
            ];
        }
        return $data;
    }

    public function getMedicalHistory($patientID = 0)
    {
        $data = [];

        $sqlMedical    = "SELECT * FROM medical_history WHERE is_deleted = 0 AND patient_id = $patientID";
        $queryMedical  = $this->db->query($sqlMedical);
        $resultMedical = $queryMedical ? $queryMedical->row() : null;
        if ($resultMedical)
        {
            $medicalHistoryID = $resultMedical->medical_history_id;

            $data['marital_status']     = $resultMedical->marital_status;
            $data['referring_doctors']  = $resultMedical->referring_doctors;
            $data['last_physical_exam'] = $resultMedical->last_physical_exam;
            $data['is_vaccinated']      = $resultMedical->is_vaccinated;
            $data['covid_patient']      = $resultMedical->is_vaccinated;

            $sqlPersonal    = "SELECT * FROM personal_health_history WHERE is_deleted = 0 AND medical_history_id = $medicalHistoryID AND patient_id = $patientID";
            $queryPersonal  = $this->db->query($sqlPersonal);
            $resultPersonal = $queryPersonal ? $queryPersonal->row() : null;
            if ($resultPersonal)
            {
                $data['childhood_illness']  = $resultPersonal->childhood_illness;
                $data['immunization']       = $resultPersonal->immunization;
                $data['medical_problems']   = $resultPersonal->medical_problems;
                $data['blood_transmission'] = $resultPersonal->blood_transmission;
            }

            $sqlSurgery    = "SELECT * FROM surgery_history WHERE is_deleted = 0 AND medical_history_id = $medicalHistoryID AND patient_id = $patientID";
            $querySurgery  = $this->db->query($sqlSurgery);
            $resultSurgery = $querySurgery ? $querySurgery->result_array() : [];
            if ($resultSurgery && !empty($resultSurgery))
            {
                $data['surgery'] = $resultSurgery;
            }

            $sqlHospitalization    = "SELECT * FROM hospitalization_history WHERE is_deleted = 0 AND medical_history_id = $medicalHistoryID AND patient_id = $patientID";
            $queryHospitalization  = $this->db->query($sqlHospitalization);
            $resultHospitalization = $queryHospitalization ? $queryHospitalization->result_array() : [];
            if ($resultHospitalization && !empty($resultHospitalization))
            {
                $data['hospitalization'] = $resultHospitalization;
            }

            $sqlPrescribeDrug    = "SELECT * FROM prescribed_drug_history WHERE is_deleted = 0 AND medical_history_id = $medicalHistoryID AND patient_id = $patientID";
            $queryPrescribeDrug  = $this->db->query($sqlPrescribeDrug);
            $resultPrescribeDrug = $queryPrescribeDrug ? $queryPrescribeDrug->result_array() : [];
            if ($resultPrescribeDrug && !empty($resultPrescribeDrug))
            {
                $data['prescribe_drug'] = $resultPrescribeDrug;
            }

            $sqlAllergyMedication    = "SELECT * FROM allergy_medication_history WHERE is_deleted = 0 AND medical_history_id = $medicalHistoryID AND patient_id = $patientID";
            $queryAllergyMedication  = $this->db->query($sqlAllergyMedication);
            $resultAllergyMedication = $queryAllergyMedication ? $queryAllergyMedication->result_array() : [];
            if ($resultAllergyMedication && !empty($resultAllergyMedication))
            {
                $data['allergy_medication'] = $resultAllergyMedication;
            }
        }

        return $data;
    }

    public function getClinicalCase($patientID = 0)
    {
        $sql   = "SELECT * FROM clinical_case_records WHERE patient_id = $patientID";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getPatientRecord($patientID = 0)
    {
        $data = [];

        $sql = "
        SELECT 
            p.*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS patient_name, c.name AS course_name, y.name AS year_name
        FROM patients AS p
            LEFT JOIN courses AS c USING(course_id)
            LEFT JOIN years AS y USING(year_id)
        WHERE p.patient_id = $patientID";
        $query  = $this->db->query($sql);
        $result = $query ? $query->row() : null;

        if ($result) 
        {
            $sqlCheckUp    = "SELECT * FROM check_ups WHERE patient_id = $patientID";
            $queryCheckUp  = $this->db->query($sqlCheckUp);
            $resultCheckUp = $queryCheckUp ? $queryCheckUp->result_array() : [];

            $check_up_data = [];
            if ($resultCheckUp && !empty($resultCheckUp))
            {
                foreach ($resultCheckUp as $i => $cu)
                {
                    $checkUpID = $cu['check_up_id'];
                    $check_up_data[] = $this->getMedicalRecord($checkUpID);
                }
            }

            $data = [
                'patient_name'       => $result->patient_name,
                'gender'             => $result->gender,
                'age'                => $result->age,
                'course_name'        => $result->course_name,
                'year_name'          => $result->year_name,
                'section'            => $result->section,
                'check_up_data'      => $check_up_data,
                'medical_history'    => $this->getMedicalHistory($patientID),
                'clinical_case'      => $this->getClinicalCase($patientID)
            ];
        }
        return $data;
    }

    public function getInventoryRecord($type = "", $id = "")
    {
        if ($type == "medicine")
        {
            $sql = "
            SELECT 
                som.*, m.name AS medicine_name, m.brand AS medicine_brand, c.name AS category_name, u.name AS unit_name, m2.name AS measurement_name, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS patient_name
            FROM stock_out_medicine som
                LEFT JOIN medicines AS m USING(medicine_id)
                LEFT JOIN category AS c ON m.category_id = c.category_id
                LEFT JOIN units AS u ON m.unit_id = u.unit_id
                LEFT JOIN measurements AS m2 ON m.measurement_id = m2.measurement_id
                LEFT JOIN patients AS p USING(patient_id)
            WHERE som.medicine_id = $id";
        }
        else 
        {
            $sql = "
            SELECT 
                soce.*, ce.name AS care_equipment_name, u.name AS unit_name, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS patient_name 
            FROM stock_out_care_equipment AS soce
                LEFT JOIN care_equipments AS ce USING(care_equipment_id)
                LEFT JOIN units AS u ON ce.unit_id = u.unit_id
                LEFT JOIN patients AS p ON soce.patient_id = p.patient_id
            WHERE soce.care_equipment_id = $id";
        }
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

}

