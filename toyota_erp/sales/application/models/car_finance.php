<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_finance extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Modified acc to Finance Module
    function insertFinance($paymentData) {
        $this->db->select('idSaleNote');
        $this->db->where('ChasisNo', $paymentData['SaleNoteNumber']);
        $this->db->from('SaleNoteNumberView');
        $SaleNote = $this->db->get();

        $idSaleNote = $SaleNote->result_array()[0];
        $this->db->select('Receipt');
        $this->db->where('SaleNoteId', $idSaleNote['idSaleNote']);
        $this->db->from('car_finance');
        $FinanceBalance = $this->db->get();
        $Balance = $FinanceBalance->result_array();

        $this->db->select('Receivable');
        $this->db->where('SaleNoteId', $idSaleNote['idSaleNote']);
        $this->db->from('car_finance');
        $FinanceBal = $this->db->get();
        $Receive = $FinanceBal->result_array();

        foreach ($Balance as $val) {
            $sum = $val;
        }

        $a = $sum['Receipt'] + $paymentData['payment'] . ".00";
        $arr = array($a);

        $b = $Receive[0]['Receivable'];
        $arr1 = array($b);

        foreach ($Receive as $val) {
            $sum1 = $val;
        }

        $subtracted = array_map(function ($x, $y) {
            return $y - $x;
        }, $arr, $arr1);

        $result = array_combine(array_keys($arr), $subtracted);

        $this->db->set('SaleNoteId', $idSaleNote['idSaleNote']);
        $this->db->set('Receipt', $paymentData['payment']);
        $this->db->set('Balance', $result[0]);
        $this->db->set('Date', $paymentData['Date']);
        $InsertFinance = $this->db->insert('car_finance');
        $updatedBalance = $result[0];
        if ($updatedBalance <= 0) {
            $updatedBalance = 0;
        }
        if ($InsertFinance) {
            $this->Transaction($paymentData, $updatedBalance, $b);
            return 1;
        } else {
            return 0;
        }
    }

    function updateCarColor($ccID, $ccName) {
        $this->db->where('IdColor', $ccID);
        $this->db->set('ColorName', $ccName);
        $this->db->update('car_color');
    }

    function deleteCarColor($ccID) {
        $this->db->where('IdColor', $ccID);
        $this->db->delete('car_color');
    }

    function OneSaleNoteList($Keyword) {
        $SaleNote = $this->db->select('*')->from('SaleNoteNumberView')->like('ChasisNo', $Keyword)->get();
        return $SaleNote->result_array();
    }

    //Added Following Functions After Finance Module
    function Transaction($paymentData, $balance, $netTotal) {

        $transactionData = array(
            'TransactionType' => 'Receivable',
            'PaymentType' => $paymentData['PaymentMode'],
            'FromDepartment' => 'SalesDepartment',
            'Description' => NULL,
            'idCustomer' => $paymentData['idCustomer'],
            'idVendor' => NULL,
            'Discount' => NULL,
            'GST' => '16',
            'NetTotal' => $netTotal,
            'PaymentAmount' => $paymentData['Payment'],
            'BalanceAmount' => $balance,
            'TransactionDate' => $this->getFieldsValue()['TransactionDate'],
            'TransactionTime' => $this->getFieldsValue()['TransactionTime'],
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $createTransaction = $this->createTransaction($transactionData);
        if ($createTransaction === "Transaction Done Successfully") {
            $receivableData = array(
                'ReceiveableAmount' => $balance,
            );
            $updateReceivable = $this->updateReceivable(NULL, $receivableData);
            if ($updateReceivable === "Receivable Updated Successfully") {
                return True;
            }
        }
    }

    function createTransaction($transactionData) {
        $this->db->insert('f_transaction', $transactionData);
        return "Transaction Done Successfully";
    }

    function updateReceivable($idReceivable, $receivableData) {
        $this->db->where('idReceivable', $idReceivable);
        $this->db->update('f_receivable', $receivableData);
        return "Receivable Updated Successfully";
    }

    function getFieldsValue() {
        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "ReceivableDate" => date("Y-m-d"), "ReceivableTime" => date("H:i:s"));
        return $fieldsValue;
    }

}
