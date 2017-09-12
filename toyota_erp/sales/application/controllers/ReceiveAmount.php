<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ReceiveAmount extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_pbo');
        $this->load->model('Car_resource_book');
        $this->load->library('form_validation');
    }

    function index($idpbo) {
        $this->data['receive'] = $this->Car_pbo->ReceiveAmount($idpbo);
        $this->data['pd'] = $this->Car_resource_book->get_car_pbo_paymentdetail($idpbo);
        $this->load->view('header');
        $this->load->view('AmountReceive', $this->data);
        $this->load->view('footer');
    }

    function updateamount() {
        $pbo = $this->input->post('Idpbo');
        $update = $this->Car_pbo->UpdateAmount($pbo);
//        echo 'aa';
        redirect(base_url() . "index.php/pbo_list/PartialAmount");
//        $this->data['PartialAmount'] = $this->Car_pbo->PartialPayment();
//        $this->load->view('header');
//        $this->load->view('PartialAmount', $this->data);
//        $this->load->view('footer');
    }
    

}

