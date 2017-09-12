<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */

class Model extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_model');
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
        $config["base_url"] = base_url() . "index.php/model/index";
        $config["total_rows"] = $this->Car_model->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["Model"] = $this->Car_model->allModel( $config["per_page"], $page);
      //  print_r($this->data["test"]);
        $this->data["counts"] = $this->Car_model->record_count();
//print_r($this->data["counts"]);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
       // $this->data['Model'] = $this->Car_model->allModel();
        $this->data['Parent'] = $this->Car_model->fillParentCombo();
        $this->data['ParentEdit'] = $this->Car_model->fillParentComboEdit();

        $this->load->view('header');
        $this->load->view('model', $this->data);
        $this->load->view('footer');
    }

    function newmodel() {
        //validate form input
        $this->form_validation->set_rules('model_name', 'Model Name', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $modelData = array(
                'Model' => $this->input->post('model_name'),
                'ParentId' => $this->input->post('parent'),
                'CreatedDate' => date('Y/m/d')
            );
            $this->Car_model->insertModel($modelData);

            redirect(base_url() . "index.php/model/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('model_id', 'Role ID', 'required|xss_clean');
        $this->form_validation->set_rules('model_name', 'Role Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $ModelId = $this->input->post('model_id');
            $ModelName = $this->input->post('model_name');
            $IdParent = $this->input->post('parent');
            $this->Car_model->updateModel($ModelId, $ModelName, $IdParent);
            redirect(base_url() . "index.php/model/index");
        }
    }

    function search() {
        $search = $this->input->post('search');
        $dataSearch = $this->Car_model->oneModel($search);
        $CarModel = json_encode($dataSearch);
        print_r($CarModel);
    }
	////////////////
public function delete($id) {
      $ModelId=$id;
        $result = $this->Car_model->delete($ModelId);
		  redirect(base_url() . "index.php/model/index");
    }
	///////////////////

}
