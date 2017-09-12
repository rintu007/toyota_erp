<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Actiontaken extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['allcomplaints'] = $this->serviceallcomplaints();
        $Data['complaintrelation'] = $this->servicecomplaintrelation();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('actiontaken', $Data);
        $this->load->view('crpanelfooter');
    }

    public function updatecomplaintactiontaken() {

        $updateataken = new registercomplaint();
        $uactiontaken = $updateataken->updatecomplaintactiontaken_();
        $this->session->set_flashdata('insertmessage', '<h4>' . $uactiontaken . '</h4>');
        redirect(base_url() . "index.php/actiontaken/index");
    }

    public function serviceallcomplaints() {

        $getallcomplaints = new registercomplaint();
        $getallcomplaintss = $getallcomplaints->getallcomplaints();
        return json_encode($getallcomplaintss->result_array);
    }

    public function servicesearchallcomplaints() {

        $getallcomplaints = new registercomplaint();
        $getallcomplaintss = $getallcomplaints->getsearchallcomplaints();
        echo json_encode($getallcomplaintss);
    }

    public function servicecomplaintrelation() {

        $complaintrelation = new registercomplaint();
        $getcomplaintrelation = $complaintrelation->getcomplaintrelation();
        return json_encode($getcomplaintrelation->result_array);
    }

    public function servicefilteredcomplaint() {

        $getfilteredcomplaint = new registercomplaint();
        $getfilteredcomplaints = $getfilteredcomplaint->getfilteredcomplaint();
    }

    public function servicefilteredcomplaintsharing() {

        $getfilteredcomplaint = new registercomplaint();
        $getfilteredcomplaints = $getfilteredcomplaint->getfilteredcomplaintsharing();
        echo json_encode($getfilteredcomplaints);
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
