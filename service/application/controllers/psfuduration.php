<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Psfuduration extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_psfuduration');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $psfuDurationModel = new S_psfuduration();
        $dataArray['psfudurationList'] = $psfuDurationModel->getAllPsfuDuration();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('psfuduration', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $psfuDurationModel = new S_psfuduration();
        if (!$this->verifyRecord()) {
            $psfudurationData = array(
                'Duration' => $this->input->post('Duration'),
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertPsfuDuration = $psfuDurationModel->InsertPsfuDuration($psfudurationData);
            $this->session->set_flashdata('insertmessage', '<h4>' . $insertPsfuDuration . '</h4>');
            redirect(base_url() . "index.php/psfuduration/index");
        } else {
            $this->session->set_flashdata('insertmessage', '<h4>' . 'Duration is already exist, Try again with different Value !' . '</h4>');
            redirect(base_url() . "index.php/psfuduration/index");
        }
    }

    function Update() {

        $psfuDurationModel = new S_psfuduration();
        $idPsfuDuration = $this->input->post('idPsfuDuration');
        $psfuDurationData = array(
            'Duration' => $this->input->post('uDuration'),
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
        );
        $updatePsfuDuration = $psfuDurationModel->UpdatePsfuDuration($idPsfuDuration, $psfuDurationData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updatePsfuDuration . '</h4>');
        redirect(base_url() . "index.php/psfuduration/index");
    }

    function Delete($idPsfuDuration) {

        $psfuDurationModel = new S_psfuduration();
        $deletePsfuDuration = $psfuDurationModel->DeletePsfuDuration($idPsfuDuration);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deletePsfuDuration . '</h4>');
        redirect(base_url() . "index.php/psfuduration/index");
    }

    function search() {

        $psfuDurationModel = new S_psfuduration();
        $search = $this->input->post('duration');
        $psfuDurationSearch= $psfuDurationModel->searchPsfuDuration($search);
        $psfuDuration = json_encode($psfuDurationSearch);
        echo $psfuDuration;
    }

    function verifyRecord() {
        $psfuDurationModel = new S_psfuduration();
        $data = array(
            'Duration' => $this->input->post('Duration'),
        );
        $result = $psfuDurationModel->isExist($data);
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
