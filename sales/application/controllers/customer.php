<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_customer');
        $this->load->library('form_validation');
    }

    function index() {
        $this->data['title'] = 'Add Customer';

        //validate form input
        $this->form_validation->set_rules('customerName', 'Customer Name', 'required|xss_clean');
        $this->form_validation->set_rules('fatherName', 'Father Name', 'required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'required|xss_clean');
        $this->form_validation->set_rules('province', 'Province', 'required|xss_clean');
        $this->form_validation->set_rules('cnicNumber', 'CNIC Number', 'required|xss_clean');
        $this->form_validation->set_rules('ntnNumber', 'NTN Number', 'required|xss_clean');
        $this->form_validation->set_rules('telePhone', 'Telephone', 'required|xss_clean');
        $this->form_validation->set_rules('cellPhone', 'Cellphone', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
        $this->form_validation->set_rules('customerType', 'Customer Type', 'required|xss_clean');
        $this->form_validation->set_rules('createdDate', 'Created Date', 'required|xss_clean');

        if ($this->form_validation->run() == true) {
            $customerData = array(
                'CustomerName' => $this->input->post('customerName'),
                'FatherName' => $this->input->post('fatherName'),
                'AddressDetails' => $this->input->post('address'),
                'City' => $this->input->post('city'),
                'Province' => $this->input->post('province'),
                'Cnic' => $this->input->post('cnicNumber'),
                'Ntn' => $this->input->post('ntnNumber'),
                'Telephone' => $this->input->post('telePhone'),
                'Cellphone' => $this->input->post('cellPhone'),
                'Email' => $this->input->post('email')
            );
            $ctData = array(
                'CustomerType' => $this->input->post('customerType'),
                'CreatedDate' => $this->input->post('createdDate')
            );

            $this->Car_customer->insertCustomer($customerData, $ctData);

            $this->session->set_flashdata('message', "<p>Customer & CustomerType added successfully.</p>");

            redirect('customer');
        } else {
            //display the add product form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $this->data['customerName'] = array(
                'name' => 'customerName',
                'id' => 'customerName',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('customerName'),
            );
            $this->data['fatherName'] = array(
                'name' => 'fatherName',
                'id' => 'fatherName',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('fatherName'),
            );
            $this->data['address'] = array(
                'name' => 'address',
                'id' => 'address',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('address'),
            );
            $this->data['city'] = array(
                'name' => 'city',
                'id' => 'city',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('city'),
            );
            $this->data['province'] = array(
                'name' => 'province',
                'id' => 'province',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('province'),
            );
            $this->data['cnicNumber'] = array(
                'name' => 'cnicNumber',
                'id' => 'cnicNumber',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('cnicNumber'),
            );
            $this->data['ntnNumber'] = array(
                'name' => 'ntnNumber',
                'id' => 'ntnNumber',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('ntnNumber'),
            );
            $this->data['telePhone'] = array(
                'name' => 'telePhone',
                'id' => 'telePhone',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('telePhone'),
            );
            $this->data['cellPhone'] = array(
                'name' => 'cellPhone',
                'id' => 'cellPhone',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('cellPhone'),
            );
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['customerType'] = array(
                'name' => 'customerType',
                'id' => 'customerType',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('customerType'),
            );
            $this->data['createdDate'] = array(
                'name' => 'createdDate',
                'id' => 'createdDate',
                'type' => 'text',
                'style' => 'width:250px;',
                'value' => $this->form_validation->set_value('createdDate'),
            );
            $this->load->view('templates/header');
            $this->load->view('customer', $this->data);
            $this->load->view('templates/footer');
        }
    }

    function editCustomer() {
        
    }

}
