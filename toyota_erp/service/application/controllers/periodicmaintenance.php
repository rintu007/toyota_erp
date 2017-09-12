<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Periodicmaintenance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('S_periodicmaintenance');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $pmModel = new S_periodicmaintenance();
        $dataArray['pmList'] = $pmModel->getAllPm();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('periodicmaintenance', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $pmModel = new S_periodicmaintenance();
        $getfieldsValue = $this->getFieldsValue();
        $this->form_validation->set_rules('Name', 'Name', 'required|xss_clean');
        $this->form_validation->set_rules('TimeTaken', 'Time Take', 'required|xss_clean');
        $pmdData = array(
            'PeriodName' => $this->input->post('Name'),
            'TimeTaken' => $this->input->post('TimeTaken'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertPm = $pmModel->InsertPm($pmdData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertPm . '</h4>');
        redirect(base_url() . "index.php/Periodicmaintenance/index");
    }

    function Update() {

        $pmModel = new S_periodicmaintenance();
        $getfieldsValue = $this->getFieldsValue();
        $idPm = $this->input->post('IdPM');
        $pmdData = array(
            'PeriodName' => $this->input->post('Name'),
            'TimeTaken' => $this->input->post('TimeTaken'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updatePm = $pmModel->UpdatePm($idPm, $pmdData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updatePm . '</h4>');
        redirect(base_url() . "index.php/Periodicmaintenance/index");
    }

    function Delete($idPm) {

        $pmModel = new S_periodicmaintenance();
        $deletePm = $pmModel->DeletePm($idPm);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deletePm . '</h4>');
        redirect(base_url() . "index.php/Periodicmaintenance/index");
    }

    function search() {

        $pmModel = new S_periodicmaintenance();
        $search = $this->input->post('searchpm');
        $pmSearch = $pmModel->searchPm($search);
        $periodName = json_encode($pmSearch);
        print_r($periodName);
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
