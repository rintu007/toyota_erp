<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Complainthistory extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['allclosedcomplaints'] = $this->serviceallclosedcomplaints();
        $Data['route'] = $this->serviceroute();
        $Data['complaintmode'] = $this->servicecomplaintmode();
        $Data['complaintrelation'] = $this->servicecomplaintrelation();
        $Data['complaintuserskills'] = $this->serviceuserskills();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('complainthistory', $Data);
        $this->load->view('crpanelfooter');
    }

    public function updatecomplaintform() {

        $updateataken = new registercomplaint();
        $uactiontaken = $updateataken->updatecomplaintform_();
        $this->session->set_flashdata('insertmessage', '<h4>' . $uactiontaken . '</h4>');
        redirect(base_url() . "index.php/complainthistory/index");
    }

    public function serviceallclosedcomplaints() {

        $getallcomplaints = new registercomplaint();
        $getallcomplaintss = $getallcomplaints->getallclosedcomplaints();
        return json_encode($getallcomplaintss->result_array);
    }

    public function servicefilteredclosedcomplaint() {

        $getfilteredcomplaint = new registercomplaint();
        $getfilteredcomplaints = $getfilteredcomplaint->getfilteredclosedcomplaint();
        echo json_encode($getfilteredcomplaints->result_array);
    }

    public function serviceroute() {

        $complaintrelation = new registercomplaint();
        $getroute = $complaintrelation->getroute();

        return json_encode($getroute->result_array);
    }

    public function servicecomplaintmode() {

        $complaintrelation = new registercomplaint();
        $getcomplaintmode = $complaintrelation->getcomplaintmode();
        return json_encode($getcomplaintmode->result_array);
    }

    public function servicecomplaintrelation() {

        $complaintrelation = new registercomplaint();
        $getcomplaintrelation = $complaintrelation->getcomplaintrelation();
        return json_encode($getcomplaintrelation->result_array);
    }

    public function serviceuserskills() {

        $complaintrelation = new registercomplaint();
        $getuserskills = $complaintrelation->getuserskills();
        return json_encode($getuserskills->result_array);
    }

    public function servicegetcompmodecategory() {

        $registercomplaint = new registercomplaint();
        $getcomplaintmode = $registercomplaint->getcompmodecategory();
        echo json_encode($getcomplaintmode->result_array);
    }

}
