<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Inquiryhistory extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Registerinquiry');
    }

    public function index() {

        $Data = array();
        $Data['allclosedinquiries'] = $this->serviceallclosedinquiries();
        $Data['route'] = $this->serviceroute();
        $Data['complaintrelation'] = $this->servicecomplaintrelation();
        $Data['complaintuserskills'] = $this->serviceuserskills();
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('inquiryhistory', $Data);
        $this->load->view('crpanelfooter');
    }

    public function updateinquiry() {

        $updateataken = new Registerinquiry();
        $uactiontaken = $updateataken->updateinquiryform();
        $this->session->set_flashdata('updatemessage', '<h4>' . $uactiontaken . '</h4>');
        redirect(base_url() . "index.php/inquiryhistory/index");
    }

    public function serviceallclosedinquiries() {

        $getallcomplaints = new Registerinquiry();
        $getallcomplaintss = $getallcomplaints->getallclosedinquiries();
        return json_encode($getallcomplaintss->result_array);
    }

    public function servicefilteredclosedinquiries() {

        $getfilteredcomplaint = new Registerinquiry();
        $getfilteredcomplaints = $getfilteredcomplaint->getfilteredclosedinquiry();
        echo json_encode($getfilteredcomplaints->result_array);
    }

    public function serviceroute() {

        $complaintrelation = new Registerinquiry();
        $getroute = $complaintrelation->getroute();
        return json_encode($getroute->result_array);
    }

    public function servicecomplaintmode() {

        $complaintrelation = new Registerinquiry();
        $getcomplaintmode = $complaintrelation->getcomplaintmode();
        return json_encode($getcomplaintmode->result_array);
    }

    public function servicecomplaintrelation() {

        $complaintrelation = new Registerinquiry();
        $getcomplaintrelation = $complaintrelation->getcomplaintrelationlist();
        return json_encode($getcomplaintrelation->result_array);
    }

    public function serviceuserskills() {

        $complaintrelation = new Registerinquiry();
        $getuserskills = $complaintrelation->getuserskills();
        return json_encode($getuserskills->result_array);
    }

}
