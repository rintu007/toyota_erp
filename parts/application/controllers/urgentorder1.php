<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Urgentorder extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_invoices');
        $this->load->model('Order_mode');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $oMode = new Order_mode();
        $this->session->set_userdata('BrandCode', $_POST['BrandCode']);
        $Data['OrderType'] = $invoice->getUrgentOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $this->load->view('header_parts', $Data);
        $this->load->view('urgentorder', $Data);
        $this->load->view('footer');
    }

    function view() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Type'] = $invoice->fillInvoiceTypeCombo();
        $Data['AllDailyOrders'] = $invoice->allDailyOrders();
        $this->load->view('header_parts', $Data);
        $this->load->view('view_invoice', $Data);
        $this->load->view('footer');
    }

    function parts() {
        $invoice = new Parts_invoices();
        $fillPartCombo = $invoice->fillPartCombo();
        echo json_encode($fillPartCombo);
    }

    function dispatch() {
        $invoice = new Parts_invoices();
        $fillDispatchCombo = $invoice->fillDispatchModeCombo();
        echo json_encode($fillDispatchCombo);
    }

    function allUrgentOrders() {
        $invoice = new Parts_invoices();
        $DailyOrder = $invoice->allUrgentOrders();
        echo json_encode($DailyOrder);
    }

    function saveUrgentOrder() {
        $invoice = new Parts_invoices();
        $savePlanOrder = $invoice->saveUrgentOrder();
    }
    
    function delete() {
        $invoice = new Parts_invoices();
        $idOrderNumber = $invoice->oneUrgentOrder($_POST["id"])[0];
        if (!empty($idOrderNumber)) {
            $deleteDailyOrder = $invoice->deleteUrgentOrder($idOrderNumber["idOrderNumber"]);
            if ($deleteDailyOrder) {
                echo json_encode(["success" => "true"]);
            } else {
                echo json_encode(["success" => "false"]);
            }
        }
    }

    function searchdailyorder() {
        $SearchKeyword = $this->input->post('idPart');
        $invoice = new Parts_invoices();
        $InvoiceSearch = $invoice->searchDailyOrder($SearchKeyword);
        $PartInvoice = json_encode($InvoiceSearch);
        echo $PartInvoice;
    }

    function orderNumber() {
        $invoice = new Parts_invoices();
        $orderNumber = $invoice->getOrderNumber($invoice->getUrgentOrderCode()[0]);
        return $orderNumber;
    }

}
