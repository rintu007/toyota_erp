<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Contactinfo extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('s_contactinfo');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $contacInfoModel = new S_contactinfo();
        $dataArray['contactInfoList'] = $contacInfoModel->getContactInfo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('contactinfo', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $contacInfoModel = new S_contactinfo();
        $getfieldsValue = $this->getFieldsValue();
        $contactInfoData = array(
            'Name' => $this->input->post('ContactName'),
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertContactInfo = $contacInfoModel->InsertContactInfo($contactInfoData);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertContactInfo . '</h4>');
        redirect(base_url() . "index.php/contactinfo/index");
    }

    function Update() {

        $contacInfoModel = new S_contactinfo();
        $getfieldsValue = $this->getFieldsValue();
        $idContactInfo = $this->input->post('IdContactInfo');
        $contactInfoData = array(
            'Name' => $this->input->post('ContactName'),
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateContactInfo = $contacInfoModel->UpdateContactInfo($idContactInfo, $contactInfoData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateContactInfo . '</h4>');
        redirect(base_url() . "index.php/contactinfo/index");
    }

    function Delete($idContactInfo) {

        $contacInfoModel = new S_contactinfo();
        $deleteContactInfo = $contacInfoModel->DeleteContactInfo($idContactInfo);
        $this->session->set_flashdata('deletemessage', '<h4>' . $deleteContactInfo . '</h4>');
        redirect(base_url() . "index.php/contactinfo/index");
    }

    function search() {

        $contacInfoModel = new S_contactinfo();
        $search = $this->input->post('searchcontactinfo');
        $contactInfoSearch = $contacInfoModel->searchContactInfo($search);
        $contactInfo = json_encode($contactInfoSearch);
        echo $contactInfo;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
