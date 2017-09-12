<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Romode extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_romode');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $roModeModel = new S_romode();
        $dataArray['romodeList'] = $roModeModel->getAllROMode();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('romode', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $roModeModel = new S_romode();
        if (!$this->verifyRecord()) {
            $romodeData = array(
                'ModeName' => $this->input->post('ROMode'),
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertROMode = $roModeModel->InsertROMode($romodeData);
            $this->session->set_flashdata('insertmessage', '<h4>' . $insertROMode . '</h4>');
            redirect(base_url() . "index.php/romode/index");
        } else {
            $this->session->set_flashdata('insertmessage', '<h4>' . 'Mode is already exist, Try again with different Mode !' . '</h4>');
            redirect(base_url() . "index.php/romode/index");
        }
    }

    function Update() {

        $roModeModel = new S_romode();
        $idROMode = $this->input->post('idROMode');
        $roModeData = array(
            'ModeName' => $this->input->post('uROMode'),
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
			'isActive' => $this->input->post('status')
        );
        $updateROMode = $roModeModel->UpdateROMode($idROMode, $roModeData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateROMode . '</h4>');
        redirect(base_url() . "index.php/romode/index");
    }

    function Delete($idROMode) {

        $roModeModel = new S_romode();
        $deleteROMode = $roModeModel->DeleteROMode($idROMode);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteROMode . '</h4>');
        redirect(base_url() . "index.php/romode/index");
    }

    function search() {

        $roModeModel = new S_romode();
        $search = $this->input->post('ROMode');
        $ROModeSearch = $roModeModel->searchROMode($search);
        $ROMode = json_encode($ROModeSearch);
        echo $ROMode;
    }

    function verifyRecord() {
        $roModeModel = new S_romode();
        $data = array(
            'ModeName' => $this->input->post('ROMode'),
        );
        $result = $roModeModel->isExist($data);
        if ($result != NULL) {
            return true;
        } else {
            return false;
        }
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
