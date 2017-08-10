<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Voucher extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('f_voucher');
        $this->load->model('f_vendor');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $voucherModel = new F_voucher();
        $vendorModel = new F_vendor();
        $dataArray['vendorsList'] = $vendorModel->getAllVendors();
        $dataArray['voucherNumber'] = $voucherModel->getVoucherNumber();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('header');
        $this->load->view('voucher', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $voucherModel = new F_voucher();
        $voucherData = array(
            'idVendor' => $this->input->post('idVendor'),
            'VoucherNo' => $this->input->post('VoucherNumber'),
            'Amount' => $this->input->post('Amount'),
            'GST' => $this->input->post('GST'),
            'Discount' => $this->input->post('Discount'),
            'NetTotal' => $this->input->post('NetTotal'),
            'Reference' => $this->input->post('RefNo'),
            'Description' => $this->input->post('Description'),
            'RegistrationNo' => $this->input->post('RegistrationNo'),
            'ChassisNo' => $this->input->post('ChassisNo'),
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $insertVoucher = $voucherModel->InsertVoucher($voucherData);
        if ($insertVoucher) {
            $this->Payable($this->input->post('idVendor'), $this->input->post('NetTotal'));
        }
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertVoucher . '</h4>');
        redirect(base_url() . "index.php/voucher/index");
    }

    function Payable($idVendor, $netTotal) {

        $voucherModel = new F_voucher();
        $isExistPayable = $voucherModel->isExistPayable($idVendor);
        if ($isExistPayable != NULL) {
            $payableAmount = $isExistPayable[0]['PayableAmount'] + $netTotal;
            $payableData = array(
                'PayableAmount' => $payableAmount,
                'PayableDate' => $this->getFieldsValue()['PayableDate'],
                'PayableTime' => $this->getFieldsValue()['PayableTime'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            );
            $updatePayable = $voucherModel->updatePayable($isExistPayable[0]['idPayable'], $payableData);
            if ($updatePayable === "Payable Updated Successfully") {
                return True;
            }
        } else {
            $payableData = array(
                'idParty' => $idVendor,
                'PayableAmount' => $netTotal,
                'FromDepartment' => 'General',
                'PayableDate' => $this->getFieldsValue()['PayableDate'],
                'PayableTime' => $this->getFieldsValue()['PayableTime'],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $createPayable = $voucherModel->createPayable($payableData);
            if ($createPayable === "Payable Created Successfully") {
                return True;
            }
        }
    }

    function Update() {
        
    }

    function Delete() {
        
    }

    function search() {
        
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "PayableDate" => date("Y-m-d"), "PayableTime" => date("H:i:s"));
        return $fieldsValue;
    }

}
