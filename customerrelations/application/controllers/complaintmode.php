<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Complaintmode extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['complaintmodeslist'] = $this->servicecomplaintmodeslist();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('complaitnmode', $Data);
        $this->load->view('crpanelfooter');
    }

    public function addcomplaintmodes() {

        $addcomplaintmodes = new registercomplaint();
        $addcompmodes = $addcomplaintmodes->insertcomplaintmodes();
        $this->session->set_flashdata('insertmessage', '<h4>' . $addcompmodes . '</h4>');
        redirect(base_url() . "index.php/Complaintmode/index");
    }

    public function updatecomplaintmodes() {

        $addcomplaintmodes = new registercomplaint();
        $addcompmodes = $addcomplaintmodes->updatecomplaintmodes_();
        $this->session->set_flashdata('updatemessage', '<h4>' . $addcompmodes . '</h4>');
        redirect(base_url() . "index.php/Complaintmode/index");
    }

    public function servicecomplaintmodeslist() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getcomplaintmodelist();
        return json_encode($compmodeslists->result_array);
    }

}
