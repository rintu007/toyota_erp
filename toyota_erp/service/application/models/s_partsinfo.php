<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_partsinfo extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function countDispatchedParts() {
        $this->db->select('count(*) as count');
        $this->db->from('viewpartsreqdetail');
        $this->db->where('viewpartsreqdetail.PartRequested', 0);
        $countDispatched = $this->db->get();
        if ($countDispatched->num_rows() > 0) {
            $row = $countDispatched->row();
            return $countDispatched = $row->count;
        }
    }

    function countRemaingPartsRequests() {

        $isRemaining = 'viewpartsrecdetail.RemainingQuantity > 0 AND viewpartsrecdetail.PartsReceived = 1';
        $this->db->select('count(*) as count');
        $this->db->from('viewpartsrecdetail');
        $this->db->where($isRemaining);
        $countReceived = $this->db->get();
        if ($countReceived->num_rows() > 0) {
            $row = $countReceived->row();
            return $countReceived = $row->count;
        }
    }

    function countReceivedParts() {
        $this->db->select('count(*) as count');
        $this->db->from('viewpartsrecdetail');
        $this->db->where('viewpartsrecdetail.PartsReceived', 0);
        $countReceived = $this->db->get();
        if ($countReceived->num_rows() > 0) {
            $row = $countReceived->row();
            return $countReceived = $row->count;
        }
    }

    function Update() {
        
    }

    function Delete() {
        
    }

    function search() {
        
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
