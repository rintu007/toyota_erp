<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jobreferencemanual extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('S_jobreferencemanual');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $jrmModel = new S_jobreferencemanual();
        $dataArray['jrmList'] = $jrmModel->getAllJrm();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('jobreferencemanual', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $jrmModel = new S_jobreferencemanual();
        $getfieldsValue = $this->getFieldsValue();
        $isBodyPaint = $this->input->post('isBodyPaint');
        $isDefault = $this->input->post('isDefault');
        if ($isBodyPaint == "1") {
            $isBodyPaint = 1;
        } else {
            $isBodyPaint = 0;
        }
        if ($isDefault == "1") {
            $isDefault = 1;
        } else {
            $isDefault = 0;
        }

        $jrmData = array(
            'JobTask' => $this->input->post('JobTask'),
            'RangeOneAmount' => $this->input->post('AmountOne'),
            'RangeTwoAmount' => $this->input->post('AmountTwo'),
            'RangeThreeAmount' => $this->input->post('AmountThree'),
            'TimeTaken' => $this->input->post('TimeTaken'),
            'isBodyPaint' => $isBodyPaint,
            'isDefault' => $isDefault,
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertJrm = $jrmModel->InsertJrm($jrmData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertJrm . '</h4>');
        redirect(base_url() . "index.php/Jobreferencemanual/index");
    }

    function Update() {

        $jrmModel = new S_jobreferencemanual();
        $getfieldsValue = $this->getFieldsValue();
        $idJrm = $this->input->post('IdJrm');
        $isBodyPaint = $this->input->post('uisBodyPaint');
        $isDefault = $this->input->post('uisDefault');

        if ($isBodyPaint == "1") {
            $isBodyPaint = 1;
        } else {
            $isBodyPaint = 0;
        }
        if ($isDefault == "1") {
            $isDefault = 1;
        } else {
            $isDefault = 0;
        }
        $jrmData = array(
            'JobTask' => $this->input->post('JobTask'),
            'TimeTaken' => $this->input->post('TimeTaken'),
            'RangeOneAmount' => $this->input->post('RAmountOne'),
            'RangeTwoAmount' => $this->input->post('RAmountTwo'),
            'RangeThreeAmount' => $this->input->post('RAmountThree'),
            'isBodyPaint' => $isBodyPaint,
            'isDefault' => $isDefault,
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateJrm = $jrmModel->UpdateJrm($idJrm, $jrmData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateJrm . '</h4>');
        redirect(base_url() . "index.php/Jobreferencemanual/index");
    }

    function Delete($idJrm) {

        $jrmModel = new S_jobreferencemanual();
        $deleteJrm = $jrmModel->DeleteJrm($idJrm);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteJrm . '</h4>');
        redirect(base_url() . "index.php/Jobreferencemanual/index");
    }

    function search() {

        $jrmModel = new S_jobreferencemanual();
        $search = $this->input->post('searchjrm');
        $jrmSearch = $jrmModel->searchJrm($search);
        $jobTask = json_encode($jrmSearch);
        echo $jobTask;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
