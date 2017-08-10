<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_fuelmanagement extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertFuelInfo($fuelData) {

        $this->db->insert('s_fuel', $fuelData);
        return "Successfully Inserted";
    }

    function UpdateFuelInfo($idFuel, $fuelData) {

        $this->db->where('idFuel', $idFuel);
        $this->db->update('s_fuel', $fuelData);
        return "Successfully Updated";
    }

    function DeleteFuelInfo($idFuel) {

        $this->db->set('isActive', 0);
        $this->db->where('idFuel', $idFuel);
        $this->db->update('s_fuel');
        return "Successfully Deleted";
    }

    function searchFuelInfo($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_fuel');
        $this->db->like('s_fuel.FuelVolume', $SearchKeyword);
        $this->db->where('s_fuel.isActive != 0');
        $searchFinance = $this->db->get();
        return $searchFinance->result_array();
    }

    function getFuelInfo() {

        $this->db->select('*');
        $this->db->from('s_fuel');
        $this->db->where('s_fuel.isActive != 0');
        $financeInfoList = $this->db->get();
        return $financeInfoList->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
