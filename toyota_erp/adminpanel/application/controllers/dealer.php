<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Author: Umar Akbar
 * Description: Dealer controller class
 */

class Dealer extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_dealer');
        $this->load->library('form_validation');
    }

    public function index() {
        $modelDealer = new M_dealer();
        $this->data['dealer'] = $modelDealer->fillDealerType();
        $this->data['limit'] = $modelDealer->fillLimitType();
        $this->data['AllDealers'] = $modelDealer->allDealers();
        $this->load->view('header');
        $this->load->view('v_dealer', $this->data);
        $this->load->view('footer');
    }

    function newdealer() {
        $modelDealer = new M_dealer();
        $this->form_validation->set_rules('dealer_name', 'Varaint Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $DealerData = array(
                'Name' => $this->input->post('dealer_name'), 'AmountLimit' => $this->input->post('amount_limit'),
                'LimitQuantity' => $this->input->post('limit_quantity'), 'VendorLimitType' => $this->input->post('limit'),
                'Address' => $this->input->post('address'), 'DealerType' => $this->input->post('dealer'),
                'IsAllow' => 1);
            $modelDealer->insertDealer($DealerData);
            redirect(base_url() . "index.php/dealer/index");
        }
    }

    function update() {
        $modelDealer = new M_dealer();
        $this->form_validation->set_rules('dealer_id', 'Dealer ID', 'required|xss_clean');
        $this->form_validation->set_rules('dealer_name', 'Dealer Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $DealerId = $this->input->post('dealer_id');
            $DealerData = array(
                'Name' => $this->input->post('dealer_name'), 'AmountLimit' => $this->input->post('amount_limit'),
                'LimitQuantity' => $this->input->post('limit_quantity'), 'VendorLimitType' => $this->input->post('limit'),
                'Address' => $this->input->post('address'), 'DealerType' => $this->input->post('dealer'),
                'IsAllow' => 1);
            $modelDealer->updateDealer($DealerId, $DealerData);
            redirect(base_url() . "index.php/dealer/index");
        }
    }

    function search() {
        $modelDealer = new M_dealer();
        $search = $this->input->post('search');
        $dataSearch = $modelDealer->searchDealer($search);
        $CarVariants = json_encode($dataSearch);
        print_r($CarVariants);
    }

}
