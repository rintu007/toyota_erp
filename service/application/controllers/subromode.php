<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class subromode extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_submode');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $submodeModel = new s_submode();
        $dataArray['modeList'] = $submodeModel->getAllROMode();
		$dataArray['SubModeList'] = $submodeModel->getAllSubROMode();
		//print_r($dataArray['modeList']);
		//die();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('submode', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $submodeModel = new s_submode();
        if (!$this->verifyRecord()) {
            $submodeData = array(
                'SubModeName' => $this->input->post('subromode'),
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
				'idROMode' => $this->input->post('romode'),
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertsubmode = $submodeModel->Insertsubmode($submodeData);
            $this->session->set_flashdata('insertmessage', '<h4>' . $insertsubmode . '</h4>');
            redirect(base_url() . "index.php/subromode/index");
        } else {
            $this->session->set_flashdata('insertmessage', '<h4>' . 'Mode is already exist, Try again with different Mode !' . '</h4>');
            redirect(base_url() . "index.php/subromode/index");
        }
    }

    function Update() {

        $submodeModel = new s_submode();
        $idsubmode = $this->input->post('idsubmode');
        $submodeData = array(
            'SubModeName' => $this->input->post('usubromode'),
			'idROMode' => $this->input->post('romode')
        );
        $updatesubmode = $submodeModel->Updatesubmode($idsubmode, $submodeData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updatesubmode . '</h4>');
        redirect(base_url() . "index.php/subromode/index");
    }

    function Delete($idsubmode) {

        $submodeModel = new s_submode();
        $deletesubmode = $submodeModel->Deletesubmode($idsubmode);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deletesubmode . '</h4>');
        redirect(base_url() . "index.php/subromode/index");
    }

    function search() {

        $submodeModel = new s_submode();
        $search = $this->input->post('submode');
        $submodeSearch = $submodeModel->searchsubmode($search);
        $submode = json_encode($submodeSearch);
        echo $submode;
    }

    function verifyRecord() {
        $submodeModel = new s_submode();
        $data = array(
            'SubModeName' => $this->input->post('subromode'),
        );
        $result = $submodeModel->isExist($data);
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
