<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Inquirymessagebox extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

          
        
        
        $Data = array();
        $Data['allinquiries'] = $this->serviceinquirymessage();
        $Data['complaintrelation'] = $this->servicecomplaintrelation();
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('inquirymessagebox', $Data);
        $this->load->view('crpanelfooter');
    }

    public function updatecomplaintfeedback() {

        $updateataken = new registercomplaint();
        $uactiontaken = $updateataken->doupdatecomplaintfeedback();
        $this->session->set_flashdata('updatemessage', '<h4>' . $uactiontaken . '</h4>');
        redirect(base_url() . "index.php/inquirymessagebox/index");
    }

    public function serviceinquirymessage() {

        $getallcomplaints = new registercomplaint();
        $getallcomplaintss = $getallcomplaints->inquiriesformessage();
        return json_encode($getallcomplaintss->result_array);
    }

    public function servicefilteredinquirymessage() {

        $getfilteredcomplaint = new registercomplaint();
        $getfilteredcomplaints = $getfilteredcomplaint->getfilteredinquirymessage();
        echo json_encode($getfilteredcomplaints->result_array);
    }

    public function servicecomplaintrelation() {

        $complaintrelation = new registercomplaint();
        $getcomplaintrelation = $complaintrelation->getcomplaintrelation();
        return json_encode($getcomplaintrelation->result_array);
    }

    public function servicefilteredcomplaint() {

        $getfilteredcomplaint = new registercomplaint();
        $getfilteredcomplaints = $getfilteredcomplaint->getfilteredcomplaint();
        echo json_encode($getfilteredcomplaints->result_array);
    }

    public function servicecontactdetaildescription() {

        $getcontactdetaildescription = new registercomplaint();
        $getcontactdetaildescriptions = $getcontactdetaildescription->getfilteredcontactdetaillist();
        echo json_encode($getcontactdetaildescriptions->result_array);
    }

    public function servicesaleprocessdescription() {

        $getsaleprocessdescription = new registercomplaint();
        $getsaleprocessdescriptions = $getsaleprocessdescription->getsaleprocessdescription();
        echo json_encode($getsaleprocessdescriptions->result_array);
    }

    public function servicesalesubprocessdescription() {

        $getsalesubprocessdescription = new registercomplaint();
        $getfilteredcomplaintss = $getsalesubprocessdescription->getsalesubprocessdescription();
        echo json_encode($getfilteredcomplaintss->result_array);
    }

}
