<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class F_payment extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getAllCustomer() {

        $this->db->select('idCustomer as idCustomer,CustomerName as Customer');
        $this->db->from('s_cutomerdetail');
        $this->db->where('isActive', 1);
        $dataList = $this->db->get();
        return $dataList->result_array();

//        $allCustomers = array();
//        $this->db->select('IdCustomer as idCustomer,CustomerName as Customer');
//        $this->db->from('car_customer');
//        $dataList = $this->db->get();
//        $allCustomers = $dataList->result_array();
//        $this->db->select('idCustomer as idCustomer,CustomerName as Customer');
//        $this->db->from('s_cutomerdetail');
//        $this->db->where('isActive', 1);
//        $dataList = $this->db->get();
//        array_push($allCustomers, $dataList->result_array());
//        print_r($allCustomers);
    }

    function getAllPaymentModes() {

        $this->db->select('*');
        $this->db->from('car_mode_payment');
        $dataList = $this->db->get();
        return $dataList->result_array();
    }

    function getPayment($idParty, $type, $department) {

        if ($type === "Customer") {
            $this->db->select('*');
            $this->db->from('f_receivable');
            $this->db->where('idParty', $idParty);
            $this->db->where('FromDepartment', $department);
            $this->db->where('ReceiveableAmount >', 0);
            $this->db->where('isActive', 1);
            $dataList = $this->db->get();
            return $dataList->result_array();
        } else {
            if ($type === "Vendor") {
                $this->db->select('*');
                $this->db->from('f_payable');
                $this->db->where('idParty', $idParty);
                $this->db->where('FromDepartment', $department);
                $this->db->where('PayableAmount >', 0);
                $this->db->where('isActive', 1);
                $dataList = $this->db->get();
                return $dataList->result_array();
            }
        }
    }

    function createTransaction($transactionData) {
        $this->db->insert('f_transaction', $transactionData);
        return "Transaction Done Successfully";
    }

    function updateReceivable($idReceivable, $receivableData) {
        $this->db->where('idReceivable', $idReceivable);
        $this->db->update('f_receivable', $receivableData);
        return "Receivable Updated Successfully";
    }

    function updatePayable($idPayable, $payableData) {
        $this->db->where('idPayable', $idPayable);
        $this->db->update('f_payable', $payableData);
        return "Payable Updated Successfully";
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
