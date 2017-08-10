<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Category extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_category');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $Data['Category'] = $this->Parts_category->allCategory();
        $this->load->view('header_parts', $Data);
        $this->load->view('category', $Data);
        $this->load->view('footer');
    }

    function newCategory() {
        $this->form_validation->set_rules('CategoryName', 'Category Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $CategoryData = array(
                'CategoryName' => $this->input->post('CategoryName'),
                'CreatedDate' => date('Y/m/d')
            );
            $this->Parts_category->insertCategory($CategoryData);
            redirect(base_url() . "index.php/category/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('CategoryName', 'Category Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idCategory = $this->input->post('CategoryId');
            $CategoryData = array(
                'CategoryName' => $this->input->post('CategoryName'),
            );
            $this->Parts_category->updateCategory($idCategory, $CategoryData);
            redirect(base_url() . "index.php/category/index");
        }
    }

    function search() {
        $Search = $this->input->post('search');
        $CategorySearch = $this->Parts_category->searchCategory($Search);
        $PartCategory = json_encode($CategorySearch);
        print_r($PartCategory);
    }

}
