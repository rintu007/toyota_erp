<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Headings extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_headings');
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
        $config["base_url"] = base_url() . "index.php/headings/index";
        $config["total_rows"] = $this->Car_headings->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["Location"] = $this->Car_headings->allLocation( $config["per_page"], $page);

        $this->data["counts"] = $this->Car_headings->record_count();

        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
       // $Data = array();
       // $Location = new Car_headings();
       // $Data['Location'] = $Location->allLocation();
	   

        $this->load->view('header');
        $this->load->view('headings', $this->data);
        $this->load->view('footer');
    }
	

    function addlocation() {
        $Location = new Car_headings();
        //validate form input
        $this->form_validation->set_rules('Location', 'Location Name', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $LocationData = array(
                'heading' => $this->input->post('Location'),
                //'Code' => $this->input->post('Code'),
            );
            $Location->insertLocation($LocationData);

            redirect(base_url() . "index.php/headings/index");
        }
    }

    function update() {
        $Location = new Car_headings();
        //validate form input
        $this->form_validation->set_rules('LocationId', 'Location ID', 'required|xss_clean');
        $this->form_validation->set_rules('LocationName', 'Location Name', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $LocationId = $this->input->post('LocationId');
            $LocationData = array(
                'heading' => $this->input->post('LocationName'),
                //'Code' => $this->input->post('Code')
            );
            $Location->updateLocation($LocationId, $LocationData);

            redirect(base_url() . "index.php/headings/index");
			//print_r($Location);
        }
    }
	//////////////////////////////////
public function delete($id) {
      $LocationId=$id;
        $result = $this->Car_headings->delete($LocationId);
		  redirect(base_url() . "index.php/headings/index");
    }

}
