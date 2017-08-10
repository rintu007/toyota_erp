<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Vocclassification extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['classificationlist'] = $this->servicevocclassification();
        $this->load->view('crpanelheader');
        $this->load->view('vocclassification', $Data);
        $this->load->view('crpanelfooter');
    }

    public function servicevocclassification() {

        $getallcomplaints = new registercomplaint();
        $getallcomplaintss = $getallcomplaints->getvocclassificationlist();
        return json_encode($getallcomplaintss->result_array);
    }

    public function servicegetfilteredvocclassification() {

        $getallcomplaints = new registercomplaint();
        $getallcomplaintss = $getallcomplaints->getfilteredvocclassification();
        echo json_encode($getallcomplaintss);
    }

}
