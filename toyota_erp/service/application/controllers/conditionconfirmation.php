<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Conditionconfirmation extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_conditionconfirmation');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $conditionModel = new S_conditionconfirmation();
        $dataArray['conditionList'] = $conditionModel->getCondition();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('conditionconfirmation', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $conditionModel = new S_conditionconfirmation();
        $getfieldsValue = $this->getFieldsValue();
        $conditionData = array(
            'Name' => $this->input->post('Condition'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertCondition = $conditionModel->InsertCondition($conditionData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertCondition . '</h4>');
        redirect(base_url() . "index.php/conditionconfirmation/index");
    }

    function Update() {

        $conditionModel = new S_conditionconfirmation();
        $getfieldsValue = $this->getFieldsValue();
        $idCondition = $this->input->post('IdCondition');
        $conditionData = array(
            'Name' => $this->input->post('Condition'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateCondition = $conditionModel->UpdateCondition($idCondition, $conditionData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateCondition . '</h4>');
        redirect(base_url() . "index.php/conditionconfirmation/index");
    }

    function Delete($idCondition) {

        $conditionModel = new S_conditionconfirmation();
        $deleteCondition = $conditionModel->DeleteCondition($idCondition);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteCondition . '</h4>');
        redirect(base_url() . "index.php/conditionconfirmation/index");
    }

    function search() {

        $conditionModel = new S_conditionconfirmation();
        $search = $this->input->post('searchconditionconfirmation');
        $conditionSearch = $conditionModel->searchCondition($search);
        $condition = json_encode($conditionSearch);
        echo $condition;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
