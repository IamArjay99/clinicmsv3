<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkup_form extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/CheckupForm_model", "checkupform");
    }

    public function index()
    {
        $data['title'] = "Check-up Form";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/checkup_form/index");
        $this->load->view("admin/template/footer");
    }

    public function insertCheckupForm()
    {
        $service_id            = $this->input->post("service_id"); 
        $clinic_appointment_id = $this->input->post("clinic_appointment_id") ?? 0; 
        $patient_id            = $this->input->post("patient_id"); 
        $temperature           = $this->input->post("temperature"); 
        $pulse_rate            = $this->input->post("pulse_rate"); 
        $respiratory_rate      = $this->input->post("respiratory_rate"); 
        $blood_pressure        = $this->input->post("blood_pressure"); 
        $random_blood_sugar    = $this->input->post("random_blood_sugar"); 
        $others                = $this->input->post("others"); 
        $medicine              = $this->input->post("medicine"); 
        $care_equipment        = $this->input->post("care_equipment") ?? []; 
        $recommendation        = $this->input->post("recommendation") ?? []; 
        $medical_history       = $this->input->post("medical_history"); 
        $clinical_case_record  = $this->input->post("clinical_case_record"); 

        $data = [
            'clinic_appointment_id' => $clinic_appointment_id,
            'service_id'            => $service_id,
            'patient_id'            => $patient_id,
            'temperature'           => $temperature,
            'pulse_rate'            => $pulse_rate,
            'respiratory_rate'      => $respiratory_rate,
            'blood_pressure'        => $blood_pressure,
            'random_blood_sugar'    => $random_blood_sugar,
            'others'                => $others,
            'recommendation'        => $recommendation,
        ];

        $insertCheckupForm = $this->checkupform->insertCheckupForm($data);
        if ($insertCheckupForm) {
            $result = explode("|", $insertCheckupForm);
            if ($result[0] == "true") {
                $check_up_id = $result[1];

                $medicineData = [];
                if ($medicine && !empty($medicine)) {
                    foreach($medicine as $med) {
                        $medicineData[] = [
                            "check_up_id" => $check_up_id,
                            "patient_id"  => $patient_id,
                            "medicine_id" => $med['medicine_id'],
                            "quantity"    => $med['quantity'],
                        ];
                    }
                }
                $insertMedicine = $this->checkupform->insertMedicine($medicineData);

                $careEquipmentData = [];
                if ($care_equipment && !empty($care_equipment)) {
                    foreach($care_equipment as $ce) {
                        $careEquipmentData[] = [
                            "check_up_id"       => $check_up_id,
                            "patient_id"        => $patient_id,
                            "care_equipment_id" => $ce['care_equipment_id'],
                            "quantity"          => $ce['quantity'],
                        ];
                    }
                }
                $insertCareEquipment = $this->checkupform->insertCareEquipment($careEquipmentData);

                if ($medical_history && !empty($medical_history))
                {
                    $medicalHistoryData = [
                        'patient_id'         => $patient_id,
                        'marital_status'     => $medical_history['marital_status'],
                        'referring_doctors'  => $medical_history['referring_doctors'],
                        'last_physical_exam' => $medical_history['last_physical_exam'],
                        'is_vaccinated'      => $medical_history['is_vaccinated'],
                        'covid_patient'      => $medical_history['covid_patient'],
                    ];
                    $insetMedicalHistory = $this->checkupform->insertMedicalHistory($medicalHistoryData);

                    if ($insetMedicalHistory) 
                    {
                        $medical_history_id = $insetMedicalHistory;

                        $personalHealthHistoryData = [
                            'medical_history_id' => $medical_history_id,
                            'patient_id'         => $patient_id,
                            'childhood_illness'  => $medical_history['childhood_illness'],
                            'immunization'       => $medical_history['immunization'],
                            'medical_problems'   => $medical_history['medical_problems'],
                            'blood_transmission' => $medical_history['blood_transmission'],
                        ];
                        $insetPersonalHealthHistory = $this->checkupform->insertPersonalHealthHistory($personalHealthHistoryData);

                        if ($medical_history['surgery'] && !empty($medical_history['surgery']))
                        {
                            $surgeryData = [];
                            foreach($medical_history['surgery'] as $s)
                            {
                                $surgeryData[] = [
                                    'medical_history_id' => $medical_history_id,
                                    'patient_id'         => $patient_id,
                                    'year'               => $s['year'],
                                    'reason'             => $s['reason'],
                                    'hospital'           => $s['hospital'],
                                ];
                            }
                            $insertSurgeryHistory = $this->checkupform->insertSurgeryHistory($surgeryData);
                        }

                        if ($medical_history['hospitalization'] && !empty($medical_history['hospitalization']))
                        {
                            $hospitalizationData = [];
                            foreach($medical_history['hospitalization'] as $s)
                            {
                                $hospitalizationData[] = [
                                    'medical_history_id' => $medical_history_id,
                                    'patient_id'         => $patient_id,
                                    'year'               => $s['year'],
                                    'reason'             => $s['reason'],
                                    'hospital'           => $s['hospital'],
                                ];
                            }
                            $insertHospitalizationHistory = $this->checkupform->insertHospitalizationHistory($hospitalizationData);
                        }

                        if ($medical_history['prescribe_drug'] && !empty($medical_history['prescribe_drug']))
                        {
                            $prescribeDrugData = [];
                            foreach($medical_history['prescribe_drug'] as $s)
                            {
                                $prescribeDrugData[] = [
                                    'medical_history_id' => $medical_history_id,
                                    'patient_id'         => $patient_id,
                                    'name'               => $s['name'],
                                    'strength'           => $s['strength'],
                                    'frequently_taken'   => $s['frequently_taken'],
                                ];
                            }
                            $insertPrescribeDrugHistory = $this->checkupform->insertPrescribeDrugHistory($prescribeDrugData);
                        }

                        if ($medical_history['allergy_medication'] && !empty($medical_history['allergy_medication']))
                        {
                            $allergyMedicationData = [];
                            foreach($medical_history['allergy_medication'] as $s)
                            {
                                $allergyMedicationData[] = [
                                    'medical_history_id' => $medical_history_id,
                                    'patient_id'         => $patient_id,
                                    'name'               => $s['name'],
                                    'reaction'           => $s['reaction'],
                                ];
                            }
                            $insertAllergyMedicationHistory = $this->checkupform->insertAllergyMedicationHistory($allergyMedicationData);
                        }
                    }
                }

                if ($clinical_case_record && !empty($clinical_case_record))
                {
                    $clinicalCaseRecordData = [
                        'check_up_id'      => $check_up_id,
                        'patient_id'       => $patient_id,
                        'health_complaint' => $clinical_case_record['health_complaint'],
                        'treatment'        => $clinical_case_record['treatment'],
                        'schedule'         => $clinical_case_record['schedule'],
                    ];
                    $insertClinicalCaseRecord = $this->checkupform->insertClinicalCaseRecord($clinicalCaseRecordData);

                    if ($insertClinicalCaseRecord)
                    {
                        $appointmentData = [
                            'patient_id'       => $patient_id,
                            'service_id'       => $service_id,
                            'purpose'          => $clinical_case_record['health_complaint'],
                            'date_appointment' => $clinical_case_record['schedule'],
                            'is_done'          => 0,
                        ];
                        $insertClinicAppointment = $this->checkupform->insertClinicAppointment($appointmentData);
                    }
                }

                $insertSurvey = $this->checkupform->insertSurvey($check_up_id, $patient_id);
            }
        }

        echo json_encode($insertCheckupForm);
    }

}

