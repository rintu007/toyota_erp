<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class F_vendor extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertVendor($vendorData) {

        $this->db->insert('f_vendor', $vendorData);
        return "Successfully Inserted";
    }

    function UpdateVendor($idVendor, $vendorData) {

        $this->db->where('idVendor', $idVendor);
        $this->db->update('f_vendor', $vendorData);
        return "Successfully Updated";
    }

    function DeleteVendor($idVendor) {

        $this->db->set('isActive', 0);
        $this->db->where('idVendor', $idVendor);
        $this->db->update('f_vendor');
        return "Successfully Deleted";
    }

    function getAllVendors() {

        $this->db->select('*');
        $this->db->from('f_vendor');
        $this->db->where('f_vendor.isActive != 0');
        $vendorList = $this->db->get();
        return $vendorList->result_array();
    }

    function searchVendor($SearchKeyword) {

        $whereClause = "f_vendor.VendorName LIKE '$SearchKeyword' OR f_vendor.CompanyName LIKE '$SearchKeyword' AND f_vendor.isActive = 1";
        $this->db->select('*');
        $this->db->from('f_vendor');
        $this->db->where($whereClause);
        $searchVendor = $this->db->get();
        return $searchVendor->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
