<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Qualitycheck extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_qualitycheck');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $qualityCheckModel = new S_qualitycheck();
        $dataArray['qualityCheckList'] = $qualityCheckModel->getQualityCheckInfo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('qualitycheck', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $qualityCheckModel = new S_qualitycheck();
        $getfieldsValue = $this->getFieldsValue();
        $qualityCheckData = array(
            'Name' => $this->input->post('Name'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertQualityCheck = $qualityCheckModel->InsertQualityCheck($qualityCheckData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertQualityCheck . '</h4>');
        redirect(base_url() . "index.php/qualitycheck/index");
    }

    function Update() {

        $qualityCheckModel = new S_qualitycheck();
        $getfieldsValue = $this->getFieldsValue();
        $idQualityCheck = $this->input->post('IdQualityCheck');
        $qualityCheckData = array(
            'Name' => $this->input->post('Name'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateQualityCheck = $qualityCheckModel->UpdateQualityCheck($idQualityCheck, $qualityCheckData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateQualityCheck . '</h4>');
        redirect(base_url() . "index.php/qualitycheck/index");
    }

    function Delete($idQualityCheck) {

        $qualityCheckModel = new S_qualitycheck();
        $deleteQualityCheck = $qualityCheckModel->DeleteQualityCheck($idQualityCheck);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteQualityCheck . '</h4>');
        redirect(base_url() . "index.php/qualitycheck/index");
    }

    function search() {

        $qualityCheckModel = new S_qualitycheck();
        $search = $this->input->post('searchqualitycheck');
        $qualityCheckSearch = $qualityCheckModel->searchQualityCheck($search);
        $qualityCheck = json_encode($qualityCheckSearch);
        echo $qualityCheck;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
