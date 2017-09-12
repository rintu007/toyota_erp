<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_insurancecompany extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertInsuranceCompany($insuranceCompanyData) {

        $this->db->insert('s_insurancecompany', $insuranceCompanyData);
        return "Successfully Inserted";
    }

    function UpdateInsuranceCompany($idInsuranceCompany, $insuranceCompanyData) {

        $this->db->where('idInsuranceCompany', $idInsuranceCompany);
        $this->db->update('s_insurancecompany', $insuranceCompanyData);
        return "Successfully Updated";
    }

    function DeleteInsuranceCompany($idInsuranceCompany) {

        $this->db->set('isActive', 0);
        $this->db->where('idInsuranceCompany', $idInsuranceCompany);
        $this->db->update('s_insurancecompany');
        return "Successfully Deleted";
    }

    function getAllInsuranceCompanies() {
        $this->db->select('*');
        $this->db->from('s_insurancecompany');
        $this->db->where('isActive', 1);
        $data = $this->db->get();
        return $data->result_array();
    }

    function searchInsuranceCompany($searchKeyword) {

        $this->db->select('*');
        $this->db->from('s_insurancecompany');
        $this->db->like('s_insurancecompany.Name', $searchKeyword);
        $this->db->or_like('s_insurancecompany.CompanyCode', $searchKeyword);
        $this->db->where('s_insurancecompany.isActive != 0');
        $searchInsuranceCompany = $this->db->get();
        return $searchInsuranceCompany->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

//    Insurance Company Branch Functions

    function InsertInsBranch($insBranchData) {

        $this->db->insert('s_insurancecompany_detail', $insBranchData);
        return "Successfully Inserted";
    }

    function UpdateInsBranch($idInsuranceCompanyDetail, $insBranchData) {

        $this->db->where('idInsuranceCompanyDetail', $idInsuranceCompanyDetail);
        $this->db->update('s_insurancecompany_detail', $insBranchData);
        return "Successfully Updated";
    }

    function DeleteInsBranch($idInsuranceCompanyDetail) {

        $this->db->set('isActive', 0);
        $this->db->where('idInsuranceCompanyDetail', $idInsuranceCompanyDetail);
        $this->db->update('s_insurancecompany_detail');
        return "Successfully Deleted";
    }

    function getAllInsBranches() {
        $this->db->select('*');
        $this->db->from('view_insurance_company_details v');
        $this->db->where('v.isActiveBranch != 0');
        $this->db->where('v.isActive != 0');
        $data = $this->db->get();
        return $data->result_array();
    }

    function searchInsBranch($searchKeyword) {
        $this->db->select('*');
        $this->db->from('view_insurance_company_details v');
        $this->db->like('v.BranchName', $searchKeyword);
        $this->db->or_like('v.InsuranceCompanyName', $searchKeyword);
        $this->db->or_like('v.InsuranceCompanyCode', $searchKeyword);
        $this->db->where('v.isActive != 0');
        $data = $this->db->get();
        return $data->result_array();
    }

}
