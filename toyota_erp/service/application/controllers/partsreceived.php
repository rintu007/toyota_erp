<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Partsreceived extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_partsrequisition');
        $this->load->model('s_partsreceived');
        $this->load->model('s_repairorder');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {
        $dataArray = array();
        $dataArray['message'] = $this->session->flashdata('message');
        $this->load->view('header');
        $this->load->view('partsreceived', $dataArray);
        $this->load->view('footer');
    }

    function Received() {
//        var_dump($_POST);die;

        $recModel = new S_partsreceived();
        $isReceived = $recModel->updatePartsReceived();
        if ($isReceived) {
            $this->session->set_flashdata('message', '<h4 style="background-color: green;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center; margin-top: 14px;">Respective Parts Has Been Received</h4>');
            redirect(base_url() . "index.php/partsreceived/index");
        } else {
            $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">Respective Parts Has Not Been Received</h4>');
            redirect(base_url() . "index.php/partsreceived/index");
        }
    }

    function allReceived() {

        $recModel = new S_partsreceived();
        $allPartsData = $recModel->getAllReceivedParts();
        $allPartsReceived = json_encode($allPartsData);
        echo $allPartsReceived;
    }

    function search() {

        $recModel = new S_partsreceived();
        $search = $this->input->post('searchbyro');
        $receivedData = $recModel->getReceivedParts($search);
        $partsReceived = json_encode($receivedData);
        echo $partsReceived;
    }

}
