<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dispatchmode extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_dispatchmode');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $dispatchModeModel = new m_dispatchmode();
        $dataArray['dispatchmodeList'] = $dispatchModeModel->getAllDispatchMode();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header_parts');
        $this->load->view('dispatchmode', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $dispatchModeModel = new m_dispatchmode();
        if (!$this->verifyRecord()) {
            $dispatchModeData = array(
                'Mode' => $this->input->post('DispatchMode')
            );
            $insertDispatchMode = $dispatchModeModel->InsertDispatchMode($dispatchModeData);
            $this->session->set_flashdata('insertmessage', '<h4>' . $insertDispatchMode . '</h4>');
            redirect(base_url() . "index.php/dispatchmode/index");
        } else {
            $this->session->set_flashdata('insertmessage', '<h4>' . 'Mode is already exist, Try again with different Mode !' . '</h4>');
            redirect(base_url() . "index.php/dispatchmode/index");
        }
    }

    function Update() {

        $dispatchModeModel = new m_dispatchmode();
        $idDispatchMode = $this->input->post('idDispatch');
        $dispatchModeData = array(
            'Mode' => $this->input->post('uDispatchMode')
        );
        $updateDispatchMode = $dispatchModeModel->UpdateDispatchMode($idDispatchMode, $dispatchModeData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateDispatchMode . '</h4>');
        redirect(base_url() . "index.php/dispatchmode/index");
    }

    function search() {

        $dispatchModeModel = new m_dispatchmode();
        $search = $this->input->post('DispatchMode');
        $dispatchModeSearch = $dispatchModeModel->searchDispatchMode($search);
        $dispatchMode = json_encode($dispatchModeSearch);
        echo $dispatchMode;
    }

    function verifyRecord() {
        $dispatchModeModel = new m_dispatchmode();
        $data = array(
            'Mode' => $this->input->post('DispatchMode'),
        );
        $result = $dispatchModeModel->isExist($data);
        if ($result != NULL) {
            return true;
        } else {
            return false;
        }
    }

}
