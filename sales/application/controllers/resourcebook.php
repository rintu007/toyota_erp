<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Resourcebook extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_resource_book');
        $this->load->library('form_validation');
    }

    function index() {
//        echo 'aa';
//        die;
        //validate form input
        //Modified for Login
        $cookieData = unserialize($_COOKIE['logindata']);

        $this->form_validation->set_rules('date', 'Date', 'required|xss_clean');
        $this->form_validation->set_rules('customertype', 'Customer Type', 'required|xss_clean');
        $this->form_validation->set_rules('contact_type', 'Contact Type', 'required|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'required|xss_clean');
        $this->form_validation->set_rules('province', 'Province', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
//            print_r($_POST);
//            die;
            $Model = $this->input->post('model');
            $variant = $this->input->post('vehicle_interst');
            $DeliveryMonth = $this->input->post('delivery_month');
            $FollowUp = $this->input->post('follow_up');
            $Color1 = $this->input->post('color_choice_one');
            $Color2 = $this->input->post('color_choice_two');

            $ActualSalesMan = $this->input->post('actual_salesman');
            $AllotedSalesMan = $this->input->post('alloted_salesman');

            if ($ActualSalesMan == "Select Sales Man") {
                $ActualSalesMan = $cookieData["userid"];
            }

            if ($AllotedSalesMan == "Select Sales Man") {
                $AllotedSalesMan = $cookieData["userid"];
            }

            if ($Model == "Select Model") {
                $Model = NULL;
            }
            if ($variant == "Select Variant") {
                $variant = NULL;
                $FollowUp = NULL;
                $Color1 = NULL;
                $Color2 = NULL;
            }

            if ($FollowUp == "Select Followup") {
                $FollowUp = NULL;
            }
            if ($Color1 == "Select Color") {
                $Color1 = NULL;
            }

            if ($Color2 == "Select Color") {
                $Color2 = NULL;
            }

            if ($DeliveryMonth == "Select Delivery Month") {
                $DeliveryMonth = NULL;
            }
            $Payment = $this->input->post('payment_mode');
            if ($Payment == "Select PaymentMode") {
                $Payment = NULL;
            }
            $CustomerStatus = $this->input->post('customer_status');
            if ($CustomerStatus == 3) {
                $CustomerStatus = NULL;
            }

            $LeadBy = $this->input->post('lead');
            if ($LeadBy == "Select Lead") {
                $LeadBy = NULL;
            }
            $Dob = $this->input->post('dob');
            if ($Dob == '') {
                $Dob = NULL;
            }

            $customerData = array(
                'gender' => $this->input->post('Gender'),
                'CustomerName' => $this->input->post('customer_name'),
                'genderType' => $this->input->post('genderType'),
                'FatherName' => $this->input->post('f_name'),
                'AddressDetails' => $this->input->post('address'),
                'AddressTwoDetails' => $this->input->post('address2'),
                'CompanyName' => $this->input->post('company_name'),
                'Designation' => $this->input->post('designation'),
                'OfficeNumber' => $this->input->post('Office_no'),
                'DateOfBirth' => $Dob,
                'City' => $this->input->post('city'),
                'Province' => $this->input->post('province'),
                'Cnic' => $this->input->post('CNIC_no'),
                'Ntn' => $this->input->post('NTN_no'),
                'Telephone' => $this->input->post('Residential_no'),
                'Cellphone' => $this->input->post('Mobile_no'),
                'Email' => $this->input->post('email'),
                'Fax' => $this->input->post('fax_no'),
                'postal_code' => $this->input->post('postal_no'),
                'idUserProfile' => $cookieData["userid"]
            );
            $CustomerId = $this->input->post('customer_id');
            $rbData = array(
                'Date' => $this->input->post('date'),
                'CustomerId' => $this->input->post('customer'),
                'CustomerTypeId' => $this->input->post('customertype'),
                'ContactTypeId' => $this->input->post('contact_type'),
                'idModel' => $Model,
                'VehicleInterested' => $variant,
                'PaymentMode' => $Payment,
                'CustomerStatus' => $CustomerStatus,
                'FollowupStatus' => $FollowUp,
                'Remarks' => $this->input->post('remarks'),
                'DeliveryMonth' => $DeliveryMonth,
                'DeliveryYear' => $this->input->post('delivery_year'),
                'TimeConsumed' => $this->input->post('time_consumed'),
                'AdditionalNote' => $this->input->post('additional_note'),
                'FinancerId' => $this->input->post('financer'),
                'A/c / Lesse' => $this->input->post('Lesse'),
                'Color1' => $Color1,
                'Color2' => $Color1,
                'LeadBy' => $LeadBy,
                'IsLost' => 0,
                'visitplanId' => $this->input->post('visit_plan'),
                'SalesmanId' => $cookieData["userid"]);
            $insertResourceBook = $this->Car_resource_book->insertResourceBook($customerData, $rbData);
            $this->session->set_flashdata('message', '<h4>Resourcebook Has Been Created!</h4>');
//            redirect(base_url() . "index.php/resourcebook/index/");
        }

        $this->data['color_choice_one'] = $this->Car_resource_book->fillColorCombo();
        $this->data['color_choice_two'] = $this->Car_resource_book->fillColorCombo();
        $this->data['allocation_type'] = $this->Car_resource_book->fillAllocationTypeCombo();
        $this->data['payment_mode'] = $this->Car_resource_book->fillPaymentTypeCombo();
        $this->data['vehicle_interst'] = $this->Car_resource_book->fillVariantsCombo();
        $this->data['customertype'] = $this->Car_resource_book->fillCustomerTypeCombo();
        $this->data['customer'] = $this->Car_resource_book->fillCustomerCombo();
        $this->data['customer_status'] = $this->Car_resource_book->fillCustomerStatusCombo();
        $this->data['contact_type'] = $this->Car_resource_book->fillContactTypeCombo();
        $this->data['followup'] = $this->Car_resource_book->fillFollowUpCombo();
        $this->data['accessories'] = $this->Car_resource_book->fillAccessoriesCheckBox();
        $this->data['Model'] = $this->Car_resource_book->fillModelCombo();
        $this->data['Bank'] = $this->Car_resource_book->fillFinancerCombo();
        $this->data['AllotedSalesMan'] = $this->Car_resource_book->fillSalesManCombo();
        $this->data['ActualSalesMan'] = $this->Car_resource_book->fillAllSalesManCombo();
        $this->data['VisitPlan'] = $this->Car_resource_book->getVisitPlan();
        $this->data['LeadBy'] = $this->Car_resource_book->fillAllSalesManCombo();
        $this->data['message'] = $this->session->flashdata('message');


//        $this->data['Dealer'] = $this->Car_resource_book->fillDealerCombo();
//        $this->data['SubDealer'] = $this->Car_resource_book->fillSubDealerCombo();
        $months = array('jan' => 'January', 'feb' => 'Feburary', 'mar' => 'March', 'apr' => 'April', 'may' => 'May', 'june' => 'june', 'july' => 'July', 'aug' => 'August', 'Sept' => 'September', 'October' => 'October', 'Nov' => 'November', 'Dec' => 'December');
//        $month = date('n'); // current month
//        $month = date("Y/m/d"); // all month
//        for ($x = 0; $x < 200; $x++) {
//            $months[] = date('F Y', mktime(0, 0, 0, $month + $x, 1));
//        }



        $this->data['deliverymonth'] = $months;

        $this->load->view('header');
        $this->load->view('resourcebook', $this->data);
        $this->load->view('footer');
    }

    public function GetAll() {
        $this->data['ResourceBook'] = $this->Car_resource_book->allResourceBook();
        $this->load->view('pbo', $this->data);
    }
    
    function getVisitPlan(){
        $post = $this->input->post();
        $data = $this->Car_resource_book->getVisitPlan($post['salepersonId']);
        echo json_encode($data);
    }
    function update($ResourceBookId) {
//        echo 'majid';
//        
        $resourcebook = $this->Car_resource_book->oneResourceBook($ResourceBookId);

        //      $this->form_validation->set_rules('date', 'Date', 'required|xss_clean');
        $Dob = $this->input->post('dob');
        if ($Dob == '') {
            $Dob = NULL;
        }
        if (isset($_POST) && !empty($_POST)) {
//            print_r($_POST);
//            echo 'aaa';
//            die;
            $customerID = $this->input->post('customer');
            $customerData = array(
                'gender' => $this->input->post('Gender'),
                'CustomerName' => $this->input->post('customer_name'),
                'genderType' => $this->input->post('genderType'),
                'FatherName' => $this->input->post('f_name'),
                'AddressDetails' => $this->input->post('address'),
                'AddressTwoDetails' => $this->input->post('address2'),
                'DateOfBirth' => $Dob,
                'CompanyName' => $this->input->post('company_name'),
                 'Designation' => $this->input->post('designation'),
                'City' => $this->input->post('city'),
                'Province' => $this->input->post('province'),
                'postal_code' => $this->input->post('postal_code'),
                'Cnic' => $this->input->post('CNIC_no'),
                'Ntn' => $this->input->post('NTN_no'),
                'Telephone' => $this->input->post('telephone'),
                'Cellphone' => $this->input->post('Mobile_no'),
                'OfficeNumber' => $this->input->post('Office_no'),
                'Fax' => $this->input->post('fax_no'),
                
                'Email' => $this->input->post('email')
            );
            $Model = $this->input->post('model');
            $variant = $this->input->post('vehicle_interst');
            $DeliveryMonth = $this->input->post('delivery_month');
            $FollowUp = $this->input->post('follow_up');
            $CustomerType = $this->input->post('customer_type');
            $Color1 = $this->input->post('color_choice_one');
            $Color2 = $this->input->post('color_choice_two');
            if ($Model == "Select Model") {
                $Model = null;
            }
            if ($variant == "Select Variant") {
                $variant = null;
                $FollowUp = null;
                $Color1 = null;
                $Color2 = null;
            }
            if ($FollowUp == "Select Followup") {
                $FollowUp = null;
            }
            if ($CustomerType == "Select Customer Type") {
                $CustomerType = null;
            }
            if ($Color1 == "Select Color") {
                $Color1 = null;
            }
            if ($Color2 == "Select Color") {
                $Color2 = null;
            }
            if ($DeliveryMonth == "Select Delivery Month") {
                $DeliveryMonth = null;
            }
            $Payment = $this->input->post('payment_mode');
            if ($Payment == "Select PaymentMode") {
                $Payment = null;
            }
            $CustomerStatus = $this->input->post('customer_status');
            if ($CustomerStatus == 3) {
                $CustomerStatus = null;
            } else if ($CustomerStatus == "Select Customer Status") {
                $CustomerStatus = null;
            }

            $LeadBy = $this->input->post('lead');
            if ($LeadBy == "Select Lead") {
                $LeadBy = NULL;
            }
            $rbData = array(
                'Date' => $this->input->post('date'),
                'CustomerId' => $customerID,
                'CustomerTypeId' => $CustomerType,
                'ContactTypeId' => $this->input->post('contact_type'),
                'idModel' => $Model,
                'VehicleInterested' => $variant,
                'PaymentMode' => $Payment,
                'CustomerStatus' => $CustomerStatus,
                'FollowupStatus' => $FollowUp,
                'Remarks' => $this->input->post('remarks'),
                'DeliveryMonth' => $DeliveryMonth,
                'DeliveryYear' => $this->input->post('delivery_year'),
                'TimeConsumed' => $this->input->post('time_consumed'),
                'AdditionalNote' => $this->input->post('additional_note'),
                 'visitplanId' => $this->input->post('visit_plan'),
                'Color1' => $Color1,
                'Color2' => $Color1,
                'LeadBy' => $LeadBy);

            $AccessoriesData = array();
            $accessory = $this->input->post('accessories');
            $count = count($this->input->post('accessories'));
            for ($i = 0; $i < $count; $i++) {
                $AccessoriesData[] = array(
                    'ResourcebookId' => '',
                    'CreatedDate' => date("Y/m/d"),
                    'AccessoryId' => $accessory[$i]
                );
            }

            $this->Car_resource_book->updateResourceBook($ResourceBookId, $customerID, $rbData, $customerData);
            $this->session->set_flashdata('PBO', '<h4>Resourcebook Has Been updated!</h4>');
            redirect(base_url() . 'index.php/pbo/index');
        } else {
            $this->data['resourcebook'] = $resourcebook;
            $this->data['customer_status'] = $this->Car_resource_book->fillCustomerStatusRadio();
            $this->data['payment_mode'] = $this->Car_resource_book->rbfillPaymentTypeCombo();
            $this->data['rbPayment'] = $this->Car_resource_book->fillPaymentTypeCombo();
            $this->data['vehicle_interst'] = $this->Car_resource_book->rbfillVariantsCombo($resourcebook['ModelId']);
            $this->data['rbVariant'] = $this->Car_resource_book->fillVariantsCombo($resourcebook['ModelId']);
            $this->data['color_choice_one'] = $this->Car_resource_book->rbfillColorCombo();
            $this->data['color1'] = $this->Car_resource_book->fillColorCombo();
            $this->data['color_choice_two'] = $this->Car_resource_book->rbfillColorCombo();
            $this->data['color2'] = $this->Car_resource_book->fillColorCombo();
            $this->data['customertype'] = $this->Car_resource_book->rbfillCustomerTypeCombo();
            $this->data['contact_type'] = $this->Car_resource_book->rbfillContactTypeCombo();
            $this->data['model'] = $this->Car_resource_book->rbfillModelCombo();
            $this->data['rbModel'] = $this->Car_resource_book->fillModelCombo();
            $this->data['followup'] = $this->Car_resource_book->rbfillFollowUpCombo();
            $this->data['rbFollowup'] = $this->Car_resource_book->fillFollowUpCombo();
            $this->data['accessories'] = $this->Car_resource_book->fillAccessoriesChecked($ResourceBookId);
            $this->data['LeadBy'] = $this->Car_resource_book->rbfillSalesManCombo();
            $this->data['AllotedSalesMan'] = $this->Car_resource_book->fillSalesManCombo();
        $this->data['ActualSalesMan'] = $this->Car_resource_book->fillAllSalesManCombo();
//            $this->data['accessories1'] = $this->Car_resource_book->fillAccessoriesCheckBox();
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

            $this->load->view('header');
            $this->load->view('edit', $this->data);
            $this->load->view('footer');
        }
    }

    function delete($ResourceBookId) {
        $this->Car_resource_book->deleteResourceBook($ResourceBookId);
        redirect(base_url() . "index.php/pbo/index");
    }

    function search() {
        $SearchKeyword = $this->input->post('search');
        $Search = $this->Car_resource_book->searchResourceBook($SearchKeyword);
        echo json_encode($Search);
    }

    function getCustomerByCnic() {
        $Cnic = $this->input->post('Cnic');
        $Resourcebook = new Car_resource_book();
        $GetCustomer = $Resourcebook->CustomerByCnic($Cnic);
        echo json_encode($GetCustomer);
    }

    function getCustomers() {
        $Resourcebook = new Car_resource_book();
        $GetCustomers = $Resourcebook->fillCustomerCombo();
        echo json_encode($GetCustomers);
    }

    function getCustomerDetails() {
        $Resourcebook = new Car_resource_book();
        $CustomerId = $this->input->post('idCustomer');
        $CustomerDetails = $Resourcebook->CustomerDetails($CustomerId);
        echo json_encode($CustomerDetails);
    }

    function getColor() {
        $Resourcebook = new Car_resource_book();
        $VariantId = $this->input->post('variantId');
        $GetColor = $Resourcebook->fillColorByVariant($VariantId);
        echo json_encode($GetColor);
    }

    function getVariants() {
        $Resourcebook = new Car_resource_book();
        $ModelId = $this->input->post('ModelId');
        $GetVariants = $Resourcebook->fillVariantByModel($ModelId);
        echo json_encode($GetVariants);
    }

    function show($ResourceBookId) {
//        
        $resourcebook = $this->Car_resource_book->oneResourceBook($ResourceBookId);
//        print_r($resourcebook);
//        die;
        //      $this->form_validation->set_rules('date', 'Date', 'required|xss_clean');
        $Dob = $this->input->post('dob');
        if ($Dob == '') {
            $Dob = NULL;
        }
        if (isset($_POST) && !empty($_POST)) {
//            echo 'aaa';
//            die;
            $customerID = $this->input->post('customer');
            $customerData = array(
                'CustomerName' => $this->input->post('customer_name'),
                'FatherName' => $this->input->post('f_name'),
                'AddressDetails' => $this->input->post('address'),
                'DateOfBirth' => $Dob,
                'City' => $this->input->post('city'),
                'Province' => $this->input->post('province'),
                'Cnic' => $this->input->post('CNIC_no'),
                'Ntn' => $this->input->post('NTN_no'),
                'Telephone' => $this->input->post('telephone'),
                'Cellphone' => $this->input->post('cellphone'),
                'Email' => $this->input->post('email')
            );
            $Model = $this->input->post('model');
            $variant = $this->input->post('vehicle_interst');
            $DeliveryMonth = $this->input->post('delivery_month');
            $FollowUp = $this->input->post('follow_up');
            $CustomerType = $this->input->post('customer_type');
            $Color1 = $this->input->post('color_choice_one');
            $Color2 = $this->input->post('color_choice_two');
            if ($Model == "Select Model") {
                $Model = null;
            }
            if ($variant == "Select Variant") {
                $variant = null;
                $FollowUp = null;
                $Color1 = null;
                $Color2 = null;
            }
            if ($FollowUp == "Select Followup") {
                $FollowUp = null;
            }
            if ($CustomerType == "Select Customer Type") {
                $CustomerType = null;
            }
            if ($Color1 == "Select Color") {
                $Color1 = null;
            }
            if ($Color2 == "Select Color") {
                $Color2 = null;
            }
            if ($DeliveryMonth == "Select Delivery Month") {
                $DeliveryMonth = null;
            }
            $Payment = $this->input->post('payment_mode');
            if ($Payment == "Select PaymentMode") {
                $Payment = null;
            }
            $CustomerStatus = $this->input->post('customer_status');
            if ($CustomerStatus == 3) {
                $CustomerStatus = null;
            } else if ($CustomerStatus == "Select Customer Status") {
                $CustomerStatus = null;
            }

            $LeadBy = $this->input->post('lead');
            if ($LeadBy == "Select Lead") {
                $LeadBy = NULL;
            }
            $rbData = array(
                'Date' => $this->input->post('date'),
                'CustomerId' => $customerID,
                'CustomerTypeId' => $CustomerType,
                'ContactTypeId' => $this->input->post('contact_type'),
                'idModel' => $Model,
                'VehicleInterested' => $variant,
                'PaymentMode' => $Payment,
                'CustomerStatus' => $CustomerStatus,
                'FollowupStatus' => $FollowUp,
                'Remarks' => $this->input->post('remarks'),
                'DeliveryMonth' => $DeliveryMonth,
                'DeliveryYear' => $this->input->post('delivery_year'),
                'TimeConsumed' => $this->input->post('time_consumed'),
                'AdditionalNote' => $this->input->post('additional_note'),
                'Color1' => $Color1,
                'Color2' => $Color2,
                'LeadBy' => $LeadBy);

            $AccessoriesData = array();
            $accessory = $this->input->post('accessories');
            $count = count($this->input->post('accessories'));
            for ($i = 0; $i < $count; $i++) {
                $AccessoriesData[] = array(
                    'ResourcebookId' => '',
                    'CreatedDate' => date("Y/m/d"),
                    'AccessoryId' => $accessory[$i]
                );
            }

            $this->Car_resource_book->updateResourceBook($ResourceBookId, $customerID, $rbData, $customerData);
            $this->session->set_flashdata('PBO', '<h4>Resourcebook Has Been updated!</h4>');
            redirect(base_url() . 'index.php/pbo/index');
        } else {
            $this->data['resourcebook'] = $resourcebook;
            $this->data['customer_status'] = $this->Car_resource_book->fillCustomerStatusRadio();
            $this->data['payment_mode'] = $this->Car_resource_book->rbfillPaymentTypeCombo();
            $this->data['rbPayment'] = $this->Car_resource_book->fillPaymentTypeCombo();
            $this->data['vehicle_interst'] = $this->Car_resource_book->rbfillVariantsCombo($resourcebook['ModelId']);
            $this->data['rbVariant'] = $this->Car_resource_book->fillVariantsCombo($resourcebook['ModelId']);
            $this->data['color_choice_one'] = $this->Car_resource_book->rbfillColorCombo();
            $this->data['color1'] = $this->Car_resource_book->fillColorCombo();
            $this->data['color_choice_two'] = $this->Car_resource_book->rbfillColorCombo();
            $this->data['color2'] = $this->Car_resource_book->fillColorCombo();
            $this->data['customertype'] = $this->Car_resource_book->rbfillCustomerTypeCombo();
            $this->data['contact_type'] = $this->Car_resource_book->rbfillContactTypeCombo();
            $this->data['model'] = $this->Car_resource_book->rbfillModelCombo();
            $this->data['rbModel'] = $this->Car_resource_book->fillModelCombo();
            $this->data['followup'] = $this->Car_resource_book->rbfillFollowUpCombo();
            $this->data['rbFollowup'] = $this->Car_resource_book->fillFollowUpCombo();
            $this->data['accessories'] = $this->Car_resource_book->fillAccessoriesChecked($ResourceBookId);
            $this->data['LeadBy'] = $this->Car_resource_book->rbfillSalesManCombo();
            
             $this->data['AllotedSalesMan'] = $this->Car_resource_book->fillSalesManCombo();
        $this->data['ActualSalesMan'] = $this->Car_resource_book->fillAllSalesManCombo();
        
//            $this->data['accessories1'] = $this->Car_resource_book->fillAccessoriesCheckBox();
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
//            print_r($this->data['resourcebook']);
            $this->load->view('header');
            $this->load->view('resorcebook_show', $this->data);
            $this->load->view('footer');
        }
    }

}
