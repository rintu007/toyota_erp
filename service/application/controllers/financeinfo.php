<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Financeinfo extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_financeinfo');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $financeInfoModel = new S_financeinfo();
        $dataArray['financeInfoList'] = $financeInfoModel->getFinanceInfo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('financeinfo', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $financeInfoModel = new S_financeinfo();
        $getfieldsValue = $this->getFieldsValue();
        $financeInfoData = array(
            'Name' => $this->input->post('FinanceName'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertFinanceInfo = $financeInfoModel->InsertFinanceInfo($financeInfoData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertFinanceInfo . '</h4>');
        redirect(base_url() . "index.php/financeinfo/index");
    }

    function Update() {

        $financeInfoModel = new S_financeinfo();
        $getfieldsValue = $this->getFieldsValue();
        $idFinanceInfo = $this->input->post('IdFinanceInfo');
        $financeInfoData = array(
            'Name' => $this->input->post('FinanceName'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateFinanceInfo = $financeInfoModel->UpdateFinanceInfo($idFinanceInfo, $financeInfoData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateFinanceInfo . '</h4>');
        redirect(base_url() . "index.php/financeinfo/index");
    }

    function Delete($idFinanceInfo) {

        $financeInfoModel = new S_financeinfo();
        $deleteFinanceInfo = $financeInfoModel->DeleteFinanceInfo($idFinanceInfo);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteFinanceInfo . '</h4>');
        redirect(base_url() . "index.php/financeinfo/index");
    }

    function search() {

        $financeInfoModel = new S_financeinfo();
        $search = $this->input->post('searchfinanceinfo');
        $financeInfoSearch = $financeInfoModel->searchFinanceInfo($search);
        $financeInfo = json_encode($financeInfoSearch);
        echo $financeInfo;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
