<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Bay extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_bays');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $baysModel = new S_bays();
        $dataArray['dealersList'] = $baysModel->getAllDealers();
		$dataArray['shopList']	= $baysModel->getAllshopwise();
        $dataArray['baysList'] = $baysModel->getAllBays();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('bay', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $baysModel = new S_bays();
        $getfieldsValue = $this->getFieldsValue();
        $bayData = array(
            'idDealer' => $this->input->post('SelectDealer'),
            'BayName' => $this->input->post('BayName'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive'],
			'idShopwise' => $this->input->post('ShopWise')
        );
        $insertBay = $baysModel->InsertBay($bayData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertBay . '</h4>');
        redirect(base_url() . "index.php/bay/index");
    }

    function Update() {

        $baysModel = new S_bays();
        $getfieldsValue = $this->getFieldsValue();
        $idBay = $this->input->post('IdBay');
        $bayData = array(
            'BayName' => $this->input->post('BayName'),
            'idDealer' => $this->input->post('IdDealer'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
			'idShopwise' => $this->input->post('ShopWise')
        );
        $updateBay = $baysModel->UpdateBay($idBay, $bayData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateBay . '</h4>');
        redirect(base_url() . "index.php/bay/index");
    }

    function Delete($idBay) {

        $baysModel = new S_bays();
        $deleteBay = $baysModel->DeleteBay($idBay);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteBay . '</h4>');
        redirect(base_url() . "index.php/bay/index");
    }

    function search() {

        $baysModel = new S_bays();
        $search = $this->input->post('searchbay');
        $baySearch = $baysModel->searchBay($search);
        $bayName = json_encode($baySearch);
        echo $bayName;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
