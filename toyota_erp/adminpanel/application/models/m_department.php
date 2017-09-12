<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_department extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allDepartment() {
        $carColor = $this->db->select('*')->from('car_user_department')->get();
        return $carColor->result_array();
    }

    function insertDepartment($departmentData) {
        $this->db->insert('car_user_department', $departmentData);
        $this->db->insert_id();
    }

    function updateDepartment($departmentID, $departmentData) {
        $this->db->where('IdDepartment', $departmentID);
        $this->db->set('Department', $departmentData);
        $this->db->update('car_user_department');
    }

    function deleteDepartment($departmentID) {
        $this->db->where('Id', $departmentID);
        $this->db->delete('car_user_department');
    }

}