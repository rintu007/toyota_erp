<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Finance extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_finance');
        $this->load->model('Car_mode_payment');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $paymentMode = new Car_mode_payment();
        $Data['Response'] = $this->session->flashdata('Response');
        $Data['paymentMode'] = $paymentMode->allModePayment();
        $this->load->view('header');
        $this->load->view('payment', $Data);
        $this->load->view('footer');
    }

    function add() {
        $Finance = new Car_finance();
        $this->form_validation->set_rules('payment', 'Payment', 'required|xss_clean');
        $this->form_validation->set_rules('SaleNoteNumber', 'Sale Note Number', 'required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $paymentData = array(
                'SaleNoteNumber' => $this->input->post('SaleNoteNumber'),
                'Payment' => $this->input->post('payment'),
                'Date' => $this->input->post('date'),
                'idCustomer' => $this->input->post('idCustomer'),
                'PaymentMode' => $this->input->post('PaymentMode')
            );
            $insertFinance = $Finance->insertFinance($paymentData);
            if ($insertFinance) {
                $this->session->set_flashdata('Response', '<h4>Payment Has Been Submitted!</h4>');
                redirect(base_url() . "index.php/finance/index");
            } else {
                $this->session->set_flashdata('Response', '<h4>Please Retry Again Some Error Occured!</h4>');
                redirect(base_url() . "index.php/finance/index");
            }
        } else {
            $this->session->set_flashdata('Response', '<h4>Must Fill All Fields!</h4>');
            redirect(base_url() . "index.php/finance/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('color_id', 'Color ID', 'required|xss_clean');
        $this->form_validation->set_rules('color_name', 'Full Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $ColorId = $this->input->post('color_id');
            $ColorName = $this->input->post('color_name');
            $this->Car_color->updateCarColor($ColorId, $ColorName);
            redirect(base_url() . "index.php/color/index");
        }
    }

    function search() {
        $Finance = new Car_finance();
        $search = $this->input->post('search');
        $dataSearch = $Finance->OneSaleNoteList($search);
        $SaleNote = json_encode($dataSearch);
        print_r($SaleNote);
    }

}
