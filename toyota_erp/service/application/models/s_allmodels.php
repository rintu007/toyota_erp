<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_allmodels extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertAllModels($allVehiclesData) {

        $this->db->insert('s_allmodels', $allVehiclesData);
        return "Successfully Inserted";
    }

    function UpdateAllModels($idAllModels, $allVehiclesData) {

        $this->db->where('idAllModels', $idAllModels);
        $this->db->update('s_allmodels', $allVehiclesData);
        return "Successfully Updated";
    }

    function DeleteAllModels($idAllModels) {

        $this->db->set('isActive', 0);
        $this->db->where('idAllModels', $idAllModels);
        $this->db->update('s_allmodels');
        return "Successfully Deleted";
    }

    function getAllModels() {

        $this->db->select('*');
        $this->db->from('s_allmodels');
        $this->db->join('s_allbrands ab', 'ab.idAllBrands = s_allmodels.idAllBrands');
        $this->db->where('s_allmodels.isActive != 0');
        $allModelsList = $this->db->get();
        return $allModelsList->result_array();
    }

    function getFilteredModels($idAllBrands) {

        $this->db->select('*');
        $this->db->from('s_allmodels');
        $this->db->join('s_allbrands ab', 'ab.idAllBrands = s_allmodels.idAllBrands');
        $this->db->where('ab.idAllBrands', $idAllBrands);
        $this->db->where('s_allmodels.isActive != 0');
        $model = $this->db->get();
        return $model->result_array();
    }

    function searchAllModels($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_allmodels');
        $this->db->join('s_allbrands ab', 'ab.idAllBrands = s_allmodels.idAllBrands');
        $this->db->like('s_allmodels.ModelName', $SearchKeyword);
        $this->db->where('s_allmodels.isActive != 0');
        $searchAllModels = $this->db->get();
        return $searchAllModels->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
