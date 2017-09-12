<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Deliveryorder extends CI_Controller {

    public $do;
    public function __construct() {
        parent::__construct();
        $this->load->model('Car_pbo');
        $this->load->model('Car_deliveryorder');
        $this->load->model('Car_resource_book');
        $this->load->library('form_validation');
        $this->do = new Car_deliveryorder;
    }

    function generate_do($idDispatch) {

        $this->data['dispatchdata'] = $this->do->get_data($idDispatch);
//        var_dump($this->data['dispatchdata'] );die;
        $this->data['sub_account'] = $this->do->get_sub_account();
        $this->data['id'] = $this->do->get_max_do_id();


        $Resourcebook = new Car_resource_book();
        $GetCustomers = $Resourcebook->fillCustomerCombo();
        $this->data['customers'] = $GetCustomers;
//        $this->data['pd'] = $this->Car_resource_book->get_car_pbo_paymentdetail($idpbo);

        $this->load->view('header');
        $this->load->view('do_generate', $this->data);
        $this->load->view('footer');
    }

    function index() {


        $Data['dorder'] = $this->do->get_do_list();
        $this->load->view('header');
        $this->load->view('deliveryorderlist', $Data);
        $this->load->view('footer');
    }
    function do_view($id) {


        $Data['dorder'] = $this->do->get_do($id);
        $Data['dispatchdata'] = $this->do->get_data($Data['dorder']->idDispatch);
        $Data['sub_account'] = $this->do->get_sub_account();

        $Resourcebook = new Car_resource_book();
        $GetCustomers = $Resourcebook->fillCustomerCombo();
        $Data['customers'] = $GetCustomers;

        $this->load->view('header');
        $this->load->view('do_view', $Data);
        $this->load->view('footer');
    }


    function insert_do()
    {

        echo $this->do->inser_do();
//        var_dump($_POST);die;

    }



}

