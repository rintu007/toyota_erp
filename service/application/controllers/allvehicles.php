<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Allvehicles extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_allbrands');
        $this->load->model('s_allmodels');
        $this->load->model('s_allvehicles');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $allBrandsModel = new S_allbrands();
        $allVehiclesModel = new S_allvehicles();
        $dataArray['brandsList'] = $allBrandsModel->getAllBrands();
        $dataArray['allvehiclesList'] = $allVehiclesModel->getAllVehicles();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('allvehicles', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $allVehiclesModel = new S_allvehicles();
        $getfieldsValue = $this->getFieldsValue();
        $allVehiclesData = array(
            'idAllBrands' => $this->input->post('SelectBrand'),
            'idAllModels' => $this->input->post('SelectModel'),
            'Variant' => $this->input->post('Variant'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertAllVehicles = $allVehiclesModel->InsertAllVehicles($allVehiclesData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertAllVehicles . '</h4>');
        redirect(base_url() . "index.php/allvehicles/index");
    }

    function Update() {

        $allVehiclesModel = new S_allvehicles();
        $getfieldsValue = $this->getFieldsValue();
        $idAllVehicles = $this->input->post('IdAllVehicles');
        $allVehiclesData = array(
            'idAllBrands' => $this->input->post('idAllBrands'),
            'idAllModels' => $this->input->post('uSelectModel'),
            'Variant' => $this->input->post('VariantName'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateAllVehicles = $allVehiclesModel->UpdateAllVehicles($idAllVehicles, $allVehiclesData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateAllVehicles . '</h4>');
        redirect(base_url() . "index.php/allvehicles/index");
    }

    function Delete($idAllVehicles) {

        $allVehiclesModel = new S_allvehicles();
        $deleteAllVehicles = $allVehiclesModel->DeleteAllVehicles($idAllVehicles);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteAllVehicles . '</h4>');
        redirect(base_url() . "index.php/allvehicles/index");
    }

    function search() {

        $allVehiclesModel = new S_allvehicles();
        $search = $this->input->post('searchvariant');
        $modelsSearch = $allVehiclesModel->searchAllVehicles($search);
        $models = json_encode($modelsSearch);
        echo $models;
    }

    function getModel() {

        $allModels = new S_allmodels();
        $search = $this->input->post('brand');
        $modelSearch = $allModels->getFilteredModels($search);
        $models = json_encode($modelSearch);
        echo $models;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
