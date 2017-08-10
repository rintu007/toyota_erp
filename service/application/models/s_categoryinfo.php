<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_categoryinfo extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertCategoryInfo($categoryData) {

        $this->db->insert('s_category', $categoryData);
        return "Successfully Inserted";
    }

    function UpdateCategoryInfo($idCategory, $categoryData) {

        $this->db->where('idCategory', $idCategory);
        $this->db->update('s_category', $categoryData);
        return "Successfully Updated";
    }

    function DeleteCategoryInfo($idCategory) {

        $this->db->set('isActive', 0);
        $this->db->where('idCategory', $idCategory);
        $this->db->update('s_category');
        return "Successfully Deleted";
    }

    function searchCategoryInfo($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_category');
        $this->db->like('s_category.Name', $SearchKeyword);
        $this->db->where('s_category.isActive != 0');
        $searchCategory = $this->db->get();
        return $searchCategory->result_array();
    }

    function getCategoryInfo() {

        $this->db->select('*');
        $this->db->from('s_category');
        $this->db->where('s_category.isActive != 0');
        $categoryInfoList = $this->db->get();
        return $categoryInfoList->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
