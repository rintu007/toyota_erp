<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Allestimatesbshop extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_estimatebodyshop');
        $this->load->model('s_allestimatesbshop');
        $this->load->model('s_customer');
        $this->load->model('s_vehicle');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {
        $dataArray = array();
        $bshopEstModel = new S_allestimatesbshop();
        $result = $bshopEstModel->selectAllBShopEstimates();
		for($j=0;$j<count($result);$j++){
		$result[$j]['PartsP'] =  	$bshopEstModel->selectPartsbyEsitmateNoTotal($result[$j]['idEstimate']);
		$result[$j]['SubletP'] =  	$bshopEstModel->selectSubletbyEsitmateNoTotal($result[$j]['idEstimate']);
		}
		$dataArray['allEstimates'] = $result;
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('header');
        $this->load->view('allestimatesbshop', $dataArray);
        $this->load->view('footer');
    }

    function printEstimate($estNo) {

        $bshopEstModel = new S_allestimatesbshop();
        $estimateData['Estimate'] = $bshopEstModel->selectbyEsitmateNo($estNo);
		 $estimateData['Parts'] = $bshopEstModel->selectPartsbyEsitmateNo($estNo);
        $estimateData['Sublet'] = $bshopEstModel->selectSubletbyEsitmateNo($estNo);
        $this->load->view('header');
        $this->load->view('estimatereceipt', $estimateData);
        $this->load->view('footer');

//        $this->session->set_flashdata('gatepasscreated', '<h4>' . $updateRO . '</h4>');
//        redirect(base_url() . "index.php/rogatepass/index");
    }

    function Add() {

        $bodyshopEstModel = new S_estimatebodyshop();
        $newRow = $this->input->post('newRow');

        $estimateData = array(
            'SerialNumber' => $this->input->post('SNO'),
            'idCustomerDetail' => $this->getCustomer(),
            'idVehicle' => $this->getVehicle(),
            'Date' => $this->getFieldsValue()['CreatedDate'],
            'Attender' => $this->input->post('ATTN'),
            'InsuranceCompany' => $this->input->post('Insurance'),
            'PolicyNumber' => $this->input->post('PolicyNubmber'),
            'SurveyorName' => $this->input->post('SurveyorName'),
            'SurveyorPhone' => $this->input->post('SurveyorPhone'),
            'Branch' => $this->input->post('Branch'),
            'LossNumber' => $this->input->post('LossNumber'),
            'PMC' => $this->input->post('PMC'),
            'ServiceAdvisor' => $this->input->post('ServiceAdvisor'),
            'isMechanical' => 0,
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $insertEstimateData = $bodyshopEstModel->InsertEstimateBodyShop($estimateData);

        if ($newRow == "-") {
            $addEstimateJob = $this->addEstimateJob();
        }

        $this->session->set_flashdata('insertmessage', '<h4>' . $insertEstimateData . '</h4>');
        redirect(base_url() . "index.php/estimatebodyshop/index");
    }

    function search() {

        $bshopEstModel = new S_allestimatesbshop();
        $search = $this->input->post('searchbyest');
        $receivedData['other'] = $bshopEstModel->selectOneBShopEstimate($search);
        $receivedData['jobs'] = $bshopEstModel->selectOneMechEstimateJobs($search);
        $oneEstimate = json_encode($receivedData);
        echo $oneEstimate;
	// echo $receivedData;
    }

    function addEstimateJob() {

        $estimateJobData = array();
        $bodyshopEstModel = new S_estimatebodyshop();
        $jobDesc = $_POST['BodyJobDesc'];
        $jobAmount = $_POST['BodyJobAmount'];

        if ($jobDesc == NULL) {
            $jobDesc = 0;
        }

        for ($count = 0; $count < count($jobDesc); $count++) {
            $estimateJobData[] = array(
                'idEstimate' => $bodyshopEstModel->getIdEstimateBodyShop(),
                'JobDescription' => $jobDesc[$count],
                'Amount' => $jobAmount[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $inserEstimateJob = $this->db->insert_batch('s_estimate_jobdescription', $estimateJobData);
    }

    function getCustomer() {

        $customerModel = new S_customer();
        $isExistCustomer = $customerModel->isExistCustomer($this->input->post('CustomerName'), $this->input->post('CustomerContact'));
        if ($isExistCustomer != NULL) {
            return $isExistCustomer;
        } else {
            $getfieldsValue = $this->getFieldsValue();
            $customerData = array(
                'CustomerName' => $this->input->post('CustomerName'),
                'AddressDetails' => $this->input->post('CustomerAddress'),
                'Cnic' => NULL,
                'Ntn' => NULL,
                'Cellphone' => $this->input->post('CustomerContact'),
                'Fax' => $this->input->post('CustomerFax'),
                'isPotentialCustomer' => 0,
                'CreatedDate' => $getfieldsValue['CreatedDate'],
                'ModifiedDate' => $getfieldsValue['ModifiedDate'],
                'isActive' => $getfieldsValue['isActive']
            );
            $insertCustomer = $customerModel->InsertCustomer($customerData);
            if ($insertCustomer === "Successfully Inserted") {
                $idCustomer = $customerModel->selectOneCustomer();
            }
            return $idCustomer;
        }
    }

    function getVehicle() {

        $vehicleModel = new S_vehicle();
        $isExistVehicle = $vehicleModel->isExistVehicle($this->input->post('Make'), $this->input->post('RegistrationNumber'));
        if ($isExistVehicle != NULL) {
            return $isExistVehicle;
        } else {
            $getfieldsValue = $this->getFieldsValue();
            $vehicleData = array(
                'VehicleName' => $this->input->post('Make'),
                'Model' => $this->input->post('Model'),
                'Year' => $this->input->post('Year'),
                'RegistrationNumber' => $this->input->post('RegistrationNumber'),
                'EngineNumber' => $this->input->post('EngineNumber'),
                'ChassisNumber' => $this->input->post('FrameNumber'),
                'Mileage' => $this->input->post('KM'),
                'isEstimate' => 1,
                'CreatedDate' => $getfieldsValue['CreatedDate'],
                'ModifiedDate' => $getfieldsValue['ModifiedDate'],
                'isActive' => $getfieldsValue['isActive']
            );
            $insertVehicle = $vehicleModel->InsertVehicle($vehicleData);
            if ($insertVehicle === "Successfully Inserted") {
                $idVehicle = $vehicleModel->selectOneVehicle();
            }
            return $idVehicle;
        }
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
