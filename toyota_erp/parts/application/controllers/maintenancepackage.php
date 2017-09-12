<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Maintenancepackage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_invoices');
        $this->load->model('Order_mode');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        //$this->session->set_userdata('BrandCode', $_POST['BrandCode']);
        $Data['OrderType'] = $invoice->getMaintenancePackageCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Part'] = $this->parts('Maintenance Package');
        $this->load->view('header_parts', $Data);
        $this->load->view('maintenancepackage', $Data);
        $this->load->view('footer');
    }

    function view() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getMaintenancePackageCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Type'] = $invoice->fillInvoiceTypeCombo();
        $Data['allMaintenancePackage'] = $invoice->allMaintenancePackage();
        $this->load->view('header_parts', $Data);
        $this->load->view('view_invoice', $Data);
        $this->load->view('footer');
    }

    function parts($Type = NULL) {
        $invoice = new Parts_invoices();
        return $invoice->fillPartCombo($Type);
//        $fillPartCombo = $invoice->fillPartCombo($Type);
//        echo json_encode($fillPartCombo);
    }

    function dispatch() {
        $invoice = new Parts_invoices();
        $fillDispatchCombo = $invoice->fillDispatchModeCombo();
        echo json_encode($fillDispatchCombo);
    }

    function MaintenancePackage($idInvoice) {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getMaintenancePackageCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber();
        $Data['GetInvoice'] = $invoice->oneDailyOrder($idInvoice)[0];
        $this->load->view('header_parts', $Data);
        $this->load->view('maintenancepackage', $Data);
        $this->load->view('footer');
    }

    function saveMaintenancePackage() {
        $invoice = new Parts_invoices();
        $saveMaintenancePackage = $invoice->saveMaintenancePackage();
        redirect(base_url() . "/index.php/maintenancepackage/index");
    }

    function allMaintenancePackage() {
        $invoice = new Parts_invoices();
        $MaintenancePackage = $invoice->allMaintenancePackage();
        echo json_encode($MaintenancePackage);
    }

    function delete() {
        $invoice = new Parts_invoices();
        $idOrderNumber = $invoice->oneMaintenancePackage($_POST["id"])[0];
        if (!empty($idOrderNumber)) {
            $deleteDailyOrder = $invoice->deleteMaintenancePackage($idOrderNumber["idOrderNumber"]);
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
