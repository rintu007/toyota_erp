<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Quotation extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Rb_quotation');
    }

    public function index($idRb) {
        $this->data['Quotation'] = $this->Rb_quotation->generateQuotation($idRb);
        $this->load->view('header');
        $this->load->view('quotation', $this->data);
        $this->load->view('footer');
    }

}
