<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AllocationType extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_allocation_type');
        $this->load->library('form_validation');
		$this->load->library("pagination");
    }

    public function index() {
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
        $config["total_rows"] = $this->Car_allocation_type->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["Allocation"] = $this->Car_allocation_type->allAllocationType( $config["per_page"], $page);

        $this->data["counts"] = $this->Car_allocation_type->record_count();

        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
        //$Data = array();
        //$Allocation = new Car_allocation_type();
        //$Data['Allocation'] = $Allocation->allAllocationType();

        $this->load->view('header');
        $this->load->view('allocation_type', $this->data);
        $this->load->view('footer');
    }

    function add() {
        $Allocation = new Car_allocation_type();
        //validate form input
        $this->form_validation->set_rules('allocation_type', 'Allocation Type', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $AllocationTypeData = array(
                'AllocationType' => $this->input->post('allocation_type'),
                'CreatedDate' => date('Y/m/d')
            );
            $Allocation->insertAllocationType($AllocationTypeData);

            redirect(base_url() . "index.php/allocationtype/index");
        }
    }

    function update() {
        $Allocation = new Car_allocation_type();
        //validate form input
        $this->form_validation->set_rules('allocation_type_id', 'Allocation Type Id', 'required|xss_clean');
        $this->form_validation->set_rules('allocation_type', 'Allocation Type', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $AllocationTypeId = $this->input->post('allocation_type_id');
            $AllocationTypeData = array(
                'AllocationType' => $this->input->post('allocation_type')
            );
            $Allocation->updateAllocationType($AllocationTypeId, $AllocationTypeData);

            redirect(base_url() . "index.php/allocationtype/index");
        }
    }
	public function delete($id) {
     $Allocation=$id;
        $result = $this->Car_allocation_type->delete($Allocation);
		  redirect(base_url() . "index.php/allocationtype/index");
    }

}
