<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Firquestions extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_firquestions');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $firquestionsModel = new S_firquestions();
        $dataArray['firquestionsList'] = $firquestionsModel->getAllFirQuestions();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('firquestions', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $firquestionsModel = new S_firquestions();
        if (!$this->verifyRecord()) {
            $firquestionsData = array(
                'QuestionNo' => 'Q' . $this->input->post('QuestionNo'),
                'Question' => $this->input->post('Question') . ' ?',
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertFirQuestions = $firquestionsModel->InsertFirQuestions($firquestionsData);
            $this->session->set_flashdata('insertmessage', '<h4>' . $insertFirQuestions . '</h4>');
            redirect(base_url() . "index.php/firquestions/index");
        } else {
            $this->session->set_flashdata('insertmessage', '<h4>' . 'Question No. is already exist, Try again with different Question No. !' . '</h4>');
            redirect(base_url() . "index.php/firquestions/index");
        }
    }

    function Update() {

        $firquestionsModel = new S_firquestions();
        $idFirQuestions = $this->input->post('idFirQuestions');
        $firquestionsData = array(
            'Question' => $this->input->post('Question'),
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
        );
        $updateFirQuestions = $firquestionsModel->UpdateFirQuestions($idFirQuestions, $firquestionsData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateFirQuestions . '</h4>');
        redirect(base_url() . "index.php/firquestions/index");
    }

    function Delete($idFirQuestions) {

        $firquestionsModel = new S_firquestions();
        $deleteFirQuestions = $firquestionsModel->DeleteFirQuestions($idFirQuestions);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteFirQuestions . '</h4>');
        redirect(base_url() . "index.php/firquestions/index");
    }

    function search() {

        $firquestionsModel = new S_firquestions();
        $search = $this->input->post('searchfirquestions');
        $firquestionSearch = $firquestionsModel->searchFirQuestions($search);
        $firquestionsName = json_encode($firquestionSearch);
        echo $firquestionsName;
    }

    function verifyRecord() {
        $firquestionsModel = new S_firquestions();
        $data = array(
            'QuestionNo' => $this->input->post('QuestionNo'),
            'Question' => $this->input->post('Question')
        );
        $result = $firquestionsModel->isExist($data);
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
