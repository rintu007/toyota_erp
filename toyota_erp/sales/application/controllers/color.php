<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Color extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_color');
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
        $config["base_url"] = base_url() . "index.php/color/index";
        $config["total_rows"] = $this->Car_color->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["Color"] = $this->Car_color->allCarColor( $config["per_page"], $page);

        $this->data["counts"] = $this->Car_color->record_count();

        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
			/////////////////////////////////////////
        $this->load->view('header');
        $this->load->view('color', $this->data);
        $this->load->view('footer');
    }

    function newcolor() {
        $this->form_validation->set_rules('color_name', 'Full Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $colorData = array(
                'ColorName' => $this->input->post('color_name'),
                'CreatedDate' => date('Y/m/d'),
                'ColorCode' => $this->input->post('color_code')
            );
            $this->Car_color->insertCarColor($colorData);
            redirect(base_url() . "index.php/color/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('color_id', 'Color ID', 'required|xss_clean');
        $this->form_validation->set_rules('color_name', 'Full Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $ColorId = $this->input->post('color_id');
            $ColorName = $this->input->post('color_name');
			$ColorCode = $this->input->post('color_code');
            $this->Car_color->updateCarColor($ColorId, $ColorName,$ColorCode);
            redirect(base_url() . "index.php/color/index");
        }
    }

    function search() {
        $search = $this->input->post('search');
        $dataSearch = $this->Car_color->oneCarColor($search);
        $CarColors = json_encode($dataSearch);
        print_r($CarColors);
    }
//////////
public function delete($id) {
      $ColorId=$id;
        $result = $this->Car_color->delete($ColorId);
		  redirect(base_url() . "index.php/color/index");
    }
}
