<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Accessories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Parts_invoices');
        $this->load->model('Car_accessories');
        $this->load->library('form_validation');
    }

    function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['CarAccessories'] = $this->Car_accessories->allCarAccessories();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $this->load->view('header_parts', $Data);
        $this->load->view('accessories', $Data);
        $this->load->view('footer');
    }

    function add() {
        $caData = array(
            'AccessoryName' => $this->input->post('accessoryname'),
            'Price' => $this->input->post('price'),
            'CreatedDate' => date('Y/m/d')
        );

        $this->Car_accessories->insertCarAccessories($caData);

        redirect(base_url() . "index.php/accessories/index");
    }

    function update($IdAccessory) {
        $accessory = $this->Car_accessories->oneCarAccessory($IdAccessory);

        $this->form_validation->set_rules('accessoryId', 'IdAccessory', 'required|xss_clean');
        $this->form_validation->set_rules('accessoryname', 'Accessory Name', 'required|xss_clean');
        $this->form_validation->set_rules('price', 'Price', 'required|xss_clean');

        if (isset($_POST) && !empty($_POST)) {

            $IdAccessory = $this->input->post('accessoryId');

            $AccessoryData = array(
                'AccessoryName' => $this->input->post('accessoryname'),
                'Price' => $this->input->post('price'),
            );
            if ($this->form_validation->run() === true) {
                $updateAccessory = $this->Car_accessories->updateCarAccessories($IdAccessory, $AccessoryData);
                redirect(base_url() . 'index.php/accessories/index');
            } else {
                echo "Cannot Update Accessory";
            }
        } else {
            $this->data['accessory'] = $accessory;

            $this->load->view('header_parts');
            $this->load->view('edit_accessories', $this->data);
            $this->load->view('footer');
        }
    }

}