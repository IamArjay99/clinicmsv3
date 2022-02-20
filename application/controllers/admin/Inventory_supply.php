<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_supply extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/InventorySupply_model", "inventorysupply");
    }

    public function index()
    {
        $data = [
            'title'           => 'Supply',
            'medicines'       => $this->inventorysupply->getMedicineSupply(),
            'care_equipments' => $this->inventorysupply->getCareEquipmentSupply(),
            'office_supply'   => $this->inventorysupply->getOfficeSupply(),
        ];

        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/inventory_supply/index", $data);
        $this->load->view("admin/template/footer");
    }

    public function view_medicine()
    {
        $medicineID = $this->input->get("id");
        $name       = $this->input->get("name");
        $data = [
            'title' => 'View Medicine',
            'type'  => 'medicine',
            'name'  => $name,
            'data'  => $this->inventorysupply->getMedicineData($medicineID)
        ];
        
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/inventory_supply/view", $data);
        $this->load->view("admin/template/footer");
    }

    public function view_care_equipment()
    {
        $careEquipmentID = $this->input->get("id");
        $name            = $this->input->get("name");
        $data = [
            'title' => 'View Care Equipment',
            'type'  => 'care equipment',
            'name'  => $name,
            'data'  => $this->inventorysupply->getCareEquipmentData($careEquipmentID)
        ];
        
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/inventory_supply/view", $data);
        $this->load->view("admin/template/footer");
    }

    public function view_office_supply()
    {
        $officeSupplyID = $this->input->get("id");
        $name           = $this->input->get("name");
        $data = [
            'title' => 'View Office Supply',
            'type'  => 'office supply',
            'name'  => $name,
            'data'  => $this->inventorysupply->getOfficeSupplyData($officeSupplyID)
        ];
        
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/inventory_supply/view", $data);
        $this->load->view("admin/template/footer");
    }

}

