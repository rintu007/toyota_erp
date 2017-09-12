<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Estimatebodyshop extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_estimatebodyshop');
        $this->load->model('s_estimatesmechanical');
        $this->load->model('s_jobreferencemanual');
        $this->load->model('s_partsrequistionmechanical');
        $this->load->model('s_customer');
        $this->load->model('s_vehicle');
        $this->load->model('s_allbrands');
        $this->load->model('s_allmodels');
        $this->load->model('s_allvehicles');
        $this->load->model('s_repairorder');
        $this->load->model('s_staff');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {
        $dataArray = array();
        $partReqMechanicalModel = new s_partsrequistionmechanical();
        $jobRefManual = new S_jobreferencemanual();
        $allBrands = new S_allbrands();
        $staffManagment = new S_staff();
        $dataArray['allJobs'] = $jobRefManual->getBodyPaintJobs();
        $dataArray['serviceAdvList'] = $staffManagment->getServiceAdvisor();
        $dataArray['brandsList'] = $allBrands->getAllBrands();
        $dataArray['surveyorList'] = $this->getAllSurveyor();
        $dataArray['insCompanyList'] = $this->getAllInsuranceCompany();
        $dataArray['partsList'] = $partReqMechanicalModel->fillPartCombo();
//        $dataArray['insCompanyBranchList'] = $this->getAllInsuranceCompanyBranch();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('header');
        $this->load->view('estimatebodyshop', $dataArray);
        $this->load->view('footer');
    }
	
	function edit() {
        $dataArray = array();
        $partReqMechanicalModel = new s_partsrequistionmechanical();
        $jobRefManual = new S_jobreferencemanual();
        $allBrands = new S_allbrands();
        $staffManagment = new S_staff();
        $dataArray['allJobs'] = $jobRefManual->getBodyPaintJobs();
        $dataArray['serviceAdvList'] = $staffManagment->getServiceAdvisor();
        $dataArray['brandsList'] = $allBrands->getAllBrands();
        $dataArray['surveyorList'] = $this->getAllSurveyor();
        $dataArray['insCompanyList'] = $this->getAllInsuranceCompany();
        $dataArray['partsList'] = $partReqMechanicalModel->fillPartCombo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('header');
        $this->load->view('edit_estimatebodyshop', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $bodyshopEstModel = new S_estimatebodyshop();
        $mechEstimateModel = new S_estimatesmechanical();
        $newSNo = $bodyshopEstModel->getSerialNumber();
        $isExist = $mechEstimateModel->isEstimateExist('s_estimate', 'SerialNumber', 0, $newSNo);
        if (!$isExist) {
            $newRow = $this->input->post('newRow');
            $newPartsRow = $this->input->post('newPartsRow');
            $estimateData = array(
                'SerialNumber' => $newSNo,
                'idCustomerDetail' => $this->getCustomer(),
                'idVehicle' => $this->getVehicle(),
                'Date' => date("Y-m-d", strtotime($this->input->post('Date'))),
                'Attender' => $this->input->post('ATTN'),
                'idInsuranceCompany' =>  $this->input->post('Insurance') == 'Select Insurance Company' ? Null  : $this->input->post('Insurance'),
                'idInsuranceCompanyDetail' => $this->input->post('Branch') == 'Select Branch' ? Null : $this->input->post('Branch'),
                'PolicyNumber' => $this->input->post('PolicyNubmber'),
                'idSurveyor' => $this->input->post('SurveyorName') == 'Select Surveyor' ? Null : $this->input->post('SurveyorName')  ,
                'LossNumber' => $this->input->post('LossNumber'),
                'PMC' => $this->input->post('PMC'),
                'ServiceAdvisor' => 6,
                'Creator' => $this->input->post('ServiceAdvisor'),
                'Range' => $this->input->post('Range'),
                'isMechanical' => 0,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertEstimateData = $bodyshopEstModel->InsertEstimateBodyShop($estimateData);
            if ($newRow == "-") {
                $this->addEstimateJob();
            }
            if ($newPartsRow == "-") {
                $this->addPartsEstimate();
            }
               $this->addSubletUseage();
            
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">' . $insertEstimateData . $newSNo . '</label>');
        } else {
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">Estimate already Opened fot this Number</label>');
        }
        redirect(base_url() . "index.php/estimatebodyshop/index");
    }
	
	
	
  function addSubletUseage() {
  $mechEstimateModel = new S_estimatebodyshop();
        $subletData = array();
        //$repairOrderModel = new S_repairorder();
        if (!empty($_POST['SubletDate'])) {
            $subletDate = $_POST['SubletDate'];
        } else {
            $subletDate = NULL;
        }
        if (!empty($_POST['SubletQunatity'])) {
            $subletQty = $_POST['SubletQunatity'];
        } else {
            $subletQty = NULL;
        }
        if (!empty($_POST['SubletRef'])) {
            $subletRef = $_POST['SubletRef'];
        } else {
            $subletRef = NULL;
        }

        if (!empty($_POST['SubletDesc'])) {
            $subletDesc = $_POST['SubletDesc'];
        } else {
            $subletDesc = NULL;
        }

        if (!empty($_POST['SubletAmount'])) {
            $subletAmount = $_POST['SubletAmount'];
        } else {
            $subletAmount = NULL;
        }
        if ($subletQty != NULL) {
            for ($count = 0; $count < count($subletQty); $count++) {
                $subletData[] = array(
                    'idEstimate' => $mechEstimateModel->getIdEstimateBodyShop(),
                    'SubletRepairDate' => $subletDate[$count],
                    'Quantity' => $subletQty[$count],
                    'Reference' => $subletRef[$count],
                    'Description' => $subletDesc[$count],
                    'SubletRepairAmount' => $subletAmount[$count],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
            $insertSubletUseage = $this->db->insert_batch('s_estimatesubletrepairuseage', $subletData);
        }
    }
	
	
  function editSubletUseage($idEstimate) {
         $mechEstimateModel = new S_estimatebodyshop();
        $subletData = array();
        //$repairOrderModel = new S_repairorder();
        if (!empty($_POST['SubletDate'])) {
            $subletDate = $_POST['SubletDate'];
        } else {
            $subletDate = NULL;
        }
        if (!empty($_POST['SubletQunatity'])) {
            $subletQty = $_POST['SubletQunatity'];
        } else {
            $subletQty = NULL;
        }
        if (!empty($_POST['SubletRef'])) {
            $subletRef = $_POST['SubletRef'];
        } else {
            $subletRef = NULL;
        }

        if (!empty($_POST['SubletDesc'])) {
            $subletDesc = $_POST['SubletDesc'];
        } else {
            $subletDesc = NULL;
        }

        if (!empty($_POST['SubletAmount'])) {
            $subletAmount = $_POST['SubletAmount'];
        } else {
            $subletAmount = NULL;
        }
        if ($subletQty != NULL) {
            for ($count = 0; $count < count($subletQty); $count++) {
                $subletData[] = array(
                    'idEstimate' => $idEstimate,
                    'SubletRepairDate' => $subletDate[$count],
                    'Quantity' => $subletQty[$count],
                    'Reference' => $subletRef[$count],
                    'Description' => $subletDesc[$count],
                    'SubletRepairAmount' => $subletAmount[$count],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
            $insertSubletUseage = $this->db->insert_batch('s_estimatesubletrepairuseage', $subletData);
        }
    }

  function addEstimateJob() {

        $estimateJobData = array();
        $bodyshopEstModel = new S_estimatebodyshop();
        $jobDesc = $_POST['BodyJobDesc'];
        $jobDescAmount = $_POST['BodyJobAmount'];
        
        if ($jobDesc == "Select Job") {
            $jobDesc = 0;
        }

        for ($count = 0; $count < count($jobDesc); $count++) {
            $estimateJobData[] = array(
                'idEstimate' => $bodyshopEstModel->getIdEstimateBodyShop(),
                'idJob' => 1,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive'],
				'JobDescription'  => $jobDesc[$count].'||'.$jobDescAmount[$count],
				'JobAmount'       => $jobDescAmount[$count]
            );
        }
        $this->db->insert_batch('s_estimate_jobdescription', $estimateJobData);
    }
	
  function editEstimateJob($idEstimate) {
       
       $estimateJobData = array();
        $bodyshopEstModel = new S_estimatebodyshop();
        $jobDesc = $_POST['BodyJobDesc'];
        $jobDescAmount = $_POST['BodyJobAmount'];
       
        if ($jobDesc == "Select Job") {
            $jobDesc = 0;
        }

        for ($count = 0; $count < count($jobDesc); $count++) {
            $estimateJobData[] = array(
                'idEstimate' => $idEstimate,
                'idJob' => 1,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive'],
				'JobDescription'  => $jobDesc[$count].'||'.$jobDescAmount[$count],
				'JobAmount'       => $jobDescAmount[$count]
            );
			
        }
        $result =  $this->db->insert_batch('s_estimate_jobdescription', $estimateJobData);
       
    }

  function addPartsEstimate() {

        $estimatePartsData = array();
        $bodyshopEstModel = new S_estimatebodyshop();
        $partsName = $_POST['PartsName'];

        if ($partsName == "Select Part Name") {
            $partsName = 0;
        }

        for ($count = 0; $count < count($partsName); $count++) {
            $estimatePartsData[] = array(
                'idEstimate' => $bodyshopEstModel->getIdEstimateBodyShop(),
                'idPart' => $partsName[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $this->db->insert_batch('s_estimate_partsdescription', $estimatePartsData);
    }
	
  function editPartsEstimate($idEstimate) {

        $estimatePartsData = array();
        $bodyshopEstModel = new S_estimatebodyshop();
        $partsName = $_POST['PartsName'];

        if ($partsName == "Select Part Name") {
            $partsName = 0;
        }

        for ($count = 0; $count < count($partsName); $count++) {
            $estimatePartsData[] = array(
                'idEstimate' => $idEstimate,
                'idPart' => $partsName[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $this->db->insert_batch('s_estimate_partsdescription', $estimatePartsData);
    }

  function getCustomer() {

        $customerModel = new S_customer();
        $isExistCustomer = $customerModel->isExistCustomer($this->input->post('CustomerName'), $this->input->post('CustomerContact'));
        if ($isExistCustomer != NULL) {
            return $isExistCustomer;
        } else {
            $getfieldsValue = $this->getFieldsValue();
            $customerData = array(
                'CompanyName' => $this->input->post('CompanyName'),
                'CompanyContact' => $this->input->post('CompanyContact'),
                'CustomerName' => $this->input->post('CustomerName'),
                'AddressDetails' => $this->input->post('CustomerAddress'),
                'Cnic' => NULL,
                'Ntn' => $this->input->post('NTN'),
                'Cellphone' => $this->input->post('CustomerContact'),
                'PhoneOne' => $this->input->post('PhoneOne'),
                'PhoneTwo' => $this->input->post('PhoneTwo'),
                'CustomerEmail' => $this->input->post('CustomerEmail'),
                'Fax' => $this->input->post('CustomerFax'),
                'isPotentialCustomer' => 0,
                'CreatedDate' => $getfieldsValue['CreatedDate'],
                'ModifiedDate' => $getfieldsValue['ModifiedDate'],
                'isActive' => $getfieldsValue['isActive'],
				'Gst'      => $this->input->post('GST_NUMBER')
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
        $variantModel = new S_allvehicles();
        $idVariant = $_POST['Make'];
        if ($idVariant === "Select Make") {
            if ($_POST['inputMake'] != NULL) {
                $idAllVehicle = $variantModel->getIdAllVehicles($_POST['inputMake']);
                $isExistVehicle = $vehicleModel->isExistVehicle($idAllVehicle, $this->input->post('RegistrationNumber'));
                if ($isExistVehicle != NULL) {
                    return $isExistVehicle;
                } else {
                    $getfieldsValue = $this->getFieldsValue();
                    $vehicleData = array(
                        'idVariant' => $idAllVehicle,
                        'idCustomer' => $this->getCustomer(),
                        'VehicleName' => NULL,
                        'Model' => $this->input->post('Model'),
                        'Year' => $this->input->post('Year'),
                        'RegistrationNumber' => $this->input->post('RegistrationNumber'),
                        'EngineNumber' => $this->input->post('EngineNumber'),
                        'ChassisNumber' => $this->input->post('ChassisNumber'),
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
        } else {
            if ($idVariant != NULL) {
                $isExistVehicle = $vehicleModel->isExistVehicle($idVariant, $this->input->post('RegistrationNumber'));
                if ($isExistVehicle != NULL) {
                    return $isExistVehicle;
                } else {
                    $getfieldsValue = $this->getFieldsValue();
                    $vehicleData = array(
                        'idVariant' => $idVariant,
                        'idCustomer' => $this->getCustomer(),
                        'VehicleName' => NULL,
                        'Model' => $this->input->post('Model'),
                        'Year' => $this->input->post('Year'),
                        'RegistrationNumber' => $this->input->post('RegistrationNumber'),
                        'EngineNumber' => $this->input->post('EngineNumber'),
                        'ChassisNumber' => $this->input->post('ChassisNumber'),
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
            if ($isExistVehicle != NULL) {
                return $isExistVehicle;
            } else {
                $getfieldsValue = $this->getFieldsValue();
                $vehicleData = array(
                    'idVariant' => NULL,
                    'idCustomer' => $this->getCustomer(),
                    'VehicleName' => NULL,
                    'Model' => $this->input->post('Model'),
                    'Year' => $this->input->post('Year'),
                    'RegistrationNumber' => $this->input->post('RegistrationNumber'),
                    'EngineNumber' => $this->input->post('EngineNumber'),
                    'ChassisNumber' => $this->input->post('ChassisNumber'),
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
    }

  function getModel() {

        $allModels = new S_allmodels();
        $search = $this->input->post('brand');
        $modelSearch = $allModels->getFilteredModels($search);
        $models = json_encode($modelSearch);
        echo $models;
    }

  function getAllVehicles() {

        $allVehicles = new S_allvehicles();
        $model = $this->input->post('model');
        $search = $allVehicles->getFilteredVehicles($model);
        $filteredVehicles = json_encode($search);
        echo $filteredVehicles;
    }

  function getJobDetails() {
        $jobRefManual = new S_jobreferencemanual();
        $idJob = $this->input->post('idJob');
        $jobDetails = $jobRefManual->getBPJobDetails($idJob);
        echo json_encode($jobDetails);
    }

  function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

  function searchExistingCustomer() {

        $repairOrderModel = new S_repairorder();
        $searchyReg = $this->input->post('searchbyreg');
        $isExist = $repairOrderModel->searchisExistCustomerbody($searchyReg);
        $isExistingCustomer = json_encode($isExist);
        echo $isExistingCustomer;
    }

    // Function for Get Surveyor
  function getAllSurveyor() {
        $this->db->select('*');
        $this->db->from('s_surveyor');
        $this->db->where('s_surveyor.isActive', 1);
        $surveyorList = $this->db->get();
        return $surveyorList->result_array();
    }

  function getSurveyorDetails() {
        $surveyorName = $this->input->post('SurveyorName');
        $this->db->select('*');
        $this->db->from('s_surveyor');
        $this->db->where('s_surveyor.Name', $surveyorName);
        $this->db->where('s_surveyor.isActive', 1);
        $data = $this->db->get()->result_array();
        $surveyorList = json_encode($data);
        echo $surveyorList;
    }

    // Function for Get Surveyor
  function getAllInsuranceCompany() {
        $this->db->select('*');
        $this->db->from('s_insurancecompany ic');
        $this->db->where('ic.isActive', 1);
        $insCompanyList = $this->db->get();
        return $insCompanyList->result_array();
    }

  function getAllInsuranceCompanyBranch() {
        $this->db->select('*');
        $this->db->from('s_insurancecompany_detail icd');
        $this->db->where('icd.isActive', 1);
        $insCompanyBranchList = $this->db->get();
        return $insCompanyBranchList->result_array();
    }

  function getInsuranceCompanyDetails() {
        $idInsuranceCompany = $this->input->post('idInsuranceCompany');
        $this->db->select('*');
        $this->db->from('s_insurancecompany ic');
        $this->db->join('s_insurancecompany_detail icd', 'icd.idInsuranceCompany = ic.idInsuranceCompany');
        $this->db->where('ic.idInsuranceCompany', $idInsuranceCompany);
        $this->db->where('ic.isActive', 1);
        $data = $this->db->get()->result_array();
        $insCompanyDetailList = json_encode($data);
        echo $insCompanyDetailList;
    }

    // Function for get Parts Details
  function getPartDetails() {
        $bodyshopEstModel = new S_estimatebodyshop();
        $idPart = $this->input->post('idPart');
        $PartDetails = $bodyshopEstModel->getPartDetails($idPart);
        echo json_encode($PartDetails);
    }
	
	
  function save_edit() {

        $bodyshopEstModel = new S_estimatebodyshop();
        $mechEstimateModel = new S_estimatesmechanical();
        $SNo = $this->input->post('searchbyreg');
        $idEstimate =  $bodyshopEstModel->get_idestimate($SNo);
		
            $newRow = $this->input->post('newRow');
            $newPartsRow = $this->input->post('newPartsRow');
            $estimateData = array(
                'idCustomerDetail' => $this->getCustomer(),
                'idVehicle' => $this->getVehicle(),
                'Date' => date("Y-m-d", strtotime($this->input->post('Date'))),
                'Attender' => $this->input->post('ATTN'),
                'idInsuranceCompany' =>  $this->input->post('Insurance') == 'Select Insurance Company' ? Null  : $this->input->post('Insurance'),
                'idInsuranceCompanyDetail' => $this->input->post('Branch') == 'Select Branch' ? Null : $this->input->post('Branch'),
                'PolicyNumber' => $this->input->post('PolicyNubmber'),
                'idSurveyor' => $this->input->post('SurveyorName') == 'Select Surveyor' ? Null : $this->input->post('SurveyorName')  ,
                'LossNumber' => $this->input->post('LossNumber'),
                'PMC' => $this->input->post('PMC'),
                'ServiceAdvisor' => 6,
                'Creator' => $this->input->post('ServiceAdvisor'),
                'Range' => $this->input->post('Range'),
                'isMechanical' => 0,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertEstimateData = $bodyshopEstModel->UpdateEstimateBodyShop($estimateData,$SNo);
            if ($newRow == "-") {
				$bodyshopEstModel->delete_estimatejob($SNo);
                $this->editEstimateJob($idEstimate);
            }
            if ($newPartsRow == "-") {
				$bodyshopEstModel->delete_estimatepart($SNo);
                $this->editPartsEstimate($idEstimate);
            }
			   $bodyshopEstModel->delete_estimatesublet($SNo);
               $this->editSubletUseage($idEstimate);
            
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">' . $insertEstimateData . '</label>');
         
            redirect(base_url() . "index.php/estimatebodyshop/edit");
    }


}
