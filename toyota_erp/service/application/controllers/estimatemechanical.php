<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Estimatemechanical extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('s_token');
        $this->load->model('s_estimatesmechanical');
        $this->load->model('s_jobreferencemanual');
        $this->load->model('s_partsrequistionmechanical');
        $this->load->model('s_staff');
        $this->load->model('s_customer');
        $this->load->model('s_vehicle');
        $this->load->model('s_allbrands');
        $this->load->model('s_allmodels');
        $this->load->model('s_allvehicles');
        $this->load->model('s_repairorder');
		$this->load->model('s_periodicmaintenancedetails');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index($token = null) {

        $dataArray = array();
        $dataArray['token'] = $this->s_token->selectOnetoken($token);
        $jobRefManual = new S_jobreferencemanual();
        $partReqMechanicalModel = new s_partsrequistionmechanical();
        $staffManagment = new S_staff();
        $allBrands = new S_allbrands();
		 $pmdModel = new S_periodicmaintenancedetails();
        $dataArray['brandsList'] = $allBrands->getAllBrands();
//        $dataArray['serialNumber'] = $mechEstimateModel->getSerialNumber();
        $dataArray['allJobs'] = $jobRefManual->selectAllOtherJobs();
        $dataArray['serviceAdvList'] = $staffManagment->getServiceAdvisor();
        $dataArray['partsList'] = $partReqMechanicalModel->fillPartCombo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['pmdList'] = $pmdModel->getAllPmd();
        $dataArray['customer_list'] = $this->s_customer->customer_list( ($token==null)?null:$dataArray['token']->idCustomer);

        $this->load->view('header');
        $this->load->view('estimatemechanical', $dataArray);
        $this->load->view('footer');
    }
	
	public function edit()
	{
		$dataArray = array();
        $jobRefManual = new S_jobreferencemanual();
        $partReqMechanicalModel = new s_partsrequistionmechanical();
        $staffManagment = new S_staff();
        $allBrands = new S_allbrands();
		$pmdModel = new S_periodicmaintenancedetails();
        $dataArray['brandsList'] = $allBrands->getAllBrands();
        $dataArray['allJobs'] = $jobRefManual->selectAllOtherJobs();
        $dataArray['serviceAdvList'] = $staffManagment->getServiceAdvisor();
        $dataArray['partsList'] = $partReqMechanicalModel->fillPartCombo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['pmdList'] = $pmdModel->getAllPmd();
        $this->load->view('header');
        $this->load->view('edit_estimatemechanical', $dataArray);
        $this->load->view('footer');
		
	}

    function Add() {
        $mechEstimateModel = new S_estimatesmechanical();
        $newSNo = $mechEstimateModel->getSerialNumber();
        $isExist = $mechEstimateModel->isEstimateExist('s_estimate', 'SerialNumber', 1, $newSNo);
        if (!$isExist) {
            $newRow = $this->input->post('newRow');
            $newPartsRow = $this->input->post('newPartsRow');
			$newRowSublet = $this->input->post('newRowSubletBP');
            $estimateData = array(
                'SerialNumber' => $newSNo,
                'idCustomerDetail' => $this->getCustomer(),
                'idVehicle' => $this->getVehicle(),
                'Date' => date("Y-m-d", strtotime($this->input->post('Date'))),
                'Attender' => $this->input->post('ATTN'),
                'InsuranceCompany' => NULL,
                'PolicyNumber' => NULL,
                'SurveyorName' => NULL,
                'SurveyorPhone' => NULL,
                'Branch' => NULL,
                'LossNumber' => NULL,
                'PMC' => NULL,
                'ServiceAdvisor' => 6,
                'Creator' => $this->input->post('ServiceAdvisor'),
                'Range' => $this->input->post('Range'),
                'isMechanical' => 1,
                'idToken' => isset($_POST['idToken'])?($_POST['idToken']):null,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
			  $is_PM = $this->input->post('is_PM');
			
			  if ($is_PM == 1){
				  $estimateData['is_PM'] = intval($is_PM);
				  $estimateData['PM_package'] = $this->input->post('pm_package');
				  $estimateData['PM_amount'] =  $this->input->post('pm_amount');
				//die("sahi". $is_PM);
			}else{
				//die("galat". $is_PM);
				
			}
            $insertEstimateData = $mechEstimateModel->InsertEstimateMechanical($estimateData);
            if ($newRow == "-") {
                $this->addEstimateJob();
            }
            if ($newPartsRow == "-") {
                $this->addPartsEstimate();
            }if ($newRowSublet == "-") {
               $this->addSubletUseage();
            }
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">' . $insertEstimateData . $newSNo . '</label>');
        } else {
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">Estimate already Opened for this Number</label>');
        }
        redirect(base_url() . "index.php/estimatemechanical/index");
    }
	
	 function addSubletUseage() {
  $mechEstimateModel = new S_estimatesmechanical();
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
                    'idEstimate' => $mechEstimateModel->getIdEstimateMechanical(),
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
         $mechEstimateModel = new S_estimatesmechanical();
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
        $mechEstimateModel = new S_estimatesmechanical();
        $jobDesc = $_POST['MechJobDesc'];
        if ($jobDesc == "Select Job") {
            $jobDesc = 0;
        }
        for ($count = 0; $count < count($jobDesc); $count++) {
            $estimateJobData[] = array(
                'idEstimate' => $mechEstimateModel->getIdEstimateMechanical(),
                'idJob' => $jobDesc[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $this->db->insert_batch('s_estimate_jobdescription', $estimateJobData);
    }
	
	function editEstimateJob($idEstimate) {

        $estimateJobData = array();
        $mechEstimateModel = new S_estimatesmechanical();
        $jobDesc = $_POST['MechJobDesc'];
        if ($jobDesc == "Select Job") {
            $jobDesc = 0;
        }
        for ($count = 0; $count < count($jobDesc); $count++) {
            $estimateJobData[] = array(
                'idEstimate' => $idEstimate,
                'idJob' => $jobDesc[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $this->db->insert_batch('s_estimate_jobdescription', $estimateJobData);
    }

    function addPartsEstimate() {

        $estimatePartsData = array();
        $mechEstimateModel = new S_estimatesmechanical();
        $partsName = $_POST['PartsName'];

        if ($partsName == "Select Part Name") {
            $partsName = 0;
        }

        for ($count = 0; $count < count($partsName); $count++) {
            $estimatePartsData[] = array(
                'idEstimate' => $mechEstimateModel->getIdEstimateMechanical(),
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
        $mechEstimateModel = new S_estimatesmechanical();
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
        if($_POST['idCustomer']!='')
            return $_POST['idCustomer'];
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
                'Cnic' => '',
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
        }
        return $idCustomer;
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
        $jobDetails = $jobRefManual->getMechJobDetails($idJob);
        echo json_encode($jobDetails);
    }

    function searchExistingCustomer() {

        $repairOrderModel = new S_repairorder();
        $searchyReg = $this->input->post('searchbyreg');
        $isExist = $repairOrderModel->searchisExistCustomer($searchyReg);
        $isExistingCustomer = json_encode($isExist);
        echo $isExistingCustomer;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }
	
	public function getamount()
	{
		$id  =  $this->input->post('id');
		$range =  $this->input->post('range');
		$model = new S_periodicmaintenancedetails();
		$amount =  $model->getamount($id , $range);
		echo json_encode($amount);
	}
	
	public function save_edit()
	{
        $mechEstimateModel = new S_estimatesmechanical();
        $SNo = $this->input->post('searchbyreg');
		$idEstimate =  $mechEstimateModel->get_idestimate($SNo);

            $newRow = $this->input->post('newRow');
            $newPartsRow = $this->input->post('newPartsRow');
			$newRowSublet = $this->input->post('newRowSubletBP');
            $estimateData = array(
                
                'idCustomerDetail' => $this->getCustomer(),
                'idVehicle' => $this->getVehicle(),
                'Date' => date("Y-m-d", strtotime($this->input->post('Date'))),
                'Attender' => $this->input->post('ATTN'),
                'InsuranceCompany' => NULL,
                'PolicyNumber' => NULL,
                'SurveyorName' => NULL,
                'SurveyorPhone' => NULL,
                'Branch' => NULL,
                'LossNumber' => NULL,
                'PMC' => NULL,
                'ServiceAdvisor' => 6,
                'Creator' => $this->input->post('ServiceAdvisor'),
                'Range' => $this->input->post('Range'),
                'isMechanical' => 1,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
			  $is_PM = $this->input->post('is_PM');
			
			  if ($is_PM == 1){
				  $estimateData['is_PM'] = intval($is_PM);
				  $estimateData['PM_package'] = $this->input->post('pm_package');
				  $estimateData['PM_amount'] =  $this->input->post('pm_amount');
				//die("sahi". $is_PM);
			}else{
				//die("galat". $is_PM);
				
			}
            $insertEstimateData = $mechEstimateModel->UpdateEstimateMechanical($estimateData,$SNo);
            if ($newRow == "-") {
				$mechEstimateModel->delete_estimatejob($SNo);
                $this->editEstimateJob($idEstimate);
            }
            if ($newPartsRow == "-") {
				$mechEstimateModel->delete_estimatepart($SNo);
                $this->editPartsEstimate($idEstimate);
            }if ($newRowSublet == "-") {
			   $mechEstimateModel->delete_estimatesublet($SNo);	
               $this->editSubletUseage($idEstimate);
            }
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">' . $insertEstimateData . $newSNo . '</label>');
         
        redirect(base_url() . "index.php/estimatemechanical/edit");
	}

}
