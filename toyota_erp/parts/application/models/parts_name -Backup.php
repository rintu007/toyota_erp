<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_name extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allParts() {
        $PartName = $this->db->select('*')->from('parts_name')->get();
        return $PartName->result_array();
    }

    function onePart($idPart) {
        $PartName = $this->db->select('*')->from('parts_name')->where('idPart', $idPart)->get();
        return $PartName->result_array();
    }

    function insertParts($PartData) {
        $this->db->trans_start();
        $this->db->insert('parts_name', $PartData);
        $idPart = $this->db->insert_id();

        $QuantityData = array(
            'MinQuantity' => $this->input->post('Quantity'),
            'PartId' => $idPart,
            'CreatedDate' => date('Y/m/d')
        );

        $this->db->insert('parts_min_quantity', $QuantityData);
        $occupiedData = array(
            'isOccupied' => 1
        );
        if ($this->input->post('Location') == "Select Primary Location") {
            $Location = NULL;
        } else if ($this->input->post('Location') == "Nill") {
            $Location = NULL;
        } else {
            $Location = $this->input->post('Location');
            $this->db->where('idRack', $Location);
            $this->db->update('parts_rack', $occupiedData);
        }
        if ($this->input->post('sLocation') == "Select Secondary Location") {
            $secondaryLocation = NULL;
        } else if ($this->input->post('sLocation') == "Nill") {
            $secondaryLocation = NULL;
        } else {
            $secondaryLocation = $this->input->post('sLocation');
            $this->db->where('idRack', $secondaryLocation);
            $this->db->update('parts_rack', $occupiedData);
        }
        $LocationData = [];
        array_push($LocationData, $Location);
        array_push($LocationData, $secondaryLocation);
        $InventoryData = array(
            'PartId' => $idPart,
            'PartCategory' => $this->input->post('PartCategory'),
            'CostPrice' => $this->input->post('CostPrice'),
            'RetailPrice' => $this->input->post('RetailPrice'),
            'BarcodeNumber' => $this->input->post('BarcodeNumber'),
            'MAD' => $this->input->post('Mad'),
            'MIP' => $this->input->post('Mip'),
            'LeadTime' => $this->input->post('LeadTime'),
            'OrderCycle' => $this->input->post('OrderCycle'),
            'Location' => $Location,
            'SecondaryLocation' => $secondaryLocation,
            'PhaseOutQuantity' => $this->input->post('PhaseOutQuantity'),
            'SafetyStock' => $this->input->post('SafetyStock'),
            'ManufacturerId' => $this->input->post('ManufacturerId')
        );
        $this->db->insert('parts_inventory', $InventoryData);
//        print_r($LocationData);
//        $PartLocationData = "";
        for ($l = 0; $l < count($LocationData); $l++) {
            $PartLocationData[] = array(
                'idPart' => $idPart,
                'idRack' => $LocationData[$l]
            );
        }
        $this->db->insert_batch('parts_location', $PartLocationData);
//        echo "<br>";
//        print_r($PartLocationData);
//        exit();
        $VariantData = array();
        $Variant = $this->input->post('variants');
//        print_r($Variant);
        $Count = count($this->input->post('variants'));
        for ($i = 0; $i < $Count; $i++) {
            $VariantData[] = array(
                'PartId' => $idPart,
                'VariantId' => $Variant[$i]);
        }
//        print_r($VariantData);
//        exit();
        if ($Variant != "") {
            $this->db->insert_batch('parts_variants', $VariantData);
        }

        // Adding Order Mode
        if ($this->input->post('OrderMode') == "Select Order Mode") {
            $orderMode = NULL;
        } else {
            $orderModeData = array();
            $orderMode = $this->input->post('OrderMode');
            $countOrderMode = count($this->input->post('OrderMode'));
            for ($i = 0; $i < $countOrderMode; $i++) {
                $orderModeData[] = array(
                    'idParts_Name' => $idPart,
                    'idOrderMode' => $orderMode[$i]);
            }
            $this->db->insert_batch('parts_ordermode', $orderModeData);
        }

        $this->db->trans_complete();
        return "Successfully Inserted";
    }

    function viewparts($idPart = NULL) {
        if ($idPart == NULL) {
            $AllParts = $this->db->select('*')->from('viewparts')->get();
        } else {
            $AllParts = $this->db->select('*')->from('viewparts')->where('idPart', $idPart)->get();
        }
        return $AllParts->result_array();
    }

    function partsvariant($idPart) {
        $AllParts = $this->db->select('*')->from('parts_variants')->where('PartId', $idPart)->get();
        return $AllParts->result_array();
    }

    function updateParts($idPart, $PartData, $idInventory, $InventoryData) {
        $this->db->trans_start();

        $this->db->where('idPart', $idPart);
        $this->db->update('parts_name', $PartData);
  $this->db->where('idParts_Name', $idPart);
        $this->db->delete('parts_ordermode');

        $orderModeData = array();
        $orderMode = $this->input->post('OrderMode');
        $countOrderMode = count($this->input->post('OrderMode'));
        for ($i = 0; $i < $countOrderMode; $i++) {
            $orderModeData[] = array(
                'idParts_Name' => $idPart,
                'idOrderMode' => $orderMode[$i]);
        }
        $this->db->insert_batch('parts_ordermode', $orderModeData);
        $InventoryData = array(
            'PartId' => $idPart,
            'PartCategory' => $this->input->post('PartCategory'),
            'CostPrice' => $this->input->post('CostPrice'),
            'RetailPrice' => $this->input->post('RetailPrice'),
            'ManufacturerId' => $this->input->post('ManufacturerId')
        );

        $this->db->where('idInventory', $idInventory);
        $this->db->update('parts_inventory', $InventoryData);

        $this->db->trans_complete();

        return "Successfully Updated";
    }

    function deleteParts($idPart) {
        $this->db->where('idPart', $idPart);
        $this->db->delete('parts_name');
    }

    function fillIMCPartsCombo() {
        $query = $this->db->query('SELECT parts_name.idPart, parts_name.PartNumber, parts_manufacturer.Manufacturer
                            FROM parts_name INNER JOIN parts_inventory ON parts_inventory.PartId = parts_name.idPart
                            INNER JOIN parts_manufacturer ON parts_inventory.ManufacturerId = parts_manufacturer.idManufacturer
                            WHERE parts_manufacturer.Manufacturer="IMC"');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }
    
    function fillLocalPartsCombo() {
        $query = $this->db->query('SELECT parts_name.idPart, parts_name.PartNumber, parts_manufacturer.Manufacturer
                            FROM parts_name INNER JOIN parts_inventory ON parts_inventory.PartId = parts_name.idPart
                            INNER JOIN parts_manufacturer ON parts_inventory.ManufacturerId = parts_manufacturer.idManufacturer
                            WHERE parts_manufacturer.Manufacturer="LOC"');
							
        $dropdowns = $query->result();
		//var_dump($dropdowns);die;
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillPartNumberCombo() {
        $query = $this->db->query('select idPart, PartNumber from parts_name');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillVariantCombo() {
        $query = $this->db->query('select distinct IdVariants, Variants from car_variants');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idVariant" => $dropdown->IdVariants, "VariantName" => $dropdown->Variants]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillLocation() {
        $query = $this->db->query('select idRack, RackNumber from parts_rack where isOccupied = 0');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idRack" => $dropdown->idRack, "RackNumber" => $dropdown->RackNumber]);
        }
        return $dropDownList;
    }

    function checkLocation() {

        $primarLocation = $this->input->post('PrimaryLocation');
        $query = $this->db->query('SELECT idRack, RackNumber from parts_rack WHERE isOccupied = 0 AND idRack != ' . $primarLocation . '');
        $dropdowns = $query->result_array();
        return $dropdowns;
//        foreach ($dropdowns as $dropdown) {
//            array_push($dropDownList, ["idRack" => $dropdown->idRack, "RackNumber" => $dropdown->RackNumber]);
//        }
    }

    function fillOrderMode() {
        $query = $this->db->query('select id, Title from invoice_claim_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["id" => $dropdown->id, "Title" => $dropdown->Title]);
        }
        return $dropDownList;
    }

    function fillBrandNameCombo() {
        $query = $this->db->query('select IdParent, ParentName from car_parent');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["IdParent" => $dropdown->IdParent, "ParentName" => $dropdown->ParentName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function variantGroup() {
        $query = $this->db->query('SELECT car_variants.Variants, car_variants.ModelCode, car_variants.IdVariants,
 car_model.IdModel, car_model.Model FROM car_variants
LEFT JOIN car_model ON car_variants.ModelId = car_variants.ModelId');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Model" => $dropdown->Model]);
        }
        return $dropDownList;
    }

    function fillVariantCheckBox() {
        $query = $this->db->query('select IdVariants, Variants, ModelCode, car_model.IdModel, car_model.Model from car_variants
LEFT OUTER JOIN car_model ON car_variants.ModelId = car_model.IdModel ');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdVariants, "Variants" => $dropdown->Variants, "ModelCode" => $dropdown->ModelCode, "idModel" => $dropdown->IdModel, "Model" => $dropdown->Model]);
        }
        return $dropDownList;
    }

    function searchPart($searchKeyword) {

        $query = $this->db->query("select IdVariants, Variants, ModelCode,car_model.IdModel,car_model.Model from car_variants
                 LEFT JOIN car_model ON car_variants.ModelId = car_model.IdModel
                 WHERE car_model.Model LIKE '$searchKeyword'");
        return $query->result_array();
    }
	
	    function onePartCheck($idPart) {
        $PartName = $this->db->select('*')->from('parts_name')->where('PartNumber', $idPart)->get();
        return $PartName->result_array();
    }

}
