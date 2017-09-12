<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Staffroles extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_staffroles');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $staffRolesModel = new S_staffroles();
        $dataArray['staffRolesList'] = $staffRolesModel->getAllStaffRoles();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('staffroles', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $staffRolesModel = new S_staffroles();
        $getfieldsValue = $this->getFieldsValue();
        $staffrolesData = array(
            'RoleName' => $this->input->post('RoleName'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertStaffRoles = $staffRolesModel->InsertStaffRoles($staffrolesData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertStaffRoles . '</h4>');
        redirect(base_url() . "index.php/staffroles/index");
    }

    function Update() {

        $staffRolesModel = new S_staffroles();
        $getfieldsValue = $this->getFieldsValue();
        $idStaff = $this->input->post('IdStaffRole');
        $StaffRolesData = array(
            'RoleName' => $this->input->post('RoleName'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateStaffRoles = $staffRolesModel->UpdateStaffRoles($idStaff, $StaffRolesData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateStaffRoles . '</h4>');
        redirect(base_url() . "index.php/staffroles/index");
    }

    function Delete($idStaffRoles) {

        $staffRolesModel = new S_staffroles();
        $deleteStaffRoles = $staffRolesModel->DeleteStaffRoles($idStaffRoles);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteStaffRoles . '</h4>');
        redirect(base_url() . "index.php/staffroles/index");
    }

    function search() {

        $staffRolesModel = new S_staffroles();
        $search = $this->input->post('searchstaffroles');
        $staffRolesSearch = $staffRolesModel->searchStaffRoles($search);
        $staffRole = json_encode($staffRolesSearch);
        echo $staffRole;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
