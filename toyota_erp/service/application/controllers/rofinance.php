<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rofinance extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('s_repairorder');
        $this->load->model('s_rofinance');
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
        $this->load->model('s_bodypaint');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $roFinance = new S_rofinance();
        $financeModel = new S_financeinfo();
        $dataArray['roDetails'] = $roFinance->getRODetail();
        $dataArray['financeInfoList'] = $financeModel->getFinanceInfo();
        $dataArray['paymentReceived'] = $this->session->flashdata('paymentreceived');
        $this->load->view('header');
        $this->load->view('rofinance', $dataArray);
        $this->load->view('footer');
    }

    function Update() {

        $roFinance = new S_rofinance();
        $financeInfoModel = new S_financeinfo();
        $getfieldsValue = $this->getFieldsValue();
        $roData = $this->input->post('data');
        $idRO = $roData['idRO'];
        $idFinance = $roData['FinanceList'];
        $balance = $roData['Balance'];
        $financeName = $financeInfoModel->selectOneFinanceInfo($idFinance);
        if ($financeName === 'Others') {
            $otherFinance = $this->input->post('InputOther');
        } else {
            $otherFinance = NULL;
        }

        if ($balance >= 0) {
            $isPaymentCleared = 1;
            $receivable = $roData['Receivable'] - $roData['NetTotal'];
            if ($receivable <= 0) {
                $receivable = 0;
            }
        } else {
            $isPaymentCleared = 0;
            $receivable = $roData['Receivable'] - $roData['PaymentReceived'];
            if ($receivable <= 0) {
                $receivable = 0;
            }
        }

        $rOData = array(
            'idFinance' => $idFinance,
            'OtherFinance' => $otherFinance,
            'CreditMemoNumber' => $roData['CreditMemo'],
            'CashMemoNumber' => $roData['CashMemo'],
            'LubOilAmount' => $roData['LubOil'],
            'SubletRepairAmount' => $roData['SubletRepair'],
            'PartsAmount' => $roData['Parts'],
            'GrandTotal' => $roData['GrandTotal'],
            'GSTax' => $roData['GST'],
            'NetTotal' => $roData['NetTotal'],
            'isPaymentCleared' => $isPaymentCleared,
            'Status' => 'open',
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
        );
        $updateRO = $roFinance->UpdateRO($idRO, $rOData, $roData['CustomerName'], $roData['RegNumber']);
        $this->Transaction($roData, $financeName, $receivable);
        if ($updateRO === "Payment Received") {
            echo $updateRO;
        } else {
            echo $updateRO;
        }
    }

    function getRODetail() {

        $roFinance = new S_rofinance();
        $search = $this->input->post('idRO');
        $roSearch = $roFinance->searchROById($search);
        $rOById = json_encode($roSearch);
        echo $rOById;
    }

    function searchRODetail() {

        $roFinance = new S_rofinance();
        $search = $this->input->post('searchbyro');
        $roSearch = $roFinance->searchRODetail($search);
        $rODetail = json_encode($roSearch);
        echo $rODetail;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "TransactionDate" => date("Y-m-d"), "TransactionTime" => date("H:i:s"));
        return $fieldsValue;
    }

    function Transaction($roData, $financeName, $receivable) {

        $roFinance = new S_rofinance();
        $transactionData = array(
            'TransactionType' => 'Receivable',
            'PaymentType' => $financeName,
            'FromDepartment' => 'ServiceDepartment',
            'Description' => NULL,
            'idCustomer' => $roData['idCustomer'],
            'idVendor' => NULL,
            'Discount' => $roData['Discount'],
            'GST' => $roData['GST'],
            'NetTotal' => $roData['NetTotal'],
            'PaymentAmount' => $roData['PaymentReceived'],
            'BalanceAmount' => $receivable,
            'TransactionDate' => $this->getFieldsValue()['TransactionDate'],
            'TransactionTime' => $this->getFieldsValue()['TransactionTime'],
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $createTransaction = $roFinance->createTransaction($transactionData);
        if ($createTransaction === "Transaction Done Successfully") {
            $receivableData = array(
                'ReceiveableAmount' => $receivable,
            );
            $updateReceivable = $roFinance->updateReceivable($roData['idReceivable'], $receivableData);
            if ($updateReceivable === "Receivable Updated Successfully") {
                return True;
            }
        }
    }

}
