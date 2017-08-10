<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_estimatesmechanical extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertEstimateMechanical($estimateData) {

        $this->db->insert('s_estimate', $estimateData);
        return "Estimate Created with Estimate-No ";
    }

    function getSerialNumber() {

        $where = "isMechanical = 1";
        $this->db->select('SerialNumber');
        $this->db->from('s_estimate');
        $this->db->where($where);
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $serialNumber = $this->db->get();
        if ($serialNumber->num_rows() > 0) {
            $row = $serialNumber->row();
            $serialNumber = $row->SerialNumber;
            return $serialNumber + 1;
        }else{
            return "1";
        }
    }

    function getIdEstimateMechanical() {

        $where = "isMechanical = 1";
        $this->db->select('idEstimate');
        $this->db->from('s_estimate');
        $this->db->where($where);
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idEstimate = $this->db->get();
        if ($idEstimate->num_rows() > 0) {
            $row = $idEstimate->row();
            $idEstimate = $row->idEstimate;
            return $idEstimate;
        }
    }

    function isEstimateExist($tableName, $where, $ofType, $value) {
        $whereClause = "$where = '$value' AND isMechanical = '$ofType' AND isActive = 1";
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($whereClause);
        $this->db->limit(1);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function Update() {
        
    }

    function Delete() {
        
    }

    function search() {
        
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
