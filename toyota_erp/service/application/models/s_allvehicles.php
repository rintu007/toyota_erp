<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_allvehicles extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertAllVehicles($allVehiclesData) {

        $this->db->insert('s_allvehicles', $allVehiclesData);
        return "Successfully Inserted";
    }

    function UpdateAllVehicles($idAllVehicles, $allVehiclesData) {

        $this->db->where('idAllVehicles', $idAllVehicles);
        $this->db->update('s_allvehicles', $allVehiclesData);
        return "Successfully Updated";
    }

    function DeleteAllVehicles($idAllVehicles) {

        $this->db->set('isActive', 0);
        $this->db->where('idAllVehicles', $idAllVehicles);
        $this->db->update('s_allvehicles');
        return "Successfully Deleted";
    }

    function getIdAllVehicles($Variant) {

        $this->db->select('idAllVehicles');
        $this->db->from('s_allvehicles');
        $this->db->where('Variant', $Variant);
        $this->db->where('isActive', 1);
        $idAllVehicles = $this->db->get();
        if ($idAllVehicles->num_rows() > 0) {
            $row = $idAllVehicles->row();
            $idAllVehicles = $row->idAllVehicles;
            return $idAllVehicles;
        }
    }

    function getAllVariants() {

        $this->db->select('*');
        $this->db->from('s_allvehicles');
        $this->db->where('isActive', 1);
        $allVariantList = $this->db->get();
        return $allVariantList->result_array();
    }

    function getAllVehicles() {

        $this->db->select('*');
        $this->db->from('s_allvehicles');
        $this->db->join('s_allmodels am', 'am.idAllModels = s_allvehicles.idAllModels');
        $this->db->join('s_allbrands ab', 'ab.idAllBrands = s_allvehicles.idAllBrands');
        $this->db->where('s_allvehicles.isActive != 0');
        $allVariantList = $this->db->get();
        return $allVariantList->result_array();
    }

    function getFilteredVehicles($searchModel) {

        $this->db->select('*');
        $this->db->from('s_allvehicles');
        $this->db->join('s_allmodels am', 'am.idAllModels= s_allvehicles.idAllModels');
        $this->db->join('s_allbrands ab', 'ab.idAllBrands = s_allvehicles.idAllBrands');
        $this->db->where('am.idAllModels', $searchModel);
        $this->db->where('s_allvehicles.isActive', 1);
        $filteredVehicles = $this->db->get();
        return $filteredVehicles->result_array();
    }

    function searchAllVehicles($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_allvehicles');
        $this->db->join('s_allmodels am', 'am.idAllModels = s_allvehicles.idAllModels');
        $this->db->join('s_allbrands ab', 'ab.idAllBrands = s_allvehicles.idAllBrands');
        $this->db->like('s_allvehicles.Variant', $SearchKeyword);
        $this->db->where('s_allvehicles.isActive != 0');
        $searchAllVehicles = $this->db->get();
        return $searchAllVehicles->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
