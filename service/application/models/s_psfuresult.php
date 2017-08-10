<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_psfuresult extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertPSFUResult($PSFUResultData) {

        $this->db->insert('s_psfuresult', $PSFUResultData);
        return "Successfully Inserted";
    }

    function UpdatePSFUResult($idPSFUResult, $PSFUResultData) {

        $this->db->where('idPSFUResult', $idPSFUResult);
        $this->db->update('s_psfuresult', $PSFUResultData);
        return "Successfully Updated";
    }

    function DeletePSFUResult($idPSFUResult) {

        $this->db->set('isActive', 0);
        $this->db->where('idPSFUResult', $idPSFUResult);
        $this->db->update('s_psfuresult');
        return "Successfully Deleted";
    }

    function searchPSFUResult($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_psfuresult');
        $this->db->like('s_psfuresult.Name', $SearchKeyword);
        $this->db->where('s_psfuresult.isActive != 0');
        $searchPSFUResult = $this->db->get();
        return $searchPSFUResult->result_array();
    }

    function getPSFUResult() {

        $this->db->select('*');
        $this->db->from('s_psfuresult');
        $this->db->where('s_psfuresult.isActive != 0');
        $psfuResultList = $this->db->get();
        return $psfuResultList->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
