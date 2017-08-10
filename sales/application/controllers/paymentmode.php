<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paymentmode extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_mode_payment');
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
        $config["base_url"] = base_url() . "index.php/paymentmode/index";
        $config["total_rows"] = $this->Car_mode_payment->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["PaymentMode"] = $this->Car_mode_payment->allModePayment( $config["per_page"], $page);
      //  print_r($this->data["test"]);
        $this->data["counts"] = $this->Car_mode_payment->record_count();
//print_r($this->data["counts"]);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
        //$this->data['PaymentMode'] = $this->Car_mode_payment->allModePayment();

        $this->load->view('header');
        $this->load->view('paymentmode', $this->data);
        $this->load->view('footer');
    }

    function newpaymentmode() {
        //validate form input
        $this->form_validation->set_rules('payment_mode', 'Full Name', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $pmData = array(
                'PaymentType' => $this->input->post('payment_mode'),
                'CreatedDate' => date('Y/m/d')
            );
            $this->Car_mode_payment->insertModePayment($pmData);

            redirect(base_url() . "index.php/paymentmode/index");
        }
    }

    function update() {
        //validate form input
        $this->form_validation->set_rules('payment_id', 'Payment Mode ID', 'required|xss_clean');
        $this->form_validation->set_rules('payment_name', 'Payment Type', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $PaymentId = $this->input->post('payment_id');
            $PaymentName = $this->input->post('payment_name');
            $this->Car_mode_payment->updateModePayment($PaymentId, $PaymentName);

            redirect(base_url() . "index.php/paymentmode/index");
        }
    }
	public function delete($id) {
      $PaymentId=$id;
        $result = $this->Car_mode_payment->delete($PaymentId);
		  redirect(base_url() . "index.php/paymentmode/index");
    }

}
