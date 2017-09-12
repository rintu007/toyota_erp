<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Message extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['allcomplaints'] = $this->servicecomplaintmessage();
        $Data['complaintrelation'] = $this->servicecomplaintrelation();
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('message', $Data);
        $this->load->view('crpanelfooter');
    }

    public function updatecomplaintfeedback() {

        $updateataken = new registercomplaint();
        $uactiontaken = $updateataken->doupdatecomplaintfeedback();
        $this->session->set_flashdata('updatemessage', '<h4>' . $uactiontaken . '</h4>');
        redirect(str_replace('customerrelations/','',base_url())."/index.php/login/menu");
        
    }

    public function servicecomplaintmessage() {

        $getallcomplaints = new registercomplaint();
        $getallcomplaintss = $getallcomplaints->complaintsformessage();
        return json_encode($getallcomplaintss->result_array);
    }

    public function servicecomplaintrelation() {

        $complaintrelation = new registercomplaint();
        $getcomplaintrelation = $complaintrelation->getcomplaintrelation();
        return json_encode($getcomplaintrelation->result_array);
    }

    public function servicefilteredcomplaintmessage() {

        $getfilteredcomplaint = new registercomplaint();
        $getfilteredcomplaints = $getfilteredcomplaint->getfilteredcomplaintmessage();
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
