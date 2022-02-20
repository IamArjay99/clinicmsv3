<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InventorySupply_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getMedicineSupply()
    {
        $data = [];

        $sql = "
        SELECT 
            m.*, u.name AS unit_name, m2.name AS measurement_name 
        FROM medicines AS m
            LEFT JOIN units AS u USING(unit_id)
            LEFT JOIN measurements AS m2 USING(measurement_id) 
        WHERE m.is_deleted = 0";
        $query     = $this->db->query($sql);
        $medicines = $query ? $query->result_array() : [];

        if ($medicines && !empty($medicines))
        {
            foreach ($medicines as $key => $med) 
            {
                $remaining        = 0;
                $medicine_id      = $med['medicine_id'];
                $name             = $med['name'];
                $brand            = $med['brand'];
                $unit_name        = $med['unit_name'];
                $measurement_name = $med['measurement_name'];
                $capacity         = $med['capacity'];

                $sql    = "SELECT quantity, remaining, batch, expiration FROM stock_in_medicine WHERE medicine_id = $medicine_id AND is_deleted = 0 AND remaining > 0";
                $query  = $this->db->query($sql);
                $items = $query ? $query->result_array() : [];

                foreach ($items as $item) $remaining += $item['remaining'];

                $data[] = [
                    'medicine_id'      => $medicine_id,     
                    'name'             => $name,            
                    'brand'            => $brand,           
                    'unit_name'        => $unit_name,       
                    'measurement_name' => $measurement_name,
                    'items'            => $items,
                    'remaining'        => $remaining,
                    'capacity'         => $capacity,
                ];
            }
        }

        return $data;
    }

    public function getCareEquipmentSupply()
    {
        $data = [];

        $sql = "
        SELECT 
            ce.*, u.name AS unit_name
        FROM care_equipments AS ce
            LEFT JOIN units AS u USING(unit_id)
        WHERE ce.is_deleted = 0";
        $query     = $this->db->query($sql);
        $care_equipments = $query ? $query->result_array() : [];

        if ($care_equipments && !empty($care_equipments))
        {
            foreach ($care_equipments as $key => $ce) 
            {
                $remaining         = 0;
                $care_equipment_id = $ce['care_equipment_id'];
                $name              = $ce['name'];
                $unit_name         = $ce['unit_name'];
                $capacity          = $ce['capacity'];

                $sql    = "SELECT quantity, remaining, batch, expiration FROM stock_in_care_equipment WHERE care_equipment_id = $care_equipment_id AND is_deleted = 0 AND remaining > 0";
                $query  = $this->db->query($sql);
                $items = $query ? $query->result_array() : [];

                foreach ($items as $item) $remaining += $item['remaining'];

                $data[] = [
                    'care_equipment_id' => $care_equipment_id,     
                    'name'              => $name,            
                    'unit_name'         => $unit_name,      
                    'items'             => $items,
                    'remaining'         => $remaining,
                    'capacity'          => $capacity,
                ];
            }
        }

        return $data;
    }

    public function getOfficeSupply()
    {
        $data = [];

        $sql = "
        SELECT 
            os.*, u.name AS unit_name
        FROM office_supply AS os
            LEFT JOIN units AS u USING(unit_id)
        WHERE os.is_deleted = 0";
        $query     = $this->db->query($sql);
        $office_supply = $query ? $query->result_array() : [];

        if ($office_supply && !empty($office_supply))
        {
            foreach ($office_supply as $key => $os) 
            {
                $remaining        = 0;
                $office_supply_id = $os['office_supply_id'];
                $name             = $os['name'];
                $unit_name        = $os['unit_name'];
                $capacity         = $os['capacity'];

                $sql    = "SELECT quantity, remaining, batch, expiration FROM stock_in_office_supply WHERE office_supply_id = $office_supply_id AND is_deleted = 0 AND remaining > 0";
                $query  = $this->db->query($sql);
                $items  = $query ? $query->result_array() : [];

                foreach ($items as $item) $remaining += $item['remaining'];

                $data[] = [
                    'office_supply_id' => $office_supply_id,     
                    'name'             => $name,            
                    'unit_name'        => $unit_name,       
                    'items'            => $items,
                    'remaining'        => $remaining,
                    'capacity'         => $capacity,
                ];
            }
        }

        return $data;
    }


    public function getMedicineData($medicineID = 0)
    {
        $sql1    = "SELECT * FROM stock_in_medicine WHERE medicine_id = $medicineID AND is_deleted = 0";
        $query1  = $this->db->query($sql1);
        $stockin = $query1 ? $query1->result_array() : [];

        $sql2     = "SELECT * FROM stock_out_medicine WHERE medicine_id = $medicineID AND is_deleted = 0";
        $query2   = $this->db->query($sql2);
        $stockout = $query2 ? $query2->result_array() : [];

        return [
            "stockin"  => $stockin,
            "stockout" => $stockout,
        ];
    }

    public function getCareEquipmentData($careEquipmentID = 0)
    {
        $sql1    = "SELECT * FROM stock_in_care_equipment WHERE care_equipment_id = $careEquipmentID AND is_deleted = 0";
        $query1  = $this->db->query($sql1);
        $stockin = $query1 ? $query1->result_array() : [];

        $sql2     = "SELECT * FROM stock_out_care_equipment WHERE care_equipment_id = $careEquipmentID AND is_deleted = 0";
        $query2   = $this->db->query($sql2);
        $stockout = $query2 ? $query2->result_array() : [];

        return [
            "stockin"  => $stockin,
            "stockout" => $stockout,
        ];
    }

    public function getOfficeSupplyData($officeSupplyID = 0)
    {
        $sql1    = "SELECT * FROM stock_in_office_supply WHERE office_supply_id = $officeSupplyID AND is_deleted = 0";
        $query1  = $this->db->query($sql1);
        $stockin = $query1 ? $query1->result_array() : [];

        $sql2     = "SELECT * FROM stock_out_office_supply WHERE office_supply_id = $officeSupplyID AND is_deleted = 0";
        $query2   = $this->db->query($sql2);
        $stockout = $query2 ? $query2->result_array() : [];

        return [
            "stockin"  => $stockin,
            "stockout" => $stockout,
        ];
    }

}

