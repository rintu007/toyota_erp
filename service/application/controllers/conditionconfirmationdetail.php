<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Conditionconfirmationdetail extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_conditionconfirmationdetail');
        $this->load->model('s_conditionconfirmation');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $conditionDetailModel = new S_conditionconfirmationdetail();
        $conditionModel = new S_conditionconfirmation();
        $dataArray['conditionList'] = $conditionModel->getCondition();
        $dataArray['conditionDetailList'] = $conditionDetailModel->getAllConditionDetails();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('conditionconfirmationdetail', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $conditionDetailModel = new S_conditionconfirmationdetail();
        $getfieldsValue = $this->getFieldsValue();
        $conditionDetailData = array(
            'idConditionConfirmation' => $this->input->post('SelectCondition'),
            'Name' => $this->input->post('ConditionDetail'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertConditionDetail = $conditionDetailModel->InsertConditionDetails($conditionDetailData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertConditionDetail . '</h4>');
        redirect(base_url() . "index.php/conditionconfirmationdetail/index");
    }

    function Update() {

        $conditionDetailModel = new S_conditionconfirmationdetail();
        $getfieldsValue = $this->getFieldsValue();
        $idConditionDetail = $this->input->post('IdConditionDetail');
        $conditionDetailData = array(
            'Name' => $this->input->post('ConditionDetail'),
            'idConditionConfirmation' => $this->input->post('IdCondition'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateConditionDetail = $conditionDetailModel->UpdateConditionDetails($idConditionDetail, $conditionDetailData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateConditionDetail . '</h4>');
        redirect(base_url() . "index.php/conditionconfirmationdetail/index");
    }

    function Delete($idConditionDetail) {

        $conditionDetailModel = new S_conditionconfirmationdetail();
        $deleteConditionDetail = $conditionDetailModel->DeleteConditionDetails($idConditionDetail);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteConditionDetail . '</h4>');
        redirect(base_url() . "index.php/conditionconfirmationdetail/index");
    }

    function search() {

        $conditionDetailModel = new S_conditionconfirmationdetail();
        $search = $this->input->post('searchconditiondetail');
        $conditionDetailSearch = $conditionDetailModel->searchConditionDetails($search);
        $conditionDetail = json_encode($conditionDetailSearch);
        echo $conditionDetail;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
