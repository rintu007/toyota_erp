<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_repairorder extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertRepairOrder($repairOrderData) {

        $this->db->insert('s_repairorderbill', $repairOrderData);
        return "RO Opened with RO-Number ";
    }

    function UpdateRepairOrder($idRO) {

        $this->db->where('idRepairOrderBill', $idRO);
        $this->db->set('isPSFU', 1);
        $this->db->update('s_repairorderbill');
        return "Successfully Updated";
    }

    function searchRepairOrder($searchKeyword) {

        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->where('vr.RONumber', $searchKeyword);
        $this->db->where('vr.isActive != 0');
        $searchRO = $this->db->get();
        return $searchRO->result_array();
    }
	function getAllCustype(){
		$this->db->select('*');
		$this->db->from('s_cusType');
		$cusType = $this->db->get();
		return $cusType->result_array();
	}

    function searchisExistCustomer($searchKeyword) {

        $this->db->select('*');
        $this->db->from('s_vehicle veh');
        $this->db->join('s_allvehicles allveh', 'allveh.idAllVehicles = veh.idVariant', 'left');
        $this->db->join('s_cutomerdetail customer', 'customer.idCustomer = veh.idCustomer', 'left');
        $this->db->like('veh.RegistrationNumber', $searchKeyword, 'after');
        $this->db->or_like('veh.ChassisNumber', $searchKeyword, 'after');
        $this->db->or_like('veh.EngineNumber', $searchKeyword, 'after');
        $this->db->or_like('veh.Model', $searchKeyword, 'after');
        $this->db->or_like('veh.EstNumber', $searchKeyword, 'after');
        $searchReg = $this->db->get();
        return $searchReg->result_array();
    }

    function selectOneRepairOrder($RONumber) {

        $where = "RONumber = '$RONumber' AND isActive != 0";
        $this->db->select('idRepairOrderBill');
        $this->db->from('s_repairorderbill');
        $this->db->where($where);
        $idRO = $this->db->get();
        if ($idRO->num_rows() > 0) {
            $row = $idRO->row();
            $idRO = $row->idRepairOrderBill;
            return $idRO;
        }
    }

    function fillPartCombo() {
        $query = $this->db->query('select idPart, PartNumber, PartName from parts_name');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber, "PartName" => $dropdown->PartName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function getIdRepairOrder() {

        $this->db->select('idRepairOrderBill');
        $this->db->from('s_repairorderbill');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idRO = $this->db->get();
        if ($idRO->num_rows() > 0) {
            $row = $idRO->row();
            $idRO = $row->idRepairOrderBill;
            return $idRO;
        }
    }

    function getIdRoPmPackage() {

        $this->db->select('idRoPMPackage');
        $this->db->from('s_ro_pmpackages');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idRoPMPackage = $this->db->get();
        if ($idRoPMPackage->num_rows() > 0) {
            $row = $idRoPMPackage->row();
            $idRoPMPackage = $row->idRoPMPackage;
            return $idRoPMPackage;
        }
    }

    function getROModes() {

        $this->db->select('*');
        $this->db->from('s_romode');
        $this->db->where('isActive', 1);
        $roModes = $this->db->get();
        return $roModes->result_array();
    }
	function getSubModesMech(){
		$this->db->select('*');
		$this->db->from('s_submode');
		$this->db->where('isActive', 1);
		$this->db->where('idROMode', 6);
		$subModesM = $this->db->get();
		return $subModesM->result_array();
	}
	function getSubModeWarr(){
		$this->db->select('*');
		$this->db->from('s_submode');
		$this->db->where('isActive', 1);
		$this->db->where('idROMode',13);
		$subModesW = $this->db->get();
		return $subModesW->result_array();
		
	}
	function getSubModeBP(){
		$this->db->select('*');
		$this->db->from('s_submode');
		$this->db->where('isActive', 1);
		$this->db->where('idROMode', 7);
		$subModesB = $this->db->get();
		return $subModesB->result_array();
	}
	function getSubModeCW(){
		$this->db->select('*');
		$this->db->from('s_submode');
		$this->db->where('isActive', 1);
		$this->db->where('idROMode', 15);
		$subModesC = $this->db->get();
		return $subModesC->result_array();
		
	}

    function getGasInfo() {

        $this->db->select('*');
        $this->db->from('s_gas');
        $this->db->where('s_gas.isActive != 0');
        $gasInfo = $this->db->get();
        return $gasInfo->result_array();
    }

    function generateRONumber() {

        $this->db->select('count(*)+1 AS RONumber');
        $this->db->from('s_repairorderbill');
        $idRO = $this->db->get();
        if ($idRO->num_rows() > 0) {
            $row = $idRO->row();
            $idRO = $row->RONumber;
            return $idRO;
        } else {
            return 0;
        }
    }

    function DeleteRepairOrder() {
        
    }

    function selectAllRepairOrder() {
        
    }
	function getRoData($RONumber){
					$sql="
							SELECT
							s_repairorderbill.RONumber,
							s_repairorderbill.CashMemoNumber,
							s_repairorderbill.CreditMemoNumber,
							s_repairorderbill.BookInDate,
							s_repairorderbill.BookInTime,
							s_repairorderbill.DeliveryDate,
							s_repairorderbill.DeliveryTime,
							s_repairorderbill.VOC,
							s_repairorderbill.LabourAmount,
							s_repairorderbill.LubOilAmount,
							s_repairorderbill.SubletRepairAmount,
							s_repairorderbill.PartsAmount,
							s_repairorderbill.GrandTotal,
							s_repairorderbill.GSTax,
							s_repairorderbill.NetTotal,
							s_repairorderbill.isWorkOrderAttach,
							s_repairorderbill.GatePassNumber,
							s_fuel.FuelVolume,
							s_cutomerdetail.CustomerName,
							s_cutomerdetail.AddressDetails,
							s_cutomerdetail.Cnic,
							s_cutomerdetail.Ntn,
							s_cutomerdetail.Cellphone,
							s_vehicle.VehicleName,
							s_vehicle.Model,
							s_vehicle.RegistrationNumber,
							s_vehicle.EngineNumber,
							s_vehicle.ChassisNumber,
							s_vehicle.Mileage
							FROM
							s_repairorderbill
							INNER JOIN s_fuel ON s_repairorderbill.idFuel = s_fuel.idFuel
							INNER JOIN s_cutomerdetail ON s_repairorderbill.idCustomerDetail = s_cutomerdetail.idCustomer
							INNER JOIN s_vehicle ON s_repairorderbill.idVehicle = s_vehicle.idVehicle
							WHERE s_repairorderbill.RONumber = $RONumber";
					
					$getRoData = $this->db->query($sql);
					return $getRoData->result_array();
					
	}

    function isRecordExist($tableName, $where, $value) {

        $whereClause = "$where = '$value' AND isActive = 1";
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($whereClause);
        $this->db->limit(1);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
