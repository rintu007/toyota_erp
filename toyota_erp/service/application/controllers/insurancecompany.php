<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Insurancecompany extends CI_Controller {

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
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('insurancecompany', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $insuranceCompanyModel = new S_insurancecompany();
        $getfieldsValue = $this->getFieldsValue();
        $insuranceCompanyData = array(
            'Name' => $this->input->post('InsuranceCompanyName'),
            'CompanyCode' => $this->input->post('InsuranceCompanyCode'),
            'Remarks' => $this->input->post('InsuranceCompanyRemarks'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insert = $insuranceCompanyModel->InsertInsuranceCompany($insuranceCompanyData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insert . '</h4>');
        redirect(base_url() . "index.php/insurancecompany/index");
    }

    function Update() {

        $insuranceCompanyModel = new S_insurancecompany();
        $getfieldsValue = $this->getFieldsValue();
        $idInsuranceCompany = $this->input->post('idInsuranceCompany');
        $insuranceCompanyData = array(
            'Name' => $this->input->post('InsuranceCompanyName'),
            'CompanyCode' => $this->input->post('InsuranceCompanyCode'),
            'Remarks' => $this->input->post('InsuranceCompanyRemarks'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $update = $insuranceCompanyModel->UpdateInsuranceCompany($idInsuranceCompany, $insuranceCompanyData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $update . '</h4>');
        redirect(base_url() . "index.php/insurancecompany/index");
    }

    function Delete($idInsuranceCompany) {

        $insuranceCompanyModel = new S_insurancecompany();
        $delete = $insuranceCompanyModel->DeleteInsuranceCompany($idInsuranceCompany);
        $this->session->set_flashdata('deletemessage', '<h4>' . $delete . '</h4>');
        redirect(base_url() . "index.php/insurancecompany/index");
    }

    function search() {

        $insuranceCompanyModel = new S_insurancecompany();
        $search = $this->input->post('searchinsurancecompany');
        $insurancecompanySearch = $insuranceCompanyModel->searchInsuranceCompany($search);
        $insurancecompanyName = json_encode($insurancecompanySearch);
        echo $insurancecompanyName;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
