<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_request extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/PurchaseRequest_model", "purchaserequest");
    }

    public function index()
    {
        $data['title'] = "Purchase Request";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/purchase_request/index");
        $this->load->view("admin/template/footer");
    }

    public function add() 
    {
        $data['title'] = "Add Purchase Request";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/purchase_request/add");
        $this->load->view("admin/template/footer");
    }

    public function getPurchaseRequest()
    {
        $purchaseRequestID = $this->input->post("purchaseRequestID");
        echo json_encode($this->purchaserequest->getPurchaseRequest($purchaseRequestID));
    }

    public function view() 
    {
        $purchaseRequestID = $this->input->get("id");
        $data = [
            "title" => "View Purchase Request",
            "data"  => $this->purchaserequest->getPurchaseRequest($purchaseRequestID),
        ];
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/purchase_request/view", $data);
        $this->load->view("admin/template/footer");
    }

    public function savePurchaseRequest()
    {
        $reason        = $this->input->post("reason");
        $medicine      = $this->input->post("medicine");
        $careEquipment = $this->input->post("careEquipment");
        $officeSupply  = $this->input->post("officeSupply");

        $data = [
            "reason" => $reason,
            "status" => 0
        ];

        $savePurchaseRequest = $this->purchaserequest->savePurchaseRequest($data, $medicine, $careEquipment, $officeSupply);
        echo json_encode($savePurchaseRequest);
    }

}

