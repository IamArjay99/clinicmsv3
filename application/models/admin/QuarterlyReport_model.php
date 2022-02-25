<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuarterlyReport_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getOccupationType()
    {
        $sql = "SELECT * FROM patient_type WHERE is_deleted = 0";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getServices()
    {
        $sql = "SELECT * FROM services WHERE is_deleted = 0";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getCountCheckUp($serviceID = 0, $patientTypeID = 0, $year = '', $month = 0)
    {
        $sql = "
        SELECT 
            COUNT(*) AS total 
        FROM check_ups AS cu 
            INNER JOIN patients AS p ON cu.patient_id = p.patient_id AND p.patient_type_id=$patientTypeID
        WHERE service_id = $serviceID
            AND YEAR(cu.created_at) = '$year' 
            AND MONTH(cu.created_at) = $month";
        $query = $this->db->query($sql);
        return $query ? $query->row()->total ?? 0 : 0;
    }

    public function getQuarterlyReport($year = '', $quarter = 1) 
    {
        $result = [];
        $occupations = $this->getOccupationType();
        $services    = $this->getServices();

        if ($year && $quarter) {
            $monthNameArr = [
                'January', 'February', 'March', 
                'April',   'May',      'June', 
                'July',    'August',   'September', 
                'October', 'November', 'December'
            ];
            $monthNumberArr = [];

            if ($quarter == 1) {
                $monthNumberArr = [1,2,3];
            }
            else if ($quarter == 2) {
                $monthNumberArr = [4,5,6];
            }
            else if ($quarter == 3) {
                $monthNumberArr = [7,8,9];
            }
            else {
                $monthNumberArr = [10,11,12];
            }

            foreach ($monthNumberArr as $month) {
                $monthName = $monthNameArr[$month - 1];

                $items = [];
                foreach ($occupations as $occ) {
                    $patientTypeID  = $occ['patient_type_id'];
                    $occupationName = $occ['name'];

                    $temp = [];
                    $totalService = 0;
                    foreach ([3,1] as $srv) { // 3 - Dispensing Medicine, 1 - Medical
                        $serviceName = $srv == 3 ? "Dispensing Medicine" : "Medical and Dental";
                        $total       = $this->getCountCheckUp($srv, $patientTypeID, $year, $month);
                        $totalService += $total;

                        $temp[] = [
                            'serviceName' => $serviceName,
                            'total'       => $total
                        ];
                    }
                    
                    $items[] = [
                        'occupationName' => $occupationName,
                        'services'       => $temp,
                        'total'          => $totalService
                    ];
                }

                $result[] = [
                    'monthName' => $monthName,
                    'items'     => $items
                ];
            }
        }

        return $result;
    }

}

