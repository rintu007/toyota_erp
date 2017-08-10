<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_inventory extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allInventory() {
        $this->db->select('*');
        $this->db->from('parts_inventory');
        $this->db->join('parts_name', 'parts_inventory.PartId = parts_name.idPart');
        $this->db->join('parts_category', 'parts_inventory.PartCategory = parts_category.idCategory');
        $this->db->join('parts_manufacturer', 'parts_inventory.ManufacturerId = parts_manufacturer.idManufacturer');
        $PartInventory = $this->db->get();
        return $PartInventory->result_array();
    }

    function oneInventory($idInventory) {
        $PartInventory = $this->db->select('*')->from('parts_inventory')->where('idInventory', $idInventory)->get();
        return $PartInventory->result_array();
    }

    function insertInventory($InventoryData) {
        $this->db->insert('parts_inventory', $InventoryData);
        $this->db->insert_id();
    }

    function deleteInventory($idInventory) {
        $this->db->where('idInventory', $idInventory);
        $this->db->delete('parts_inventory');
    }

    function searchInventory($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('parts_inventory');
        $this->db->join('parts_name', 'parts_inventory.PartId = parts_name.idPart');
        $this->db->join('parts_category', 'parts_inventory.PartCategory = parts_category.idCategory');
        $this->db->join('parts_manufacturer', 'parts_inventory.ManufacturerId = parts_manufacturer.idManufacturer');
        $this->db->like('parts_name.idPart', $SearchKeyword);
        $this->db->like('parts_name.PartName', $SearchKeyword);
        $SearchInventory = $this->db->get();
        return $SearchInventory->result_array();
    }

}
