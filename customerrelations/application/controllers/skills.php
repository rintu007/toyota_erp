<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Skills extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['skillslist'] = $this->serviceskillslist();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('skills', $Data);
        $this->load->view('crpanelfooter');
    }

    public function addskills() {

        $skills = new registercomplaint();
        $addSkills = $skills->addskills_();
        $this->session->set_flashdata('insertmessage', '<h4>' . $addSkills . '</h4>');
        redirect(base_url() . "index.php/skills/index");
    }

    public function updateskills() {

        $skills = new registercomplaint();
        $updateSkills = $skills->updateskills_();
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateSkills . '</h4>');
        redirect(base_url() . "index.php/skills/index");
    }

    public function serviceskillslist() {

        $modeslist = new registercomplaint();
        $modeslists = $modeslist->getskillslist();
        return json_encode($modeslists->result_array);
    }

}
