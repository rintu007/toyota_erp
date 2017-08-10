<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class OpenPbo extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_pbo');
        $this->load->model('Car_resource_book');
        $this->load->model('Car_customer');
        $this->load->model('Car_lost_sale');
        $this->load->library('form_validation');
    }

    function index() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];
        $this->data['ResourceBook'] = $this->Car_resource_book->allRbNoPbo($UserId, $UserRole);
        $this->data['PboMessage'] = $this->session->flashdata('PBO');

        $this->load->view('header');
        $this->load->view('openpbo', $this->data);
        $this->load->view('footer');
    }

    function search() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $search = $this->input->post('search');
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];
        $dataSearch = $this->Car_resource_book->searchRBnoPbo($search, $UserId, $UserRole);
//        $dataSearch = $this->Car_resource_book->searchRBnoPbo($search, $UserId);

        $ResourceBook = json_encode($dataSearch);
        print_r($ResourceBook);
    }

}
