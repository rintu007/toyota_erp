<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Inventioncontrol extends CI_Controller {

    function __construct() {
        parent::__construct();
		  $this->load->model('Inventory_sales');
        $this->load->model('Reporting');
        $this->load->library("Pdf");
    }
	
	
	
	}
?>