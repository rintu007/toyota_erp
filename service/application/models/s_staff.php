<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_staff extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertStaff($staffData) {

        $this->db->insert('s_staff', $staffData);
        return "Successfully Inserted";
    }

    function UpdateStaff($idStaff, $staffData) {

        $this->db->where('idStaff', $idStaff);
        $this->db->update('s_staff', $staffData);
        return "Successfully Updated";
    }

    function DeleteStaff($idStaff) {

        $this->db->set('isActive', 0);
        $this->db->where('idStaff', $idStaff);
        $this->db->update('s_staff');
        return "Successfully Deleted";
    }

    function searchStaff($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_staff');
        $this->db->join('s_staffroles', 's_staffroles.idStaffRoles = s_staff.idStaffRoles');
		$this->db->join('s_staff_desc', 's_staff_desc.idStaffDesc = s_staff.idStaffDesc');
        $this->db->like('s_staff.Name', $SearchKeyword);
        $this->db->where('s_staff.isActive != 0');
        $searchStaffName = $this->db->get();
        return $searchStaffName->result_array();
    }

    function AllStaff() {
        $this->db->select('*');
        $this->db->from('s_staff');
        $this->db->where('isActive', 1);
        $BaysList = $this->db->get();
        $colorCombo = $BaysList->result();
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            array_push($dropDownList, ["idStaff" => $dropdown->idStaff, "Name" => $dropdown->Name]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }
	function getAllStaffDesc(){
		$query = $this->db->query('select * from s_staff_desc');
		$queryResult = $query->result();
		$queryResultList = array();
		foreach ($queryResult as $key)
		{
			array_push($queryResultList, ["idStaffDesc" => $key->idStaffDesc, "StaffDesc"=> $key->StaffDesc]);
		}
		$StaffDescList = $queryResultList;
		return $StaffDescList;
	}
    function getAllStaff() {

        $this->db->select('*');
        $this->db->from('s_staff');
        $this->db->join('s_staffroles', 's_staffroles.idStaffRoles = s_staff.idStaffRoles');
		$this->db->join('s_staff_desc', 's_staff_desc.idStaffDesc = s_staff.idStaffDesc');
        $this->db->where('s_staff.isActive != 0');
        $staffList = $this->db->get();
        return $staffList->result_array();
    }
	function getStaffById($idstaff){
		$this->db->select('*');
		$this->db->from('s_staff');
		$this->db->join('s_staffroles', 's_staffroles.idStaffRoles = s_staff.idStaffRoles');
		$this->db->join('s_staff_desc', 's_staff_desc.idStaffDesc = s_staff.idStaffDesc');
		$this->db->where('S_staff.idStaff =' . $idstaff);
		$staffListById = $this->db->get();
		return $staffListById->result_array();
	}
    function getTechnicianStaff() {

        $this->db->select('*');
        $this->db->from('s_staff');
        $this->db->join('s_staffroles', 's_staffroles.idStaffRoles = s_staff.idStaffRoles');
		$this->db->join('s_staff_desc', 's_staff_desc.idStaffDesc = s_staff.idStaffDesc');
        $this->db->where('s_staffroles.RoleName = "Technician"');
        $this->db->where('s_staff.isActive != 0');
        $technicianList = $this->db->get();
        return $technicianList->result_array();
    }

    function getServiceAdvisor() {

        $this->db->select('*');
        $this->db->from('s_staff');
        $this->db->join('s_staffroles', 's_staffroles.idStaffRoles = s_staff.idStaffRoles');
		$this->db->join('s_staff_desc', 's_staff_desc.idStaffDesc = s_staff.idStaffDesc');
        $this->db->like('s_staffroles.RoleName', 'Service Advisor');
        $this->db->or_like('s_staffroles.RoleName', 'Manager Service');
        $this->db->or_like('s_staffroles.RoleName', 'A.M Service');
        $this->db->or_like('s_staffroles.RoleName', 'Deputy Manager');
        $this->db->where('s_staff.isActive', '1');
        $technicianList = $this->db->get();
        return $technicianList->result_array();
    }

    function getForemanStaff() {
        $this->db->select('*');
        $this->db->from('s_staff');
        $this->db->join('s_staffroles', 's_staffroles.idStaffRoles = s_staff.idStaffRoles');
		$this->db->join('s_staff_desc', 's_staff_desc.idStaffDesc = s_staff.idStaffDesc');
        $this->db->where('s_staffroles.RoleName = "Foreman"');
        $this->db->where('s_staff.isActive != 0');
        $foremanList = $this->db->get();
        return $foremanList->result_array();
    }

    function getDenterStaff() {
        $this->db->select('*');
        $this->db->from('s_staff');
        $this->db->join('s_staffroles', 's_staffroles.idStaffRoles = s_staff.idStaffRoles');
		$this->db->join('s_staff_desc', 's_staff_desc.idStaffDesc = s_staff.idStaffDesc');
        $this->db->where('s_staffroles.RoleName = "Denter"');
        $this->db->where('s_staff.isActive != 0');
        $denterList = $this->db->get();
        return $denterList->result_array();
    }

    function getPainterStaff() {
        $this->db->select('*');
        $this->db->from('s_staff');
        $this->db->join('s_staffroles', 's_staffroles.idStaffRoles = s_staff.idStaffRoles');
		$this->db->join('s_staff_desc', 's_staff_desc.idStaffDesc = s_staff.idStaffDesc');
        $this->db->where('s_staffroles.RoleName = "Painter"');
        $this->db->where('s_staff.isActive != 0');
        $painterList = $this->db->get();
        return $painterList->result_array();
    }

    function getRoName($idromode){
        $this->db->select('s_romode.ModeName');
        $this->db->from('s_romode');
        $this->db->where('s_romode.isActive != 0');
        $this->db->where('s_romode.idROMode' , $idromode);
        $financeInfoList = $this->db->get();
        return $financeInfoList->result_array();        
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
