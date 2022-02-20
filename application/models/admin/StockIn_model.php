<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockIn_model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
    }

    public function saveStockIn($data = [], $medicine = [], $careEquipment = [], $officeSupply = [])
    {
        $query = $this->db->insert("stock_in", $data);
        if ($query) 
        {
            $stockInID = $this->db->insert_id();
            $code = generateCode("SI", $stockInID);
            $this->db->update("stock_in", ["code" => $code], ["stock_in_id" => $stockInID]);

            if ($medicine && !empty($medicine))
            {
                foreach ($medicine as $key => $m) 
                {
                    $medicine[$key]["stock_in_id"] = $stockInID;
                    $medicine[$key]["remaining"]   = $m['quantity'];
                } 
                $this->db->insert_batch("stock_in_medicine", $medicine);
            }

            if ($careEquipment && !empty($careEquipment))
            {
                foreach ($careEquipment as $key => $ce)
                {
                    $careEquipment[$key]["stock_in_id"] = $stockInID;
                    $careEquipment[$key]["remaining"]   = $ce['quantity'];
                } 
                $this->db->insert_batch("stock_in_care_equipment", $careEquipment);
            }

            if ($officeSupply && !empty($officeSupply))
            {
                foreach ($officeSupply as $key => $os)
                {
                    $officeSupply[$key]["stock_in_id"] = $stockInID;
                    $officeSupply[$key]["remaining"]   = $os['quantity'];
                } 
                $this->db->insert_batch("stock_in_office_supply", $officeSupply);
            }

            return "true|Stock in saved successfully!";
        }
        return "false|There was an error saving stock in.";
    }

    public function getStockInMedicine($stockInID = 0)
    {
        $sql = "
        SELECT 
            sim.*, m.name AS medicine_name, m.brand AS medicine_brand, u.name AS unit_name, m2.name AS measurement_name
        FROM stock_in_medicine AS sim 
            LEFT JOIN medicines AS m USING(medicine_id)
            LEFT JOIN units AS u ON m.unit_id = u.unit_id
            LEFT JOIN measurements AS m2 ON m.measurement_id = m2.measurement_id 
        WHERE sim.stock_in_id = $stockInID";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getStockInCareEquipment($stockInID = 0)
    {
        $sql = "
        SELECT 
            sice.*, ce.name AS care_equipment_name, u.name AS unit_name 
        FROM stock_in_care_equipment AS sice 
            LEFT JOIN care_equipments AS ce USING(care_equipment_id)
            LEFT JOIN units AS u ON ce.unit_id = u.unit_id
        WHERE sice.stock_in_id = $stockInID";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getStockInOfficeSupply($stockInID = 0)
    {
        $sql = "
        SELECT 
            sios.*, os.name AS office_supply_name, u.name AS unit_name 
        FROM stock_in_office_supply AS sios 
            LEFT JOIN office_supply AS os USING(office_supply_id)
            LEFT JOIN units AS u ON os.unit_id = u.unit_id
        WHERE sios.stock_in_id = $stockInID";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getStockIn($stockInID = 0)
    {
        $data = [];
        
        $sql    = "SELECT * FROM stock_in WHERE stock_in_id = $stockInID";
        $query  = $this->db->query($sql);
        $result = $query ? $query->row() : null;
        if ($result) 
        {
            $data = [
                'stock_in_id'         => $result->stock_in_id,
                'purchase_request_id' => $result->purchase_request_id,
                'code'                => $result->code,
                'reason'              => $result->reason,
                'medicine'            => $this->getStockInMedicine($stockInID),
                'care_equipment'      => $this->getStockInCareEquipment($stockInID),
                'office_supply'       => $this->getStockInOfficeSupply($stockInID),
            ];
        }
        return $data;
    }

}

