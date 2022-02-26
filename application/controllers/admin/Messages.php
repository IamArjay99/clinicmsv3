<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
            "message"    => $message
        ];
        $sendMessage = $this->messages->sendMessage($data);
        $updateConversation = $this->messages->updateConversation($isAdmin, $patientID);
        echo json_encode($sendMessage);
    }

}

