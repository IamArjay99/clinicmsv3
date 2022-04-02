<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Messages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Messages_model", "messages");
    }

    public function index()
    {
        $data['title'] = "Messages";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/messages/index");
        $this->load->view("admin/template/footer");
    }

    public function sendMessage()
    {
        $isAdmin   = $this->input->post("isAdmin");
        $patientID = $this->input->post("patientID");
        $message   = $this->input->post("message");
        $data = [
            "is_admin"   => $isAdmin,
            "patient_id" => $patientID,
            "message"    => $message,
            "created_at" => date("Y-m-d H:i:s"),
        ];
        $sendMessage = $this->messages->sendMessage($data);
        $updateConversation = $this->messages->updateConversation($isAdmin, $patientID);
        echo json_encode($sendMessage);
    }

}

