<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pbo extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_pbo');
        $this->load->model('Car_resource_book');
        $this->load->model('Car_customer');
        $this->load->model('Car_lost_sale');
        $this->load->library("pagination");
        $this->load->library('form_validation');
    }

    function index() {
        $data = unserialize($_COOKIE['logindata']);
        $UserId = $data["userid"];
        $UserRole = $data["Role"];
        $this->data['ResourceBook'] = $this->Car_resource_book->allResourceBook($UserId, $UserRole, $limit = '', $offset = '');

        $this->data['customer_status'] = $this->Car_resource_book->fillCustomerStatusRadio();
        $this->data['CustomerStatus'] = $this->Car_resource_book->fillCustomerStatusCombo();
        $this->data['payment_mode'] = $this->Car_resource_book->fillPaymentTypeCombo();
        $this->data['Dealer'] = $this->Car_resource_book->fillDealerCombo();
        $this->data['vehicle_interst'] = $this->Car_resource_book->fillVariantsCombo();
        $this->data['Salesman'] = $this->Car_resource_book->fillSalesManCombo();
        $this->data['color_choice_one'] = $this->Car_resource_book->fillColorCombo();
        $this->data['color_choice_two'] = $this->Car_resource_book->fillColorCombo();
        $this->data['customertype'] = $this->Car_resource_book->fillCustomerTypeCombo();
        $this->data['contact_type'] = $this->Car_resource_book->fillContactTypeCombo();
        $this->data['model'] = $this->Car_resource_book->fillModelCombo();
        $this->data['followup'] = $this->Car_resource_book->fillFollowUpCombo();
        $this->data['PboMessage'] = $this->session->flashdata('PBO');
        $this->data['Province'] = $month = array(
            '' => 'Select Province', // PUT ANY DEFAULT VALUE HERE
            'Sindh' => 'Sindh',
            'Punjab' => 'Punjab',
            'Balochistan' => 'Balochistan',
            'Khyber Pakhtunkhwa' => 'Khyber Pakhtunkhwa'
        );

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
        $config["base_url"] = base_url() . "index.php/pbo/index";
        $config["total_rows"] = $this->Car_resource_book->record_count($UserId);
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["ResourceBook"] = $this->Car_resource_book->allResourceBook($UserId, $UserRole, $config["per_page"], $page);
        //  print_r($this->data["ResourceBook"]);
        $this->data["counts"] = $this->Car_resource_book->record_count($UserId);

        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
//        print_r($this->data['ResourceBook']);

        $this->load->view('header');
        $this->load->view('pbo', $this->data);
        $this->load->view('footer');
    }

    function uploadPbo() {
//         print_r($_POST);
//            die;
        $this->form_validation->set_rules('idRes', 'idResourceBook', 'required|xss_clean');

        $config = array(
            'upload_path' => 'upload',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'max_size' => 2000,
            'max_width' => 1920,
            'max_height' => 1080,
        );
        $this->load->library('upload', $config);
        $this->load->helper('form');

        $check_file_upload = FALSE;

        if (isset($_FILES['ImgPbo']['error']) && ($_FILES['ImgPbo']['error'] != 4)) {
            $check_file_upload = TRUE;
        }
        if (!$this->form_validation->run() || ($check_file_upload && !$this->upload->do_upload('ImgPbo')))
        {
            redirect(base_url() . "index.php/resourcebook/index");
        } else {
            $upload_data = $this->upload->data();
            if (isset($upload_data['file_name'])) {
                $imgPbo = $upload_data['file_name'];
            }
            $VariantId = $this->input->post('variantId');
            $DeliveryMonth = $this->input->post('allocation_month');
            $AllocationType = $this->input->post('allocation_type');
            $ColorId = $this->input->post('colorId');

            $EFAmount = $this->input->post('amount');
            $FIAmount = $this->input->post('Freightamount');
            $TotalAmount = $EFAmount + $FIAmount;
            $ChasisNumber = $this->input->post('ChasisNo');
            $EngineNumber = $this->input->post('EngineNo');
            if ($ChasisNumber == "") {
                $ChasisNumber = NULL;
            }

            if ($EngineNumber == "") {
                $EngineNumber = NULL;
            }
//            print_r($_POST);
            $pboData = array(
                'PboNumber' => $this->input->post('PboNumber'),
                'ActualSalePerson' => $this->input->post('ActualSalePerson'),
                'ResourcebookId' => $this->input->post('idRes'),
                'PayorderNumber' => $this->input->post('payOrderNo'),
                'PayorderImage' => $imgPbo,
                'PboOpeningDate' => $this->input->post('OpeningDate'),
                'AllocationTypeId' => $this->input->post('allocation_type'),
                'AllocationMonth' => $this->input->post('allocation_month'),
                'OrderTypeId' => $this->input->post('order_type'),
                'ChasisNumber' => $ChasisNumber,
                'EngineNumber' => $EngineNumber,
                'ExFactoryPO' => $this->input->post('efPO'),
                'BankName' => $this->input->post('BankName'),
                'BankBranch' => $this->input->post('BankBranch'),
                'BankCity' => $this->input->post('BankCity'),
                'EFAmount' => $this->input->post('amount'),
                'FIType' => $this->input->post('Filer'),
                'FIPO' => $this->input->post('fiPO'),
                'FIPONumber' => $this->input->post('fiPayOrder'),
                'FIBankName' => $this->input->post('fiBankName'),
                'FIBankBranch' => $this->input->post('fiBankBranch'),
                'FIBankCity' => $this->input->post('fiBankCity'),
                'FIAmount' => $this->input->post('Freightamount'),
                'TotalAmount' => $TotalAmount,
                'PurchaseOrderNumber' => $this->input->post('PurchaseOrder'),
                'PurchaseDate' => $this->input->post('PurchaseDate'),
                'PboSerialNumber' => $this->input->post('PboSerial'),
                'InvoiceCreated' => 0,
                     'Is_partial' => 0
            );
            $insertPbo = $this->Car_pbo->insertPbo($pboData, $VariantId, $DeliveryMonth, $ColorId, $AllocationType, $imgPbo);
            $this->session->set_flashdata('PBO', $insertPbo);
            redirect(base_url() . "index.php/openpbo/index");
        }
    }

    function lossSale() {
        $IdRb = $this->input->post('idResourceBook');
//        print_r($_POST);
//        die;
        $LossSale = array(
            'IdResourceBook' => $this->input->post('idResourceBook'),
            'Reason' => $this->input->post('reason'),
            'reason_type' => $this->input->post('dispatch'),
            'Date' => $this->input->post('date')
        );
        $this->Car_lost_sale->insertLostSale($LossSale, $IdRb);
        redirect(base_url() . "index.php/pbo/index");
    }

    function getlossSale() {
        $IdRb = $this->input->post('idRb');
        $result = $this->Car_lost_sale->getlossSale($IdRb);
        echo json_encode($result);
//        redirect(base_url() . "index.php/pbo/index");
    }

    function search() {
        $search = $this->input->post('search');
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];
//        $dataSearch = $this->Car_resource_book->searchRBnoPbo($search, $UserId, $UserRole);
        $dataSearch = $this->Car_resource_book->searchRB($search, $UserId, $UserRole);
        $ResourceBook = json_encode($dataSearch);
        print_r($ResourceBook);
        return $ResourceBook;
    }

    public function getPBO($PBOid = '') {

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
        $this->data['pd'] = $this->Car_resource_book->get_car_pbo_paymentdetail($PBOid);
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

        $this->data['PboMessage'] = $this->session->flashdata('PBO');
        $this->load->view('header');
        $this->load->view('pbo_show', $this->data);
        $this->load->view('footer');
    }

    public function editPBO($PBOid = '') {

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
        $this->data['pd'] = $this->Car_resource_book->get_car_pbo_paymentdetail($PBOid);
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

        $this->data['PboMessage'] = $this->session->flashdata('PBO');
        $this->load->view('header');
        $this->load->view('pbo_edit', $this->data);
        $this->load->view('footer');
    }

    public function updatePBO() {
        $post = $this->input->post();
//        print_r($post);
        if ((isset($_FILES['ImgPbo']['name'])) && ($_FILES['ImgPbo']['name'] !== '')) {
            $upload_data = $this->upload->data();
            if (isset($upload_data['file_name'])) {
                $imgPbo = $upload_data['file_name'];
                $data['PayorderImage'] = $imgPbo;
            }

        }
        $ChasisNo = $this->input->post('ChasisNumber');
        $EngineNo = $this->input->post('EngineNumber');

        $EFAmount = $this->input->post('amount');
        $FIAmount = $this->input->post('Freightamount');
        $TotalAmount = $EFAmount + $FIAmount;
        $data['Id'] = $this->input->post('PBO_Id');
        $data['PboNumber'] = $this->input->post('PboNumber');
        $data['ActualSalePerson'] = $this->input->post('ActualSalePerson');
        $data['PayorderNumber'] = $this->input->post('payOrderNo');
        $data['PboOpeningDate'] = $this->input->post('OpeningDate');
        $data['AllocationMonth'] = $this->input->post('allocation_month');
        $data['AllocationTypeId'] = $this->input->post('allocation_type');
        $data['OrderTypeId'] = $this->input->post('order_type');
        $data['ChasisNumber'] = $ChasisNo;
        $data['EngineNumber'] = $EngineNo;
        $data['ExFactoryPO'] = $this->input->post('efPO');
        $data['BankName'] = $this->input->post('BankName');
        $data['BankBranch'] = $this->input->post('BankBranch');
        $data['BankCity'] = $this->input->post('BankCity');
        $data['EFAmount'] = $this->input->post('amount');
        $data['FIType'] = $this->input->post('FIler');
        $data['FIPO'] = $this->input->post('fiPO');
        $data['FIPONumber'] = $this->input->post('fiPayOrder');
        $data['FIBankName'] = $this->input->post('fiBankName');
        $data['FIBankBranch'] = $this->input->post('fiBankBranch');
        $data['FIBankCity'] = $this->input->post('fiBankCity');
        $data['FIAmount'] = $this->input->post('Freightamount');
        $data['TotalAmount'] = $TotalAmount;
        $data['PurchaseOrderNumber'] = $this->input->post('PurchaseOrder');
        $data['TotalPartialAmount'] = $this->input->post('TotalPartialAmount');
        $data['PurchaseDate'] = $this->input->post('PurchaseDate');
        $data['PboSerialNumber'] = $this->input->post('PboSerial');
//        print_r($data);
        $result = $this->Car_pbo->updatePBOO($data);
        
        
        $customer = array(
            'idCustomer' => $this->input->post('customer'),
            'NameOfInvoice' => $this->input->post('nameofInvoice'),
            'NameOfIndividual' => $this->input->post('NameOfIndividual')
        );
        $resultCustomer = $this->Car_pbo->updateCustomer($customer);
        $chequeone = $this->input->post('ChequeOne');
        $chequetwo = $this->input->post('ChequeTwo');
        $chequethree = $this->input->post('ChequeThree');
        $partial = array(
            'PboNumber' => $this->input->post('PboNumber'),
            //'ActualSalePerson' => $this->input->post('ActualSalePerson'),
            'ChequeOne' => $chequeone,
            'ChequeTwo' => $chequetwo,
            'ChequeThree' => $chequethree,
            'BankOne' => $this->input->post('BankOne'),
            'BranchOne' => $this->input->post('BranchOne'),
            //'BankTwo' => $this->input->post('BankTwo'),
            //'BranchTwo' => $this->input->post('BranchTwo'),
            //'BankThree' => $this->input->post('BankThree'),
            //'BranchThree' =>$this->input->post('BranchThree'),
            'ChequeNoOne' => $this->input->post('Chequeoneno')
        );
        $resultPartial = $this->Car_pbo->updatePBOPartial($partial);
        redirect(base_url() . "index.php/pbo/editPBO/".$data['Id']);
//        $this->editPBO($data['Id']);
    }

}
