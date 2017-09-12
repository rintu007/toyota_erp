<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_role extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allRole() {
        $carColor = $this->db->select('*')->from('car_app_role')->get();
        return $carColor->result_array();
    }

    function insertRole($roleData) {
        $this->db->insert('car_app_role', $roleData);
        $this->db->insert_id();
    }

    function updateRole($roleID, $roleData) {
        $this->db->where('RoleId', $roleID);
        $this->db->set('RoleName', $roleData);
        $this->db->update('car_app_role');
    }

    function deleteRole($roleID) {
        $this->db->where('RoleId', $roleID);
        $this->db->delete('car_app_role');
    }

}
