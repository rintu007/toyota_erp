<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Partsinfo extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_partsrequisition');
        $this->load->model('s_partsreceived');
        $this->load->model('s_partsinfo');
        $this->load->model('s_repairorder');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $partsInfoModel = new S_partsinfo();
        $dataArray['Dispatched'] = $partsInfoModel->countDispatchedParts();
        $dataArray['Received'] = $partsInfoModel->countReceivedParts();
        $dataArray['RemainingQty'] = $partsInfoModel->countRemaingPartsRequests();
        $this->load->view('header');
        $this->load->view('partsinfo', $dataArray);
        $this->load->view('footer');
    }

}
