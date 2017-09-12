<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rodetail extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('s_rodetail');
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
        $this->load->model('s_partsrequisition');
        $this->load->model('s_partsreceived');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $repairOrderModel = new S_repairorder();
        $financeModel = new S_financeinfo();
        $dataArray['ROMode'] = $repairOrderModel->getROModes();
        $dataArray['partsList'] = $repairOrderModel->fillPartCombo();
        $dataArray['financeInfoList'] = $financeModel->getFinanceInfo();
        $dataArray['gasVolume'] = $repairOrderModel->getGasInfo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('rodetail', $dataArray);
        $this->load->view('footer');
    }

    function save() {
        $roDetailModel = new S_rodetail();
        $newRowWorkPerformed = $this->input->post('newRowWorkPerformed');
        $newRowParts = $this->input->post('newRowParts');
        $newRowSublet = $this->input->post('newRowSublet');
        $newRowLubOil = $this->input->post('newRowLubricants');
        $idRO = $this->input->post('IdInsertRO');
        $isRepeatRO = $this->input->post('IsRepeatRO');
        $netTotal = $this->input->post('NetTotal');
        $idCustomer = $this->input->post('IdCustomer');
        $isAmountDue = 0;
        if ($isRepeatRO != "1") {
            $isAmountDue = 1;
        } else {
            $isAmountDue = 0;
        }
        $roData = array(
            'LabourAmount' => $this->input->post('Labour'),
            'LubOilAmount' => $this->input->post('LubOil'),
            'SubletRepairAmount' => $this->input->post('SubletRepair'),
            'PartsAmount' => $this->input->post('Parts'),
            'GrandTotal' => 0,
            'GSTax' => $this->input->post('GST'),
            'NetTotal' => $netTotal,
			'DepAmountPercent' => $this->input->post('DepAmountPercent'),
            'DepreciationAmount' => $this->input->post('DepAmountRs'),
			'VEOD_Percent' => $this->input->post('VEOD_Percent'),
            'Veod' => $this->input->post('VEOD'),
			'VEOD2_Percent' => $this->input->post('VEOD2_Percent'),
            'Veod2' => $this->input->post('VEOD2'),
            'isAmountDue' => $isAmountDue
        );
        $roDetailModel->UpdateRO($idRO, $roData);

      //  if ($newRowWorkPerformed == "-") {
            $this->addWorkPerformed($idRO);
      //  }
        if ($newRowParts == "-") {
            $this->addPartsUseage($idRO);
        }
        if ($newRowSublet == "-") {
            $this->addSubletUseage($idRO);
        }
        if ($newRowLubOil == "-") {
            $this->addLubUseage($idRO);
        }
        if ($isRepeatRO != "1") {
            $this->Receivable($idCustomer, $netTotal);
        }
        $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">RO Updated Successfully</label>');
//        $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">' . $insertRepairOrder . $newRONumber . '</label>');
        redirect(base_url() . "index.php/rodetail/index");
    }

    function addWorkPerformed($idRO) {
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
                    'idRepairOrderBill' => $idRO,
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

    function addPartsUseage($idRO) {

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
    }

    function addSubletUseage($idRO) {

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
        }
    }

    function addLubUseage($idRO) {

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
    }

    function getRODetail() {

        $roDetailModel = new S_rodetail();
        $search = $this->input->post('searchRONumber');
        $data = $roDetailModel->roDetail($search);
        $data2 = $roDetailModel->roDetailparts($search);
       // $data2 = $roDetailModel->roDetailparts($search);
		$array = array('parts'=>$data2,'other'=>$data);
		//var_dump($array);die;
        $roDetail = json_encode($array);
        echo $roDetail;
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

//    Functions for Parts Info
    function requestedParts() {

        $roDetailModel = new S_rodetail();
        $search = $this->input->post('searchRONumber');
        $allRequestedData = $roDetailModel->getRequestedParts($search);
        $allPartsRequested = json_encode($allRequestedData);
        echo $allPartsRequested;
    }

    function receivedParts() {

        $roDetailModel = new S_rodetail();
        $search = $this->input->post('searchRONumber');
        $allPartsData = $roDetailModel->getReceivedParts($search);
        $allPartsReceived = json_encode($allPartsData);
        echo $allPartsReceived;
    }

    function getFieldsValue() {
        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "ReceivableDate" => date("Y-m-d"), "ReceivableTime" => date("H:i:s"));
        return $fieldsValue;
    }

    // Function for Body-Paint Materail and Total Cost

    function saveBodyPaint() {
        $roDetailModel = new S_rodetail();
        $newRowMaterial = $this->input->post('newRowMaterial');
        $newRowSublet = $this->input->post('newRowSubletBP');
        $idRO = $this->input->post('IdInsertROBP');
        $isRepeatRO = $this->input->post('IsRepeatBP');
        $idCustomer = $this->input->post('IdCustomerBP');
        $netTotal = $this->input->post('NetTotalBP');
        $isAmountDue = 0;
        if ($isRepeatRO != "1") {
            $isAmountDue = 1;
        } else {
            $isAmountDue = 0;
        }
        $insertTotalCost = $this->addTotalCostData($netTotal, $idRO);
        if ($insertTotalCost) {
            $roData = array(
                'isAmountDue' => $isAmountDue
            );
            $roDetailModel->UpdateRO($idRO, $roData);
        }

        if ($newRowMaterial == "-") {
            $this->addMaterialUsage($idRO);
        }
        if ($newRowSublet == "-") {
            $this->addSubletUseage($idRO);
        }

        if ($isRepeatRO != "1") {
            $this->Receivable($idCustomer, $netTotal);
        }
        $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">Body-Paint RO Updated Successfully</label>');
//        $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">' . $insertRepairOrder . $newRONumber . '</label>');
        redirect(base_url() . "index.php/rodetail/index");
    }

    function addMaterialUsage($idRO) {
        $materialData = array();
        $usageDate = $_POST['UsageDate'];
        $materialQty = $_POST['Quantity'];
        $materialName = $_POST['MaterialName'];
        $materialAmount = $_POST['Amount'];
        $materialDesc = $_POST['Description'];
        for ($count = 0; $count < count($materialName); $count++) {
            $materialData[] = array(
                'idRepairOrderBill' => $idRO,
                'UsageDate' => $usageDate[$count],
                'MaterialName' => $materialName[$count],
                'Quantity' => $materialQty[$count],
                'Amount' => $materialAmount[$count],
                'Description' => $materialDesc[$count],
                'InvoiceNumber' => 0,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $insertData = $this->db->insert_batch('s_bodypaint_material_usage', $materialData);
        return true;
    }

    function addTotalCostData($netTotal, $idRO) {
        $roDetailModel = new S_rodetail();
        $totalCostData = array(
            'idRepairOrderBill' => $idRO,
            'MaterialCost' => $this->input->post('MaterialCost'),
            'PainterLabour' => $this->input->post('PainterLabour'),
            'DenterLabour' => $this->input->post('DenterLabour'),
            'TechnicianCost' => $this->input->post('TechnicianCost'),
            'OtherExpenses' => $this->input->post('OtherExpences'),
            'LabourApproved' => $this->input->post('ApprovedLabour'),
            'DepreciationAmount' => $this->input->post('DepreciationAmount'),
            'GSTax' => $this->input->post('GSTBP'),
            'TotalCost' => $netTotal,
            'NetTotal' => $netTotal,
            'Description' => $this->input->post('TotalCostDescription'),
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $insertData = $roDetailModel->InsertTotalCostData($totalCostData);
        return $insertData;
    }

}
