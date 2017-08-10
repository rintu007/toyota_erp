<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Psfuupdate extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_psfu');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $psfuModel = new s_psfu();
        $dataArray['countRO'] = $psfuModel->getCountRO();
        $dataArray['psfuDue'] = $psfuModel->getRO();
        $this->load->view('header');
        $this->load->view('psfuupdate', $dataArray);
        $this->load->view('footer');
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

    function Add() {
        
    }

    function Update() {
        
    }

    function Delete() {
        
    }

    function search() {
        
    }

}
