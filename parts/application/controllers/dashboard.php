<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_name');
        $this->load->model('Parts_inventory');
        $this->load->model('Parts_invoices');
        $this->load->model('Parts_service');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Service = new Parts_service();
        $DailyOrderCode = $invoice->getDailyOrderCode();
        if ($DailyOrderCode != NULL) {
            $DailyOrderCode = $invoice->getDailyOrderCode()[0];
        } else {
            $DailyOrderCode = NULL;
        }
        $Data['OrderType'] = $DailyOrderCode;
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Requests'] = $Service->count();
        $Data['message'] = $this->session->flashdata('message');
        $this->load->view('header_parts', $Data);
        $this->load->view('dashboard', $Data);
        $this->load->view('footer');
    }

}
