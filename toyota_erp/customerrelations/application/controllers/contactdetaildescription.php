<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Contactdetaildescription extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['relatedtolist'] = $this->servicerelatedto();
        $Data['classificationlist'] = $this->servicedetaillist();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('contactdetaildescription', $Data);
        $this->load->view('crpanelfooter');
    }

    public function adddetailrules() {

        $regComplaint = new registercomplaint();
        $adddetailrules  = $regComplaint->adddetailruless();
        $this->session->set_flashdata('insertmessage', '<h4>' . $adddetailrules . '</h4>');
        redirect(base_url() . "index.php/Contactdetaildescription/index");
    }

    public function updatedetailrules() {

        $updatedetailrules = new registercomplaint();
        $updatedetailruless = $updatedetailrules->updatetodetailrules();
        $this->session->set_flashdata('updatemessage', '<h4>' . $updatedetailruless . '</h4>');
        redirect(base_url() . "index.php/Contactdetaildescription/index");
    }

    public function servicerelatedto() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getcomplaintrelation();
        return json_encode($compmodeslists->result_array);
    }

    public function servicedetaillist() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getdetaillist();
        return json_encode($compmodeslists->result_array);
    }

}
