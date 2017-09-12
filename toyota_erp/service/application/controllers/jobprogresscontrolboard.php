<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jobprogresscontrolboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('S_bays');
        $this->load->model('S_jobreferencemanual');
        $this->load->model('S_jobprogresscontrolboard');
        $this->load->library('form_validation');
    }

    function index() {
        $Bays = new S_bays();
//     try {
//            $url = 'http://203.215.160.179:8083/corporate_sms2/api/auth.jsp?msisdn=923458242070&password=UTFURB';
//            $xml = new SimpleXMLElement(file_get_contents($url, true));
//            $SessioSMS = $xml->data;
//            echo $SesioSMS;
//            $Customer = $Bays->Bays();
//            print_r($Customer);
//            $ptn = "/^0/";  // Regex
//            $str = $Customer['mobile_number']; //Your input, perhaps $_POST['textbox'] or whatever
//            $rpltxt = "92";  // Replacement string
//            $r = preg_replace($ptn, $rpltxt, $str);
////            $url = 'http://203.215.160.179:8083/corporate_sms2/api/sendsms.jsp?session_id=' . $SessioSMS . '&to=' . $Customer['mobile_number'] . '&text=Dear ' . $Customer['BayName'] . ', Thank You For Buying Puro 1L Regards FD';
//            $url = 'http://203.215.160.179:8083/corporate_sms2/api/sendsms.jsp?session_id=' . $SessioSMS . '&to=' . $r . '&text=Dear ' . $Customer['BayName'];
//            echo '<br>';
//            echo $url;
//            echo '<br>';
//            $file_get_contents = file_get_contents($url);
//            print_r($file_get_contents);
//        } catch (Exception $e) {
//        }

        $JobRefManual = new S_jobreferencemanual();
        $Jpcb = new S_jobprogresscontrolboard();
        $AllBays = $Bays->AllBays();
        $AllJobRef = $JobRefManual->AllJobRef();
        $Data['Bays'] = json_encode($AllBays);
        $Data['JobRef'] = json_encode($AllJobRef);
        $Data['AllJpcb'] = json_encode($Jpcb->AllJPCB());

        $this->load->view('jobprogresscontrolboard', $Data);
    }

    function Add() {
        $JPCB = new S_jobprogresscontrolboard();
        $Bay = $this->input->post('Bay');
        $Description = $this->input->post('Description');
        $JobRef = $this->input->post('JobRef');
        $StartTime = $this->input->post('StartTime');
        $EndTime = $this->input->post('EndTime');
        $StartMin = $this->input->post('StartMin');
        $EndMin = $this->input->post('EndMin');
        $TotalTime = $this->input->post('TotalTime');
        $RegNo = $this->input->post('RegNo');
        $StartDate = $this->input->post('StartDate');
        $StartMonth = $this->input->post('StartMonth') + 1;
        $StartYear = $this->input->post('StartYear');
        $EndDate = $this->input->post('EndDate');
        $EndMonth = $this->input->post('EndMonth') + 1;
        $EndYear = $this->input->post('EndYear');

        $sDate = $StartYear . '-' . $StartMonth . '-' . $StartDate;
        $eDate = $EndYear . '-' . $EndMonth . '-' . $EndDate;

        $JPCBData = array(
            'RegistrationNumber' => $RegNo,
            'Description' => $Description,
            'idJobPerform' => $JobRef,
            'idBay' => $Bay,
            'StartDate' => $sDate,
            'EndDate' => $eDate,
            'StartTime' => $StartTime,
            'EndTime' => $EndTime,
            'StartMin' => $StartMin,
            'EndMin' => $EndMin,
            'TotalTime' => $TotalTime,
        );
        $InsertJPCB = $JPCB->InsertJpcb($JPCBData);
        if ($InsertJPCB) {
            return 'Success';
        } else {
            return 'Failed';
        }
    }

    function GetJobRef() {
        $JobRefManual = new S_jobreferencemanual();
        $AllJobRef = $JobRefManual->AllJobRef();
        echo json_encode($AllJobRef);
    }

}
