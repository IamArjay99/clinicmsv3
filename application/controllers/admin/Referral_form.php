<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral_form extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/ReferralForm_model", "referralform");
    }

    public function index()
    {
        $data['title'] = "Referral Form";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/referral_form/index");
        $this->load->view("admin/template/footer");
    }

    public function print()
    {
        $referralFormID = $this->input->get("id");
        $data = [
            "title" => "Referral Form",
            "data"  => $this->referralform->getReferralForm($referralFormID)
        ];
        $this->load->view("admin/referral_form/print", $data);
    }

}

