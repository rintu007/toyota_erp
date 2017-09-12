<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Author: Umar Akbar
 * Description: Dealer controller class
 */

class Dealer extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_dealer');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->data['dealer'] = $this->Car_dealer->fillDealerType();
        $this->data['limit'] = $this->Car_dealer->fillLimitType();
        $this->data['AllDealers'] = $this->Car_dealer->allDealers();
        $this->load->view('header');
        $this->load->view('dealer', $this->data);
        $this->load->view('footer');
    }

    function newdealer() {
        $this->form_validation->set_rules('dealer_name', 'Varaint Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $DealerData = array(
                'Name' => $this->input->post('dealer_name'), 'AmountLimit' => $this->input->post('amount_limit'),
                'LimitQuantity' => $this->input->post('limit_quantity'), 'VendorLimitType' => $this->input->post('limit'),
                'Address' => $this->input->post('address'), 'DealerType' => $this->input->post('dealer'),
                'IsAllow' => 1);
            $this->Car_dealer->insertDealer($DealerData);
            redirect(base_url() . "index.php/dealer/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('dealer_id', 'Dealer ID', 'required|xss_clean');
        $this->form_validation->set_rules('dealer_name', 'Dealer Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $DealerId = $this->input->post('dealer_id');
            $DealerData = array(
                'Name' => $this->input->post('dealer_name'), 'AmountLimit' => $this->input->post('amount_limit'),
                'LimitQuantity' => $this->input->post('limit_quantity'), 'VendorLimitType' => $this->input->post('limit'),
                'Address' => $this->input->post('address'), 'DealerType' => $this->input->post('dealer'),
                'IsAllow' => 1);
            $this->Car_dealer->updateDealer($DealerId, $DealerData);
            redirect(base_url() . "index.php/dealer/index");
        }
    }

    function search() {
        $search = $this->input->post('search');
        $dataSearch = $this->Car_dealer->searchDealer($search);
        $CarVariants = json_encode($dataSearch);
        print_r($CarVariants);
    }

}
