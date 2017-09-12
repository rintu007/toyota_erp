<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rochecklist extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_rochecklist');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $checkListModel = new S_Rochecklist();
        $dataArray['checkList'] = $checkListModel->getAllRoCheckList();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('rochecklist', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $checkListModel = new S_Rochecklist();
        $getfieldsValue = $this->getFieldsValue();
        $checkListData = array(
            'Name' => $this->input->post('Name'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertCheckList = $checkListModel->InsertRoCheckList($checkListData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertCheckList . '</h4>');
        redirect(base_url() . "index.php/Rochecklist/index");
    }

    function Update() {

        $checkListModel = new S_Rochecklist();
        $getfieldsValue = $this->getFieldsValue();
        $idCheckList = $this->input->post('IdCheckList');
        $checkListData = array(
            'Name' => $this->input->post('CheckListName'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateCheckList = $checkListModel->UpdateRoCheckList($idCheckList, $checkListData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateCheckList . '</h4>');
        redirect(base_url() . "index.php/Rochecklist/index");
    }

    function Delete($idCheckList) {

        $checkListModel = new S_Rochecklist();
        $deleteCheckList = $checkListModel->DeleteRoCheckList($idCheckList);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteCheckList . '</h4>');
        redirect(base_url() . "index.php/Rochecklist/index");
    }

    function search() {

        $checkListModel = new S_Rochecklist();
        $search = $this->input->post('searchchecklist');
        $checkListSearch = $checkListModel->searchRoCheckList($search);
        $checkListName = json_encode($checkListSearch);
        print_r($checkListName);
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
