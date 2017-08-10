<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_user extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allUser() {
        $carUser = $this->db->select('*')->from('car_user_profile')->
                        join('car_user_department', 'car_user_profile.DepartmentId = car_user_department.IdDepartment')->
                        join('car_app_role', 'car_user_profile.RoleId = car_app_role.RoleId')->
                        join('car_sub_dealer', 'car_user_profile.DealerShip = car_sub_dealer.IdSubDealer')
                        ->where('IsDeleted', 0)->get();
        return $carUser->result_array();
    }

    function insertUser($userData) {
        $this->db->insert('car_user_profile', $userData);
        $this->db->insert_id();
    }

    function updateUser($userID, $userData) {
        $this->db->where('Id', $userID);
        $this->db->update('car_user_profile', $userData);
    }

    function deleteUser($userID) {
        $this->db->where('Id', $userID);
//        $this->db->delete('car_user_profile');
        $this->db->set('IsDeleted', 1);
        $this->db->update('car_user_profile');
    }

    function fillDealerShip() {
        $query = $this->db->query('select distinct IdSubDealer, Name from car_sub_dealer');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdSubDealer, "DealerShipName" => $dropdown->Name]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillUserDepartment() {
        $query = $this->db->query('select distinct IdDepartment, Department from car_user_department');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdDepartment, "Department" => $dropdown->Department]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillUserRole() {
        $query = $this->db->query('select distinct RoleId, RoleName from car_app_role');
        $dropdowns = $query->result();
//        foreach ($dropdowns as $dropdown) {
//            $dropDownList[$dropdown->RoleId] = $dropdown->RoleName;
//        }
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->RoleId, "RoleName" => $dropdown->RoleName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function oneUser($keyword) {
        $OneUser = $this->db->select('*')->from('car_user_profile')->
                        join('car_user_department', 'car_user_profile.DepartmentId = car_user_department.IdDepartment')->
                        join('car_app_role', 'car_user_profile.RoleId = car_app_role.RoleId')->
                        join('car_sub_dealer', 'car_user_profile.DealerShip = car_sub_dealer.IdSubDealer')->
                        like('car_user_profile.FullName', $keyword)->where('IsDeleted', 0)->get();
        if ($OneUser->num_rows() > 0) {
            return $OneUser->result_array();
        }
//        return $OneUser->result();
    }

}
