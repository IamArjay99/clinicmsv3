<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function updateAppointment()
    {
        $sql = "UPDATE clinic_appointments SET is_read = 1 WHERE clinic_appointment_id <> 0 AND is_read = 0";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }

}

