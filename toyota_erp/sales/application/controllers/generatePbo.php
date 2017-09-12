<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class GeneratePbo extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_pbo');
        $this->load->model('Car_resource_book');
        $this->load->model('Car_customer');
        $this->load->model('Car_lost_sale');
        $this->load->library('form_validation');
    }

    function index($ResourceBookId) {
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
//        $this->data['ResourceBook'] = $this->Car_resource_book->allResourceBook($UserId);
        $this->data['ResourceBook'] = $this->Car_resource_book->oneResourceBook($ResourceBookId);
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
        $this->data['PboMessage'] = $this->session->flashdata('PBO');
        $this->load->view('header');
        $this->load->view('generatepbo', $this->data);
        $this->load->view('footer');
    }

    function uploadPbo() {
        $this->form_validation->set_rules('idRes', 'idResourceBook', 'required|xss_clean');
//        $this->form_validation->set_rules('payOrderNo', 'PayOrder Number', 'required|xss_clean');
        $this->form_validation->set_rules('ImgPbo', 'PBO Image', 'callback__image_upload');
//        $this->form_validation->set_rules('date', 'Date', 'required|xss_clean');
//        $this->form_validation->set_rules('ChasisNo', 'Chasis Number', 'required|xss_clean');
//        $this->form_validation->set_rules('EngineNo', 'Engine Number', 'required|xss_clean');

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
        if (!$this->form_validation->run() || ($check_file_upload && !$this->upload->do_upload('ImgPbo'))) {
            redirect(base_url() . "index.php/resourcebook/index");
        } else {
            $upload_data = $this->upload->data();
            if (isset($upload_data['file_name'])) {
                $imgPbo = $upload_data['file_name'];
            }
            $VariantId = $this->input->post('variantId');
            $DeliveryMonth = $this->input->post('dMonth');

//            $pboData = array(
//                'ResourcebookId' => $this->input->post('idRes'),
//                'PboNumber' => $this->input->post('PboNumber'),
//                'PboSerialNumber' => $this->input->post('PboSerial'),
//                'PayorderNumber' => $this->input->post('payOrderNo'),
//                'PayorderImage' => $imgPbo,
//                'PboOpeningDate' => $this->input->post('OpeningDate'),
//                'ChasisNumber' => $this->input->post('ChasisNo'),
//                'EngineNumber' => $this->input->post('EngineNo'),
//                'BankName' => $this->input->post('BankName'),
//                'BankBranch' => $this->input->post('BankBranch'),
//                'BankCity' => $this->input->post('BankCity'),
//                'PurchaseOrderNumber' => $this->input->post('PurchaseOrder'),
//                'PurchaseDate' => $this->input->post('PurchaseDate'),
//            );
//            $insertPbo = $this->Car_pbo->insertPbo($pboData, $VariantId, $DeliveryMonth);
//            echo($insertPbo);
//            $set_flashdata = $this->session->set_flashdata('message', $insertPbo);
//            echo $set_flashdata;
            echo $VariantId . "<br>";
            echo $DeliveryMonth;
//            redirect(base_url() . "index.php/pbo/index");
        }
    }

    function lossSale() {
        $IdRb = $this->input->post('idResourceBook');
        $LossSale = array(
            'IdResourceBook' => $this->input->post('idResourceBook'),
            'Reason' => $this->input->post('reason'),
            'Date' => $this->input->post('date')
        );
        $this->Car_lost_sale->insertLostSale($LossSale, $IdRb);
        redirect(base_url() . "index.php/pbo/index");
    }

    function search() {
        $search = $this->input->post('search');
        $dataSearch = $this->Car_resource_book->searchResourceBook($search);

        $ResourceBook = json_encode($dataSearch);
       // print_r($ResourceBook);
//        $this->load->view('header');
//        $this->load->view('pbo', $ResourceBook);
//        $this->load->view('footer');
    }

    function getAllocationMonth() {
        $Pbo = new Car_pbo();
        $AllocationType = $this->input->post('idAllocationType');
        $AllocationColor = $this->input->post('idColor');
        $AllocationVariant = $this->input->post('idVariant');

        $CustomerDetails = $Pbo->AllocationMonth($AllocationType, $AllocationColor, $AllocationVariant);
        echo json_encode($CustomerDetails);
//        print_r($CustomerDetails);
    }

    function AllocationValidity() {
        $Pbo = new Car_pbo();
        $AllocationType = $this->input->post('idAllocationType');
        $AllocationColor = $this->input->post('idColor');
        $AllocationVariant = $this->input->post('idVariant');
        $AllocationMonth = $this->input->post('Month');
        $AllocationValidity = $Pbo->AllocationValidity($AllocationType, $AllocationColor, $AllocationVariant, $AllocationMonth);

//        if ($AllocationValidity == null) {
//            echo "Allocation Validity Has Been Expired!";
//        } 
//        echo json_encode($CustomerDetails);
        echo json_encode($AllocationValidity);
    }

    function OpenStock() {
        $Pbo = new Car_pbo();
        $AllocationColor = $this->input->post('idColor');
        $AllocationVariant = $this->input->post('idVariant');

//        echo "Color: " . $AllocationColor . " .. Variant: " . $AllocationVariant;
        $AllocationValidity = $Pbo->OpenStock($AllocationColor, $AllocationVariant);
        echo json_encode($AllocationValidity);
//        print_r($AllocationValidity);
    }

    function CheckPboSerial() {
        $Pbo = new Car_pbo();
        $PboSerial = $this->input->post('PboSerial');
        $CheckPboSerial = $Pbo->CheckPboSerial($PboSerial);
        print_r($CheckPboSerial);
    }

    function CheckPboNumber() {
        $Pbo = new Car_pbo();
        $PboNumber = $this->input->post('PboNumber');
        $CheckPboNumber = $Pbo->CheckPboNumber($PboNumber);
        print_r($CheckPboNumber);
    }

    
    
}
