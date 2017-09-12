<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lostsale extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_pbo');
        $this->load->model('Car_resource_book');
        $this->load->model('Car_customer');
        $this->load->model('Car_lost_sale');
        $this->load->library('form_validation');
    }

    function index() {
        $this->data['LostSale'] = $this->Car_lost_sale->allLostSale();

        $this->load->view('header');
        $this->load->view('lostsale', $this->data);
        $this->load->view('footer');
    }
	
	public function getcsv()
    {
        $csvarray = array();
        $filename = 'LostSale' . '.csv';
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        $file = fopen('php://output', 'w');
        $customers = $this->Car_lost_sale->allLostSale();  // model to get data
        if($customers != "false")
        {
        foreach ($customers[0] as $key => $val) {
            $dataaa[] = $key;
        }
        array_unshift($customers, $dataaa);

        foreach ($customers as $customer) {
            $csvarray[] = implode(',', $customer);
        }
        foreach ($csvarray as $line) {
            fputcsv($file, explode(',', $line));
        }
        }
        fclose($file);
		
        
    }

}
