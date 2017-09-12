<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Categoryinfo extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_categoryinfo');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $categoryInfoModel = new S_categoryinfo();
        $dataArray['categoryInfoList'] = $categoryInfoModel->getCategoryInfo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('categoryinfo', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $categoryInfoModel = new S_categoryinfo();
        $getfieldsValue = $this->getFieldsValue();
        $categoryInfoData = array(
            'Name' => $this->input->post('CategoryName'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertCategoryInfo = $categoryInfoModel->InsertCategoryInfo($categoryInfoData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertCategoryInfo . '</h4>');
        redirect(base_url() . "index.php/categoryinfo/index");
    }

    function Update() {

        $categoryInfoModel = new S_categoryinfo();
        $getfieldsValue = $this->getFieldsValue();
        $idCategoryInfo = $this->input->post('IdCategoryInfo');
        $categoryInfoData = array(
            'Name' => $this->input->post('CategoryName'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateCategoryInfo = $categoryInfoModel->UpdateCategoryInfo($idCategoryInfo, $categoryInfoData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateCategoryInfo . '</h4>');
        redirect(base_url() . "index.php/categoryinfo/index");
    }

    function Delete($idCategoryinfo) {

        $categoryInfoModel = new S_categoryinfo();
        $deleteCategoryInfo = $categoryInfoModel->DeleteCategoryInfo($idCategoryinfo);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteCategoryInfo . '</h4>');
        redirect(base_url() . "index.php/categoryinfo/index");
    }

    function search() {

        $categoryInfoModel = new S_categoryinfo();
        $search = $this->input->post('searchcategoryinfo');
        $categoryInfoSearch = $categoryInfoModel->searchCategoryInfo($search);
        $categoryInfo = json_encode($categoryInfoSearch);
        echo $categoryInfo;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
