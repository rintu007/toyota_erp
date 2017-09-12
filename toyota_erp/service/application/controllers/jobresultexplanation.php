<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Jobresultexplanation extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_jobresultexplanation');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $jobResultModel = new S_jobresultexplanation();
        $dataArray['jobResultList'] = $jobResultModel->getJobResult();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('jobresultexplanation', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $jobResultModel = new S_jobresultexplanation();
        $getfieldsValue = $this->getFieldsValue();
        $jobResultData = array(
            'Name' => $this->input->post('JobResultType'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertJobResult = $jobResultModel->InsertJobResult($jobResultData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertJobResult . '</h4>');
        redirect(base_url() . "index.php/jobresultexplanation/index");
    }

    function Update() {

        $jobResultModel = new S_jobresultexplanation();
        $getfieldsValue = $this->getFieldsValue();
        $idJobResult = $this->input->post('IdJobResult');
        $jobResultData = array(
            'Name' => $this->input->post('JobResultType'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateJobResult = $jobResultModel->UpdateJobResult($idJobResult, $jobResultData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateJobResult . '</h4>');
        redirect(base_url() . "index.php/jobresultexplanation/index");
    }

    function Delete($idJobResult) {

        $jobResultModel = new S_jobresultexplanation();
        $deleteJobResult = $jobResultModel->DeleteJobResult($idJobResult);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteJobResult . '</h4>');
        redirect(base_url() . "index.php/jobresultexplanation/index");
    }

    function search() {

        $jobResultModel = new S_jobresultexplanation();
        $search = $this->input->post('searchjobresultexplanation');
        $searchJobResult = $jobResultModel->searchJobResult($search);
        $jobResultInfo = json_encode($searchJobResult);
        echo $jobResultInfo;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
