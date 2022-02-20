<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockOut_model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
    }

    public function getStockInMedicine($medicineID = 0)
    {
        $sql = "
        SELECT 
            * 
        FROM stock_in_medicine
        WHERE medicine_id = $medicineID
            AND remaining > 0
            AND is_deleted = 0
        ORDER BY expiration";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function updateStockInMedicine($medicineID = 0, $quantity = 0)
    {
        $tempQuantity = $quantity;
        $updatedData = [];

        $stockInData = $this->getStockInMedicine($medicineID);
        if ($stockInData && !empty($stockInData))
        {
            foreach ($stockInData as $si) 
            {
                $remaining    = $si['remaining'] ?? 0;
                $newRemaining = $remaining - $tempQuantity;
                $newRemaining = $newRemaining > 0 ? $newRemaining : 0;
                $tempQuantity = $tempQuantity - $remaining;
                $tempQuantity = $tempQuantity > 0 ? $tempQuantity : 0;


                $updatedData[] = [
                    'stock_in_medicine_id' => $si['stock_in_medicine_id'],
                    'remaining'            => $newRemaining
                ];
            }
        }

        if ($updatedData && !empty($updatedData))
        {
            $query = $this->db->update_batch("stock_in_medicine", $updatedData, 'stock_in_medicine_id');
            return $query ? true : false;
        }
        return false;
    }

    public function getStockInCareEquipment($careEquipmentID = 0)
    {
        $sql = "
        SELECT 
            * 
        FROM stock_in_care_equipment
        WHERE care_equipment_id = $careEquipmentID
            AND remaining > 0
            AND is_deleted = 0
        ORDER BY expiration";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function updateStockInCareEquipment($careEquipmentID = 0, $quantity = 0)
    {
        $tempQuantity = $quantity;
        $updatedData = [];

        $stockInData = $this->getStockInCareEquipment($careEquipmentID);
        if ($stockInData && !empty($stockInData))
        {
            foreach ($stockInData as $si) 
            {
                $remaining    = $si['remaining'] ?? 0;
                $newRemaining = $remaining - $tempQuantity;
                $newRemaining = $newRemaining > 0 ? $newRemaining : 0;
                $tempQuantity = $tempQuantity - $remaining;
                $tempQuantity = $tempQuantity > 0 ? $tempQuantity : 0;


                $updatedData[] = [
                    'stock_in_care_equipment_id' => $si['stock_in_care_equipment_id'],
                    'remaining'                  => $newRemaining
                ];
            }
        }

        if ($updatedData && !empty($updatedData))
        {
            $query = $this->db->update_batch("stock_in_care_equipment", $updatedData, 'stock_in_care_equipment_id');
            return $query ? true : false;
        }
        return false;
    }

    public function getStockInOfficeSupply($officeSupplyID = 0)
    {
        $sql = "
        SELECT 
            * 
        FROM stock_in_office_supply
        WHERE office_supply_id = $officeSupplyID
            AND remaining > 0
            AND is_deleted = 0
        ORDER BY expiration";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function updateStockInOfficeSupply($officeSupplyID = 0, $quantity = 0)
    {
        $tempQuantity = $quantity;
        $updatedData = [];

        $stockInData = $this->getStockInOfficeSupply($officeSupplyID);
        if ($stockInData && !empty($stockInData))
        {
            foreach ($stockInData as $si) 
            {
                $remaining    = $si['remaining'] ?? 0;
                $newRemaining = $remaining - $tempQuantity;
                $newRemaining = $newRemaining > 0 ? $newRemaining : 0;
                $tempQuantity = $tempQuantity - $remaining;
                $tempQuantity = $tempQuantity > 0 ? $tempQuantity : 0;


                $updatedData[] = [
                    'stock_in_office_supply_id' => $si['stock_in_office_supply_id'],
                    'remaining'                 => $newRemaining
                ];
            }
        }

        if ($updatedData && !empty($updatedData))
        {
            $query = $this->db->update_batch("stock_in_office_supply", $updatedData, 'stock_in_office_supply_id');
            return $query ? true : false;
        }
        return false;
    }

    public function saveStockOut($data = [], $medicine = [], $careEquipment = [], $officeSupply = [])
    {
        $query = $this->db->insert("stock_out", $data);
        if ($query) 
        {
            $stockOutID = $this->db->insert_id();
            $code = generateCode("SO", $stockOutID);
            $this->db->update("stock_out", ["code" => $code], ["stock_out_id" => $stockOutID]);

            if ($medicine && !empty($medicine))
            {
                foreach ($medicine as $key => $m) 
                {
                    $medicineID = $m['medicine_id'];
                    $quantity   = $m['quantity'];
                    $this->updateStockInMedicine($medicineID, $quantity);

                    $medicine[$key]["stock_out_id"] = $stockOutID;
                    $medicine[$key]["remaining"]    = $quantity;
                } 
                $this->db->insert_batch("stock_out_medicine", $medicine);
            }

            if ($careEquipment && !empty($careEquipment))
            {
                foreach ($careEquipment as $key => $ce)
                {
                    $careEquipmentID = $ce['care_equipment_id'];
                    $quantity        = $ce['quantity'];
                    $this->updateStockInCareEquipment($careEquipmentID, $quantity);

                    $careEquipment[$key]["stock_out_id"] = $stockOutID;
                    $careEquipment[$key]["remaining"]   = $ce['quantity'];
                } 
                $this->db->insert_batch("stock_out_care_equipment", $careEquipment);
            }

            if ($officeSupply && !empty($officeSupply))
            {
                foreach ($officeSupply as $key => $os)
                {
                    $officeSupplyID = $os['office_supply_id'];
                    $quantity       = $os['quantity'];
                    $this->updateStockInOfficeSupply($officeSupplyID, $quantity);

                    $officeSupply[$key]["stock_out_id"] = $stockOutID;
                    $officeSupply[$key]["remaining"]   = $os['quantity'];
                } 
                $this->db->insert_batch("stock_out_office_supply", $officeSupply);
            }

            return "true|Stock out saved successfully!";
        }
        return "false|There was an error saving stock out.";
    }

    public function getStockOutMedicine($stockOutID = 0)
    {
        $sql = "
        SELECT 
            sim.*, m.name AS medicine_name, m.brand AS medicine_brand, u.name AS unit_name, m2.name AS measurement_name
        FROM stock_out_medicine AS sim 
            LEFT JOIN medicines AS m USING(medicine_id)
            LEFT JOIN units AS u ON m.unit_id = u.unit_id
            LEFT JOIN measurements AS m2 ON m.measurement_id = m2.measurement_id 
        WHERE sim.stock_out_id = $stockOutID";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getStockOutCareEquipment($stockOutID = 0)
    {
        $sql = "
        SELECT 
            sice.*, ce.name AS care_equipment_name, u.name AS unit_name 
        FROM stock_out_care_equipment AS sice 
            LEFT JOIN care_equipments AS ce USING(care_equipment_id)
            LEFT JOIN units AS u ON ce.unit_id = u.unit_id
        WHERE sice.stock_out_id = $stockOutID";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getStockOutOfficeSupply($stockOutID = 0)
    {
        $sql = "
        SELECT 
            sios.*, os.name AS office_supply_name, u.name AS unit_name 
        FROM stock_out_office_supply AS sios 
            LEFT JOIN office_supply AS os USING(office_supply_id)
            LEFT JOIN units AS u ON os.unit_id = u.unit_id
        WHERE sios.stock_out_id = $stockOutID";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getStockOut($stockOutID = 0)
    {
        $data = [];
        
        $sql    = "SELECT * FROM stock_out WHERE stock_out_id = $stockOutID";
        $query  = $this->db->query($sql);
        $result = $query ? $query->row() : null;
        if ($result) 
        {
            $data = [
                'stock_out_id'   => $result->stock_out_id,
                'code'           => $result->code,
                'reason'         => $result->reason,
                'medicine'       => $this->getStockOutMedicine($stockOutID),
                'care_equipment' => $this->getStockOutCareEquipment($stockOutID),
                'office_supply'  => $this->getStockOutOfficeSupply($stockOutID),
            ];
        }
        return $data;
    }

}

