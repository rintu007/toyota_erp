<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Complaintmodecategory extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['complaintmodeslist'] = $this->servicecomplaintmodeslist();
        $Data['complaintmodescategory'] = $this->servicecomplaintmodesandcategory();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('complaintmodecategory', $Data);
        $this->load->view('crpanelfooter');
    }

    public function addcomplaintcategories() {

        $addcomplaintmodes = new registercomplaint();
        $addcompmodes = $addcomplaintmodes->addcomplaintcategory();
        $this->session->set_flashdata('insertmessage', '<h4>' . $addcompmodes . '</h4>');
        redirect(base_url() . "index.php/Complaintmodecategory/index");
    }

    public function updatecategories() {

        $addcomplaintmodes = new registercomplaint();
        $addcompmodes = $addcomplaintmodes->updatecomplaintcategories();
        $this->session->set_flashdata('updatemessage', '<h4>' . $addcompmodes . '</h4>');
        redirect(base_url() . "index.php/Complaintmodecategory/index");
    }

    public function updatecomplaintmodes() {

        $addcomplaintmodes = new registercomplaint();
        $addcompmodes = $addcomplaintmodes->updatecomplaintcategories();
//        redirect(base_url() . "index.php/Complaintmode/index");
    }

    public function servicecomplaintmodeslist() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getcomplaintmodelist();
        return json_encode($compmodeslists->result_array);
    }

    public function servicecomplaintmodesandcategory() {

        $compmodeslist = new registercomplaint();
        $compmodeslists = $compmodeslist->getcomplaintmodesandcategory();
        return json_encode($compmodeslists->result_array);
    }

}
