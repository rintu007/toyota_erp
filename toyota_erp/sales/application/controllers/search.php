<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_pbo');
        $this->load->model('Car_resource_book');
        $this->load->model('Car_customer');
        $this->load->library('form_validation');
    }

    function index() {
        $this->load->view('header');
        $this->load->view('search');
        $this->load->view('footer');
    }

}
