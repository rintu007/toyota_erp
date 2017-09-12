<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Complaintrelation extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['complaintrelationlist'] = $this->servicecomplaintrelaion();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('complaintrelation', $Data);
        $this->load->view('crpanelfooter');
    }

    public function addcomplaintrelaion() {

        $addcomplaintrel = new registercomplaint();
        $addcomplaintrels = $addcomplaintrel->addcomplaintrelation_();
        $this->session->set_flashdata('insertmessage', '<h4>' . $addcomplaintrels . '</h4>');
        redirect(base_url() . "index.php/Complaintrelation/index");
    }

    public function updatecomplaintrelaion() {

        $addcomplaintrel = new registercomplaint();
        $addcomplaintrels = $addcomplaintrel->updatecomplaintrelation_();
        $this->session->set_flashdata('updatemessage', '<h4>' . $addcomplaintrels . '</h4>');
        redirect(base_url() . "index.php/Complaintrelation/index");
    }

    public function servicecomplaintrelaion() {

        $getcomplaintrel = new registercomplaint();
        $complaintrellists = $getcomplaintrel->getcomplaintrelationlist();
        return json_encode($complaintrellists->result_array);
    }

}
