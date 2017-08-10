<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class UrgentOrder extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_invoices');
        $this->load->model('Order_mode');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
		if(isset($_POST['BrandCode']))
        $this->session->set_userdata('BrandCode', $_POST['BrandCode']);
        $Data['OrderType'] = $invoice->geturgentorderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Part'] = $this->parts("Urgent Order");
        $this->load->view('header_parts', $Data);
        $this->load->view('otherpurchase', $Data);
        $this->load->view('footer');
    }

    function view() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getOtherPurchaseCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Type'] = $invoice->fillInvoiceTypeCombo();
        $Data['AllTgmo'] = $invoice->allOtherPurchase();
        $this->load->view('header_parts', $Data);
        $this->load->view('view_invoice', $Data);
        $this->load->view('footer');
    }

    function parts($Type = NULL) {
        $invoice = new Parts_invoices();
        return $invoice->fillPartCombo($Type);
//        $fillPartCombo = $invoice->fillPartCombo();
//        echo json_encode($fillPartCombo);
    }

    function dispatch() {
        $invoice = new Parts_invoices();
        $fillDispatchCombo = $invoice->fillDispatchModeCombo();
        echo json_encode($fillDispatchCombo);
    }

    function saveOtherPurchase() {
        $invoice = new Parts_invoices();
        $saveDhamkapackage = $invoice->saveOtherPurchase();
        redirect(base_url() . "/index.php/UrgentOrder/index");
    }

    function allOtherPurchase() {
        $invoice = new Parts_invoices();
        $Dhamkapackage = $invoice->allOtherPurchase();
        echo json_encode($Dhamkapackage);
    }

    function delete() {
        $invoice = new Parts_invoices();
        $idOrderNumber = $invoice->oneOtherPurchase($_POST["id"])[0];
        if (!empty($idOrderNumber)) {
            $deleteDailyOrder = $invoice->deleteOtherPurchase($idOrderNumber["idOrderNumber"]);
            if ($deleteDailyOrder) {
                echo json_encode(["success" => "true"]);
            } else {
                echo json_encode(["success" => "false"]);
            }
        }
    }
    
    function orderNumber() {
        $invoice = new Parts_invoices();
        $orderNumber = $invoice->getOrderNumber($invoice->getDailyOrderCode()[0]);
        return $orderNumber;
    }

}
