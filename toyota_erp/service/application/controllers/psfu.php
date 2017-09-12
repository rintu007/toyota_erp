<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Psfu extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_repairorder');
        $this->load->model('s_vehicle');
        $this->load->model('s_psfu');
        $this->load->model('s_psfuresult');
        $this->load->model('s_contactinfo');
        $this->load->model('s_staff');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function _remap($method, $args) {

        if (method_exists($this, $method)) {
            $this->$method($args);
        } else {
            $this->index($method, $args);
        }
    }

    function index($args,$firArg) {

        $dataArray = array();
        $psfuresultModel = new S_psfuresult();
        $contactModel = new S_contactinfo();
        $staffManagment = new S_staff();
        $psfuModel = new s_psfu();
        $dataArray['idRO'] = $args;
        $dataArray['isFIR'] = $firArg;
        $dataArray['psufList'] = $psfuresultModel->getPSFUResult();
        $dataArray['contactList'] = $contactModel->getContactInfo();
        $dataArray['staffList'] = $staffManagment->getAllStaff();
        $dataArray['Questions'] = $psfuModel->getAllQuestions();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('psfu', $dataArray);
        $this->load->view('footer');
    }

    // Not in Use So Far...
    function Add() {
//        $psfuModel = new s_psfu();
//        $psfuData = array(
//            'idRO' => $this->input->post('idRO'),
//            'idStaff' => $this->input->post('StaffName'),
//            'idPSFUResult' => $this->input->post('PsfuResult'),
//            'PSFUPlanDate' => $this->input->post('PSFUPlanDate'),
//            'PSFUPlanTime' => $this->input->post('PSFUPlanTime'),
//            'PSFUActualDate' => $this->input->post('PSFUActualDate'),
//            'PSFUActualTime' => $this->input->post('PSFUActualTime'),
//            'PSFURemarks' => $this->input->post('PSFURemarks'),
//            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
//            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
//            'isActive' => $this->getFieldsValue()['isActive']
//        );
//        $insertPSFU = $psfuModel->InsertPSFU($psfuData);
//        if ($insertPSFU === "Successfully Inserted") {
//            $repairOrderModel = new S_repairorder();
//            $repairOrderModel->UpdateRepairOrder($this->input->post('idRO'));
//            $idPSFU = $psfuModel->getIdPsfu();
//            if ($_POST['ContactInfo'] != NULL) {
//                $addPSFUContact = $this->addPsfuContactInfo($idPSFU);
//                if ($addPSFUContact == "PSFU Created") {
////                    redirect(base_url() . "index.php/psfuupdate/index");
//                } else {
//                    
//                }
//            }
//        }
    }

    function addPsfuContactInfo($idPsfu) {

        $psfuContactData = array();
        $idContactInfo = $_POST['ContactInfo'];
        for ($count = 0; $count < count($_POST['ContactInfo']); $count++) {
            $psfuContactData[] = array(
                'idContactInfo' => $idContactInfo[$count],
                'idPSFU' => $idPsfu,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $insertPsfuContact = $this->db->insert_batch('s_psfu_contact', $psfuContactData);
        if ($insertPsfuContact) {
            return "PSFU Created";
        } else {
            return NULL;
        }
    }

    function addFIRQuestionnaire($idPsfu) {

        $firQArr = array();
        $firQData = json_decode($_POST['FIRQ'], true);
        for ($Count = 0; $Count < count($firQData); $Count++) {
            $firQArr = array(
                'idPSFU' => $idPsfu,
                'QNo-Ans' => $firQData[$Count]['QNo'].'-'.$firQData[$Count]['Answer'],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertFirQA = $this->db->insert('s_psfu_firquestions', $firQArr);
        }
    }

    function Update() {
        $psfuModel = new s_psfu();
        $psfuData = array(
            'idStaff' => $this->input->post('StaffName'),
            'idPSFUResult' => $this->input->post('PsfuResult'),
            'PSFUActualDate' => $this->input->post('PSFUActualDate'),
            'PSFUActualTime' => $this->input->post('PSFUActualTime'),
            'PSFURemarks' => $this->input->post('PSFURemarks'),
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
        );
        $updatePSFU = $psfuModel->UpdatePSFU($this->input->post('idRO'), $psfuData);
        if ($updatePSFU === "Successfully Updated") {
            $repairOrderModel = new S_repairorder();
            $repairOrderModel->UpdateRepairOrder($this->input->post('idRO'));
            $idPSFU = $psfuModel->getIdPsfu();
            if ($_POST['ContactInfo'] != NULL) {
                $addPSFUContact = $this->addPsfuContactInfo($idPSFU);
                if ($addPSFUContact == "PSFU Created") {
                    $addFIRQuestionnaire = $this->addFIRQuestionnaire($idPSFU);
                    if ($addFIRQuestionnaire) {
                       redirect(base_url() . "index.php/psfuupdate/index");
                    }
                } else {
                    
                }
            }
        }
    }

    function Delete() {
        
    }

    function search() {
        
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
