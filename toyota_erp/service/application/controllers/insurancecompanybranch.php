<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Insurancecompanybranch extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_insurancecompany');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $insuranceCompanyModel = new S_insurancecompany();
        $dataArray['insuranceCompanyList'] = $insuranceCompanyModel->getAllInsuranceCompanies();
        $dataArray['insBranchList'] = $insuranceCompanyModel->getAllInsBranches();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('insurancecompanybranch', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $insuranceCompanyModel = new S_insurancecompany();
        $getfieldsValue = $this->getFieldsValue();
        $insBranchData = array(
            'idInsuranceCompany' => $this->input->post('SelectInsuranceCompany'),
            'BranchName' => $this->input->post('BranchName'),
            'Phone' => $this->input->post('BranchContact'),
            'Email' => $this->input->post('BranchEmail'),
            'Address' => $this->input->post('BranchAddress'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insert = $insuranceCompanyModel->InsertInsBranch($insBranchData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insert . '</h4>');
        redirect(base_url() . "index.php/insurancecompanybranch/index");
    }

    function Update() {

        $insuranceCompanyModel = new S_insurancecompany();
        $getfieldsValue = $this->getFieldsValue();
        $idInsuranceCompanyBranch = $this->input->post('idInsuranceCompanyBranch');
        $insBranchData = array(
            'idInsuranceCompany' => $this->input->post('SelectInsuranceCompany'),
            'BranchName' => $this->input->post('BranchName'),
            'Phone' => $this->input->post('BranchContact'),
            'Email' => $this->input->post('BranchEmail'),
            'Address' => $this->input->post('BranchAddress'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate']
        );
        $update = $insuranceCompanyModel->UpdateInsBranch($idInsuranceCompanyBranch, $insBranchData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $update . '</h4>');
        redirect(base_url() . "index.php/insurancecompanybranch/index");
    }

    function Delete($idInsuranceCompanyBranch) {

        $insuranceCompanyModel = new S_insurancecompany();
        $delete = $insuranceCompanyModel->DeleteInsBranch($idInsuranceCompanyBranch);
        $this->session->set_flashdata('deletemessage', '<h4>' . $delete . '</h4>');
        redirect(base_url() . "index.php/insurancecompanybranch/index");
    }

    function search() {

        $insuranceCompanyModel = new S_insurancecompany();
        $search = $this->input->post('searchBranch');
        $insurancecompanySearch = $insuranceCompanyModel->searchInsBranch($search);
        $data = json_encode($insurancecompanySearch);
        echo $data;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
