<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_periodicmaintenance extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertPm($PmData) {

        $this->db->insert('s_periodicmaintenance', $PmData);
        return "Successfully Inserted";
    }

    function UpdatePm($idPeriodicMaintenance, $PmData) {

        $this->db->where('idPeriodicMaintenance', $idPeriodicMaintenance);
        $this->db->update('s_periodicmaintenance', $PmData);
        return "Successfully Updated";
    }

    function DeletePm($idPeriodicMaintenance) {

        $this->db->set('isActive', 0);
        $this->db->where('idPeriodicMaintenance', $idPeriodicMaintenance);
        $this->db->update('s_periodicmaintenance');
        return "Successfully Deleted";
    }

    function getAllPm() {

        $this->db->select('*');
        $this->db->from('s_periodicmaintenance');
        $this->db->where('s_periodicmaintenance.isActive', 1);
        $pmList = $this->db->get();
        return $pmList->result_array();
    }

    function searchPm($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_periodicmaintenance');
        $this->db->like('s_periodicmaintenance.PeriodName', $SearchKeyword);
        $this->db->where('isActive', 1);
        $searchPM = $this->db->get();
        return $searchPM->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
