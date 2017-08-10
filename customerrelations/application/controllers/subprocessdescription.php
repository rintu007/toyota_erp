<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Subprocessdescription extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['relatedtolist'] = $this->servicerelatedto();
        $Data['classificationlist'] = $this->servicegetsubprocesslist();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('subprocessdescription', $Data);
        $this->load->view('crpanelfooter');
    }

    public function addsubprocessrules() {

        $addcomplaintmodes = new registercomplaint();
        $addcomplaintmodess = $addcomplaintmodes->addsubprocessruless();
        $this->session->set_flashdata('insertmessage', '<h4>' . $addcomplaintmodess . '</h4>');
        redirect(base_url() . "index.php/Subprocessdescription/index");
    }

    public function updatesubprocessrules() {

        $updatedetailrules = new registercomplaint();
        $updatedetailruless = $updatedetailrules->updatetosubprocessrules();
        $this->session->set_flashdata('updatemessage', '<h4>' . $updatedetailruless . '</h4>');
        redirect(base_url() . "index.php/Subprocessdescription/index");
    }

    public function servicerelatedto() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getcomplaintrelation();
        return json_encode($compmodeslists->result_array);
    }

    public function servicecontactdetaillist() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getvocclassificationlist();
        return json_encode($compmodeslists->result_array);
    }

    public function servicegetsubprocesslist() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getsubprocesslist();
        return json_encode($compmodeslists->result_array);
    }

    public function servicefilteredprocesslist() {

        $processlist = new registercomplaint();
        $processlists = $processlist->gefilteredprocesslist();
        echo json_encode($processlists->result_array);
    }

}
