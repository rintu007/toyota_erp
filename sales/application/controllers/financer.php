<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Financer extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_financer');
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
        $config["base_url"] = base_url() . "index.php/financer/index";
        $config["total_rows"] = $this->Car_financer->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["Finance"] = $this->Car_financer->allFinancer( $config["per_page"], $page);

        $this->data["counts"] = $this->Car_financer->record_count();

        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
       // $Data = array();
       // $Financer = new Car_financer();
       // $Data['Finance'] = $Financer->allFinancer();

        $this->load->view('header');
        $this->load->view('financer', $this->data);
        $this->load->view('footer');
    }

    function addfinance() {
        $Financer = new Car_financer();
        //validate form input
        $this->form_validation->set_rules('financeName', 'Financer Name', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $FinanceData = array(
                'FinancerName' => $this->input->post('financeName'),
                'CreatedDate' => date('Y/m/d')
            );
            $Financer->insertFinancer($FinanceData);

            redirect(base_url() . "index.php/financer/index");
        }
    }

    function update() {
        $Financer = new Car_financer();
        //validate form input
        $this->form_validation->set_rules('finance_id', 'Customer Type ID', 'required|xss_clean');
        $this->form_validation->set_rules('finance_name', 'Customer Type', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $FinancerId = $this->input->post('finance_id');
            $FinancerName = $this->input->post('finance_name');
            $Financer->updateFinancer($FinancerId, $FinancerName);

            redirect(base_url() . "index.php/financer/index");
        }
    }
	public function delete($id) {
		 $Financer = new Car_financer();
      $FinancerId =$id;
        $result = $this->Car_financer->delete($FinancerId );
		  redirect(base_url() . "index.php/financer/index");
    }

}
