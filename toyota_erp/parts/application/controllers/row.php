<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Row extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_row');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index($ZoneRow = NULL) {
        $Row = new Parts_row();
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $Data['Row'] = $Row->allRow();
        $Data['Zone'] = $Row->fillZoneCombo();
        $Data['Warehouse'] = $Row->fillWarehouseCombo();
        $Data['ZoneRow'] = $ZoneRow;
        $this->load->view('header_parts', $Data);
        $this->load->view('row', $Data);
        $this->load->view('footer');
    }

//    public function lists($AlreadyExists) {
//        $Row = new Parts_row();
//        $Data = array();
//        $invoice = new Parts_invoices();
//        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
//        $Data['DealerCode'] = $invoice->getDealerCode()[0];
//        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
//        $Data['message'] = $this->session->flashdata('message');
//        $Data['Row'] = $Row->allRow();
//        $Data['Zone'] = $Row->fillZoneCombo();
//        $Data['Warehouse'] = $Row->fillWarehouseCombo();
//        $Data['AlreadyExists'] = $AlreadyExists;
//        $this->load->view('header_parts', $Data);
//        $this->load->view('row', $Data);
//        $this->load->view('footer');
//    }

    function newRow() {
        $Row = new Parts_row();
        $this->form_validation->set_rules('ToRow', 'To', 'required|xss_clean');
        $this->form_validation->set_rules('FromRow', 'From', 'required|xss_clean');
        $this->form_validation->set_rules('ZoneId', 'Zone ID', 'required|xss_clean');
        $this->form_validation->set_rules('WarehouseId', 'Warehouse ID', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $RowData = array(
                'To' => $this->input->post('ToRow'),
                'From' => $this->input->post('FromRow'),
                'ZoneId' => $this->input->post('ZoneId'),
                'WarehouseId' => $this->input->post('WarehouseId'),
                'CreatedDate' => date('Y/m/d')
            );
            $insertRow = $Row->insertRow($RowData);
//            if ($insertRow) {
//                $this->session->set_flashdata('message', '<h4 style="background-color: green;color: white;font-size: medium;">Zone Row Inserted !!</h4>');
//            } else {
//                $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: medium;">Zone Row Already Exisit !!</h4>');
//            }
//            echo $insertRow;
//            $this->
//            redirect(base_url() . "index.php/row/index/");
            $this->index($insertRow);
        }
    }

    function update() {
        $Row = new Parts_row();
        $this->form_validation->set_rules('RowNumber', 'To', 'required|xss_clean');
//        $this->form_validation->set_rules('FromRow', 'From', 'required|xss_clean');
        $this->form_validation->set_rules('ZoneId', 'Zone ID', 'required|xss_clean');
        $this->form_validation->set_rules('WarehouseId', 'Warehouse ID', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idRow = $this->input->post('RowId');
            $RowData = array(
                'RowNumber' => $this->input->post('RowNumber'),
//                'From' => $this->input->post('FromRow'),
                'ZoneId' => $this->input->post('ZoneId'),
                'WarehouseId' => $this->input->post('WarehouseId')
            );
            $Row->updateRow($RowData, $idRow);
            redirect(base_url() . "index.php/row/index");
        }
    }

    function search() {
        $Row = new Parts_row();
        $Search = $this->input->post('search');
        $RowSearch = $Row->searchRow($Search);
        $PartRow = json_encode($RowSearch);
        print_r($PartRow);
    }

}
