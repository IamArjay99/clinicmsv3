<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_out extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/StockOut_model", "stockout");
    }

    public function index()
    {
        $data['title'] = "Stock Out";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/stock_out/index");
        $this->load->view("admin/template/footer");
    }

    public function add() 
    {
        $data['title'] = "Add Stock Out";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/stock_out/add");
        $this->load->view("admin/template/footer");
    }

    public function view() 
    {
        $stockInID = $this->input->get("id");
        $data = [
            "title" => "View Stock Out",
            "data"  => $this->stockout->getStockOut($stockInID),
        ];
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/stock_out/view", $data);
        $this->load->view("admin/template/footer");
    }

    public function saveStockOut()
    {
        $reason              = $this->input->post("reason");
        $medicine            = $this->input->post("medicine");
        $careEquipment       = $this->input->post("careEquipment");
        $officeSupply        = $this->input->post("officeSupply");

        $data = [
            "reason"     => $reason,
            "created_at" => date("Y-m-d H:i:s")
        ];

        $saveStockOut = $this->stockout->saveStockOut($data, $medicine, $careEquipment, $officeSupply);
        echo json_encode($saveStockOut);
    }

}

