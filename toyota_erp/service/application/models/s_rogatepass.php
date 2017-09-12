<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_rogatepass extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertRepairOrder($repairOrderData) {

        echo 'Is Occur';
        $this->db->insert('s_repairorderbill', $repairOrderData);
        return "RO Created";
    }

    function UpdateRO($idRO, $rOData) {

        $this->db->where('idRepairOrderBill', $idRO);
        $rOUpdated = $this->db->update('s_repairorderbill', $rOData);
        if ($rOUpdated) {
            $this->db->select('*');
            $this->db->from('viewrodetail vr');
            $this->db->where('vr.idRO', $idRO);
            $rODetail = $this->db->get();
            return $rODetail->result_array();
        }
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

    function generateGatePassNumber() {

        $where = "isPaymentCleared = 1 AND Status = 'close'";
        $this->db->select('GatePassNumber');
        $this->db->from('s_repairorderbill');
        $this->db->where($where);
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $gatePassNumber = $this->db->get();
        if ($gatePassNumber->num_rows() > 0) {
            $row = $gatePassNumber->row();
            $gatePassNumber = $row->GatePassNumber;
            return $gatePassNumber;
        }
    }

    function getRODetail() {

        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->where('vr.isPaymentCleared != 0');
        $this->db->where('vr.Status = "Open"');
        $this->db->where('vr.isActive != 0');
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

    function searchROById($idRO) {

        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->like('vr.idRO', $idRO);
        $this->db->where('vr.isActive != 0');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    }

    function searchRODetail($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->like('vr.RONumber', $SearchKeyword);
        $this->db->where('vr.isPaymentCleared != 0');
        $this->db->where('vr.Status = "Open"');
        $this->db->where('vr.isActive != 0');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    }

    function selectAllRepairOrder() {
        
    }

}
