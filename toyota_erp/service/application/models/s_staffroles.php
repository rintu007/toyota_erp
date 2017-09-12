<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_staffroles extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertStaffRoles($staffRolesData) {

        $this->db->insert('s_staffroles', $staffRolesData);
        return "Successfully Inserted";
    }

    function UpdateStaffRoles($idStaffRoles, $staffRolesData) {

        $this->db->where('idStaffRoles', $idStaffRoles);
        $this->db->update('s_staffroles', $staffRolesData);
        return "Successfully Updated";
    }

    function DeleteStaffRoles($idStaffRoles) {

        $this->db->set('isActive', 0);
        $this->db->where('idStaffRoles', $idStaffRoles);
        $this->db->update('s_staffroles');
        return "Successfully Deleted";
    }

    function searchStaffRoles($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_staffroles');
        $this->db->like('s_staffroles.RoleName', $SearchKeyword);
        $this->db->where('s_staffroles.isActive != 0');
        $searchStaffRoles= $this->db->get();
        return $searchStaffRoles->result_array();
    }

    function getAllStaffRoles() {

        $this->db->select('*');
        $this->db->from('s_staffroles');
        $this->db->where('s_staffroles.isActive != 0');
        $staffRolesList = $this->db->get();
        return $staffRolesList->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
