<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Author: Umar Akbar
 * Description: Brand controller class
 */

class Brand extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_parent');
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
        $config["base_url"] = base_url() . "index.php/brand/index";
        $config["total_rows"] = $this->Car_parent->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["Brand"] = $this->Car_parent->allParent( $config["per_page"], $page);
      //  print_r($this->data["test"]);
        $this->data["counts"] = $this->Car_parent->record_count();
//print_r($this->data["counts"]);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
        //$this->data['Brand'] = $this->Car_parent->allParent();

        $this->load->view('header');
        $this->load->view('brand', $this->data);
        $this->load->view('footer');
    }

    function newparent() {
        //validate form input
        $this->form_validation->set_rules('parent_name', 'Brand Name', 'required|xss_clean');
        $this->form_validation->set_rules('parent_code', 'Brand Code', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $BrandData = array(
                'ParentName' => $this->input->post('parent_name'),
                'CreatedDate' => date('Y/m/d'),
                'ShortCode' => $this->input->post('parent_code')
            );
            $this->Car_parent->insertParent($BrandData);

            redirect(base_url() . "index.php/brand/index");
        }
    }

    function update() {
		//print_r($_POST);
		//die;
        $this->form_validation->set_rules('parent_id', 'Parent ID', 'required|xss_clean');
        $this->form_validation->set_rules('parent_name', 'Parent Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $ParentId = $this->input->post('parent_id');
            $ParentName = $this->input->post('parent_name');
			$ParentCode = $this->input->post('brand_code');
			//print_r($ParentCode);
			//die;
            $this->Car_parent->updateParent($ParentId, $ParentName,$ParentCode);
            redirect(base_url() . "index.php/brand/index");
        }
    }

    function search() {
        $search = $this->input->post('search');
        $dataSearch = $this->Car_parent->oneParent($search);
        $CarParent = json_encode($dataSearch);
        print_r($CarParent);
    }
////////////////
public function delete($id) {
      $ParentId=$id;
        $result = $this->Car_parent->delete($ParentId);
		  redirect(base_url() . "index.php/brand/index");
    }
	///////////////////
}
