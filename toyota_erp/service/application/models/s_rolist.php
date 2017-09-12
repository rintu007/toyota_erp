<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_rolist extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertRepairOrder($repairOrderData) {

        echo 'Is Occur';
        $this->db->insert('s_repairorderbill', $repairOrderData);
        return "RO Created";
    }

    function UpdateRO($idRO, $roData) {

        echo '$roData';
        print_r($roData);
        $this->db->where('idRepairOrderBill', $idRO);
        $this->db->update('s_repairorderbill', $roData);
        return "Successfully Updated";
    }

    function UpdateRepairOrder($idRO) {

        $this->db->where('idRepairOrderBill', $idRO);
        $this->db->set('isPSFU', 1);
        $this->db->update('s_repairorderbill');
        return "Successfully Updated";
    }

    function DeleteRepairOrder() {
        
    }

    function selectOneRepairOrder($RONumber) {

        $where = "RONumber = '
        $RONumber' AND isActive != 0";
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

    // get All Closed ROs
    function getRODetail() {

        $this->db->select('*');
        $this->db->from('viewroupdate vr');
        $this->db->where('vr.Status = "close"');
        $this->db->where('vr.isActive != 0');
        $this->db->group_by('vr.idRO');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    }

    // get All Opened ROs
    function getOpenedRODetail() {
        $this->db->select('*');
        $this->db->from('viewroupdate vr');
        $this->db->where('vr.Status = "open"');
        $this->db->where('vr.isActive != 0');
        $this->db->group_by('vr.idRO');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
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

    function searchRODetail($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('viewroupdate vr');
        $this->db->like('vr.RONumber', $SearchKeyword,'after');
        $this->db->where('vr.Status = "close"');
        $this->db->where('vr.isActive != 0');
        $this->db->group_by('vr.idRO');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    } 

	function searchRODetailDate($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('viewroupdate vr');
        if($SearchKeyword)
        $this->db->where('vr.BookingDate', $SearchKeyword);
        $this->db->where('vr.Status = "close"');
        $this->db->where('vr.isActive != 0');
        $this->db->group_by('vr.idRO');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    }

    function searchROById($idRO) {

        $this->db->select('*');
        $this->db->from('viewroupdate vr');
        $this->db->where('vr.idRO', $idRO);
        $this->db->where('vr.isActive != 0');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    }

    function getROWorkPerformed($idRO) {

        $this->db->select('idROWorkPerformed,WorkPerformed,WorkPerformedAmount,WorkPerformedHrs');
        $this->db->from('viewroupdate vr');
        $this->db->where('vr.idRO', $idRO);
        $this->db->where('vr.isActive != 0');
        $this->db->group_by('vr.idROWorkPerformed');
        $workPerformed = $this->db->get();
        return $workPerformed->result_array();
    }

    function getROPartsUseage($idRO) {

        $this->db->select('idPartsUseage,PartDate,PartNumber,PartQuantity,PartDescription,PartAmount,PartSignature');
        $this->db->from('viewroupdate vr');
        $this->db->where('vr.idRO', $idRO);
        $this->db->where('vr.isActive != 0');
        $this->db->group_by('vr.idPartsUseage');
        $partsUseage = $this->db->get();
        return $partsUseage->result_array();
    }

    function getROSubletUseage($idRO) {

        $this->db->select('idSubletRepairUseage,SubletDate,SubletQuantity,SubletReference,SubletDescription,SubletAmount');
        $this->db->from('viewroupdate vr');
        $this->db->where('vr.idRO', $idRO);
        $this->db->where('vr.isActive != 0');
        $this->db->group_by('vr.idSubletRepairUseage');
        $subletUseage = $this->db->get();
        return $subletUseage->result_array();
    }

    function getROLubOilUseage($idRO) {

        $this->db->select('idLubOilUseage,LubDate,LubQuantity,LubDescription,LubAmount,LubSignature');
        $this->db->from('viewroupdate vr');
        $this->db->where('vr.idRO', $idRO);
        $this->db->where('vr.isActive != 0');
        $this->db->group_by('vr.idLubOilUseage');
        $lubOilUseage = $this->db->get();
        return $lubOilUseage->result_array();
    }

    function selectAllRepairOrder() {
        
    }

}
