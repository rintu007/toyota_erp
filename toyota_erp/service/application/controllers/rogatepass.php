<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rogatepass extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('s_repairorder');
        $this->load->model('s_rogatepass');
        $this->load->model('s_rochecklist');
        $this->load->model('s_financeinfo');
        $this->load->model('s_fuelmanagement');
        $this->load->model('s_jobreferencemanual');
        $this->load->model('s_partsuseage');
        $this->load->model('s_subletrepairuseage');
        $this->load->model('s_luboiluseage');
        $this->load->model('s_staff');
        $this->load->model('s_customer');
        $this->load->model('s_vehicle');
        $this->load->model('s_bodypaint');
        $this->load->model('s_allbrands');
        $this->load->model('s_allvehicles');
        $this->load->model('s_bodypaint');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $roGatePass = new S_rogatepass();
        $dataArray['roDetails'] = $roGatePass->getRODetail();
        $dataArray['gatePassNumber'] = $roGatePass->generateGatePassNumber();
        $dataArray['gatePassCreated'] = $this->session->flashdata('gatepasscreated');
        $this->load->view('header');
        $this->load->view('rogatepass', $dataArray);
        $this->load->view('footer');
    }

    function createGatePass() {
//var_dump(date('Y-m-d',strtotime($this->input->post('GatePassDate'))));die;
        $roGatePass = new S_rogatepass();
        $IdRO = $this->input->post('idRO');
        $rOData = array(
            'GatePassNumber' => $this->input->post('GatePassNumber'),
            'GatePassDate' => date('Y-m-d',strtotime($this->input->post('GatePassDate'))),
            'Status' => 'close',
			'GatePassTime' =>  $this->input->post('time'),
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
        );

        $gatePassData['GatePassReceipt'] = $roGatePass->UpdateRO($IdRO, $rOData);
        $this->load->view('header');
        $this->load->view('gatepassreceipt', $gatePassData);
        $this->load->view('footer');

//        $this->session->set_flashdata('gatepasscreated', '<h4>' . $updateRO . '</h4>');
//        redirect(base_url() . "index.php/rogatepass/index");
    }

    function getRODetail() {

        $roGatePass = new S_rogatepass();
        $search = $this->input->post('idRO');
        $roSearch = $roGatePass->searchROById($search);
        $rOById = json_encode($roSearch);
        echo $rOById;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

    function searchRODetail() {

        $roGatePass = new S_rogatepass();
        $search = $this->input->post('searchbyro');
        $roSearch = $roGatePass->searchRODetail($search);
        $rODetail = json_encode($roSearch);
        echo $rODetail;
    }

}
