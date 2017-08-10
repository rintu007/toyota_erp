<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ChangeColor extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_change_color');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $ChangeColor = new Car_change_color();

        $Months = array();
        $Month = date('n'); // current month
        for ($x = 0; $x < 12; $x++) {
            $Months[] = date('F Y', mktime(0, 0, 0, $Month + $x, 1));
        }
        $Data['message'] = $this->session->flashdata('message');
        $Data['Month'] = $Months;
        $Data['Model'] = $ChangeColor->fillModelCombo();
        $Data['ChangeColor'] = $ChangeColor->allChangeColor();
        $Data['AllocationType'] = $ChangeColor->fillAllocationTypeCombo();

        $this->load->view('header');
        $this->load->view('changecolor', $Data);
        $this->load->view('footer');
    }

    function addchangecolor() {
        $Allocation = new Car_change_color();

//        print_r($_POST);
        //validate form input
        $this->form_validation->set_rules('allocation_month', 'Allocation Month', 'required|xss_clean');
        $this->form_validation->set_rules('variant', 'Variant', 'required|xss_clean');
        $this->form_validation->set_rules('color', 'Color', 'required|xss_clean');
        $this->form_validation->set_rules('quantity', 'Quanitty', 'required|xss_clean');
//        $this->form_validation->set_rules('validitystartdate', 'Validity Start Date', 'required|xss_clean');
//        $this->form_validation->set_rules('validityenddate', 'Validity End Date', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('variant') == 'Select Variant' || $this->input->post('color') == 'Select Color' || $this->input->post('allocation_month') == 'Select Allocation Month') {
                $this->session->set_flashdata('message', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please Fill All The Fields!</h4>');
                redirect(base_url() . "index.php/changecolor/index");
            } else {


                $AllocationData = array(
                    'Month' => $this->input->post('allocation_month'),
                    'VariantId' => $this->input->post('variant'),
                    'ColorId' => $this->input->post('color'),
                    'Quantity' => $this->input->post('quantity'),
                    'AllocationTypeId' => $this->input->post('allocationType'),
                    'BalanceQuantity' => $this->input->post('quantity'),
                    'ValidityStartDate' => $this->input->post('validitystartdate'),
                    'ValidityEndDate' => $this->input->post('validityenddate'),
                    'CreatedDate' => date('Y/m/d')
                );
                $insertAllocation = $Allocation->insertChangeColor($AllocationData);
//                echo $insertAllocation;
//                echo $insertAllocation;
//                echo "This Color is not Available in Allocation";
                if ($insertAllocation == "No Color") {
                    $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Your Selected From Color is Not Available in Allocation.</h4>');
                    redirect(base_url() . "index.php/changecolor/index");
                } else if ($insertAllocation == "Not Available") {
                    $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Not Enough Quantity!</h4>');
                    redirect(base_url() . "index.php/changecolor/index");
                } else if ($insertAllocation == "Please Open an Allocation First.") {
                    $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Your Selected To Color is Not Available in Allocation. Please Add an Allocation First.</h4>');
                    redirect(base_url() . "index.php/changecolor/index");
                } else if ($insertAllocation == "Success") {
                    $this->session->set_flashdata('message', '<h4 style="background-color: darkgreen;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Allocation Color Has Been Changed Successfully!</h4>');
                    redirect(base_url() . "index.php/changecolor/index");
                }


//                if ($insertAllocation == 1) {
//                    $this->session->set_flashdata('message', '<h4 style="background-color: darkgreen;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Allocation Color Has Been Changed Successfully!</h4>');
//                    redirect(base_url() . "index.php/changecolor/index");
//                } else if ($insertAllocation == "Not Available") {
//                    $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Not Enough Quantity!</h4>');
//                    redirect(base_url() . "index.php/changecolor/index");
//                } else {
//                    $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Failed To Change Color!</h4>');
//                    redirect(base_url() . "index.php/changecolor/index");
//                }
            }
        } else {
            $this->session->set_flashdata('message', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please Fill All The Fields!</h4>');
            redirect(base_url() . "index.php/changecolor/index");
        }
    }

    function update() {
        $Allocation = new Car_change_color();
        //validate form input
        $this->form_validation->set_rules('allocation_month', 'Allocation Month', 'required|xss_clean');
        $this->form_validation->set_rules('variant', 'Variant', 'required|xss_clean');
        $this->form_validation->set_rules('color', 'Color', 'required|xss_clean');
        $this->form_validation->set_rules('quantity', 'Quanitty', 'required|xss_clean');
        $this->form_validation->set_rules('validitydate', 'Validity Date', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $AllocationId = $this->input->post('allocation_id');
//            $AllocationType = $this->input->post('allocation_type');
            $AllocationData = array(
                'Month' => $this->input->post('allocation_month'),
                'VariantId' => $this->input->post('variant'),
                'ColorId' => $this->input->post('color'),
                'Qunatity' => $this->input->post('quantity'),
                'BalanceQuantity' => $this->input->post('quantity'),
                'ValidityDate' => $this->input->post('validitydate'),
            );
            $Allocation->updateAllocation($AllocationId, $AllocationData);

            redirect(base_url() . "index.php/changecolor/index");
        }
    }

    function getColor() {
        $Allocation = new Car_change_color();
        $VariantId = $this->input->post('variantId');
        $GetColor = $Allocation->fillColorByVariant($VariantId);
        echo json_encode($GetColor);
    }

    function getVariants() {
        $Allocation = new Car_change_color();
        $ModelId = $this->input->post('ModelId');
        $GetVariants = $Allocation->fillVariantByModel($ModelId);
        echo json_encode($GetVariants);
    }

}
