<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Displacement extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_displacement');
        $this->load->library('form_validation');
		$this->load->library("pagination");
    }

    public function index() {
		//////////////////////////////////////////////
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
        $config["base_url"] = base_url() . "index.php/displacement/index";
        $config["total_rows"] = $this->Car_displacement->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["Displacement"] = $this->Car_displacement->allDisplacement( $config["per_page"], $page);
      //  print_r($this->data["test"]);
        $this->data["counts"] = $this->Car_displacement->record_count();
//print_r($this->data["counts"]);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
        //$this->data['Displacement'] = $this->Car_displacement->allDisplacement();
        $this->load->view('header');
        $this->load->view('displacement', $this->data);
        $this->load->view('footer');
    }


////////////////////
    function newdisplacement() {
        $this->form_validation->set_rules('displacement_name', 'Displacement Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $DisplacementData = array(
                'DisplacementName' => $this->input->post('displacement_name'),
                'CreatedDate' => date('Y/m/d'),
            );
            $this->Car_displacement->insertDisplacement($DisplacementData);
            redirect(base_url() . "index.php/displacement/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('displacement_id', 'Color ID', 'required|xss_clean');
        $this->form_validation->set_rules('displacement_name', 'Full Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $DisplacementId = $this->input->post('displacement_id');
            $DisplacementName = $this->input->post('displacement_name');
            $this->Car_displacement->updateDisplacement($DisplacementId, $DisplacementName);
            redirect(base_url() . "index.php/displacement/index");
        }
    }

    function search() {
        $search = $this->input->post('search');
        $dataSearch = $this->Car_displacement->oneDisplacement($search);
        $CarDisplacement = json_encode($dataSearch);
        print_r($CarDisplacement);
    }
	//////
	public function delete($id) {
      $DisplacementId=$id;
        $result = $this->Car_displacement->delete($DisplacementId);
		  redirect(base_url() . "index.php/displacement/index");
    }
}
