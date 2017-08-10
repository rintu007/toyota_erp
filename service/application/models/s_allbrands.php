<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_allbrands extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertAllBrands($allBrandsData) {

        $this->db->insert('s_allbrands', $allBrandsData);
        return "Successfully Inserted";
    }

    function UpdateAllBrands($idAllBrands, $allBrandsData) {

        $this->db->where('idAllBrands', $idAllBrands);
        $this->db->update('s_allbrands', $allBrandsData);
        return "Successfully Updated";
    }

    function DeleteAllBrands($idAllBrands) {

        $this->db->set('isActive', 0);
        $this->db->where('idAllBrands', $idAllBrands);
        $this->db->update('s_allbrands');
        return "Successfully Deleted";
    }

    function getAllBrands() {

        $this->db->select('*');
        $this->db->from('s_allbrands');
        $this->db->where('s_allbrands.isActive != 0');
        $baysList = $this->db->get();
        return $baysList->result_array();
    }

    function searchAllBrands($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_allbrands');
        $this->db->like('s_allbrands.BrandName', $SearchKeyword);
        $this->db->where('s_allbrands.isActive != 0');
        $searchAllBrands = $this->db->get();
        return $searchAllBrands->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
