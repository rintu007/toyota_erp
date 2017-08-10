<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Appointment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('s_repairorder');
        $this->load->model('s_rochecklist');
        $this->load->model('s_rofinance');
        $this->load->model('s_financeinfo');
        $this->load->model('s_fuelmanagement');
        $this->load->model('s_jobreferencemanual');
        $this->load->model('s_partsuseage');
        $this->load->model('s_subletrepairuseage');
        $this->load->model('s_luboiluseage');
        $this->load->model('s_staff');
        $this->load->model('s_customer');
        $this->load->model('s_vehicle');
        $this->load->model('s_bodypaint');
        $this->load->model('s_allbrands');
        $this->load->model('s_allmodels');
        $this->load->model('s_allvehicles');
        $this->load->model('s_bodypaint');
        $this->load->model('s_conditionconfirmationdetail');
        $this->load->model('s_periodicmaintenancedetails');
        $this->load->model('s_jobprogresscontrolboard');
        $this->load->model('s_bays');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {
        $dataArray = array();
        $repairOrderModel = new S_repairorder();
        $checkListModel = new S_Rochecklist();
        $financeModel = new S_financeinfo();
        $jobRefManual = new S_jobreferencemanual();
        $fuelManagment = new S_fuelmanagement();
        $staffManagment = new S_staff();
        $allBrands = new S_allbrands();
        $allVehicles = new S_allvehicles();
        $allModels = new S_allmodels();
        $pmdModel = new S_periodicmaintenancedetails();
        $conditionModel = new S_conditionconfirmationdetail();
        $dataArray['ROMode'] = $repairOrderModel->getROModes();
        $dataArray['RONumber'] = $repairOrderModel->generateRONumber();
        $dataArray['condConfirm'] = $conditionModel->getConditionDetail();
        $dataArray['partsList'] = $repairOrderModel->fillPartCombo();
        $dataArray['checkList'] = $checkListModel->getAllRoCheckList();
        $dataArray['financeInfoList'] = $financeModel->getFinanceInfo();
        $dataArray['mechanicalJobs'] = $jobRefManual->getMechanicalJobs();
        $dataArray['bodyPaintJobs'] = $jobRefManual->getBodyPaintJobs();
        $dataArray['fuelVolume'] = $fuelManagment->getFuelInfo();
        $dataArray['gasVolume'] = $repairOrderModel->getGasInfo();
        $dataArray['technicianList'] = $staffManagment->getTechnicianStaff();
        $dataArray['serviceAdvList'] = $staffManagment->getServiceAdvisor();
        $dataArray['foremanList'] = $staffManagment->getForemanStaff();
        $dataArray['brandsList'] = $allBrands->getAllBrands();
        $dataArray['pmdList'] = $pmdModel->getAllPmd();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('appointment', $dataArray);
        $this->load->view('footer');
    }

    function Add() {
        $JPCB = new S_jobprogresscontrolboard();
        $scheduleAppointment = $JPCB->ScheduleAppointment();
        if ($scheduleAppointment) {
            $Response = '<h4 style="background-color: green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Appointment Has Been Scheduled.</h4>';
            $this->session->set_flashdata('Appointment', $Response);
            redirect(base_url() . "index.php/jpcb/");
        } else {
            $Response = '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Failed To Schedule Appointment</h4>';
            $this->session->set_flashdata('Appointment', $Response);
            redirect(base_url() . "index.php/jpcb/");
        }
    }

    function CheckPartsStock() {
        $JPCB = new S_jobprogresscontrolboard();
        $idPart = $this->input->post('idPart');
        $PartDetails = $JPCB->GetParts($idPart);
        if ($PartDetails == "Out of Stock") {
            echo "Out of Stock";
        } else {
            echo json_encode($PartDetails);
        }
    }

}
