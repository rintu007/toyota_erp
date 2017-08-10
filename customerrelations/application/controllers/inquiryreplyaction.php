<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Inquiryreplyaction extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Registerinquiry');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['allinquiries'] = $this->serviceallinquiries();
        $Data['complaintrelation'] = $this->servicegetrelation();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('inquiryreplyaction', $Data);
        $this->load->view('crpanelfooter');
    }

    public function sale() {
        $Data = array();
        $Data['allinquiries'] = $this->serviceallinquiriessale();
        $Data['complaintrelation'] = $this->servicegetrelation();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('Feedback', $Data);
        $this->load->view('crpanelfooter');
    }
    public function service() {

        $Data = array();
        $Data['allinquiries'] = $this->serviceallinquiriesservice();
        $Data['complaintrelation'] = $this->servicegetrelation();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('Feedback', $Data);
        $this->load->view('crpanelfooter');
    }
    
    public function parts() {

        $Data = array();
        $Data['allinquiries'] = $this->serviceallinquiriesparts();
        $Data['complaintrelation'] = $this->servicegetrelation();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('Feedback', $Data);
        $this->load->view('crpanelfooter');
    }
    
     public function finance() {

        $Data = array();
        $Data['allinquiries'] = $this->serviceallinquiriesfinance();
        $Data['complaintrelation'] = $this->servicegetrelation();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('crpanelheader');
        $this->load->view('Feedback', $Data);
        $this->load->view('crpanelfooter');
    }
    
    public function updatereplyaction() {

        $updatereplyaction = new Registerinquiry();
        $updatereplyactions = $updatereplyaction->updatereplyaction_();
        $this->session->set_flashdata('insertmessage', '<h4>' . $updatereplyactions . '</h4>');
        redirect(base_url() . "index.php/inquiryreplyaction/index");
    }

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

    public function servicefilteredinquiry() {

        $getfilteredinquiry = new Registerinquiry();
        $getfilteredinquiries = $getfilteredinquiry->getfilteredinquiry();
        echo json_encode($getfilteredinquiries->result_array);
    }

    public function servicefilteredinquirysharing() {

        $getfilteredinquiry = new Registerinquiry();
        $getfilteredinquiries = $getfilteredinquiry->getfilteredinquirysharing();
        echo json_encode($getfilteredinquiries);
    }

    public function servicecontactdetaildescription() {

        $complaintrelation = new Registerinquiry();
        $getcontactdetaildescriptions = $complaintrelation->getcontactdetaildescription();
        echo json_encode($getcontactdetaildescriptions->result_array);
    }

    public function servicesaleprocessdescription() {

        $getsaleprocessdescription = new Registerinquiry();
        $getsaleprocessdescriptions = $getsaleprocessdescription->getsaleprocessdescription();
        echo json_encode($getsaleprocessdescriptions->result_array);
    }

    public function servicesalesubprocessdescription() {

        $getsalesubprocessdescription = new Registerinquiry();
        $getfilteredcomplaintss = $getsalesubprocessdescription->getsalesubprocessdescription();
        echo json_encode($getfilteredcomplaintss->result_array);
    }

    
    public function serviceallinquiriessale() {

        $getallinquiries = new Registerinquiry();
        $getallinquiriess = $getallinquiries->getallinquiriessale();
        return json_encode($getallinquiriess->result_array);
    }
     public function serviceallinquiriesservice() {

        $getallinquiries = new Registerinquiry();
        $getallinquiriess = $getallinquiries->getallinquiriesservice();
        return json_encode($getallinquiriess->result_array);
    }
     public function serviceallinquiriesparts() {

        $getallinquiries = new Registerinquiry();
        $getallinquiriess = $getallinquiries->getallinquiriesparts();
        return json_encode($getallinquiriess->result_array);
    }
    public function serviceallinquiriesfinance() {

        $getallinquiries = new Registerinquiry();
        $getallinquiriess = $getallinquiries->getallinquiriesfinance();
        return json_encode($getallinquiriess->result_array);
    }
}
