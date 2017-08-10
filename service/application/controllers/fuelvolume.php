<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Fuelvolume extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_fuelvolume');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $fuelVolumeModel = new S_fuelvolume();
        $dataArray['fuelvolumeList'] = $fuelVolumeModel->getAllFuelVolume();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('fuelvolume', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $fuelVolumeModel = new S_fuelvolume();
        if (!$this->verifyRecord()) {
            $fuelvolumeData = array(
                'GasVolume' => $this->input->post('FuelVol'),
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertFuelVolume = $fuelVolumeModel->InsertFuelVolume($fuelvolumeData);
            $this->session->set_flashdata('insertmessage', '<h4>' . $insertFuelVolume . '</h4>');
            redirect(base_url() . "index.php/fuelvolume/index");
        } else {
            $this->session->set_flashdata('insertmessage', '<h4>' . 'Fuel Volume is already exist, Try again with different Volume. !' . '</h4>');
            redirect(base_url() . "index.php/fuelvolume/index");
        }
    }

    function Update() {

        $fuelVolumeModel = new S_fuelvolume();
        $idGas = $this->input->post('idFuelVol');
        $fuelVolData = array(
            'GasVolume' => $this->input->post('uFuelVol'),
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
        );
        $updateFuelVolume = $fuelVolumeModel->UpdateFuelVolume($idGas, $fuelVolData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateFuelVolume . '</h4>');
        redirect(base_url() . "index.php/fuelvolume/index");
    }

    function Delete($idGas) {

        $fuelVolumeModel = new S_fuelvolume();
        $deleteFuelVolume = $fuelVolumeModel->DeleteFuelVolume($idGas);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteFuelVolume . '</h4>');
        redirect(base_url() . "index.php/fuelvolume/index");
    }

    function search() {

        $fuelVolumeModel = new S_fuelvolume();
        $search = $this->input->post('fuelVolume');
        $fuelVolumeSearch = $fuelVolumeModel->searchFuelVolume($search);
        $fuelVolume = json_encode($fuelVolumeSearch);
        echo $fuelVolume;
    }

    function verifyRecord() {
        $fuelVolumeModel = new S_fuelvolume();
        $data = array(
            'GasVolume' => $this->input->post('FuelVol'),
        );
        $result = $fuelVolumeModel->isExist($data);
        if ($result != NULL) {
            return true;
        } else {
            return false;
        }
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
