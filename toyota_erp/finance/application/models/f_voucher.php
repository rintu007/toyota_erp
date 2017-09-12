<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class F_voucher extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertVoucher($vendorData) {

        $this->db->insert('f_voucher', $vendorData);
        return "Voucher has been Created Successfully";
    }

    function isExistPayable($idVendor) {
        $whereClause = "idParty = '$idVendor' AND FromDepartment = 'General' AND isActive = 1";
        $this->db->select('*');
        $this->db->from('f_payable');
        $this->db->where($whereClause);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            return $isExist->result_array();
        }
    }

    function createPayable($payableData) {
        $this->db->insert('f_payable', $payableData);
        return "Payable Created Successfully";
    }

    function updatePayable($idPayable, $payableData) {
        $this->db->where('idPayable', $idPayable);
        $this->db->update('f_payable', $payableData);
        return "Payable Updated Successfully";
    }

    function getVoucherNumber() {
        $this->db->select('count(*)+1 as VoucherNumber');
        $this->db->from('f_voucher');
        $voucherNumber = $this->db->get();
        if ($voucherNumber->num_rows() > 0) {
            $row = $voucherNumber->row();
            $voucherNumber = $row->VoucherNumber;
            return $voucherNumber;
        } else {
            return 0;
        }
    }

    function UpdateVoucher() {
        
    }

    function DeleteVoucher() {
        
    }

    function selectOneVoucher() {
        
    }

    function selectAllVoucher() {
        
    }

}
