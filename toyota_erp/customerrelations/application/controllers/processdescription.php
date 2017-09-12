<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Processdescription extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['relatedtolist'] = $this->servicerelatedto();
        $Data['classificationlist'] = $this->serviceprocesslist();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('processdescription', $Data);
        $this->load->view('crpanelfooter');
    }

    public function addprocessrules() {

        $addcomplaintmodes = new registercomplaint();
        $addcomplaintmodess = $addcomplaintmodes->addprocessruless();
        $this->session->set_flashdata('insertmessage', '<h4>' . $addcomplaintmodess . '</h4>');
        redirect(base_url() . "index.php/Processdescription/index");
    }

    public function updateprocessrules() {

        $updatedetailrules = new registercomplaint();
        $updatedetailruless = $updatedetailrules->updatetoprocessrules();
        $this->session->set_flashdata('updatemessage', '<h4>' . $updatedetailruless . '</h4>');
        redirect(base_url() . "index.php/Processdescription/index");
    }

    public function servicerelatedto() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getcomplaintrelation();
        return json_encode($compmodeslists->result_array);
    }

    public function serviceprocesslist() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getprocesslist();
        return json_encode($compmodeslists->result_array);
    }

    public function servicefilteredcontactdetaillist() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getfilteredcontactdetaillist();
        echo json_encode($compmodeslists->result_array);
    }

}
