<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class AllEstimatesmech extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_estimatesmechanical');
        $this->load->model('s_allestimatesmech');
        $this->load->model('s_customer');
        $this->load->model('s_vehicle');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $mechEstimateModel = new S_allestimatesmech();
        $result = $mechEstimateModel->selectAllMechEstimates();
		for($j=0;$j<count($result);$j++){
		$result[$j]['PartsP'] =  	$mechEstimateModel->selectPartsbyEsitmateNoTotal($result[$j]['idEstimate']);
		$result[$j]['SubletP'] =  	$mechEstimateModel->selectSubletbyEsitmateNoTotal($result[$j]['idEstimate']);
		}
		//var_dump($result);die;
		$dataArray['allEstimates'] = $result;
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('header');
        $this->load->view('allestimatesmech', $dataArray);
        $this->load->view('footer');
    }
	
	    function pm_package($id) {

        $this->db->select('PeriodName');
        $this->db->from('s_periodicmaintenance');
        $result = $this->db->where('idPeriodicMaintenance',$id)->get()->result_array();
	//	var_dump($result);die;
		if($result){
			return $result[0]['PeriodName'];
		}
    }

    function Add() {

        $mechEstimateModel = new S_estimatesmechanical();
        $newRow = $this->input->post('newRow');
        $estimateData = array(
            'SerialNumber' => $this->input->post('SNO'),
            'idCustomerDetail' => $this->getCustomer(),
            'idVehicle' => $this->getVehicle(),
            'Date' => $this->getFieldsValue()['CreatedDate'],
            'Attender' => $this->input->post('ATTN'),
            'InsuranceCompany' => NULL,
            'PolicyNumber' => NULL,
            'SurveyorName' => NULL,
            'SurveyorPhone' => NULL,
            'Branch' => NULL,
            'LossNumber' => NULL,
            'PMC' => NULL,
            'ServiceAdvisor' => $this->input->post('ServiceAdvisor'),
            'isMechanical' => 1,
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $insertEstimateData = $mechEstimateModel->InsertEstimateMechanical($estimateData);
        if ($newRow == "-") {
            $addEstimateJob = $this->addEstimateJob();
        }
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertEstimateData . '</h4>');
        redirect(base_url() . "index.php/estimatemechanical/index");
    }

    function printEstimate($estNo) {

        $mechEstimateModel = new S_allestimatesmech();
        $estimateData['Estimate'] = $mechEstimateModel->selectbyEsitmateNo($estNo);
        $estimateData['Parts'] = $mechEstimateModel->selectPartsbyEsitmateNo($estNo);
        $estimateData['Sublet'] = $mechEstimateModel->selectSubletbyEsitmateNo($estNo);
		//var_dump($estimateData);die;
        $this->load->view('header');
        $this->load->view('estimatereceipt', $estimateData);
        $this->load->view('footer');

//        $this->session->set_flashdata('gatepasscreated', '<h4>' . $updateRO . '</h4>');
//        redirect(base_url() . "index.php/rogatepass/index");
    }


    function search() {

        $mechEstimateModel = new S_allestimatesmech();
        $search = $this->input->post('searchbyest');
        $receivedData['other'] = $mechEstimateModel->selectOneMechEstimate($search);
        $receivedData['jobs'] = $mechEstimateModel->selectOneMechEstimateJobs($search);
        $oneEstimate = json_encode($receivedData);
        echo $oneEstimate;
    }

    function addEstimateJob() {

        $estimateJobData = array();
        $mechEstimateModel = new S_estimatesmechanical();
        $jobDesc = $_POST['MechJobDesc'];
        $jobAmount = $_POST['MechJobAmount'];
        if ($jobDesc == NULL) {
            $jobDesc = 0;
        }
        for ($count = 0; $count < count($jobDesc); $count++) {
            $estimateJobData[] = array(
                'idEstimate' => $mechEstimateModel->getIdEstimateMechanical(),
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
                'Cnic' => '',
                'Ntn' => '',
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
        }
        return $idCustomer;
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
