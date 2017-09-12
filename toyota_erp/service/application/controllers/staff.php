<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Staff extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_staff');
        $this->load->model('s_staffroles');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $staffModel = new S_staff();
        $staffRolesModel = new S_staffroles();
        $dataArray['staffRolesList'] = $staffRolesModel->getAllStaffRoles();
        $dataArray['staffsList'] = $staffModel->getAllStaff();
		$dataArray['StaffDescList'] = $staffModel->getAllStaffDesc();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('Staff', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $staffModel = new S_staff();
        $getfieldsValue = $this->getFieldsValue();
        $staffData = array(
            'Name' => $this->input->post('StaffName'),
            'idStaffRoles' => $this->input->post('SelectStaffRole'),
            'Rating' => $this->input->post('StaffRating'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive'],
			'salary' => $this->input->post('Salary'),
			'idStaffDesc' => $this->input->post('SelectStaffDesc')
        );
        $insertStaff = $staffModel->InsertStaff($staffData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertStaff . '</h4>');
        redirect(base_url() . "index.php/staff/index");
    }

    function Update() {
        $staffModel = new S_staff();
        $getfieldsValue = $this->getFieldsValue();
		$idStaff = $this->input->post('IdStaff');
		/*$getRecord = $this->getStaffById($idstaff);*/
        $staffData = array(
            'Name' => $this->input->post('StaffName'),
            'idStaffRoles' => $this->input->post('SelectStaffRole'),
            'Rating' => $this->input->post('StaffRating'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
			'salary' => $this->input->post('Salary'),
			'idStaffDesc' => $this->input->post('SelectStaffDesc')
        );
        $updateStaff = $staffModel->UpdateStaff($idStaff, $staffData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateStaff . '</h4>');
        redirect(base_url() . "index.php/staff/index");
    }
	function testdata($idstaff){
		
		$staffModel = new s_staff();
		$dataArray['staffListById'] = $staffModel->getStaffById($idstaff);
		//$data = $dataArray['staffListById'];
		print_r($dataArray['staffListById']);
		die();
	}

    function Delete($idStaff) {

        $staffModel = new S_staff();
        $deleteStaff = $staffModel->DeleteStaff($idStaff);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteStaff . '</h4>');
        redirect(base_url() . "index.php/staff/index");
    }

    function search() {

        $financeInfoModel = new S_staff();
        $search = $this->input->post('searchstaffname');
        $staffNameSearch = $financeInfoModel->searchStaff($search);
        $staffName = json_encode($staffNameSearch);
        echo $staffName;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
