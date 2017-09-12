<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Complaintresponsetime extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['complaintresponsetime'] = $this->servicecomplaintresponsetime();
        $Data['selectmode'] = $this->serviceselectmode();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('complaintresponsetime', $Data);
        $this->load->view('crpanelfooter');
    }

    public function addcomplaintresponsetime() {

        $addrestime = new registercomplaint();
        $addrestimes = $addrestime->insertcomplaintresponsetime();
        $this->session->set_flashdata('insertmessage', '<h4>' . $addrestimes . '</h4>');
        redirect(base_url() . "index.php/Complaintresponsetime/index");
    }

    public function updatecomplaintresponsetime() {

        $updaterestime = new registercomplaint();
        $updaterestimess = $updaterestime->updatecomplaintresponsetime_();
        $this->session->set_flashdata('updatemessage', '<h4>' . $updaterestimess . '</h4>');
        redirect(base_url() . "index.php/Complaintresponsetime/index");
    }

    public function servicecomplaintresponsetime() {

        $getresptime = new registercomplaint();
        $getresptimes = $getresptime->getcomplaintresponsetime();
        return json_encode($getresptimes->result_array);
    }

    public function serviceselectmode() {

        $modeoptions = new registercomplaint();
        $modeoptionss = $modeoptions->getmodesslist();
        return json_encode($modeoptionss->result_array);
    }

}
