<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Engine extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_engine');
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
        $config["base_url"] = base_url() . "index.php/engine/index";
        $config["total_rows"] = $this->Car_engine->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["Engine"] = $this->Car_engine->allEngine( $config["per_page"], $page);
      //  print_r($this->data["test"]);
        $this->data["counts"] = $this->Car_engine->record_count();
//print_r($this->data["counts"]);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
        //$this->data['Engine'] = $this->Car_engine->allEngine();
        $this->load->view('header');
        $this->load->view('engine', $this->data);
        $this->load->view('footer');
    }

    function newengine() {
        $this->form_validation->set_rules('engine_name', 'Engine Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $EngineData = array(
                'EngineType' => $this->input->post('engine_name'),
                'CreatedDate' => date('Y/m/d')
            );
            $this->Car_engine->insertEngine($EngineData);
            redirect(base_url() . "index.php/engine/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('engine_id', 'Engine ID', 'required|xss_clean');
        $this->form_validation->set_rules('engine_name', 'Engine Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $EngineId = $this->input->post('engine_id');
            $EngineName = $this->input->post('engine_name');
            $this->Car_engine->updateEngine($EngineId, $EngineName);
            redirect(base_url() . "index.php/engine/index");
        }
    }

    function search() {
        $search = $this->input->post('search');
        $dataSearch = $this->Car_engine->oneEngine($search);
        $CarEngine = json_encode($dataSearch);
        print_r($CarEngine);
    }
	//////
	public function delete($id) {
      $EngineId=$id;
        $result = $this->Car_engine->delete($EngineId);
		  redirect(base_url() . "index.php/engine/index");
    }
}
