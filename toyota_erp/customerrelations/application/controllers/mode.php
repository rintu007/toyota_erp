<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mode extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['modeslist'] = $this->servicemodeslist();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('mode', $Data);
        $this->load->view('crpanelfooter');
    }

    public function addmodes() {

        $addmodes = new registercomplaint();
        $addmodess = $addmodes->addmodes_();
        $this->session->set_flashdata('insertmessage', '<h4>' . $addmodess . '</h4>');
        redirect(base_url() . "index.php/Mode/index");
    }

    public function updatemodes() {

        $updatemode = new registercomplaint();
        $updatemodes = $updatemode->updatemodes_();
        $this->session->set_flashdata('updatemessage', '<h4>' . $updatemodes . '</h4>');
        redirect(base_url() . "index.php/Mode/index");
    }

    public function servicemodeslist() {

        $modeslist = new registercomplaint();
        $modeslists = $modeslist->getmodesslist();
        return json_encode($modeslists->result_array);
    }

}
