<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_partsrequistionbodyshop extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertPartsBodyShop($partsData) {

        $this->db->insert('s_partsrequisition', $partsData);
        return "Request Generated";
    }

    function getPartDetails($idPart) {
        $this->db->select('*');
        $this->db->from('parts_name');
        $this->db->where('idPart', $idPart);
        $getPartDetails = $this->db->get();
        return $getPartDetails->result_array();
    }

    function getIdPartsBodyShop() {

        $where = "isMechanical = 0";
        $this->db->select('idPartsRequisition');
        $this->db->from('s_partsrequisition');
        $this->db->where($where);
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idParts = $this->db->get();
        if ($idParts->num_rows() > 0) {
            $row = $idParts->row();
            $idParts = $row->idPartsRequisition;
            return $idParts;
        }
    }

    function getSerialNumber() {

        $where = "isMechanical = 0";
        $this->db->select('SerialNumber');
        $this->db->from('s_partsrequisition');
        $this->db->where($where);
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $serialNumber = $this->db->get();
        if ($serialNumber->num_rows() > 0) {
            $row = $serialNumber->row();
            $serialNumber = $row->SerialNumber;
            return $serialNumber;
        }
    }

    function fillPartCombo() {
        $query = $this->db->query('select idPart, PartNumber,PartName from parts_name');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber, "PartName" => $dropdown->PartName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
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
