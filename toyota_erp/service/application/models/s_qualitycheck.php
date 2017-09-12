<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_qualitycheck extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertQualityCheck($qualityCheckData) {

        $this->db->insert('s_qualitycheck', $qualityCheckData);
        return "Successfully Inserted";
    }

    function UpdateQualityCheck($idQualityCheck, $qualityCheckData) {

        $this->db->where('idQualityCheck', $idQualityCheck);
        $this->db->update('s_qualitycheck', $qualityCheckData);
        return "Successfully Updated";
    }

    function DeleteQualityCheck($idQualityCheck) {

        $this->db->set('isActive', 0);
        $this->db->where('idQualityCheck', $idQualityCheck);
        $this->db->update('s_qualitycheck');
        return "Successfully Deleted";
    }

    function searchQualityCheck($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_qualitycheck');
        $this->db->like('s_qualitycheck.Name', $SearchKeyword);
        $this->db->where('s_qualitycheck.isActive != 0');
        $searchQualityCheck = $this->db->get();
        return $searchQualityCheck->result_array();
    }

    function getQualityCheckInfo() {

        $this->db->select('*');
        $this->db->from('s_qualitycheck');
        $this->db->where('s_qualitycheck.isActive != 0');
        $qualityCheckList = $this->db->get();
        return $qualityCheckList->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
