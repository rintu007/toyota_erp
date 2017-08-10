<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Inventory extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_name');
        $this->load->model('Inventory_main');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Inventory = new Inventory_main();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $Data['Inventory'] = $Inventory->allInventory();
        $this->load->view('header_parts', $Data);
        $this->load->view('inventory', $Data);
        $this->load->view('footer');
    }

    function search() {
        $Inventory = new Inventory_main();
        $Search = $this->input->post('search');
        $SearchInventory = $Inventory->searchInventory($Search);
        echo json_encode($SearchInventory);
    }

}
