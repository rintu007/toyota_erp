<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Salenote extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_salenote');
        $this->load->library('form_validation');
        $this->load->library("pagination");
    }

    function getAllSaleNote() {


        $cookieData = unserialize($_COOKIE['logindata']);

        $this->data['ResourceBook'] = $this->Car_salenote->getAllSaleNote($limit = '', $offset = '');

        $config = array();
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 1;
        $config["base_url"] = base_url() . "index.php/salenote/getAllSaleNote";
        $config["total_rows"] = $this->Car_salenote->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['SaleNoteList'] = $this->Car_salenote->getAllSaleNote($config["per_page"], $page);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['PboMessage'] = $this->session->flashdata('PBO');

        $this->load->view('header');
        $this->load->view('salenote_list', $this->data);
        $this->load->view('footer');
    }

    function index() {
        $Data = array();
        $SaleNote = new Car_salenote();
        $Data['Model'] = $SaleNote->fillModelCombo();
        $Data['Response'] = $this->session->flashdata('Response');
        $this->load->view('header');
        $this->load->view('salenote', $Data);
        $this->load->view('footer');
    }

    function add() {
//        print_r($_POST);
//        die;
        $SaleNote = new Car_salenote();

        /*      $this->form_validation->set_rules('SaleNoteNumber', 'Sale Note Number', 'required|xss_clean');
          $this->form_validation->set_rules('dispatchId', 'Customer Type', 'required|xss_clean');
          $this->form_validation->set_rules('dispatchId', 'Customer Type', 'required|xss_clean'); */
        if (TRUE) {

            $CustomerData = array(
                'CustomerName' => $this->input->post('customer_name'),
                'FatherName' => $this->input->post('f_name'),
                'AddressDetails' => $this->input->post('address'),
                'DateOfBirth' => $this->input->post('dob'),
                'City' => $this->input->post('city'),
                'Province' => $this->input->post('province'),
                'Cnic' => $this->input->post('CNIC_no'),
                'Ntn' => $this->input->post('NTN_no'),
                'Telephone' => $this->input->post('Residential_no'),
                'Cellphone' => $this->input->post('Mobile_no'),
                'Email' => $this->input->post('email')
            );

//            $insertSaleNote = $SaleNote->insertSaleNote();
            $insertSaleNote = $SaleNote->insertSaleNote($CustomerData);

            if ($insertSaleNote) {
                $this->session->set_flashdata('Response', '<h4>Sale Note Has Been Created!</h4>');
                redirect(base_url() . "index.php/salenote/index");
            } else {
                $this->session->set_flashdata('Response', '<h4>Error Occured. Please Re-enter data and save Sale Note.</h4>');
                redirect(base_url() . "index.php/salenote/index");
            }
        } else {
            $this->session->set_flashdata('Response', '<h4>Fill All Required Fields</h4>');
            redirect(base_url() . "index.php/salenote/index");
        }
    }

    function update($idSaleNote) {
        $SaleNote = new Car_salenote();
        $OneSaleNote['data'] = $SaleNote->oneSaleNote($idSaleNote);
//        print_r($OneSaleNote);
//        die;
        $this->load->view('header');
        $this->load->view('salenote_edit', $OneSaleNote);
        $this->load->view('footer');
    }

    function delete($idSaleNote) {
        $this->Car_resource_book->deleteResourceBook($ResourceBookId);
        redirect(base_url() . "index.php/pbo/index");
    }

    function search() {
        $SearchKeyword = $this->input->post('search');
        $SaleNote = new Car_salenote();
        $Search = $SaleNote->searchResourceBook($SearchKeyword);
        echo json_encode($Search);
    }

    function getDispatch() {
        $SaleNote = new Car_salenote();
        $search = $this->input->post('ChassisNo');
        $dataSearch = $SaleNote->getDispatch($search);
        echo json_encode($dataSearch);
    }

    function getDispatchByPbo() {
        $SaleNote = new Car_salenote();
        $search = $this->input->post('PboNumber');
        $dataSearch = $SaleNote->getDispatchByPbo($search);
        echo json_encode($dataSearch);
    }

    function getCustomerByCnic() {
        $Cnic = $this->input->post('Cnic');
        $SaleNote = new Car_salenote();
        $GetCustomer = $SaleNote->CustomerByCnic($Cnic);
        echo json_encode($GetCustomer);
    }

    function getCustomers() {
        $SaleNote = new Car_salenote();
        $GetCustomers = $SaleNote->fillCustomerCombo();
        echo json_encode($GetCustomers);
    }

    function getCustomerDetails() {
        $SaleNote = new Car_salenote();
        $CustomerId = $this->input->post('idCustomer');
        $CustomerDetails = $SaleNote->CustomerDetails($CustomerId);
        echo json_encode($CustomerDetails);
    }

    function getColor() {
        $Resourcebook = new Car_resource_book();
        $VariantId = $this->input->post('variantId');
        $GetColor = $Resourcebook->fillColorByVariant($VariantId);
        echo json_encode($GetColor);
    }

    function getVariants() {
        $SaleNote = new Car_salenote();
        $ModelId = $this->input->post('ModelId');
        $GetVariants = $SaleNote->fillVariantByModel($ModelId);
        echo json_encode($GetVariants);
    }

}
