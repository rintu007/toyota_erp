<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Bin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_bin');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber();
        $Data['message'] = $this->session->flashdata('message');
        $Data['Rack'] = $this->Parts_bin->allRack();
        $Data['Zone'] = $this->Parts_bin->fillZoneCombo();
        $Data['Row'] = $this->Parts_bin->fillRowCombo();
        $Data['Warehouse'] = $this->Parts_bin->fillWarehouseCombo();
        $this->load->view('header_parts', $Data);
        $this->load->view('bin', $Data);
        $this->load->view('footer');
    }

    function newRack() {
        $this->form_validation->set_rules('RackNumber', 'Rack Number', 'required|xss_clean');
        $this->form_validation->set_rules('ZoneId', 'Zone ID', 'required|xss_clean');
        $this->form_validation->set_rules('RowId', 'Row ID', 'required|xss_clean');
        $this->form_validation->set_rules('WarehouseId', 'Warehouse ID', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $RackData = array(
                'RackNumber' => $this->input->post('RackNumber'),
                'ZoneId' => $this->input->post('ZoneId'),
                'RowId' => $this->input->post('RowId'),
                'WarehouseId' => $this->input->post('WarehouseId')
            );
            $this->Parts_bin->insertRack($RackData);
            redirect(base_url() . "index.php/bin/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('RackNumber', 'Rack Number', 'required|xss_clean');
        $this->form_validation->set_rules('ZoneId', 'Zone ID', 'required|xss_clean');
        $this->form_validation->set_rules('RowId', 'Row ID', 'required|xss_clean');
        $this->form_validation->set_rules('WarehouseId', 'Warehouse ID', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idRack = $this->input->post('RackId');
            $RackData = array(
                'RackNumber' => $this->input->post('RackNumber'),
                'ZoneId' => $this->input->post('ZoneId'),
                'RowId' => $this->input->post('RowId'),
                'WarehouseId' => $this->input->post('WarehouseId')
            );
            $this->Parts_bin->updateRack($RackData, $idRack);
            redirect(base_url() . "index.php/bin/index");
        }
    }

    function search() {
        $Search = $this->input->post('search');
        $InventorySearch = $this->Parts_bin->searchRack($Search);
        $PartInventory = json_encode($InventorySearch);
        print_r($PartInventory);
    }

    function getZoneByWarehouse() {
        $WarehouseId = $this->input->post('WarehouseId');
        $GetZones = $this->Parts_bin->fillZoneByWarehouse($WarehouseId);
        echo json_encode($GetZones);
    }

    function getRowByZone() {
        $ZoneId = $this->input->post('ZoneId');
        $GetRows = $this->Parts_bin->fillRowByZone($ZoneId);
        echo json_encode($GetRows);
    }

}
