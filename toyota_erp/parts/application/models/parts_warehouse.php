<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_warehouse extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allWarehouse() {
        $this->db->select('*');
        $this->db->from('parts_warehouse');
        $PartWarehouse = $this->db->get();
        return $PartWarehouse->result_array();
    }

    function oneWarehouse($idWarehouse) {
        $PartWarehouse = $this->db->select('*')->from('parts_warehouse')->where('idWarehouse', $idWarehouse)->get();
        return $PartWarehouse->result_array();
    }

    function insertWarehouse($WarehouseData) {
        $InsertWarehouse = $this->db->insert('parts_warehouse', $WarehouseData);
        if ($InsertWarehouse) {
            return "Successfully Inserted";
        } else {
            return "Failed";
        }
        $this->db->insert_id();
    }

    function deleteWarehouse($idWarehouse) {
        $this->db->where('idWarehouse', $idWarehouse);
        $this->db->delete('parts_warehouse');
    }

    function searchWarehouse($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('parts_warehouse');
        $this->db->like('parts_warehouse.Name', $SearchKeyword);
        $SearchWarehouse = $this->db->get();
        return $SearchWarehouse->result_array();
    }

}
