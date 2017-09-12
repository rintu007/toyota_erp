<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Accessories extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_pbo');
        $this->load->model('Car_resource_book');
        $this->load->model('Car_customer');
        $this->load->model('Car_accessories');
        $this->load->library('form_validation');
		$this->load->library("pagination");
    }

    function index() {
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
        $config["base_url"] = base_url() . "index.php/accessories/index";
        $config["total_rows"] = $this->Car_accessories->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->data["CarAccessories"] = $this->Car_accessories->allCarAccessories( $config["per_page"], $page);
      //  print_r($this->data["test"]);
        $this->data["counts"] = $this->Car_accessories->record_count();
//print_r($this->data["counts"]);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['message'] = $this->session->flashdata('message');
       // $this->data['CarAccessories'] = $this->Car_accessories->allCarAccessories();

        $this->load->view('header');
        $this->load->view('accessories', $this->data);
        $this->load->view('footer');
    }

    function add() {
        $caData = array(
            'AccessoryName' => $this->input->post('accessoryname'),
            'Price' => $this->input->post('price'),
            'CreatedDate' => date('Y/m/d')
        );

        $this->Car_accessories->insertCarAccessories($caData);

        redirect(base_url() . "index.php/accessories/index");
    }

    function update($IdAccessory) {
        $accessory = $this->Car_accessories->oneCarAccessory($IdAccessory);

        $this->form_validation->set_rules('accessoryId', 'IdAccessory', 'required|xss_clean');
        $this->form_validation->set_rules('accessoryname', 'Accessory Name', 'required|xss_clean');
        $this->form_validation->set_rules('price', 'Price', 'required|xss_clean');

        if (isset($_POST) && !empty($_POST)) {

            $IdAccessory = $this->input->post('accessoryId');

            $AccessoryData = array(
                'AccessoryName' => $this->input->post('accessoryname'),
                'Price' => $this->input->post('price'),
            );
            if ($this->form_validation->run() === true) {
                $updateAccessory = $this->Car_accessories->updateCarAccessories($IdAccessory, $AccessoryData);
                redirect(base_url() . 'index.php/accessories/index');
            } else {
                echo "Cannot Update Accessory";
            }
        } else {
			
            $this->data['accessory'] = $accessory;
			
            $this->load->view('header');
			
            $this->load->view('edit_accessories', $this->data);
            $this->load->view('footer');
        }
    }
	public function delete($id) {
      $IdAccessory=$id;
        $result = $this->Car_accessories->delete($IdAccessory);
		  redirect(base_url() . "index.php/accessories/index");
    }

}
