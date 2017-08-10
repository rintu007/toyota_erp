<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vendor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('f_vendor');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $vendorModel = new F_vendor();
        $dataArray['vendorsList'] = $vendorModel->getAllVendors();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('vendor', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $vendorModel = new F_vendor();
        $vendorData = array(
            'VendorName' => $this->input->post('VendorName'),
            'VendorPhone' => $this->input->post('VendorContact'),
            'VendorMobile' => $this->input->post('VendorMobile'),
            'VendorCNIC' => $this->input->post('VendorNIC'),
            'CompanyName' => $this->input->post('CompanyName'),
            'CompanyContact' => $this->input->post('CompanyContact'),
            'CompanyAddress' => $this->input->post('CompanyAddress'),
            'CompanyFax' => $this->input->post('CompanyFax'),
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $insertVendor = $vendorModel->InsertVendor($vendorData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertVendor . '</h4>');
        redirect(base_url() . "index.php/vendor/index");
    }

    function Update() {

        $vendorsModel = new F_vendor();
        $idVendor = $this->input->post('uidVendor');
        $vendorData = array(
            'VendorName' => $this->input->post('uVendorName'),
            'VendorPhone' => $this->input->post('uVendorContact'),
            'VendorMobile' => $this->input->post('uVendorMobile'),
            'CompanyName' => $this->input->post('uCompanyName'),
            'CompanyContact' => $this->input->post('uCompanyContact'),
            'CompanyAddress' => $this->input->post('uCompanyAddress'),
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
        );
        $updateVendor = $vendorsModel->UpdateVendor($idVendor, $vendorData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateVendor . '</h4>');
        redirect(base_url() . "index.php/vendor/index");
    }

    function Delete($idVendor) {

        $vendorsModel = new F_vendor();
        $deleteVendor = $vendorsModel->DeleteVendor($idVendor);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteVendor . '</h4>');
        redirect(base_url() . "index.php/vendor/index");
    }

    function search() {

        $vendorsModel = new F_vendor();
        $search = $this->input->post('searchVendor');
        $vendorSearch = $vendorsModel->searchVendor($search);
        $vendorName = json_encode($vendorSearch);
        echo $vendorName;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
