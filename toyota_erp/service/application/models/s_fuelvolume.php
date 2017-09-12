<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_fuelvolume extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function AllFuelVolume() {

        $this->db->select('*');
        $this->db->from('s_gas');
        $this->db->where('isActive', 1);
        $FuelVolumeList = $this->db->get();
        $colorCombo = $FuelVolumeList->result();
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            array_push($dropDownList, ["key" => $dropdown->idGas, "label" => $dropdown->Question]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function InsertFuelVolume($fuelVolumeData) {

        $this->db->insert('s_gas', $fuelVolumeData);
        return "Successfully Inserted";
    }

    function UpdateFuelVolume($idGas, $fuelVolumeData) {

        $this->db->where('idGas', $idGas);
        $this->db->update('s_gas', $fuelVolumeData);
        return "Successfully Updated";
    }

    function DeleteFuelVolume($idGas) {

        $this->db->set('isActive', 0);
        $this->db->where('idGas', $idGas);
        $this->db->update('s_gas');
        return "Successfully Deleted";
    }

    function getAllFuelVolume() {

        $this->db->select('*');
        $this->db->from('s_gas');
        $this->db->where('s_gas.isActive != 0');
        $firQuestionsList = $this->db->get();
        return $firQuestionsList->result_array();
    }

    function isExist($data) {
        $this->db->select('*');
        $this->db->from('s_gas');
        $this->db->like('s_gas.GasVolume', $data['GasVolume']);
        $this->db->where('s_gas.isActive != 0');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            $result = $row->GasVolume;
            return $result;
        }
    }

    function searchFuelVolume($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_gas');
        $this->db->like('s_gas.GasVolume', $SearchKeyword);
        $this->db->where('s_gas.isActive != 0');
        $searchFuelVolume = $this->db->get();
        return $searchFuelVolume->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}