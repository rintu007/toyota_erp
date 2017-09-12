<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Psfuresult extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('S_psfuresult');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $psfuResultModel = new S_psfuresult();
        $dataArray['psfuResultList'] = $psfuResultModel->getPSFUResult();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('psfuresult', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $psfuResultModel = new S_psfuresult();
        $getfieldsValue = $this->getFieldsValue();
        $psfuResultData = array(
            'Name' => $this->input->post('PSFUResult'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertPSFUResult = $psfuResultModel->InsertPSFUResult($psfuResultData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertPSFUResult . '</h4>');
        redirect(base_url() . "index.php/psfuresult/index");
    }

    function Update() {

        $psfuResultModel = new S_psfuresult();
        $getfieldsValue = $this->getFieldsValue();
        $idPSFUResult = $this->input->post('IdPSFUResult');
        $psfuResultData = array(
            'Name' => $this->input->post('PSFUResult'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updatePSFUResult = $psfuResultModel->UpdatePSFUResult($idPSFUResult, $psfuResultData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updatePSFUResult . '</h4>');
        redirect(base_url() . "index.php/psfuresult/index");
    }

    function Delete($idPsfuResult) {

        $psfuResultModel = new S_psfuresult();
        $deletePSFUResult = $psfuResultModel->DeletePSFUResult($idPsfuResult);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deletePSFUResult . '</h4>');
        redirect(base_url() . "index.php/psfuresult/index");
    }

    function search() {

        $psfuResultModel = new S_psfuresult();
        $search = $this->input->post('searchpsfuresult');
        $psfuResultSearch = $psfuResultModel->searchPSFUResult($search);
        $psfuResult = json_encode($psfuResultSearch);
        echo $psfuResult;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
