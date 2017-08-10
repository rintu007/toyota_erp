<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Inquiry extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Registerinquiry');
    }

    public function index() {

        $Data = array();
        $Data['inquiryroute'] = $this->serviceroute();
        $Data['inquiryrelation'] = $this->serviceinquiryrelation();
        $Data['inquiryuserskills'] = $this->serviceuserskills();
        $Data['variants'] = $this->servicevariants();
        $Data['padnumber'] = $this->servicecheckinquirynumber();
        $Data['insertmessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('inquiry', $Data);
        $this->load->view('crpanelfooter');
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

    public function serviceinquiryrelation() {

        $complaintrelation = new Registerinquiry();
        $getcomplaintrelation = $complaintrelation->getinquiryrelation();
        return json_encode($getcomplaintrelation->result_array);
    }

    public function serviceinquirydepart() {

        $complaintrelation = new Registerinquiry();
        $getcomplaintrelation = $complaintrelation->getinquirydepart();
        return json_encode($getcomplaintrelation->result_array);
    }

    public function serviceapprole() {

        $getapproles = new Registerinquiry();
        $getapproless = $getapproles->getapproles();
        echo json_encode($getapproless->result_array);
    }

    public function serviceuserskills() {

        $complaintrelation = new Registerinquiry();
        $getuserskills = $complaintrelation->getuserskills();
        return json_encode($getuserskills->result_array);
    }

    public function servicecomplainstatus() {

        $complainstatus = new Registerinquiry();
        $getcomplainstatus = $complainstatus->getcomplainstatus();
        return json_encode($getcomplainstatus->result_array);
    }

    public function serviceexistingcustomer() {

        $getapproles = new Registerinquiry();
        $getapproless = $getapproles->getexistingcustomer();
        echo json_encode($getapproless);
    }

    public function servicegetuserinfo() {

        $getapproles = new Registerinquiry();
        $getapproless = $getapproles->getuserinfo();
        echo json_encode($getapproless->result_array);
    }

    public function serviceexistcustomerdata() {

        $check = new Registerinquiry();
        $checks = $check->getexistcustomerdata();
        echo json_encode($checks);
    }

    public function servicecheckinquirynumber() {

        $check = new Registerinquiry();
        $checks = $check->checkinquirynum();
        return $checks;
    }

    public function servicevehicle() {

        $complaintrelation = new Registerinquiry();
        $getvehcile = $complaintrelation->getvehicle();
        return json_encode($getvehcile->result_array);
    }

    public function servicevariants() {

        $complaintrelation = new Registerinquiry();
        $getapproless = $complaintrelation->getvariants();
        return json_encode($getapproless->result_array);
    }

    public function registerinquiry() {

        $complaintrelation = new Registerinquiry();
        $inquiryRegistered = $complaintrelation->registerinquiry_();

        $this->session->set_flashdata('insertmessage', '<label style="margin-left:130px;margin-top:20px;font-weight: bolder;font-size:30px;">' . $inquiryRegistered . '</label>');
        redirect(base_url() . "index.php/inquiry/index");
    }

    public function registercustomerdetail() {

        $registercustomerdetail = new Registerinquiry();
        $customerdetail = $registercustomerdetail->registercustomerdetail_();
    }

    public function registervehicledetail() {

        $registervehicledetail = new Registerinquiry();
        $vehicledetail = $registervehicledetail->registervehicledetail_();
    }

    public function sharecomplaint() {

        $sharecomplaint = new Registerinquiry();
        $sharecomplaint = $sharecomplaint->sharecomplaint_();
    }

    public function updatecomplaint($updatefield) {

        $updatecomplaint = new Registerinquiry();
        $ucomplaint = $updatecomplaint->updatecomplaint_();
    }

    public function servicegetdepartments() {

        $complaintrelation = new Registerinquiry();
        $getcomplaintmode = $complaintrelation->getdepartments();
        echo json_encode($getcomplaintmode->result_array);
    }

}
