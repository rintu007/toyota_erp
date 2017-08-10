<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pbo_List extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_pbo');
        $this->load->model('Car_resource_book');
        $this->load->model('Car_customer');
        $this->load->model('Car_lost_sale');
        $this->load->library('form_validation');
         $this->load->library("pagination");
         $this->load->model('Rb_quotation');
         
         
           
    }

    function index() {


        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];
        $this->data['ResourceBook'] = $this->Car_resource_book->allRbWithPbo($UserId, $UserRole, $limit = '', $offset = '');
        
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
        $config["base_url"] = base_url() . "index.php/pbo_list/index";
        $config["total_rows"] = $this->Car_resource_book->record_count($UserId);
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
//        echo 'aaaaaaaaaaaaaaaaaaaaa';
//        print_r($limit);
        $this->data['ResourceBook'] = $this->Car_resource_book->allRbWithPbo($UserId, $UserRole, $config["per_page"], $page);
         $this->data["links"] = $this->pagination->create_links();
        $this->data['PboMessage'] = $this->session->flashdata('PBO');

        $this->load->view('header');
        $this->load->view('pbo_list', $this->data);
        $this->load->view('footer');
    }
    
    public function printPBO($PBOid = '') {
        $PBOid = 625;
//         $idRb = 5081;
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];

        $this->data['PBODetails'] = $this->Car_pbo->onePBO($PBOid);
        $ResourceBookId = $this->data['PBODetails']['ResourcebookId'];
//         print_r($this->data['PBODetails']);
//         die;
//        $this->data['ResourceBook'] = $this->Car_resource_book->allResourceBook($UserId);
        $this->data['ResourceBook'] = $this->Car_resource_book->oneResourceBook($ResourceBookId);
        //   print_r($this->data['ResourceBook']);
//        print_r($this->data['ResourceBook']);
        $idVariant = $this->data['ResourceBook']['VehicleInterested'];
        $this->data['customer_status'] = $this->Car_resource_book->rbfillCustomerStatusCombo();
        $this->data['payment_mode'] = $this->Car_resource_book->rbfillPaymentTypeCombo();
        $this->data['vehicle_interst'] = $this->Car_resource_book->rbfillVariantsCombo();
        $this->data['color_choice_one'] = $this->Car_resource_book->pboColorCombo($idVariant);
        $this->data['color_choice_two'] = $this->Car_resource_book->pboColorCombo($idVariant);
        $this->data['customertype'] = $this->Car_resource_book->rbfillCustomerTypeCombo();
        $this->data['contact_type'] = $this->Car_resource_book->rbfillContactTypeCombo();
        $this->data['model'] = $this->Car_resource_book->rbfillModelCombo();
        $this->data['followup'] = $this->Car_resource_book->fillFollowUpRadio();
        $this->data['accessories'] = $this->Car_resource_book->fillAccessoriesChecked($ResourceBookId);
        $this->data['AllocationType'] = $this->Car_resource_book->fillAllocationTypeCombo();
        $this->data['OrderType'] = $this->Car_resource_book->fillOrderTypeCombo();
        $this->data['Filer'] = $this->Car_resource_book->getFiler($idVariant);
        $this->data['NFiler'] = $this->Car_resource_book->getNFiler($idVariant);
        $months = array();
        $month = date('n'); // current month
        for ($x = 0; $x < 12; $x++) {
            $months[] = date('F Y', mktime(0, 0, 0, $month + $x, 1));
        }
        $this->data['deliverymonth'] = $months;

        $this->data['province'] = $month = array(
            'Select Province' => 'Select Province', // PUT ANY DEFAULT VALUE HERE
            'Sindh' => 'Sindh',
            'Punjab' => 'Punjab',
            'Balochistan' => 'Balochistan',
            'Khyber Pakhtunkhwa' => 'Khyber Pakhtunkhwa'
        );
        $this->data['city'] = $month = array(
            'Select City' => 'Select City', // PUT ANY DEFAULT VALUE HERE
            'Karachi' => 'Karachi',
            'Hyderabad' => 'Hyderabad',
            'Islamabad' => 'Islamabad',
            'Rawalpindi' => 'Rawalpindi',
            'Lahore' => 'Lahore',
            'Multan' => 'Multan',
            'Quetta' => 'Quetta',
            'Faisalabad' => 'Faisalabad',
            'Shukkar' => 'Shukkar',
            'Peshawar' => 'Peshawar'
        );
//        print_r($this->data['PBODetails']);
//        $this->data['PboMessage'] = $this->session->flashdata('PBO');
        $this->load->view('header');
        $this->load->view('pbo_print', $this->data);
        $this->load->view('footer');
       
//        $this->data['Quotation'] = $this->Rb_quotation->generateQuotation($idRb);
//        $this->load->view('header');
//        $this->load->view('quotation', $this->data);
//        $this->load->view('footer');
    }

    function search() {
        $search = $this->input->post('search');
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];
        $dataSearch = $this->Car_resource_book->searchRBwithPbo($search, $UserId, $UserRole);
        $ResourceBook = json_encode($dataSearch);

    }

    function PartialAmount() {
         $this->load->library("pagination");
        $this->data['PartialAmount'] = $this->Car_pbo->PartialPayment($limit = '', $offset = '');
//        print_r();
        
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
        $config["base_url"] = base_url() . "index.php/pbo_list/PartialAmount";
        $config["total_rows"] = count($this->Car_pbo->PartialPayment($limit = '', $offset = ''));
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
$this->data['count'] = $config["total_rows"];
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
//        echo 'aaaaaaaaaaaaaaaaaaaaa';
//        print_r($limit);
        $this->data['PartialAmount'] = $this->Car_pbo->PartialPayment($config["per_page"], $page);
         $this->data["links"] = $this->pagination->create_links();
        
     
        $this->load->view('header');
        $this->load->view('PartialAmount', $this->data);
        $this->load->view('footer');
    }

    function searchPartialAmount() {
        $search = $this->input->post('search');
        $dataSearch = $this->Car_resource_book->searchPartialAmount($search);
        $ResourceBook = json_encode($dataSearch);
        print_r($ResourceBook);
    }

}
