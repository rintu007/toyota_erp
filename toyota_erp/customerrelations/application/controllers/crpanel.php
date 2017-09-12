<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Crpanel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
       $this->load->model('Registerinquiry');
       $this->load->model('registercomplaint');
       $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $regcomplaint = new registercomplaint();
//        $Data['complaintuserskills'] = $this->serviceuserskills();
//        $Data['allclosedinquiries'] = $this->serviceallclosedinquiries();
//        $Data['route'] = $this->serviceroute();
//        $Data['allinquiries'] = $this->serviceinquirymessage();
//        $Data['complaintrelation'] = $this->servicecomplaintrelation();
//        $Data['allcomplaints'] = $this->servicecomplaintmessage();
        $Data['allcomplaints'] = $this->serviceallcomplaints();
        $Data["noofcomplaints"] = $regcomplaint->getNumberComplaintMessage();
        $Data["noofinquiries"] = $regcomplaint->getNumberInquiryMessage();
        $Data["noofcomplaintfeedback"] = $regcomplaint->getReturnComplaint();
        $Data["noofinquiryfeedback"] = $regcomplaint->getReturnInquiry();
        $Data['allinquiries'] = $this->serviceallinquiries();
        $Data['complaintrelation'] = $this->servicegetrelation();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('crpanel', $Data);
        $this->load->view('crpanelfooter');
    }
    
//     public function serviceinquirymessage() {
//
//        $getallcomplaints = new registercomplaint();
//        $getallcomplaintss = $getallcomplaints->inquiriesformessage();
//        return json_encode($getallcomplaintss->result_array);
//    }
//    
//     public function servicecomplaintrelation() {
//
//        $complaintrelation = new registercomplaint();
//        $getcomplaintrelation = $complaintrelation->getcomplaintrelation();
//        return json_encode($getcomplaintrelation->result_array);
//    }
//     public function servicecomplaintmessage() {
//
//        $getallcomplaints = new registercomplaint();
//        $getallcomplaintss = $getallcomplaints->complaintsformessage();
//        return json_encode($getallcomplaintss->result_array);
//    }
//
//    public function serviceallclosedinquiries() {
//
//        $getallcomplaints = new Registerinquiry();
//        $getallcomplaintss = $getallcomplaints->getallclosedinquiries();
//        return json_encode($getallcomplaintss->result_array);
//    }
//    public function serviceroute() {
//
//        $complaintrelation = new Registerinquiry();
//        $getroute = $complaintrelation->getroute();
//        return json_encode($getroute->result_array);
//    }
//    public function serviceuserskills() {
//
//        $complaintrelation = new Registerinquiry();
//        $getuserskills = $complaintrelation->getuserskills();
//        return json_encode($getuserskills->result_array);
//    }
    
    
    
    
     public function serviceallinquiries() {

        $getallinquiries = new Registerinquiry();
        $getallinquiriess = $getallinquiries->getallinquiries();
        return json_encode($getallinquiriess->result_array);
    }
    public function servicegetrelation() {

        $complaintrelation = new Registerinquiry();
        $getcomplaintrelation = $complaintrelation->getcomplaintrelationlist();
        return json_encode($getcomplaintrelation->result_array);
    }
    public function serviceallcomplaints() {

        $getallcomplaints = new registercomplaint();
        $getallcomplaintss = $getallcomplaints->getallcomplaints();
        return json_encode($getallcomplaintss->result_array);
    }
}
