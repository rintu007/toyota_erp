<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Faqs extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['faqslist'] = $this->servicefaqslist();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('faqs', $Data);
        $this->load->view('crpanelfooter');
    }

    public function addfaqs() {

        $addfaqs = new registercomplaint();
        $addfaqss = $addfaqs->addfaqs_();
         $this->session->set_flashdata('insertmessage', '<h4>' . $addfaqss . '</h4>');
        redirect(base_url() . "index.php/Faqs/index");
    }

    public function servicefaqslist() {

        $faqslist = new registercomplaint();
        $faqslists = $faqslist->getfaqslist();
        return json_encode($faqslists->result_array);
    }

    public function servicegetquestionsanswers() {

        $faqslist = new registercomplaint();
        $faqslists = $faqslist->getquestionsanswers();
        echo json_encode($faqslists->result_array);
    }

}
