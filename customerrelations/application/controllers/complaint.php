<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Complaint extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['route'] = $this->serviceroute();
        $Data['complaintmode'] = $this->servicecomplaintmode();
        $Data['complaintrelation'] = $this->servicecomplaintrelation();
        $Data['complaintuserskills'] = $this->serviceuserskills();
        $Data['variants'] = $this->servicevariants();
        $Data['padnumber'] = $this->servicecheckcomplaintnum();
        $Data['insertmessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('complaint', $Data);
        $this->load->view('crpanelfooter');
    }

    public function servicevehicle() {

        $complaintrelation = new registercomplaint();
        $getvehcile = $complaintrelation->getvehicle();
        return json_encode($getvehcile->result_array);
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

    public function servicegetcompmodecategory() {

        $complaintrelation = new registercomplaint();
        $getcomplaintmode = $complaintrelation->getcompmodecategory();
        echo json_encode($getcomplaintmode->result_array);
    }

    public function servicecomplaintrelation() {

        $complaintrelation = new registercomplaint();
        $getcomplaintrelation = $complaintrelation->getcomplaintrelation();
        return json_encode($getcomplaintrelation->result_array);
    }

    public function serviceapprole() {

        $getapproles = new registercomplaint();
        $getapproless = $getapproles->getapproles();
        echo json_encode($getapproless->result_array);
    }

    public function servicevariants() {

        $getapproles = new registercomplaint();
        $getapproless = $getapproles->getvariants();
        return json_encode($getapproless->result_array);
    }

    public function serviceuserskills() {

        $complaintrelation = new registercomplaint();
        $getuserskills = $complaintrelation->getuserskills();
        return json_encode($getuserskills->result_array);
    }

    public function servicecomplainstatus() {

        $complainstatus = new registercomplaint();
        $getcomplainstatus = $complainstatus->getcomplainstatus();
        return json_encode($getcomplainstatus->result_array);
    }

    public function serviceexistingcustomer() {

        $getapproles = new registercomplaint();
        $getapproless = $getapproles->getexistingcustomer();
        echo json_encode($getapproless);
    }

    public function servicegetuserinfo() {

        $getapproles = new registercomplaint();
        $getapproless = $getapproles->getuserinfo();
        echo json_encode($getapproless->result_array);
    }

    public function registercomplaint() {

        $complaintrelation = new registercomplaint();
        $complaintRegistered = $complaintrelation->registercomplaint_();
        $this->session->set_flashdata('insertmessage', '<label style="margin-left:130px;margin-top:20px;font-weight: bolder;font-size:30px;">' . $complaintRegistered . '</label>');
        redirect(base_url() . "index.php/complaint/index");
    }

    public function registercustomerdetail() {

        $registercustomerdetail = new registercomplaint();
        $customerdetail = $registercustomerdetail->registercustomerdetail_();
    }

    public function registervehicledetail() {

        $registervehicledetail = new registercomplaint();
        $vehicledetail = $registervehicledetail->registervehicledetail_();
    }

    public function sharecomplaint() {

        $sharecomplaint = new registercomplaint();
        $sharecomplaint = $sharecomplaint->sharecomplaint_();
    }

    public function serviceexistcustomerdata() {

        $check = new registercomplaint();
        $checks = $check->getexistcustomerdata();
        echo json_encode($checks);
    }

    public function servicecheckcomplaintnum() {

        $check = new registercomplaint();
        $checks = $check->checkcomplaintnum();
        return $checks;
    }

    public function servicegetdepartments() {

        $complaintrelation = new registercomplaint();
        $getcomplaintmode = $complaintrelation->getdepartments();
        echo json_encode($getcomplaintmode->result_array);
//        echo json_encode($getcomplaintmode->result_array);
    }    
   

}
