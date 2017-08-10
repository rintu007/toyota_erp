<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Followup extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_pbo');
        $this->load->model('Car_resource_book');
        $this->load->model('Car_customer');
        $this->load->model('Car_lost_sale');
        $this->load->library('form_validation');
    }

    function index() {
        $this->data['CustomerFollowup'] = $this->Car_resource_book->customerFollowUp();

        $this->load->view('header');
        $this->load->view('followup', $this->data);
        $this->load->view('footer');
    }

    function attend($followupID) {
        $this->Car_resource_book->updateCustomerFollowUp($followupID);

        redirect(base_url() . "index.php/Followup/index");
    }

}
