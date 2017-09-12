<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_loss_sale extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function insertLossSale($LossSale) {
        $this->db->insert('car_loss_sale', $LossSale);
        $this->db->insert_id();
    }

}
