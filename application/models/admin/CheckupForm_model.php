<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckupForm_model extends CI_Model {

    public function insertCheckupForm($data = [])
    {
        if ($data && !empty($data)) 
        {
            $query = $this->db->insert("check_ups", $data);
            $clinicAppointmentID = $data['clinic_appointment_id'];
            
            $insertID = $this->db->insert_id();
            $this->db->update('clinic_appointments', ['is_done' => 1], ['clinic_appointment_id' => $clinicAppointmentID]);
            
            return $query ? "true|$insertID|Successfully saved!" : "false|System error: Please contact the system administrator for assistance!";
        }
        return "false|System error: Please contact the system administrator for assistance!";
    }

    public function getMedicine($medicineID)
    {
        $sql   = "SELECT * FROM medicines WHERE medicine_id = $medicineID";
        $query = $this->db->query($sql);
        return $query ? $query->row() : null;
    }

    // public function insertTreatmentMedicine($treatmentData = [], $medicineData = [])
    // {
    //     if ($treatmentData && !empty($treatmentData))
    //     {
    //         $query = $this->db->insert_batch("check_up_treatments", $treatmentData);
    //     }

    //     if ($medicineData && !empty($medicineData))
    //     {
    //         $query = $this->db->insert_batch("check_up_medicines", $medicineData);

    //         foreach($medicineData as $med) 
    //         {
    //             $checkUpID  = $med['check_up_id'];
    //             $medicineID = $med['medicine_id'];
    //             $quantity   = $med['quantity'] ?? 0;

    //             $medicine = $this->getMedicine($medicineID);
    //             if ($medicine)
    //             {
    //                 $stocks    = $medicine->quantity ?? 0;
    //                 $remaining = $stocks - $quantity;
    //                 $remaining = $remaining > 0 ? $remaining : 0;

    //                 $medicineTransactionData = [
    //                     "check_up_id" => $checkUpID,
    //                     "medicine_id" => $medicineID,
    //                     "stocks"      => $stocks,
    //                     "quantity"    => $quantity,
    //                     "remaining"   => $remaining,
    //                 ];

    //                 $query2 = $this->db->insert("medicine_transactions", $medicineTransactionData);
    //                 if ($query2)
    //                 {
    //                     $this->db->update("medicines", ["quantity" => $remaining], ["medicine_id" => $medicineID]);
    //                 }
    //             }
    //         }
    //     }
    // }


    public function getStockInMedicine($medicineID = 0)
    {
        $sql = "
        SELECT 
            * 
        FROM stock_in_medicine
        WHERE medicine_id = $medicineID
            AND remaining > 0
            AND is_deleted = 0
        ORDER BY expiration";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }


    public function updateStockInMedicine($medicineID = 0, $quantity = 0)
    {
        $tempQuantity = $quantity;
        $updatedData = [];

        $stockInData = $this->getStockInMedicine($medicineID);
        if ($stockInData && !empty($stockInData))
        {
            foreach ($stockInData as $si) 
            {
                $remaining    = $si['remaining'] ?? 0;
                $newRemaining = $remaining - $tempQuantity;
                $newRemaining = $newRemaining > 0 ? $newRemaining : 0;
                $tempQuantity = $tempQuantity - $remaining;
                $tempQuantity = $tempQuantity > 0 ? $tempQuantity : 0;


                $updatedData[] = [
                    'stock_in_medicine_id' => $si['stock_in_medicine_id'],
                    'remaining'            => $newRemaining
                ];
            }
        }

        if ($updatedData && !empty($updatedData))
        {
            $query = $this->db->update_batch("stock_in_medicine", $updatedData, 'stock_in_medicine_id');
            return $query ? true : false;
        }
        return false;
    }


    public function insertMedicine($medicineData = [])
    {
        if ($medicineData && !empty($medicineData))
        {
            $this->db->insert_batch("check_up_medicines", $medicineData);

            foreach ($medicineData as $key => $m) 
            {
                $medicineID = $m['medicine_id'];
                $quantity   = $m['quantity'];
                $this->updateStockInMedicine($medicineID, $quantity);
            } 
            $this->db->insert_batch("stock_out_medicine", $medicineData);
        }
    }


    public function getStockInCareEquipment($careEquipmentID = 0)
    {
        $sql = "
        SELECT 
            * 
        FROM stock_in_care_equipment
        WHERE care_equipment_id = $careEquipmentID
            AND remaining > 0
            AND is_deleted = 0
        ORDER BY expiration";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function updateStockInCareEquipment($careEquipmentID = 0, $quantity = 0)
    {
        $tempQuantity = $quantity;
        $updatedData = [];

        $stockInData = $this->getStockInCareEquipment($careEquipmentID);
        if ($stockInData && !empty($stockInData))
        {
            foreach ($stockInData as $si) 
            {
                $remaining    = $si['remaining'] ?? 0;
                $newRemaining = $remaining - $tempQuantity;
                $newRemaining = $newRemaining > 0 ? $newRemaining : 0;
                $tempQuantity = $tempQuantity - $remaining;
                $tempQuantity = $tempQuantity > 0 ? $tempQuantity : 0;


                $updatedData[] = [
                    'stock_in_care_equipment_id' => $si['stock_in_care_equipment_id'],
                    'remaining'                  => $newRemaining
                ];
            }
        }

        if ($updatedData && !empty($updatedData))
        {
            $query = $this->db->update_batch("stock_in_care_equipment", $updatedData, 'stock_in_care_equipment_id');
            return $query ? true : false;
        }
        return false;
    }


    public function insertCareEquipment($careEquipmentData = [])
    {
        if ($careEquipmentData && !empty($careEquipmentData))
        {
            $this->db->insert_batch("check_up_care_equipments", $careEquipmentData);

            foreach ($careEquipmentData as $key => $ce) 
            {
                $careEquipmentID = $ce['care_equipment_id'];
                $quantity        = $ce['quantity'];
                $this->updateStockInCareEquipment($careEquipmentID, $quantity);
            } 
            $this->db->insert_batch("stock_out_care_equipment", $careEquipmentData);
        }
    }


    public function insertMedicalHistory($medicalHistoryData = [])
    {
        if ($medicalHistoryData && !empty($medicalHistoryData))
        {
            $query = $this->db->insert("medical_history", $medicalHistoryData);
            return $query ? $this->db->insert_id() : false;
        }
        return false;
    }


    public function insertPersonalHealthHistory($personalHealthHistoryData = [])
    {
        if ($personalHealthHistoryData && !empty($personalHealthHistoryData))
        {
            $query = $this->db->insert('personal_health_history', $personalHealthHistoryData);
            return $query ? true : false;
        }
        return false;
    }


    public function insertSurgeryHistory($surgeryData = [])
    {
        if ($surgeryData && !empty($surgeryData))
        {
            $query = $this->db->insert_batch('surgery_history', $surgeryData);
            return $query ? true : false;
        }
        return false;
    }


    public function insertHospitalizationHistory($hospitalizationData = [])
    {
        if ($hospitalizationData && !empty($hospitalizationData))
        {
            $query = $this->db->insert_batch('hospitalization_history', $hospitalizationData);
            return $query ? true : false;
        }
        return false;
    }


    public function insertPrescribeDrugHistory($prescribeDrugData = [])
    {
        if ($prescribeDrugData && !empty($prescribeDrugData))
        {
            $query = $this->db->insert_batch('prescribed_drug_history', $prescribeDrugData);
            return $query ? true : false;
        }
        return false;
    }


    public function insertAllergyMedicationHistory($allergyMedicationData)
    {
        if ($allergyMedicationData && !empty($allergyMedicationData))
        {
            $query = $this->db->insert_batch('allergy_medication_history', $allergyMedicationData);
            return $query ? true : false;
        }
        return false;
    }


    public function insertClinicalCaseRecord($clinicalCaseRecordData = [])
    {
        if ($clinicalCaseRecordData && !empty($clinicalCaseRecordData))
        {
            $query = $this->db->insert('clinical_case_records', $clinicalCaseRecordData);
            return $query ? true : false;
        }
        return false;
    }


    public function insertClinicAppointment($appointmentData = [])
    {
        if ($appointmentData && !empty($appointmentData))
        {
            $query = $this->db->insert('clinic_appointments', $appointmentData);
            return $query ? true : false;
        }
        return false;
    }


    public function insertSurvey($checkUpID, $patientID)
    {
        $data = [
            "check_up_id" => $checkUpID,
            "patient_id"  => $patientID,
            "status"      => 0,
        ];
        $query = $this->db->insert("surveys", $data);
        return $query ? true : false;
    }

}

