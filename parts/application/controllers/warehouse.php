<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Warehouse extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_warehouse');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Warehouse = new Parts_warehouse();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $Data['Warehouse'] = $Warehouse->allWarehouse();
        $this->load->view('header_parts', $Data);
        $this->load->view('warehouse', $Data);
        $this->load->view('footer');
    }

    function newWarehouse() {
        $Warehouse = new Parts_warehouse();
        $this->form_validation->set_rules('Name', 'Warehouse Name', 'required|xss_clean');
        $this->form_validation->set_rules('MobileNumber', 'Mobile Number', 'required|xss_clean');
        $this->form_validation->set_rules('Address', 'Warehouse Address', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $WarehouseData = array(
                'Name' => $this->input->post('Name'),
                'PersonIncharge' => $this->input->post('Incharge'),
                'Cellphone' => $this->input->post('MobileNumber'),
                'Address' => $this->input->post('Address')
            );
            $Warehouse->insertWarehouse($WarehouseData);
            redirect(base_url() . "index.php/warehouse/index");
        }
    }

    function update() {
        $Warehouse = new Parts_warehouse();
        $this->form_validation->set_rules('Name', 'Warehouse Name', 'required|xss_clean');
        $this->form_validation->set_rules('MobileNumber', 'Mobile Number', 'required|xss_clean');
        $this->form_validation->set_rules('Address', 'Warehouse Address', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idWarehouse = $this->input->post('WarehouseId');
            $WarehouseData = array(
                'Name' => $this->input->post('Name'),
                'PersonIncharge' => $this->input->post('Incharge'),
                'Cellphone' => $this->input->post('MobileNumber'),
                'Address' => $this->input->post('Address')
            );
            $Warehouse->updateWarehouse($idWarehouse, $WarehouseData);
            redirect(base_url() . "index.php/warehouse/index");
        }
    }

    function search() {
        $Warehouse = new Parts_warehouse();
        $Search = $this->input->post('search');
        $WarehouseSearch = $Warehouse->searchWarehouse($Search);
        $PartWarehouse = json_encode($WarehouseSearch);
        print_r($PartWarehouse);
    }

}
