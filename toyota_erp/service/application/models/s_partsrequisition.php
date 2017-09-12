<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_partsrequisition extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getAllRequestedParts() {
        $this->db->select('*');
        $this->db->from('viewpartsreqdetail vr');
        $this->db->where('vr.PartRequested', 0);
        $partsRequested = $this->db->get();
        return $partsRequested->result_array();
    }

    function getRequestedParts($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('viewpartsreqdetail vr');
        $this->db->like('vr.RONumber', $SearchKeyword);
        $this->db->where('vr.PartRequested', 0);
        $partsRequested = $this->db->get();
        return $partsRequested->result_array();
    }
	function getPartsByRo($RONumber){
		$sql = "
				SELECT
				s_repairorderbill.idRepairOrderBill,
				s_cutomerdetail.CustomerName,
				s_cutomerdetail.Cnic,
				s_vehicle.VehicleName,
				s_vehicle.Model,
				s_vehicle.RegistrationNumber,
				s_vehicle.EngineNumber,
				s_vehicle.ChassisNumber,
				s_partsreq_partsinfo.PartQuantity,
				s_partsreq_partsinfo.PartAmount,
				s_partsreq_partsinfo.idPart,
				parts_name.PartNumber,
				parts_name.PartName,
				s_partsreq_partsinfo.CreatedDate,
				s_vehicle.EstNumber,
				s_vehicle.ModelCode,
				parts_inventory.CostPrice,
				parts_inventory.RetailPrice
				FROM
				s_repairorderbill
				INNER JOIN s_cutomerdetail ON s_repairorderbill.idCustomerDetail = s_cutomerdetail.idCustomer
				INNER JOIN s_partsrequisition ON s_partsrequisition.idRepairOrderBill = s_repairorderbill.idRepairOrderBill
				INNER JOIN s_vehicle ON s_vehicle.idCustomer = s_cutomerdetail.idCustomer AND s_repairorderbill.idVehicle = s_vehicle.idVehicle
				INNER JOIN s_partsreq_partsinfo ON s_partsreq_partsinfo.idPartsRequisition = s_partsrequisition.idPartsRequisition
				INNER JOIN parts_name ON s_partsreq_partsinfo.idPart = parts_name.idPart
				INNER JOIN parts_inventory ON parts_inventory.PartId = parts_name.idPart
				WHERE s_repairorderbill.idRepairOrderBill = $RONumber";
				$query = $this->db->query($sql);
				$partsRequested = $query->result_array();
				return $partsRequested;
	}

    function fillPartCombo() {
        $query = $this->db->query('select idPart, PartNumber,PartName from parts_name');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber, "PartName" => $dropdown->PartName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function Update() {
        
    }

    function Delete() {
        
    }

    function search() {
        
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
