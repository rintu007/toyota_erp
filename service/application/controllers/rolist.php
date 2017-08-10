<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rolist extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('s_repairorder');
        $this->load->model('s_rolist');
        $this->load->model('s_rochecklist');
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
        $this->load->model('s_allvehicles');
        $this->load->model('s_allmodels');
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
        $conditionModel = new S_conditionconfirmationdetail();
        $pmdModel = new S_periodicmaintenancedetails();
        $roList = new S_rolist();
        $dataArray['partsList'] = $repairOrderModel->fillPartCombo();
        $dataArray['checkList'] = $checkListModel->getAllRoCheckList();
        $dataArray['financeInfoList'] = $financeModel->getFinanceInfo();
        $dataArray['mechanicalJobs'] = $jobRefManual->getMechanicalJobs();
        $dataArray['bodyPaintJobs'] = $jobRefManual->getBodyPaintJobs();
        $dataArray['fuelVolume'] = $fuelManagment->getFuelInfo();
        $dataArray['gasVolume'] = $repairOrderModel->getGasInfo();
        $dataArray['technicianList'] = $staffManagment->getTechnicianStaff();
        $dataArray['foremanList'] = $staffManagment->getForemanStaff();
        $dataArray['brandsList'] = $allBrands->getAllBrands();
        $dataArray['roDetails'] = $roList->getRODetail();
        $dataArray['variantList'] = $allVehicles->getAllVariants();
        $dataArray['condConfirm'] = $conditionModel->getConditionDetail();
        $dataArray['pmdList'] = $pmdModel->getAllPmd();
        $dataArray['ROMode'] = $repairOrderModel->getROModes();
        $dataArray['serviceAdvList'] = $staffManagment->getServiceAdvisor();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('rolist', $dataArray);
        $this->load->view('footer');
    }

    function Update() {

        $roList = new S_rolist();
        $financeInfoModel = new S_financeinfo();
        $idRO = $this->input->post('idRO');
        $idBodyPaint = $this->input->post('idBodyPaint');
        $idRoPMPackage = $this->input->post('idRoPMPackage');
        $isWorkOrderAttach = $this->input->post('isWorkOrder');
        $approvedLabour = $this->input->post('LabourRs');
        $idFinance = $this->input->post('FinanceList');
        $getJob = $this->input->post('isM');
        $financeName = $financeInfoModel->selectOneFinanceInfo($idFinance);
        $conditionModel = new S_conditionconfirmationdetail();
        if ($financeName === 'Others') {
            $otherFinance = $this->input->post('InputOther');
        } else {
            $otherFinance = NULL;
        }
        if ($isWorkOrderAttach == "1") {
            $isWorkOrderAttach = 1;
        } else {
            $isWorkOrderAttach = 0;
        }

        $roData = array(
            'idCustomerDetail' => $this->input->post('idCustomer'),
            'idVehicle' => $this->input->post('idVehicle'),
            'idFinance' => $idFinance,
            'idFuel' => $this->input->post('FuelVolume'),
            'RONumber' => $this->input->post('RoNumber'),
            'CashMemoNumber' => $this->input->post('CashMemo'),
            'CreditMemoNumber' => $this->input->post('CreditMemo'),
            'BookInDate' => $this->input->post('BookDate'),
            'BookInTime' => $this->input->post('BookTime'),
            'DeliveryDate' => $this->input->post('DeliveryDate'),
            'DeliveryTime' => $this->input->post('DeliveryTime'),
            'VOC' => $this->input->post('VOC'),
            'LabourAmount' => $this->input->post('Labour'),
            'LubOilAmount' => $this->input->post('LubOil'),
            'SubletRepairAmount' => $this->input->post('SubletRepair'),
            'PartsAmount' => $this->input->post('Parts'),
            'GrandTotal' => $this->input->post('GrandTotal'),
            'GSTax' => $this->input->post('GST'),
            'NetTotal' => $this->input->post('NetTotal'),
            'isWorkOrderAttach' => $isWorkOrderAttach,
            'idStaff' => $this->input->post('idStaff'),
            'idForeman' => $this->input->post('Foreman'),
            'OtherFinance' => $otherFinance,
            'FinanceRefNo' => $this->input->post('FinanceRefNo'),
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate']
        );

        $updateCustomer = $this->updateCustomer($this->input->post('idCustomer'));

        $updateVehicle = $this->updateVehicle($this->input->post('idVehicle'), $this->input->post('idCustomer'));

        if ($_POST['ConditionDetail'] != NULL) {
            $updateROCondition = $this->updateROCondition($idRO);
        }

        if ($getJob === "1") {
            $updateMechJob = $this->updateMechJob($idRO);
            if ($this->input->post('SelectPMPackage') != "Select PM Packages") {
                $updatePMPackage = $this->updatePMPackage($this->input->post('SelectPMPackage'));
            }
        } else {
            if ($getJob === "0") {
                $updateBPJobs = $this->updateBPJobs($idBodyPaint);
                $updateBodyPaint = $this->updateBodyPaint($idBodyPaint);
            }
        }
        if ($_POST['WorkPerformed'] != 'No Data') {
            $updateWorkPerformed = $this->updateWorkPerformed($idRO);
        }
        if ($_POST['CheckList']) {
            $updateCheckList = $this->updateCheckList($idRO);
        }

        if ($_POST['SubletQunatity'] != 0) {
            $updateSubletUseage = $this->updateSubletUseage($idRO);
        }
        if ($_POST['LubQunatity'] != 0) {
            $updateLubUseage = $this->updateLubUseage($idRO);
        }

        $updateRO = $roList->UpdateRO($idRO, $roData);
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateRO . '</h4>');
        redirect(base_url() . "index.php/rolist/index");
    }

    function updateCustomer($idCustomer) {


        $customerModel = new S_customer();
        $customerData = array(
            'CustomerName' => $this->input->post('CustomerName'),
            'AddressDetails' => $this->input->post('CustomerAddress'),
            'Cnic' => $this->input->post('CustomerNIC'),
            'Ntn' => $this->input->post('CustomerNTN'),
            'Cellphone' => $this->input->post('CustomerContact'),
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate']
        );
        $updateCustomer = $customerModel->UpdateCustomer($idCustomer, $customerData);
        if ($updateCustomer === "Successfully Update") {
            return $updateCustomer;
        }
    }

    function updateVehicle($idVehicle, $idCustomer) {


        $vehicleModel = new S_vehicle();
        $vehicleData = array(
            'idVariant' => $this->input->post('Make'),
            'idCustomer' => $idCustomer,
            'VehicleName' => NULL,
            'Model' => $this->input->post('Model'),
            'RegistrationNumber' => $this->input->post('RegNumber'),
            'Mileage' => $this->input->post('KM'),
            'ChassisNumber' => $this->input->post('FrameNumber'),
            'EngineNumber' => $this->input->post('EngineNumber'),
            'ModelCode' => $this->input->post('ModelCode'),
            'EstNumber' => $this->input->post('EstNum'),
            'Year' => $this->input->post('Year'),
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate']
        );
        $updateVehicle = $vehicleModel->UpdateVehicle($idVehicle, $vehicleData);
        if ($updateVehicle === "Successfully Update") {
            return $updateVehicle;
        }
    }

    function updateROCondition($idRO) {

        $this->db->where('idRepairOrderBill', $idRO);
        $updateCondtions = $this->db->delete('s_jobprog_condition');

        if ($updateCondtions) {
            $conditionData = array();
            $idCondtion = $_POST['ConditionDetail'];
            for ($count = 0; $count < count($_POST['ConditionDetail']); $count++) {
                $conditionData[] = array(
                    'idRepairOrderBill' => $idRO,
                    'idConditionConfirmationDetail' => $idCondtion[$count],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
            $inserJobCondition = $this->db->insert_batch('s_jobprog_condition', $conditionData);
        }
    }

    function updateMechJob($idRO) {

        $this->db->where('idRepairOrderBill', $idRO);
        $updateMechJob = $this->db->delete('s_ro_mechrepairs');

        if ($updateMechJob) {
            $mechJobData = array();
            $idJobRef = $_POST['MechJob'];
            for ($count = 0; $count < count($_POST['MechJob']); $count++) {
                $mechJobData[] = array(
                    'idRepairOrderBill' => $idRO,
                    'idJobRefManual' => $idJobRef[$count],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
            $insertMechJob = $this->db->insert_batch('s_ro_mechrepairs', $mechJobData);
            if ($insertMechJob) {
                return "Successfully Update";
            }
        }
    }

    function updatePMPackage($idRoPMPackage, $idRO, $idPMDetail) {

        $roPMData = array(
            'idRepairOrderBill' => $idRO,
            'idPeriodicMaintenanceDetail' => $idPMDetail,
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
        );
        $this->db->where('idRoPMPackage', $idRoPMPackage);
        if ($this->db->update('s_ro_pmpackages', $roPMData)) {
            $this->updatePMJobs($idRoPMPackage, $idPMDetail);
        }
    }

    function updatePMJobs($idRoPMPackage) {

        $this->db->where('idRoPMPackage', $idRoPMPackage);
        $updatePMJobs = $this->db->delete('s_ro_pm_jobs');
        $pMJobs = $_POST['PmJobs'];
        if ($updatePMJobs) {
            $pmJobData = array();
            for ($count = 0; $count < count($_POST['PmJobs']); $count++) {
                $pmJobData[] = array(
                    'idRoPMPackage' => $idRoPMPackage,
                    'idJobRef' => $pMJobs[$count],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
            $insertPMJobData = $this->db->insert_batch('s_ro_pm_jobs', $pmJobData);
        }
    }

    function updateBPJobs($idBodyPaint) {

        $this->db->where('idBodyPaint', $idBodyPaint);
        $updateBPJobs = $this->db->delete('s_bodypaint_jobref');

        if ($updateBPJobs) {
            $jobRefData = array();
            $idJobRef = $_POST['SelectJob'];
            for ($count = 0; $count < count($_POST['SelectJob']); $count++) {
                $jobRefData[] = array(
                    'idBodyPaint' => $idBodyPaint,
                    'idJobRefManual' => $idJobRef[$count],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
            $insertBPJobs = $this->db->insert_batch('s_bodypaint_jobref', $jobRefData);
            if ($insertBPJobs) {
                return "Successfully Update";
            }
        }
    }

    function updateBodyPaint($idBodyPaint) {

        $bodyPaintModel = new S_bodypaint();
        $invoiceDate = $this->input->post('InvoiceDate');
        $deliveryDate = $this->input->post('BPDeliveryDate');
        if ($invoiceDate == NULL) {
            $invoiceDate = '0000-00-00';
        }
        if ($deliveryDate == NULL) {
            $deliveryDate = '0000-00-00';
        }
        $bodyPaintData = array(
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
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate']
        );
        $updateBPaint = $bodyPaintModel->UpdateBodyPaint($idBodyPaint, $bodyPaintData);
        if ($updateBPaint === "Successfully Update") {
            return $updateBPaint;
        } else {
            
        }
    }

    function updateWorkPerformed($idRO) {

        $this->db->where('idRepairOrderBill', $idRO);
        $updateWorkPerformed = $this->db->delete('s_ro_workperformed');


        if ($updateWorkPerformed) {
            $workPerformed = $_POST['WorkPerformed'];
            $workHrs = $_POST['WorkPerformedHrs'];
            $workAmount = $_POST['WorkPerformedAmount'];
            $workData = array();
            if ($workPerformed === 'No Data') {
                $workPerformed = 0;
            }
            $workPerformed = $_POST['WorkPerformed'];
            $workHrs = $_POST['WorkPerformedHrs'];
            $workAmount = $_POST['WorkPerformedAmount'];
            if ($workPerformed == NULL) {
                $workPerformed = 0;
            }
            for ($count = 0; $count < count($workPerformed); $count++) {
                $workData[] = array(
                    'idRepairOrderBill' => $idRO,
                    'WorkPerformed' => $workPerformed[$count],
                    'Hours' => $workHrs[$count],
                    'Amount' => $workAmount[$count],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
            $insertWorkPerformed = $this->db->insert_batch('s_ro_workperformed', $workData);
            if ($insertWorkPerformed) {
                return "Successfully Update";
            }
        }
    }

    function updateCheckList($idRO) {

        $this->db->where('idRepairOrderBill', $idRO);
        $updateCheckList = $this->db->delete('s_repairorder_checklist');

        if ($updateCheckList) {
            $checkListData = array();
            $idCheckList = $_POST['CheckList'];
            for ($count = 0; $count < count($_POST['CheckList']); $count++) {
                $checkListData[] = array(
                    'idRepairOrderBill' => $idRO,
                    'idCheckList' => $idCheckList[$count],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
            $insertCheckLists = $this->db->insert_batch('s_repairorder_checklist', $checkListData);
            if ($insertCheckLists) {
                return "Successfully Update";
            }
        }
    }

    function updatePartsUseage($idRO) {

        $this->db->where('idRepairOrderBill', $idRO);
        $updatePartsUseage = $this->db->delete('s_partsuseage');

        if ($updatePartsUseage) {
            $partsData = array();
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
                    'idRepairOrderBill' => $idRO,
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
            if ($insertPartsUseage) {
                return "Successfully Update";
            }
        }
    }

    function updateSubletUseage($idRO) {

        $this->db->where('idRepairOrderBill', $idRO);
        $updateSubletUseage = $this->db->delete('s_subletrepairuseage');

        if ($updateSubletUseage) {
            $subletData = array();
            $subletDate = $_POST['SubletDate'];
            $subletQty = $_POST['SubletQunatity'];
            $subletRef = $_POST['SubletRef'];
            $subletDesc = $_POST['SubletDesc'];
            $subletAmount = $_POST['SubletAmount'];
            if ($subletQty == NULL) {
                $subletQty = 0;
            }
            for ($count = 0; $count < count($subletQty); $count++) {
                $subletData[] = array(
                    'idRepairOrderBill' => $idRO,
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
            if ($insertSubletUseage) {
                return "Successfully Update";
            }
        }
    }

    function updateLubUseage($idRO) {

        $this->db->where('idRepairOrderBill', $idRO);
        $updateLubUseage = $this->db->delete('s_luboiluseage');

        if ($updateLubUseage) {
            $lubData = array();
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
                    'idRepairOrderBill' => $idRO,
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
            if ($insertLubUseage) {
                return "Successfully Update";
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

    function getRODetail() {

        $roList = new S_rolist();
        $search = $this->input->post('idRO');
        $roSearch = $roList->searchROById($search);
        $rOById = json_encode($roSearch);
        echo $rOById;
    }

    function getWorkPerformed() {

        $roList = new S_rolist();
        $search = $this->input->post('idRO');
        $workData = $roList->getROWorkPerformed($search);
        $workPerformed = json_encode($workData);
        echo $workPerformed;
    }

    function getPartsUseage() {

        $roList = new S_rolist();
        $search = $this->input->post('idRO');
        $partsData = $roList->getROPartsUseage($search);
        $partsUseage = json_encode($partsData);
        echo $partsUseage;
    }

    function getSubletUseage() {

        $roList = new S_rolist();
        $search = $this->input->post('idRO');
        $subData = $roList->getROSubletUseage($search);
        $subLetUseage = json_encode($subData);
        echo $subLetUseage;
    }

    function getLubOilUseage() {

        $roList = new S_rolist();
        $search = $this->input->post('idRO');
        $lubData = $roList->getROLubOilUseage($search);
        $lubOilUseage = json_encode($lubData);
        echo $lubOilUseage;
    }

    function getOtherJobs() {

        $jobRefManual = new S_jobreferencemanual();
        $allJobs = $jobRefManual->selectAllJobs();
        $otherJobs = json_encode($allJobs);
        echo $otherJobs;
    }

    function getPMJobs() {

        $pmdModel = new S_periodicmaintenancedetails();
        $pm = $this->input->post('pm');
        $search = $pmdModel->getFilteredPmd($pm);
        $filteredPMJobs = json_encode($search);
        echo $filteredPMJobs;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

    function getAllOpenedRO() {
        $roList = new S_rolist();
        $data = $roList->getOpenedRODetail($pm);
        $openedROData = json_encode($data);
        return $openedROData;
    }

    function searchRODetail() {

        $roList = new S_rolist();
        $search = $this->input->post('searchbyro');
        $roSearch = $roList->searchRODetail($search);
        $rODetail = json_encode($roSearch);
        echo $rODetail;
    } 
	
	function searchRODetailDate() {

        $roList = new S_rolist();
        $search = $this->input->post('searchbyro');
        $roSearch = $roList->searchRODetailDate($search);
        $rODetail = json_encode($roSearch);
        echo $rODetail;
    }

}
