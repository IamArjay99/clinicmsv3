<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Appointment_model", "appointment");
    }

    public function index()
    {
        $data['title'] = "Appointment";
        $updateAppointment = $this->appointment->updateAppointment();

        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/appointment/index");
        $this->load->view("admin/template/footer");
    }

}

