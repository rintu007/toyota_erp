<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_rofinance extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function isExistReceivable($idCustomer) {
        $whereClause = "idParty = '$idCustomer' AND FromDepartment = 'ServiceDepartment' AND isActive = 1";
        $this->db->select('*');
        $this->db->from('f_receivable');
        $this->db->where($whereClause);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            return $isExist->result_array();
        }
    }

    function createTransaction($transactionData) {
        $this->db->insert('f_transaction', $transactionData);
        return "Transaction Done Successfully";
    }

    function createReceivable($receivableData) {
        $this->db->insert('f_receivable', $receivableData);
        return "Receivable Created Successfully";
    }

    function updateReceivable($idReceivable, $receivableData) {
        $this->db->where('idReceivable', $idReceivable);
        $this->db->update('f_receivable', $receivableData);
        return "Receivable Updated Successfully";
    }

    function UpdateRO($idRO, $rOData, $customerName, $regNumber) {

        // First Save Receive Payment.
        $this->db->where('idRepairOrderBill', $idRO);
        $this->db->update('s_repairorderbill', $rOData);

        //Now Check if any Other RO is Opened or Not for the Respective Customer
        $this->db->select('idRO');
        $this->db->from('viewrodetail vr');
        $this->db->where('vr.CustomerName', $customerName);
        $this->db->where('vr.RegNumber', $regNumber);
        $this->db->where('vr.isPaymentCleared', 0);
        $idRO = $this->db->get();
        if ($idRO->num_rows() > 0) {
            $row = $idRO->row();
            $idRO = $row->idRO;
            return $idRO;
        } else {
            return "Payment Received";
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

    function getRODetail() {

        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->where('vr.isPaymentCleared != 1');
        $this->db->where('vr.isAmountDue', 1);
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

    function searchRODetail($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->like('vr.RONumber', $SearchKeyword);
        $this->db->where('vr.isPaymentCleared != 1');
        $this->db->where('vr.Status = "Open"');
        $this->db->where('vr.isActive != 0');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    }

    function searchROById($idRO) {

        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->like('vr.idRO', $idRO);
        $this->db->where('vr.isActive != 0');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    }

    function selectAllRepairOrder() {
        
    }

}
