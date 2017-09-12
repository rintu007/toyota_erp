<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Zone extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_zone');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index() {
        $Zone = new Parts_zone();
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $Data['Zone'] = $Zone->allZone();
        $Data['Warehouse'] = $Zone->fillWarehouseCombo();
        $this->load->view('header_parts', $Data);
        $this->load->view('zone', $Data);
        $this->load->view('footer');
    }

    function newZone() {
        $Zone = new Parts_zone();
        $this->form_validation->set_rules('ZoneName', 'Zone Name', 'required|xss_clean');
        $this->form_validation->set_rules('WarehouseId', 'Warehouse ID', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $RackData = array(
                'ZoneName' => $this->input->post('ZoneName'),
                'WarehouseId' => $this->input->post('WarehouseId'),
                'CreatedDate' => date('Y/m/d')
            );
            $Zone->insertZone($RackData);
            redirect(base_url() . "index.php/zone/index");
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
            $this->Parts_rack->updateRack($idRack, $RackData);
            redirect(base_url() . "index.php/rack/index");
        }
    }

    function search() {
        $Zone = new Parts_zone();
        $Search = $this->input->post('search');
        $InventorySearch = $Zone->searchZone($Search);
        echo json_encode($InventorySearch);
    }

}
