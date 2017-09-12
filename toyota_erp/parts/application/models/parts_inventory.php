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
        $this->db->join('parts_superceed', 'parts_name.idPart = parts_superceed.OldPart', 'LEFT OUTER');
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
        $this->db->join('parts_superceed', 'parts_name.idPart = parts_superceed.OldPart', 'LEFT OUTER');
        $this->db->like('parts_name.idPart', $SearchKeyword);
        $this->db->or_like('parts_superceed.SuperceedPart', $SearchKeyword);
        $this->db->or_like('parts_name.PartName', $SearchKeyword);
        $this->db->or_like('parts_category.CategoryName', $SearchKeyword);
        $this->db->or_like('parts_manufacturer.Manufacturer', $SearchKeyword);
        $SearchInventory = $this->db->get();
//        print_r($SearchInventorys);
        return $SearchInventory->result_array();
    }

    function fillPartCombo() {
        $Query = $this->db->query('select distinct idPart, PartName from parts_name');
        $PartCombo = $Query->result();
        $DropdownList = array();
        foreach ($PartCombo as $Dropdown) {
            array_push($DropdownList, ["idPart" => $Dropdown->idPart, "PartName" => $Dropdown->PartName]);
        }
        $FinalDropdown = $DropdownList;
        return $FinalDropdown;
    }

    function fillCategoryCombo() {
        $Query = $this->db->query('select distinct idCategory, CategoryName from parts_category');
        $CategoryCombo = $Query->result();
        $DropdownList = array();
        foreach ($CategoryCombo as $Dropdown) {
            array_push($DropdownList, ["idCategory" => $Dropdown->idCategory, "CategoryName" => $Dropdown->CategoryName]);
        }
        $FinalDropdown = $DropdownList;
        return $FinalDropdown;
    }

    function fillManufacturerCombo() {
        $Query = $this->db->query('select distinct idManufacturer, Manufacturer from parts_manufacturer');
        $ManufacturerCombo = $Query->result();
        $DropdownList = array();
        foreach ($ManufacturerCombo as $Dropdown) {
            array_push($DropdownList, ["idManufacturer" => $Dropdown->idManufacturer, "Manufacturer" => $Dropdown->Manufacturer]);
        }
        $FinalDropdown = $DropdownList;
        return $FinalDropdown;
    }
	
	
	function searchPartsDetails($searchKeyword) {
        if ($searchKeyword == NULL) {
            $data = $this->db->select('*')->from('viewparts')->get();
        } else {
            $this->db->select('*');
            $this->db->from('viewparts');
            $this->db->like('PartNumber', $searchKeyword, 'after');
            $this->db->or_like('PartName', $searchKeyword, 'after');
            $this->db->or_like('Manufacturer', $searchKeyword, 'after');
            $this->db->or_like('CategoryName', $searchKeyword, 'after');
            $data = $this->db->get();
        }
        return $data->result_array();
    }
	

}
