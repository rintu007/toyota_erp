<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_category extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allCategory() {
        $this->db->select('*');
        $this->db->from('Parts_category');
        $PartCategory = $this->db->get();
        return $PartCategory->result_array();
    }

    function oneCategory($idCategory) {
        $PartCategory = $this->db->select('*')->from('parts_category')->where('idCategory', $idCategory)->get();
        return $PartCategory->result_array();
    }

    function insertCategory($CategoryData) {
        $InsertCategory = $this->db->insert('parts_category', $CategoryData);
        if ($InsertCategory) {
            return "Successfully Inserted";
        } else {
            return "Failed";
        }
        $this->db->insert_id();
    }

    function updateCategory($idCategory, $CategoryData) {
        $this->db->where('idCategory', $idCategory);
        $this->db->update('parts_category', $CategoryData);
    }

    function deleteCategory($idCategory) {
        $this->db->where('idCategory', $idCategory);
        $this->db->delete('parts_category');
    }

    function searchCategory($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('parts_category');
        $this->db->like('parts_category.CategoryName', $SearchKeyword);
        $SearchCategory = $this->db->get();
        return $SearchCategory->result_array();
    }

}
