<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_name extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_name');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->data['Parts'] = $this->Parts_name->allParts();
        $this->load->view('header_parts');
        $this->load->view('partsName', $this->data);
        $this->load->view('footer');
    }

    function newPart() {
        $this->form_validation->set_rules('PartsId', 'Part ID', 'required|xss_clean');
        $this->form_validation->set_rules('PartsName', 'Part Name', 'required|xss_clean');
        $this->form_validation->set_rules('VariantId', 'Variant ID', 'required|xss_clean');
        $this->form_validation->set_rules('Quantity', 'Quantity', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $PartData = array(
                'idPart' => $this->input->post('PartsId'),
                'PartName' => $this->input->post('PartsName'),
                'VariantId' => $this->input->post('VariantId'),
                'Quantity' => $this->input->post('Quantity'),
            );
            $this->Parts_name->insertParts($PartData);
            redirect(base_url() . "index.php/partsName/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('PartsId', 'Part ID', 'required|xss_clean');
        $this->form_validation->set_rules('PartsName', 'Part Name', 'required|xss_clean');
        $this->form_validation->set_rules('VariantId', 'Variant ID', 'required|xss_clean');
        $this->form_validation->set_rules('Quantity', 'Quantity', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idPart = $this->input->post('PartsId');
            $PartData = array(
                'idPart' => $this->input->post('PartsId'),
                'PartName' => $this->input->post('PartsName'),
                'VariantId' => $this->input->post('VariantId'),
                'Quantity' => $this->input->post('Quantity'),
            );
            $this->Parts_name->updateParts($idPart, $PartData);
            redirect(base_url() . "index.php/partsName/index");
        }
    }

    function search() {
        $search = $this->input->post('search');
        $dataSearch = $this->Parts_name->searchPart($search);
        $PartName = json_encode($dataSearch);
        print_r($PartName);
    }

}
