<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Allbrands extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_allvehicles');
        $this->load->model('s_allbrands');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $allBrandsModel = new S_allbrands();
        $dataArray['brandsList'] = $allBrandsModel->getAllBrands();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('allbrands', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $allBrandsModel = new S_allbrands();
        $getfieldsValue = $this->getFieldsValue();
        $allBrandsData = array(
            'BrandName' => $this->input->post('BrandName'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertAllBrand = $allBrandsModel->InsertAllBrands($allBrandsData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertAllBrand . '</h4>');
        redirect(base_url() . "index.php/allbrands/index");
    }

    function Update() {

        $allBrandsModel = new S_allbrands();
        $getfieldsValue = $this->getFieldsValue();
        $idAllBrands = $this->input->post('idAllBrand');
        $allBrandsData = array(
            'BrandName' => $this->input->post('BrandName'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateAllBrand = $allBrandsModel->UpdateAllBrands($idAllBrands, $allBrandsData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateAllBrand . '</h4>');
        redirect(base_url() . "index.php/allbrands/index");
    }

    function Delete($idAllBrands) {

        $allBrandsModel = new S_allbrands();
        $deleteAllBrand = $allBrandsModel->DeleteAllBrands($idAllBrands);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteAllBrand . '</h4>');
        redirect(base_url() . "index.php/allbrands/index");
    }

    function search() {

        $allBrandsModel = new S_allbrands();
        $search = $this->input->post('searchbrand');
        $allBrandsSearch = $allBrandsModel->searchAllBrands($search);
        $brandName = json_encode($allBrandsSearch);
        echo $brandName;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
