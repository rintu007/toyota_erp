<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('f_payment');
        $this->load->model('f_vendor');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $paymentModel = new F_payment();
        $vendorModel = new F_vendor();
        $dataArray['customersList'] = $paymentModel->getAllCustomer();
        $dataArray['vendorsList'] = $vendorModel->getAllVendors();
        $dataArray['paymentModes'] = $paymentModel->getAllPaymentModes();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $this->load->view('header');
        $this->load->view('payment', $dataArray);
        $this->load->view('footer');
    }

    function Transaction() {
        $paymentModel = new F_payment();
        $transactionType = $this->input->post('transactionType');
        $payableBalance = $this->input->post('PayableAmount') - $this->input->post('PaymentReceived');
        if ($payableBalance <= 0) {
            $payableBalance = 0;
        }
        if ($transactionType === "Payable") {
            $idParty = $this->input->post('idVendor');
            $transactionData = array(
                'TransactionType' => $transactionType,
                'PaymentType' => $this->input->post('PaymentMode'),
                'FromDepartment' => $this->input->post('From'),
                'Description' => $this->input->post('Description'),
                'idCustomer' => $idParty,
                'idVendor' => $idParty,
                'Discount' => NULL,
                'GST' => '16',
                'NetTotal' => $this->input->post('PayableAmount'),
                'PaymentAmount' => $this->input->post('PaymentReceived'),
                'BalanceAmount' => $payableBalance,
                'TransactionDate' => $this->getFieldsValue()['TransactionDate'],
                'TransactionTime' => $this->getFieldsValue()['TransactionTime'],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $createTransaction = $paymentModel->createTransaction($transactionData);
            if ($createTransaction === "Transaction Done Successfully") {
                $payableData = array(
                    'PayableAmount' => $payableBalance,
                );
                $updatePayable = $paymentModel->updatePayable($this->input->post('idPayable'), $payableData);
                if ($updatePayable === "Payable Updated Successfully") {
                    $this->session->set_flashdata('insertmessage', '<h4>' . $createTransaction . '</h4>');
                    redirect(base_url() . "index.php/payment/index");
                }
            }
        } else {
            $idParty = $this->input->post('idCustomer');
            $receiveableBalance = $this->input->post('TotalAmount') - $this->input->post('PaymentReceived');
            if ($receiveableBalance <= 0) {
                $receiveableBalance = 0;
            }
            $transactionData = array(
                'TransactionType' => $transactionType,
                'PaymentType' => $this->input->post('PaymentMode'),
                'FromDepartment' => $this->input->post('From'),
                'Description' => $this->input->post('Description'),
                'idCustomer' => $idParty,
                'idVendor' => $idParty,
                'Discount' => NULL,
                'GST' => '16',
                'NetTotal' => $this->input->post('TotalAmount'),
                'PaymentAmount' => $this->input->post('PaymentReceived'),
                'BalanceAmount' => $receiveableBalance,
                'TransactionDate' => $this->getFieldsValue()['TransactionDate'],
                'TransactionTime' => $this->getFieldsValue()['TransactionTime'],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $createTransaction = $paymentModel->createTransaction($transactionData);
            if ($createTransaction === "Transaction Done Successfully") {
                $receivableData = array(
                    'ReceiveableAmount' => $receiveableBalance,
                );
                $updateReceivable = $paymentModel->updateReceivable($this->input->post('idTotalAmount'), $receivableData);
                if ($updateReceivable === "Receivable Updated Successfully") {
                    $this->session->set_flashdata('insertmessage', '<h4>' . $createTransaction . '</h4>');
                    redirect(base_url() . "index.php/payment/index");
                }
            }
        }
    }

    function search() {
        $paymentModel = new F_payment();
        $idParty = $this->input->post('idParty');
        $type = $this->input->post('party');
        $department = $this->input->post('$department');
        $data = $paymentModel->getPayment($idParty, $type,$department);
        $paymentData = json_encode($data);
        echo $paymentData;
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "TransactionDate" => date("Y-m-d"), "TransactionTime" => date("H:i:s"));
        return $fieldsValue;
    }

}
