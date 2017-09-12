<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class OrderMode extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Parts_invoices');
        $this->load->model('Order_mode');
        $this->load->library('form_validation');
    }

    public function index() {
        $OrderMode = new Order_mode();
        $this->form_validation->set_rules('OrderMode', 'Order Mode Name', 'required|xss_clean');
        $this->form_validation->set_rules('Code', 'Order Mode Code', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $OrderModeData = array(
                'Title' => $this->input->post('OrderMode'),
                'Timeline' => $this->input->post('Timeline'),
                'Code' => $this->input->post('Code'),
            );

            $insertOrderMode = $OrderMode->insertOrderMode($OrderModeData);

            if ($insertOrderMode) {
                $this->session->set_flashdata('Response', '<h4 style="background-color: green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Order Mode has been added successfully!</h4>');
                redirect(base_url() . "index.php/ordermode/");
            } else {
                $this->session->set_flashdata('Response', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please fill all required feilds!</h4>');
                redirect(base_url() . "index.php/ordermode/");
            }
        }

        $Data = array();

        $invoice = new Parts_invoices();

        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['OrderMode'] = $OrderMode->allOrderModes();
        $Data['Response'] = $this->session->flashdata('Response');

        $this->load->view('header_parts', $Data);
        $this->load->view('ordermode', $Data);
        $this->load->view('footer');
    }

    function update() {
        $OrderMode = new Order_mode();

        $this->form_validation->set_rules('id', ' id of Order Mode', 'required|xss_clean');
        $this->form_validation->set_rules('OrderMode', 'Order Mode Name', 'required|xss_clean');
        $this->form_validation->set_rules('Code', 'Order Mode Code', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $id = $this->input->post('id');

            $OrderModeData = array(
                'Title' => $this->input->post('OrderMode'),
                'Timeline' => $this->input->post('Timeline'),
                'Code' => $this->input->post('Code'),
            );

            $updateOrderMode = $OrderMode->updateOrderMode($id, $OrderModeData);

            if ($updateOrderMode) {
                $this->session->set_flashdata('Response', '<h4 style="background-color: green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Order Mode Has Been Updated Successfully!</h4>');
                redirect(base_url() . "index.php/ordermode/");
            }
        }
    }

    function search() {
        $OrderMode = new Order_mode();

        $SearchKeyword = $this->input->post('search');
        $OrderModeSearch = $OrderMode->searchOrderMode($SearchKeyword);
        $SearchOrderMode = json_encode($OrderModeSearch);
        print_r($SearchOrderMode);
    }

}
