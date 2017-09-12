<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Allmodels extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_allbrands');
        $this->load->model('s_allmodels');
        $this->load->model('s_allmodels');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $allBrandsModel = new S_allbrands();
        $allModels = new S_allmodels();
        $dataArray['allModelsList'] = $allModels->getAllModels();
        $dataArray['brandsList'] = $allBrandsModel->getAllBrands();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('allmodels', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $allModels = new S_allmodels();
        $getfieldsValue = $this->getFieldsValue();
        $allModelsData = array(
            'idAllBrands' => $this->input->post('SelectBrand'),
            'ModelName' => $this->input->post('ModelName'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertAllModels = $allModels->InsertAllModels($allModelsData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertAllModels . '</h4>');
        redirect(base_url() . "index.php/allmodels/index");
    }

    function Update() {

        $allModels = new S_allmodels();
        $getfieldsValue = $this->getFieldsValue();
        $idAllModels = $this->input->post('IdAllModels');
        $allModelsData = array(
            'idAllBrands' => $this->input->post('uidAllBrands'),
            'ModelName' => $this->input->post('UModelName'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateAllModels = $allModels->UpdateAllModels($idAllModels, $allModelsData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateAllModels . '</h4>');
        redirect(base_url() . "index.php/allmodels/index");
    }

    function Delete($idAllModels) {

        $allModels = new S_allmodels();
        $deleteAllModels = $allModels->DeleteAllModels($idAllModels);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteAllModels . '</h4>');
        redirect(base_url() . "index.php/allmodels/index");
    }

    function search() {

        $allModels = new S_allmodels();
        $search = $this->input->post('searchmodel');
        $modelSearch = $allModels->searchAllModels($search);
        $model = json_encode($modelSearch);
        echo $model;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
