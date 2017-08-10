<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Order_mode extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allOrderModes() {
        $this->db->select('*');
        $this->db->from('invoice_claim_type');
        $OrderMode = $this->db->get();
        return $OrderMode->result_array();
    }

    function oneOrderMode($id) {
        $OrderMode = $this->db->select('*')->from('invoice_claim_type')->where('id', $id)->get();
        return $OrderMode->result_array();
    }

    function insertOrderMode($OrderModeData) {
        $InsertOrderMode = $this->db->insert('invoice_claim_type', $OrderModeData);
        if ($InsertOrderMode) {
            return TRUE;
        } else {
            return FALSE;
        }
        $this->db->insert_id();
    }

    function updateOrderMode($id, $OrderModeData) {
        $this->db->where('id', $id);
        $UpdateOrderMode = $this->db->update('invoice_claim_type', $OrderModeData);
        if ($UpdateOrderMode) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function deleteOrderMode($id) {
        $this->db->where('id', $id);
        $this->db->delete('invoice_claim_type');
    }

    function searchOrderMode($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('invoice_claim_type');
        $this->db->like('invoice_claim_type.Title', $SearchKeyword);
        $SearchOrderMode = $this->db->get();
        return $SearchOrderMode->result_array();
    }

}
