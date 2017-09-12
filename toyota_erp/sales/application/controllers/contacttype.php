<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacttype extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_contact_type');
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
        $config["base_url"] = base_url() . "index.php/contacttype/index";
        $config["total_rows"] = $this->Car_contact_type->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["ContactType"] = $this->Car_contact_type->allContactType( $config["per_page"], $page);
      //  print_r($this->data["test"]);
        $this->data["counts"] = $this->Car_contact_type->record_count();
//print_r($this->data["counts"]);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
        //$this->data['ContactType'] = $this->Car_contact_type->allContactType();

        $this->load->view('header');
        $this->load->view('contacttype', $this->data);
        $this->load->view('footer');
    }

    function newcontacttype() {
        //validate form input
        $this->form_validation->set_rules('contact_type', 'Contact Type', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $ctData = array(
                'ContactType' => $this->input->post('contact_type'),
                'CreatedDate' => date('Y/m/d')
            );
            $this->Car_contact_type->insertContactType($ctData);

            redirect(base_url() . "index.php/contacttype/index");
        }
    }

    function update() {
        //validate form input
        $this->form_validation->set_rules('contacttype_id', 'Contact Type ID', 'required|xss_clean');
        $this->form_validation->set_rules('contacttype_name', 'Contact Type', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $ContactTypeId = $this->input->post('contacttype_id');
            $ContactTypeName = $this->input->post('contacttype_name');
            $this->Car_contact_type->updateContactType($ContactTypeId, $ContactTypeName);

            redirect(base_url() . "index.php/contacttype/index");
        }
    }
	public function delete($id) {
      $ContactTypeId=$id;
        $result = $this->Car_contact_type->delete($ContactTypeId);
		  redirect(base_url() . "index.php/contacttype/index");
    }

}
