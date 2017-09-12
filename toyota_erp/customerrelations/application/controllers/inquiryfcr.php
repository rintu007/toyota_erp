<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Inquiryfcr extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Registerinquiry');
    }

    public function index() {

        $Data = array();
        $Data['allnonfcrinquiries'] = $this->serviceallnonfcrinquiries();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('inquiryfcr', $Data);
        $this->load->view('crpanelfooter');
    }

    public function serviceallnonfcrinquiries() {

        $getallinquiries = new Registerinquiry();
        $getallinquiriess = $getallinquiries->getallnonfcrinquiries();
        return json_encode($getallinquiriess->result_array);
    }

    public function servicefilterednonfcrinquiry() {

        $getfilteredinquiry = new Registerinquiry();
        $getfilteredinquiries = $getfilteredinquiry->getfilterednonfcrinquiry();
        echo json_encode($getfilteredinquiries->result_array);
    }

    public function registernonfcrform() {

        $updatereplyaction = new Registerinquiry();
        $updatereplyactions = $updatereplyaction->registernonfcrform_();
        $this->session->set_flashdata('insertmessage', '<h4>' . $updatereplyactions . '</h4>');
        redirect(base_url() . "index.php/inquiryfcr/index");
    }

}
