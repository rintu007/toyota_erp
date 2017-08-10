<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Allocation extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_allocation');
        $this->load->library('form_validation');
		$this->load->library("pagination");
    }

    public function index() {
        //$Data = array();
        //$Allocation = new Car_allocation();

        $Months = array();
        $Month = date('n'); // current month
        for ($x = 0; $x < 12; $x++) {
            $Months[] = date('F Y', mktime(0, 0, 0, $Month + $x, 1));
        }
        $Data['message'] = $this->session->flashdata('message');
        $Data['Month'] = $Months;
		 $Data = array();
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
        $config["base_url"] = base_url() . "index.php/allocation/index";
        $config["total_rows"] = $this->Car_allocation->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["Allocation"] = $this->Car_allocation->allAllocation( $config["per_page"], $page);

        $this->data["counts"] = $this->Car_allocation->record_count();

        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
		/////////////////
		$this->data["Model"] = $this->Car_allocation->fillModelCombo();
		$this->data["AllocationType"] = $this->Car_allocation->fillAllocationTypeCombo();
		/////////
       // $Data['Model'] = $Allocation->fillModelCombo();
       // $Data['Allocation'] = $Allocation->allAllocation();
       // $Data['AllocationType'] = $Allocation->fillAllocationTypeCombo();

        $this->load->view('header');
        $this->load->view('allocation', $this->data);
        $this->load->view('footer');
    }

    function addallocation() {
        $Allocation = new Car_allocation();
        //validate form input
        $this->form_validation->set_rules('allocation_month', 'Allocation Month', 'required|xss_clean');
        $this->form_validation->set_rules('variant', 'Variant', 'required|xss_clean');
        $this->form_validation->set_rules('color', 'Color', 'required|xss_clean');
        $this->form_validation->set_rules('quantity', 'Quanitty', 'required|xss_clean');
        $this->form_validation->set_rules('validitystartdate', 'Validity Start Date', 'required|xss_clean');
        $this->form_validation->set_rules('validityenddate', 'Validity End Date', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('variant') == 'Select Variant' || $this->input->post('allocation_month') == 'Select Allocation Month') {
                $this->session->set_flashdata('message', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please Fill All The Fields!</h4>');
                redirect(base_url() . "index.php/allocation/index");
            } else {
                $checkAllocation = $Allocation->checkAllocation()[0];
                if (empty($checkAllocation)) {
                    $AllocationData = array(
                        'Month' => $this->input->post('allocation_month'),
                        'VariantId' => $this->input->post('variant'),
                        'ColorId' => $this->input->post('color') == 'Select Color' ? '15' : $this->input->post('color') ,
                        'Quantity' => $this->input->post('quantity'),
                        'AllocationTypeId' => $this->input->post('allocationType'),
                        'BalanceQuantity' => $this->input->post('quantity'),
                        'ValidityStartDate' => $this->input->post('validitystartdate'),
                        'ValidityEndDate' => $this->input->post('validityenddate'),
                        'CreatedDate' => date('Y/m/d')
                    );
                    $insertAllocation = $Allocation->insertAllocation($AllocationData);
                } else {
                    echo "Else <br>";
                    print_r($checkAllocation);
                    $idAllocation = $checkAllocation['idAllocation'];
                    $Quantity = $checkAllocation['Quantity'];
                    $BalanceQuantity = $checkAllocation['BalanceQuantity'];
                    $ValidityEnd = $checkAllocation['ValidityEndDate'];

                    if ($this->input->post('validitystartdate') <= $ValidityEnd) {
                        $AllocationData = array(
                            'Month' => $this->input->post('allocation_month'),
                            'VariantId' => $this->input->post('variant'),
                            'ColorId' => $this->input->post('color'),
                            'Quantity' => $Quantity + $this->input->post('quantity'),
                            'AllocationTypeId' => $this->input->post('allocationType'),
                            'BalanceQuantity' => $BalanceQuantity + $this->input->post('quantity'),
                            'ValidityEndDate' => $this->input->post('validityenddate')
                        );
                        $insertAllocation = $Allocation->updateAllocation($idAllocation, $AllocationData);
                    } else {
                        $AllocationData = array(
                            'Month' => $this->input->post('allocation_month'),
                            'VariantId' => $this->input->post('variant'),
                            'ColorId' => $this->input->post('color'),
                            'Quantity' => $Quantity + $this->input->post('quantity'),
                            'AllocationTypeId' => $this->input->post('allocationType'),
                            'BalanceQuantity' => $BalanceQuantity + $this->input->post('quantity'),
                            'ValidityStartDate' => $this->input->post('validitystartdate'),
                            'ValidityEndDate' => $this->input->post('validityenddate')
                        );
                        $insertAllocation = $Allocation->updateAllocation($idAllocation, $AllocationData);
                      
                    }
                }
                if ($insertAllocation == 1) {
                    $this->session->set_flashdata('message', '<h4 style="background-color: darkgreen;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Allocation Successfully Created!</h4>');
                    redirect(base_url() . "index.php/allocation/index");
                } else if ($insertAllocation == "not available") {
                    $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Allocation is already availablle!</h4>');
                    redirect(base_url() . "index.php/allocation/index");
                } else if ($insertAllocation == "Quantity Updated") {
                    $this->session->set_flashdata('message', '<h4 style="background-color: darkgreen;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Allocation Successfully Update and Quantity Updated!</h4>');
                    redirect(base_url() . "index.php/allocation/index");
                } else {
                    $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;margin-left: 39px;margin-top: 12px;width: 1016px;text-align: center;">Failed To Create Allocation!</h4>');
                    redirect(base_url() . "index.php/allocation/index");
                }
            }
        } else {
            $this->session->set_flashdata('message', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please Fill All The Fields!</h4>');
            redirect(base_url() . "index.php/allocation/index");
        }
    }

    function update() {
        $Allocation = new Car_allocation();
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
           // print_r($AllocationData);
            
            $Allocation->updateAllocation($AllocationId, $AllocationData);
           
            //redirect(base_url() . "index.php/allocation/index");
        }
    }

    function getColor() {
        $Allocation = new Car_allocation();
        $VariantId = $this->input->post('variantId');
        $GetColor = $Allocation->fillColorByVariant($VariantId);
        echo json_encode($GetColor);
    }

    function getVariants() {
        $Allocation = new Car_allocation();
        $ModelId = $this->input->post('ModelId');
        $GetVariants = $Allocation->fillVariantByModel($ModelId);
        echo json_encode($GetVariants);
    }
	///////////////
	//////////////////////////////////
public function delete($id) {
      $idAllocation=$id;
        $result = $this->Car_allocation->delete($idAllocation);
		  redirect(base_url() . "index.php/allocation/index");
    }

}
