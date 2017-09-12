<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_department extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allDepartment($perpage = '', $limit = '') {
       // $carColor = $this->db->select('*')->from('car_user_department')->get();
        //return $carColor->result_array();
		$this->db->select('*');
		$this->db->limit($perpage, $limit);
		$Department = $this->db->get('car_user_department')->result_array();
        return $Department;
    }
////////
///////////
 public function record_count() {
        
            $this->db->select('*');
         //$this->db->where('IsLost', 0);
            $query = $this->db->get("car_user_department");
            return $query->num_rows();
       // print_r($return);
    }
    function insertDepartment($departmentData) {
        $this->db->insert('car_user_department', $departmentData);
        $this->db->insert_id();
    }

    function updateDepartment($departmentID, $departmentData) {
        $this->db->where('Id', $departmentID);
        $this->db->set('Department', $departmentData);
        $this->db->update('car_user_department');
    }

    function deleteDepartment($departmentID) {
        $this->db->where('Id', $departmentID);
        $this->db->delete('car_user_department');
    }

}
