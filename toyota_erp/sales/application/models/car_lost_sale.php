<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_lost_sale extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allLostSale() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $this->db->select('*');
        $this->db->from('car_lost_sale');
        $this->db->join('car_resource_book', 'car_lost_sale.IdResourceBook = car_resource_book.IdResourceBook','LEFT');
        $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer','LEFT');
        $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor','LEFT');
        $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants','LEFT');
		$this->db->order_by('car_lost_sale.IdResourceBook','desc');
        //$this->db->where('car_resource_book.SalesmanId', $UserId);
        $LostSale = $this->db->get();
        return $LostSale->result_array();
    }

    function insertLostSale($LostSale, $idResourceBook) {
        $this->db->trans_start();
        $this->db->insert('car_lost_sale', $LostSale);
        $this->db->insert_id();

        $this->db->where('IdResourceBook', $idResourceBook);
        $this->db->set('IsLost', 1);
        $this->db->update('car_resource_book');
        $this->db->trans_complete();
    }
    
    function getlossSale($idResourceBook) {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->where('car_lost_sale.IdResourceBook', $idResourceBook);
        $LostSale = $this->db->get('car_lost_sale');
        return $LostSale->result_array();
        $this->db->trans_complete();
    }

}
