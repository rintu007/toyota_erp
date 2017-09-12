<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customertype extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_customer_type');
        $this->load->library('form_validation');
		$this->load->library("pagination");
    }

    public function index() {
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
        $config["base_url"] = base_url() . "index.php/customertype/index";
        $config["total_rows"] = $this->Car_customer_type->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["CustomerType"] = $this->Car_customer_type->allCustomerType( $config["per_page"], $page);
      //  print_r($this->data["test"]);
        $this->data["counts"] = $this->Car_customer_type->record_count();
//print_r($this->data["counts"]);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
        //$this->data['CustomerType'] = $this->Car_customer_type->allCustomerType();

        $this->load->view('header');
        $this->load->view('customertype', $this->data);
        $this->load->view('footer');
    }

    function newcustomertype() {
        //validate form input
        $this->form_validation->set_rules('customer_type', 'Customer Type', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $ctData = array(
                'CustomerType' => $this->input->post('customer_type'),
                'CreatedDate' => date('Y/m/d')
            );
            $this->Car_customer_type->insertCustomerType($ctData);

            redirect(base_url() . "index.php/customertype/index");
        }
    }

    function update() {
        //validate form input
        $this->form_validation->set_rules('customertype_id', 'Customer Type ID', 'required|xss_clean');
        $this->form_validation->set_rules('customertype_name', 'Customer Type', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $CustomerTypeId = $this->input->post('customertype_id');
            $CustomerTypeName = $this->input->post('customertype_name');
            $this->Car_customer_type->updateCustomerType($CustomerTypeId, $CustomerTypeName);

            redirect(base_url() . "index.php/customertype/index");
        }
    }
	//////
	public function delete($id) {
      $CustomerTypeId=$id;
        $result = $this->Car_customer_type->delete($CustomerTypeId);
		  redirect(base_url() . "index.php/customertype/index");
    }

}
