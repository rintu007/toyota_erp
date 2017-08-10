<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Fuelmanagement extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_fuelmanagement');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $fuelModel = new S_fuelmanagement();
        $dataArray['fuelInfoList'] = $fuelModel->getFuelInfo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('fuelmanagement', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $fuelModel = new S_fuelmanagement();
        $getfieldsValue = $this->getFieldsValue();
        $fuelInfoData = array(
            'FuelVolume' => $this->input->post('FuelVolume'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertFuelInfo = $fuelModel->InsertFuelInfo($fuelInfoData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertFuelInfo . '</h4>');
        redirect(base_url() . "index.php/fuelmanagement/index");
    }

    function Update() {

        $fuelModel = new S_fuelmanagement();
        $getfieldsValue = $this->getFieldsValue();
        $idFuelInfo = $this->input->post('IdFuel');
        $fuelInfoData = array(
            'FuelVolume' => $this->input->post('FuelVolume'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateFuelInfo = $fuelModel->UpdateFuelInfo($idFuelInfo, $fuelInfoData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateFuelInfo . '</h4>');
        redirect(base_url() . "index.php/fuelmanagement/index");
    }

    function Delete($idFuelInfo) {

        $fuelModel = new S_fuelmanagement();
        $deleteFuelInfo = $fuelModel->DeleteFuelInfo($idFuelInfo);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteFuelInfo . '</h4>');
        redirect(base_url() . "index.php/fuelmanagement/index");
    }

    function search() {

        $fuelModel = new S_fuelmanagement();
        $search = $this->input->post('searchfuelvol');
        $fuelInfoSearch = $fuelModel->searchFuelInfo($search);
        $fuelInfo = json_encode($fuelInfoSearch);
        echo $fuelInfo;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
