<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Inventory_main extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allInventory() {
//        $query = $this->db->query('SELECT * FROM viewinventorytab vit GROUP BY vit.PartNumber');
        $query = $this->db->query('SELECT * FROM viewinventorytab');
        return $query->result_array();
    }

    function searchInventory($SearchKeyword) {
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

//    function allInventory() {
//        $query = $this->db->query('SELECT * FROM parts_inventory
//                        LEFT OUTER JOIN parts_name ON parts_inventory.PartId = parts_name.idPart
//            LEFT OUTER JOIN parts_superceed ON parts_superceed.OldPart = parts_name.idPart
//            LEFT OUTER JOIN parts_category ON parts_inventory.PartCategory = parts_category.idCategory
//            LEFT OUTER JOIN parts_manufacturer ON parts_inventory.ManufacturerId = parts_manufacturer.idManufacturer
//            LEFT JOIN inventory_purchase_imc imc ON imc.PartId = parts_name.idPart
//            LEFT JOIN inventory_purchase ip ON ip.idPurchase = imc.PurchaseId
//            LEFT JOIN inventory_purchase_local ON inventory_purchase_local.PartId = parts_name.idPart
//            LEFT JOIN inventory_purchase ON inventory_purchase.idPurchase = inventory_purchase_local.PurchaseId
//            LEFT JOIN inventory_sale_detail ON inventory_sale_detail.PartId = parts_name.idPart
//            LEFT JOIN inventory_sale ON inventory_sale.idSale = inventory_sale_detail.SaleId
//            LEFT JOIN parts_variants ON parts_variants.PartId = parts_name.idPart
//            LEFT JOIN car_variants ON car_variants.IdVariants = parts_variants.VariantId Group By parts_name.PartNumber');
//        return $query->result_array();
//    }
}
