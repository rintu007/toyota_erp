<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Partsrequisitionbodyshop extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_partsrequistionbodyshop');
        $this->load->model('s_repairorder');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $bodyPartsModel = new S_partsrequistionbodyshop();
        $dataArray['serialNumber'] = $bodyPartsModel->getSerialNumber();
        $dataArray['Parts'] = $bodyPartsModel->fillPartCombo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('header');
        $this->load->view('partsrequisitionbodyshop', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $bodyPartsModel = new S_partsrequistionbodyshop();
        $roModel = new S_repairorder();
        $roNumber = $this->input->post('RoNumber');
        $newRow = $this->input->post('newRow');
        $estimateData = array(
             'SerialNumber' => $this->input->post('SNO'),
            'idRepairOrderBill' => $roModel->selectOneRepairOrder($roNumber),
            'InsuranceCompany' => NULL,
            'Branch' => NULL,
            'Outstanding' => NULL,
            'ServiceAdvisor' => $this->input->post('ServiceAdvisor'),
            'PartsDepartment' => $this->input->post('PartsDepartment'),
            'isMechanical' => 0,
            'PartsRequisitionDate' => date("Y-m-d", strtotime($this->input->post('Date'))),
            'PartsRequisitionTime' => $this->input->post('Time'),
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $insertPartsReqData = $bodyPartsModel->InsertPartsBodyShop($estimateData);
    //    if ($newRow == "-") {
            $addPartsInfo = $this->addPartsInfo();
      //  }
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertPartsReqData . '</h4>');
        redirect(base_url() . "index.php/partsrequisitionbodyshop/index");
    }

    function addPartsInfo() {

        $partsInfoData = array();
        $bodyPartsModel = new S_partsrequistionbodyshop();
     //   $idPart = $_POST['BodyParts'];
     //   $partsQty = $_POST['BodyQty'];
		    $idPart = $_POST['MechParts'];
        $partsQty = $_POST['MechPartsQty'];

        for ($count = 0; $count < count($idPart); $count++) {
            $partsInfoData[] = array(
                'idPartsRequisition' => $bodyPartsModel->getIdPartsBodyShop(),
                'idPart' => $idPart[$count],
                'PartQuantity' => $partsQty[$count],
                'PartAmount' => 0,
                'isDispatched' => 0,
				'isReceived'   => 0,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
		//var_dump($partsInfoData);die;
        $inserPartsInfo = $this->db->insert_batch('s_partsreq_partsinfo', $partsInfoData);
    }

    function getPartDetails() {
        $BodyShop = new S_partsrequistionbodyshop();
        $idPart = $this->input->post('idPart');
        $PartDetails = $BodyShop->getPartDetails($idPart);
        echo json_encode($PartDetails);
    }

    function getRONumber() {

        $roModel = new S_repairorder();
        $idRO = $roModel->selectOneRO();
        return $idRO;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

    function searchRONumber() {

        $roModel = new S_repairorder();
        $search = $this->input->post('searchRONumber');
        $roSearch = $roModel->searchRepairOrder($search);
        $rONumber = json_encode($roSearch);
        echo $rONumber;
    }

}
