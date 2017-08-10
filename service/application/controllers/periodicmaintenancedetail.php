<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class periodicmaintenancedetail extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('S_periodicmaintenancedetails');
        $this->load->model('S_jobreferencemanual');
        $this->load->model('S_periodicmaintenance');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $jrmModel = new S_jobreferencemanual();
        $pmModel = new S_periodicmaintenance();
        $pmdModel = new S_periodicmaintenancedetails();
        $dataArray['jrmList'] = $jrmModel->getAllJrm();
        $dataArray['pmList'] = $pmModel->getAllPm();
        $dataArray['pmdList'] = $pmdModel->getAllPmd();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('Periodicmaintenancedetail', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $pmdModel = new S_periodicmaintenancedetails();
        $getfieldsValue = $this->getFieldsValue();
        $pmdData = array(
            'idPeriodicMaintenance' => $this->input->post('SelectPm'),
            'RangeOneAmount' => $this->input->post('AmountOne'),
            'RangeTwoAmount' => $this->input->post('AmountTwo'),
            'RangeThreeAmount' => $this->input->post('AmountThree'),
//            'Amount' => $this->input->post('Amount'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertPmd = $pmdModel->InsertPmd($pmdData);
        if ($insertPmd == "Successfully Inserted") {
            $this->addPeriodicDetailJobs();
        }

        $this->session->set_flashdata('insertmessage', '<h4>' . $insertPmd . '</h4>');
        redirect(base_url() . "index.php/periodicmaintenancedetail/index");
    }

    function addPeriodicDetailJobs() {

        $periodJobData = array();
        $pmdModel = new S_periodicmaintenancedetails();
        $idJobRef = $_POST['SelectJrm'];
        for ($count = 0; $count < count($_POST['SelectJrm']); $count++) {
            $periodJobData[] = array(
                'idPeriodicMaintenanceDetail' => $pmdModel->getIdPmd(),
                'idJobRef' => $idJobRef[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $insertPmdJob = $this->db->insert_batch('s_periodicdetail_jobs', $periodJobData);
    }

    function Update() {

        $pmdModel = new S_periodicmaintenancedetails();
        $getfieldsValue = $this->getFieldsValue();
        $idPmd = $this->input->post('IdPMD');
        $pmdData = array(
            'idPeriodicMaintenance' => $this->input->post('SelectPm'),
//            'Amount' => $this->input->post('Amount'),
            'RangeOneAmount' => $this->input->post('AmountOne'),
            'RangeTwoAmount' => $this->input->post('AmountTwo'),
            'RangeThreeAmount' => $this->input->post('AmountThree'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updatePmd = $pmdModel->UpdatePmd($idPmd, $pmdData);
        if ($updatePmd) {
            $updatePmdJobs = $this->updatePeriodicDetailJobs($idPmd);
            $this->session->set_flashdata('updatemessage', '<h4>' . $updatePmdJobs . '</h4>');
            redirect(base_url() . "index.php/periodicmaintenancedetail/index");
        }
    }

    function updatePeriodicDetailJobs($idPmd) {

        $this->db->where('idPeriodicMaintenanceDetail', $idPmd);
        $updatePDetailJobs = $this->db->delete('s_periodicdetail_jobs');
        if ($updatePDetailJobs) {
            $periodJobData = array();
            $pmdModel = new S_periodicmaintenancedetails();
            $idJobRef = $_POST['updateSelectJrm'];
            for ($count = 0; $count < count($_POST['updateSelectJrm']); $count++) {
                $periodJobData[] = array(
                    'idPeriodicMaintenanceDetail' => $idPmd,
                    'idJobRef' => $idJobRef[$count],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
            $updatePmdJob = $this->db->insert_batch('s_periodicdetail_jobs', $periodJobData);
            if ($updatePmdJob) {
                return "Successfully Update";
            }
        }
    }

    function Delete($idPmd) {

        $pmdModel = new S_periodicmaintenancedetails();
        $deletePmd = $pmdModel->DeletePmd($idPmd);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deletePmd . '</h4>');
        redirect(base_url() . "index.php/periodicmaintenancedetail/index");
    }

    function search() {

        $pmdModel = new S_periodicmaintenancedetails();
        $search = $this->input->post('searchpmd');
        $pmdSearch = $pmdModel->searchPmd($search);
        $pmd = json_encode($pmdSearch);
        print_r($pmd);
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
