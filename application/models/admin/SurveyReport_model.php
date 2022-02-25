<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SurveyReport_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getSurveyReport($year = '', $month = '')
    {
        $sql = "
        SELECT 
            ROUND((q1+q2+q3+q4+q5+q6+q7+q8+q9+q10)/10, 0) AS average 
        FROM surveys WHERE status = 1
            AND YEAR(created_at) = '$year' 
            AND MONTH(created_at) = '$month'";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

}

