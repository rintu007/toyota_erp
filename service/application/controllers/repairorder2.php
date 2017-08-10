<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Repairorder extends CI_Controller {

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
		$dataArray['subModesM'] = $repairOrderModel->getSubModesMech();
		$dataArray['subModesW'] = $repairOrderModel->getSubModeWarr();
		$dataArray['subModesB'] = $repairOrderModel->getSubModeBP();
		$dataArray['subModesC'] = $repairOrderModel->getSubModeCW();
		$dataArray['custype'] = $repairOrderModel->getAllCustype();
//        $dataArray['RONumber'] = $repairOrderModel->generateRONumber();
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
        $this->load->view('repairorder', $dataArray);
        $this->load->view('footer');
    }
	function testData(){
		$repairOrderModel = new S_repairorder();
		$dataArray['subModes'] = $repairOrderModel->getSubModeCW();
		print_r($dataArray['subModes']);
	}

    function Add() {

        $repairOrderModel = new S_repairorder();
        $financeInfoModel = new S_financeinfo();
        $conditionModel = new S_conditionconfirmationdetail();
        $isFIR = $this->input->post('isFIR');
        $isWorkOrderAttach = $this->input->post('isWorkOrder');
        $isOrignalTools = $this->input->post('isOrignial');
        $idRoMode = $this->input->post('isM');
		$idSubRoMode = $this->input->post('subType');
        $newRow = $this->input->post('newRow');
        $newRowParts = 0;
        $newRowSublet = 0;
        $newRowLub = 0;
        $approvedLabour = 0;
        $getJob = $this->input->post('roModeType');
        $idFinance = $this->input->post('FinanceList');
        $netTotal = 0;
        $newRONumber = $repairOrderModel->generateRONumber();
        $isExist = $repairOrderModel->isRecordExist('s_repairorderbill', 'RONumber', $newRONumber);
        if (!$isExist) {
            $financeName = $financeInfoModel->selectOneFinanceInfo($idFinance);
            if ($financeName === 'Others') {
                $otherFinance = $this->input->post('InputOther');
            } else {
                $otherFinance = NULL;
            }

            if ($isFIR == "1") {
                $isFIR = 1;
            } else {
                $isFIR = 0;
            }

            if ($isWorkOrderAttach == "1") {
                $isWorkOrderAttach = 1;
            } else {
                $isWorkOrderAttach = 0;
            }

            if ($isOrignalTools == "1") {
                $isOrignalTools = 1;
            } else {
                $isOrignalTools = 0;
            }

            if ($this->input->post('idStaff') === "Select Technician") {
                $idStaff = NULL;
            } else {
                $idStaff = $this->input->post('idStaff');
            }

            if ($this->input->post('Foreman') === "Select Foreman") {
                $idForeman = NULL;
            } else {
                $idForeman = $this->input->post('Foreman');
            }

            if (!empty($_POST['isRepeatRO'])) {
                $isRepeatRO = $this->input->post('isRepeatRO');
            } else {
                $isRepeatRO = 0;
            }

            if (!empty($_POST['idEstimate'])) {
                $idEstimate = $this->input->post('idEstimate');
            } else {
                $idEstimate = NULL;
            }
			//$uniqueid = $this->session->userdata('productkey');
			//mkdir("./assets/warrantydetail/$newRONumber");
			// Upload Program
			$config['upload_path'] = './assets/warrantydetail/' . $newRONumber;
			$config['allowed_types'] = 'jpg|jpeg|png|PNG|pdf';
			$config['max_size'] = '3000000';
			//$config['file_name'] = $newRONumber;
			$config['overwrite'] = false;
		
			$this->load->library('upload', $config);
			$this->upload->do_upload('trReport');
			$this->upload->do_upload('edrReport');
			$this->upload->do_upload('vehicalImage');
		
			$imagename1 = $_POST['trReport'];
			$imagename2 = $_POST['edrReport'];
			$imagename3 = $_POST['vehicalImage'];
		
            $idCustomer = $this->getCustomer();
            $repairOrderData = array(
                'idCustomerDetail' => $idCustomer,
                'idVehicle' => $this->getVehicle(),
                'idFinance' => $idFinance,
                'idFuel' => $this->input->post('FuelVolume'),
                'idCNG' => $this->input->post('CNGVolume'),
                'idLPG' => $this->input->post('LPGVolume'),
                'RONumber' => $newRONumber,
                'CashMemoNumber' => $this->input->post('CashMemo'),
                'CreditMemoNumber' => $this->input->post('CreditMemo'),
                'BookInDate' => date("Y-m-d", strtotime($this->input->post('BookDate'))),
                'BookInTime' => $this->input->post('BookTime'),
                'DeliveryDate' => date("Y-m-d", strtotime($this->input->post('DeliveryDate'))),
                'DeliveryTime' => $this->input->post('DeliveryTime'),
                'VOC' => $this->input->post('VOC'),
                'LabourAmount' => 0,
                'LubOilAmount' => 0,
                'SubletRepairAmount' => 0,
                'PartsAmount' => 0,
                'GrandTotal' => 0,
                'GSTax' => 0,
                'NetTotal' => $netTotal,
                'isWorkOrderAttach' => $isWorkOrderAttach,
                'isPSFU' => 0,
                'idStaff' => $idStaff,
                'idForeman' => $idForeman,
                'idROMode' => $idRoMode,
                'isPaymentCleared' => 0,
                'isFIR' => $isFIR,
                'Status' => 'open',
                'MileageBefTesting' => $this->input->post('MBRT'),
                'MileageAftTesting' => $this->input->post('MART'),
                'ToolsQuantity' => $this->input->post('toolsQty'),
                'isOrignalTools' => $isOrignalTools,
                'OtherFinance' => $otherFinance,
                'FinanceRefNo' => $this->input->post('FinanceRefNo'),
                'SSCDescription' => $this->input->post('SSC'),
                'idEstimate' => $idEstimate,
                'isRepeatRO' => $isRepeatRO,
                'isCancel' => 0,
                'isAmountDue' => 0,
                'idSubROMode' => $idSubRoMode,
                'DepreciationAmount' => 0,
                'Veod' => 0,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive'],
				'trNo' =>$this->input->post('trNo'),
				'drNo' =>$this->input->post('drNo'),
				'warrantyClaimNo' =>$this->input->post('wrNo'),
				'trReport' =>$imagename1,
				'edrReport' =>$imagename2,
				'vehicleImage' =>$imagename3,
				'cusTypeId' =>$this->input->post('csh')
            );
            $insertRepairOrder = $repairOrderModel->InsertRepairOrder($repairOrderData);
            if ($getJob === "GR") {
                if (!empty($_POST['MechJob'])) {
                    $addMechJob = $this->addMechJob();
                }
            } else if ($getJob === "BP") {
                if (!empty($_POST['SelectJob'])) {
                    $addBodyPaint = $this->addBodyPaint();
                }
            } else if ($getJob === "PM") {
                if ($this->input->post('SelectPMPackage') != "Select PM Packages") {
                    $addPMPackage = $this->addPMPackage($this->input->post('SelectPMPackage'));
                }
            } else if ($getJob === "GR-PM") {
                if (!empty($_POST['MechJob'])) {
                    $addMechJob = $this->addMechJob();
                }
                if ($this->input->post('SelectPMPackage') != "Select PM Packages") {
                    $addPMPackage = $this->addPMPackage($this->input->post('SelectPMPackage'));
                }
            } else if ($getJob === "Other-PM") {
                if ($this->input->post('SelectPMPackage') != "Select PM Packages") {
                    $addPMPackage = $this->addPMPackage($this->input->post('SelectPMPackage'));
                }
            } else if ($getJob === "Other PM-GR") {
                if (!empty($_POST['MechJob'])) {
                    $addMechJob = $this->addMechJob();
                }
                if ($this->input->post('SelectPMPackage') != "Select PM Packages") {
                    $addPMPackage = $this->addPMPackage($this->input->post('SelectPMPackage'));
                }
            } else if ($getJob === "SSC-Campaign") {
                
            } else if ($getJob === "Warranty") {
                if (!empty($_POST['MechJob'])) {
                    $addMechJob = $this->addMechJob();
                }
            } else if ($getJob === "PDS") {
                // Nothing to Insert in PDS
            }
            /*if (count($_POST['ConditionDetail']) > 0) {
                $addJobCondition = $this->addJobCondition();
            }*/
            $addCheckList = $this->addCheckList();
//            According to new Change
//            if ($newRow == "-") {
//                $addWorkPerfomed = $this->addWorkPerformed();
//            }
//            if ($newRowSublet == "-") {
//                $addSubletUseage = $this->addSubletUseage();
//            }
//            $this->Receivable($idCustomer, $netTotal);
//            End 
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">' . $insertRepairOrder . $newRONumber . '</label>');
        } else {
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">RO already Opened fot this Number</label>');
        }
        redirect(base_url() . "index.php/repairorder/index");
    }

    function addMechJob() {

        $mechJobData = array();
        $repairOrderModel = new S_repairorder();
        $idJobRef = $_POST['MechJob'];
        for ($count = 0; $count < count($_POST['MechJob']); $count++) {
            $mechJobData[] = array(
                'idRepairOrderBill' => $repairOrderModel->getIdRepairOrder(),
                'idJobRefManual' => $idJobRef[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $insertMechJob = $this->db->insert_batch('s_ro_mechrepairs', $mechJobData);
    }

    function addPMPackage($idPM) {

        $repairOrderModel = new S_repairorder();
        $roPMData = array(
            'idRepairOrderBill' => $repairOrderModel->getIdRepairOrder(),
            'idPeriodicMaintenanceDetail' => $idPM,
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $insertPMPackages = $this->db->insert('s_ro_pmpackages', $roPMData);
        if ($insertPMPackages) {
            $this->addPMJobs($idPM);
        }
    }

    function addPMJobs($idPMPackage) {

        $pmJobData = array();
        $repairOrderModel = new S_repairorder();
        $pMJobs = $_POST['PmJobs'];
        for ($count = 0; $count < count($_POST['PmJobs']); $count++) {
            $pmJobData[] = array(
                'idRoPMPackage' => $repairOrderModel->getIdRoPmPackage(),
                'idJobRef' => $pMJobs[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $insertPMJobData = $this->db->insert_batch('s_ro_pm_jobs', $pmJobData);
    }

    function addBodyPaint() {

        $bodyPaintModel = new S_bodypaint();
        $repairOrderModel = new S_repairorder();
        $invoiceDate = date("Y-m-d", strtotime($this->input->post('InvoiceDate')));
        $deliveryDate = date("Y-m-d", strtotime($this->input->post('BPDeliveryDate')));
        if ($invoiceDate == NULL) {
            $invoiceDate = '0000-00-00';
        }
        if ($deliveryDate == NULL) {
            $deliveryDate = '0000-00-00';
        }

        $bodyPaintData = array(
            'idRepairOrderBill' => $repairOrderModel->getIdRepairOrder(),
            'ColorPaintCode' => $this->input->post('ColourCode'),
            'InsuranceCode' => $this->input->post('InsuranceCode'),
            'Surveyor' => $this->input->post('Surveyor'),
            'BPRORefNum' => $this->input->post('BPRoRef'),
            'MechRORefNum' => $this->input->post('MechRORef'),
            'ApprovedLabourRs' => $this->input->post('LabourRs'),
            'DepreciationAmountRs' => $this->input->post('DepAmountRs'),
            'InvoiceNumber' => $this->input->post('InvoiceNum'),
            'InvoiceDate' => $invoiceDate,
            'DeliveryDate' => $deliveryDate,
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $insertBodyPaint = $bodyPaintModel->InsertBodyPaint($bodyPaintData);
        if ($insertBodyPaint === "Successfully Inserted") {
            $addJobRef = $this->addJobRef();
        }
    }

    function addJobCondition() {

        $conditionArray = json_decode($_POST['ConditionDetail'], true);
        $otherValueArray = json_decode($_POST['OtherValue'], true);
        $repairOrderModel = new S_repairorder();
        for ($Count = 0; $Count < count($conditionArray); $Count++) {
            $conditionData = array(
                'idRepairOrderBill' => $repairOrderModel->getIdRepairOrder(),
                'idConditionConfirmationDetail' => $conditionArray[$Count],
                'Others' => $otherValueArray[$Count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $inserJobCondition = $this->db->insert('s_jobprog_condition', $conditionData);
        }
//        $inserJobCondition = $this->db->insert_batch('s_jobprog_condition', $conditionData);
    }

    function addCheckList() {

        $checkListData = array();
        $repairOrderModel = new S_repairorder();
        //$idCheckList = $_POST['CheckList'];
        /*for ($count = 0; $count < count($_POST['CheckList']); $count++) {
            $checkListData[] = array(
                'idRepairOrderBill' => $repairOrderModel->getIdRepairOrder(),
                'idCheckList' => $idCheckList[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $insertCheckLists = $this->db->insert_batch('s_repairorder_checklist', $checkListData);*/
    }

    function addWorkPerformed() {
        $workData = array();
        $repairOrderModel = new S_repairorder();
        if (!empty($_POST['WorkPerformed'])) {
            $workPerformed = $_POST['WorkPerformed'];
        } else {
            $workPerformed = NULL;
        }

        if (!empty($_POST['WorkPerformedHrs'])) {
            $workHrs = $_POST['WorkPerformedHrs'];
        } else {
            $workHrs = NULL;
        }

        if (!empty($_POST['WorkPerformedAmount'])) {
            $workAmount = $_POST['WorkPerformedAmount'];
        } else {
            $workAmount = NULL;
        }

        if ($workPerformed != NULL) {
            for ($count = 0; $count < count($workPerformed); $count++) {
                $workData[] = array(
                    'idRepairOrderBill' => $repairOrderModel->getIdRepairOrder(),
                    'WorkPerformed' => $workPerformed[$count],
                    'Hours' => $workHrs[$count],
                    'Amount' => $workAmount[$count],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
            $insertWorkPerfomed = $this->db->insert_batch('s_ro_workperformed', $workData);
        } else {
            
        }
    }

    function addPartsUseage() {

        $partsData = array();
        $repairOrderModel = new S_repairorder();
        $partsDate = $_POST['PartsDate'];
        $partsInv = $_POST['PartsInvoiceNo'];
        $partsNum = $_POST['PartNumber'];
        $partsQty = $_POST['PartsQuantity'];
        $partsDesc = $_POST['PartsDescription'];
        $partsAmount = $_POST['PartsAmount'];
        $partsSign = $_POST['PartsSign'];
        if ($partsNum == "Select Part Number") {
            $partsNum = 0;
        }
        for ($count = 0; $count < count($partsNum); $count++) {
            $partsData[] = array(
                'idRepairOrderBill' => $repairOrderModel->getIdRepairOrder(),
                'PartsUseageDate' => $partsDate[$count],
                'InvoiceNumber' => $partsInv[$count],
                'PartNumber' => $partsNum[$count],
                'Quantity' => $partsQty[$count],
                'Description' => $partsDesc[$count],
                'PartsUseageAmount' => $partsAmount[$count],
                'Signature' => $partsSign[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $insertPartsUseage = $this->db->insert_batch('s_partsuseage', $partsData);
    }

    function addSubletUseage() {

        $subletData = array();
        $repairOrderModel = new S_repairorder();
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
                    'idRepairOrderBill' => $repairOrderModel->getIdRepairOrder(),
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
            $insertSubletUseage = $this->db->insert_batch('s_subletrepairuseage', $subletData);
        }
    }

    function addLubUseage() {

        $lubData = array();
        $repairOrderModel = new S_repairorder();
        $lubDate = $_POST['LubDate'];
        $lubQty = $_POST['LubQunatity'];
        $lubDesc = $_POST['LubDesc'];
        $lubAmount = $_POST['LubAmount'];
        $lubSign = $_POST['LubSignature'];
        if ($lubQty == NULL) {
            $lubQty = 0;
        }
        for ($count = 0; $count < count($lubQty); $count++) {
            $lubData[] = array(
                'idRepairOrderBill' => $repairOrderModel->getIdRepairOrder(),
                'LubOilUseageDate' => $lubDate[$count],
                'Quantity' => $lubQty[$count],
                'Description' => $lubDesc[$count],
                'LubOilAmount' => $lubAmount[$count],
                'Signature' => $lubSign[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $insertLubUseage = $this->db->insert_batch('s_luboiluseage', $lubData);
    }

    function addJobRef() {

        $jobRefData = array();
        $bodyPaintModel = new S_bodypaint();
        $idJobRef = $_POST['SelectJob'];
        for ($count = 0; $count < count($_POST['SelectJob']); $count++) {
            $jobRefData[] = array(
                'idBodyPaint' => $bodyPaintModel->getIdBodyPaint(),
                'idJobRefManual' => $idJobRef[$count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $insertJobRef = $this->db->insert_batch('s_bodypaint_jobref', $jobRefData);
    }

    function getCustomer() {

        $customerModel = new S_customer();
        $isExistCustomer = $customerModel->isExistCustomer($this->input->post('CustomerName'), $this->input->post('CustomerContact'));
        if ($isExistCustomer != NULL) {
            return $isExistCustomer;
        } else {
            if ($this->input->post('CompanyName') == NULL) {
                $isCompany = 0;
            } else {
                $isCompany = 1;
            }

            $getfieldsValue = $this->getFieldsValue();
            $customerData = array(
                'CustomerName' => $this->input->post('CustomerName'),
                'AddressDetails' => $this->input->post('CustomerAddress'),
                'Cnic' => $this->input->post('CustomerNIC'),
                'Ntn' => $this->input->post('CustomerNTN'),
                'Cellphone' => $this->input->post('CustomerContact'),
                'Fax' => NULL,
                'isPotentialCustomer' => 1,
                'CompanyName' => $this->input->post('CompanyName'),
                'CompanyContact' => $this->input->post('CompanyContact'),
                'PhoneOne' => $this->input->post('PhoneOne'),
                'PhoneTwo' => $this->input->post('PhoneTwo'),
                'isCompany' => $isCompany,
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

    function getCustomerOtherDepartment() {

        $customerModel = new S_customer();
        $search = $this->input->post('contactNumber');
        $customerSearch = $customerModel->selectAllCustomers($search);
        $customerDetail = json_encode($customerSearch);
        echo $customerDetail;
    }

    function getOtherJobs() {

        $jobRefManual = new S_jobreferencemanual();
        $allJobs = $jobRefManual->selectAllJobs();
        $otherJobs = json_encode($allJobs);
        echo $otherJobs;
    }

    function getVehicle() {

        $vehicleModel = new S_vehicle();
        $variantModel = new S_allvehicles();
        $idVariant = $_POST['Make'];
        if ($idVariant === "Select Make") {
            if ($_POST['inputMake'] != NULL) {
                $idAllVehicle = $variantModel->getIdAllVehicles($_POST['inputMake']);
                $isExistVehicle = $vehicleModel->isExistVehicle($idAllVehicle, $this->input->post('RegNumber'));
                if ($isExistVehicle != NULL) {
                    return $isExistVehicle;
                } else {
                    $getfieldsValue = $this->getFieldsValue();
                    $vehicleData = array(
                        'idVariant' => $idAllVehicle,
                        'idCustomer' => $this->getCustomer(),
                        'VehicleName' => NULL,
                        'Model' => $this->input->post('Model'),
                        'RegistrationNumber' => $this->input->post('RegNumber'),
                        'Mileage' => $this->input->post('KM'),
                        'ChassisNumber' => $this->input->post('FrameNumber'),
                        'EngineNumber' => $this->input->post('EngineNumber'),
                        'ModelCode' => $this->input->post('ModelCode'),
                        'EstNumber' => $this->input->post('EstNum'),
                        'Year' => $this->input->post('Year'),
                        'isEstimate' => 0,
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
                $isExistVehicle = $vehicleModel->isExistVehicle($idVariant, $this->input->post('RegNumber'));
                if ($isExistVehicle != NULL) {
                    return $isExistVehicle;
                } else {
                    $getfieldsValue = $this->getFieldsValue();
                    $vehicleData = array(
                        'idVariant' => $idVariant,
                        'idCustomer' => $this->getCustomer(),
                        'VehicleName' => NULL,
                        'Model' => $this->input->post('Model'),
                        'RegistrationNumber' => $this->input->post('RegNumber'),
                        'Mileage' => $this->input->post('KM'),
                        'ChassisNumber' => $this->input->post('FrameNumber'),
                        'EngineNumber' => $this->input->post('EngineNumber'),
                        'ModelCode' => $this->input->post('ModelCode'),
                        'EstNumber' => $this->input->post('EstNum'),
                        'Year' => $this->input->post('Year'),
                        'isEstimate' => 0,
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
                    'RegistrationNumber' => $this->input->post('RegNumber'),
                    'Mileage' => $this->input->post('KM'),
                    'ChassisNumber' => $this->input->post('FrameNumber'),
                    'EngineNumber' => $this->input->post('EngineNumber'),
                    'ModelCode' => $this->input->post('ModelCode'),
                    'EstNumber' => $this->input->post('EstNum'),
                    'Year' => $this->input->post('Year'),
                    'isEstimate' => 0,
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

    function getFieldsValue() {
        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "ReceivableDate" => date("Y-m-d"), "ReceivableTime" => date("H:i:s"));
        return $fieldsValue;
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

    function getPMJobs() {

        $pmdModel = new S_periodicmaintenancedetails();
        $pm = $this->input->post('pm');
        $search = $pmdModel->getFilteredPmd($pm);
        $filteredPMJobs = json_encode($search);
        echo $filteredPMJobs;
    }

    function searchRONumber() {

        $repairOrderModel = new S_repairorder();
        $search = $this->input->post('searchRONumber');
        $roSearch = $repairOrderModel->searchRepairOrder($search);
        $rONumber = json_encode($roSearch);
        echo $rONumber;
    }

    function searchExistingCustomer() {

        $repairOrderModel = new S_repairorder();
        $searchyReg = $this->input->post('searchbyreg');
        $isExist = $repairOrderModel->searchisExistCustomer($searchyReg);
        $isExistingCustomer = json_encode($isExist);
        echo $isExistingCustomer;
    }

    function getRange() {
        $jobRefManual = new S_jobreferencemanual();
        $range = $this->input->post('range');
        $idJob = $this->input->post('idJob');
        $amount = $jobRefManual->getJobRangeDetail($range, $idJob);
        echo $amount;
    }

    function Receivable($idCustomer, $netTotal) {

        $roFinance = new S_rofinance();
        $isExistReceivable = $roFinance->isExistReceivable($idCustomer);
        if ($isExistReceivable != NULL) {
            $receivableAmount = $isExistReceivable[0]['ReceiveableAmount'] + $netTotal;
            $receivableData = array(
                'ReceiveableAmount' => $receivableAmount,
                'ReceivableDate' => $this->getFieldsValue()['ReceivableDate'],
                'ReceivableTime' => $this->getFieldsValue()['ReceivableTime'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            );
            $updateReceivable = $roFinance->updateReceivable($isExistReceivable[0]['idReceivable'], $receivableData);
            if ($updateReceivable === "Receivable Updated Successfully") {
                return True;
            }
        } else {
            $receivableData = array(
                'idParty' => $idCustomer,
                'ReceiveableAmount' => $netTotal,
                'FromDepartment' => 'ServiceDepartment',
                'ReceivableDate' => $this->getFieldsValue()['ReceivableDate'],
                'ReceivableTime' => $this->getFieldsValue()['ReceivableTime'],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $createReceivable = $roFinance->createReceivable($receivableData);
            if ($createReceivable === "Receivable Created Successfully") {
                return True;
            }
        }
    }

}
