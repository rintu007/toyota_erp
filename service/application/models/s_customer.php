<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_customer extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertCustomer($customerData) {

        $this->db->insert('s_cutomerdetail', $customerData);
        return "Successfully Inserted";
    }

    function UpdateCustomer($idCustomer, $customerData) {

        $this->db->where('idCustomer', $idCustomer);
        $this->db->update('s_cutomerdetail', $customerData);
        return "Successfully Update";
    }

    function DeleteCustomer($idCustomer) {

        $this->db->set('isActive', 0);
        $this->db->where('idCustomer', $idCustomer);
        $this->db->update('s_cutomerdetail');
        return "Successfully Deleted";
    }

    function selectOneCustomer() {

        $this->db->select('idCustomer');
        $this->db->from('s_cutomerdetail');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idCustomer = $this->db->get();
        if ($idCustomer->num_rows() > 0) {
            $row = $idCustomer->row();
            $idCustomer = $row->idCustomer;
            return $idCustomer;
        }
    }

    function selectAllCustomers($ContactNumber) {
        $this->db->select('*');
        $this->db->from('s_cutomerdetail');
        $this->db->like('s_cutomerdetail.Cellphone', $ContactNumber);
        $this->db->where('s_cutomerdetail.isActive != 0');
        $serviceCustomer = $this->db->get();
        if ($serviceCustomer != NULL) {
            return $serviceCustomer->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('car_customer');
            $this->db->like('car_customer.Telephone', $ContactNumber);
            $carCustomer = $this->db->get();
            if ($carCustomer != NULL) {
                return $carCustomer->result_array();
            } else {
                $this->db->select('*');
                $this->db->from('cr_customerdetail');
                $this->db->like('cr_customerdetail.Telephone', $ContactNumber);
                $crCustomer = $this->db->get();
                if ($crCustomer != NULL) {
                    return $crCustomer->result_array();
                }
            }
        }
    }

    function searchCustomer($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_cutomerdetail');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_cutomerdetail.idDealer');
        $this->db->like('s_cutomerdetail.CustomerName', $SearchKeyword);
        $this->db->where('s_cutomerdetail.isActive != 0');
        $searchCustomer = $this->db->get();
        return $searchCustomer->result_array();
    }

    function isExistCustomer($name, $contactNumber) {

        $whereClause = "CustomerName = '$name' AND Cellphone = '$contactNumber' AND isActive = 1";
        $this->db->select('*');
        $this->db->from('s_cutomerdetail');
        $this->db->where($whereClause);
        $this->db->limit(1);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            $row = $isExist->row();
            $isExist = $row->idCustomer;
            return $isExist;
        }
    }

}
