<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_manufacturer extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allManufacturer() {
        $this->db->select('*');
        $this->db->from('parts_manufacturer');
        $PartManufacturer = $this->db->get();
        return $PartManufacturer->result_array();
    }

    function oneManufacturer($idManufacturer) {
        $PartRack = $this->db->select('*')->from('parts_manufacturer')->where('idManufacturer', $idManufacturer)->get();
        return $PartRack->result_array();
    }

    function insertManufacturer($ManufacturerData) {
        $InsertRack = $this->db->insert('parts_manufacturer', $ManufacturerData);
        if ($InsertRack) {
            return "Successfully Inserted";
        } else {
            return "Failed";
        }
        $this->db->insert_id();
    }

    function updateManufacturer($idManufacturer, $ManufacturerData) {
        $this->db->where('idManufacturer', $idManufacturer);
        $this->db->update('parts_manufacturer', $ManufacturerData);
    }

    function deleteManufacturer($idManufacturer) {
        $this->db->where('idManufacturer', $idManufacturer);
        $this->db->delete('parts_manufacturer');
    }

    function searchManufacturer($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('parts_manufacturer');
        $this->db->like('parts_manufacturer.Manufacturer', $SearchKeyword);
        $SearchInventory = $this->db->get();
        return $SearchInventory->result_array();
    }

}
