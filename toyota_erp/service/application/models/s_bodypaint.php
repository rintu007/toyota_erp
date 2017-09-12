<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_bodypaint extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertBodyPaint($BodyPaintData) {

        $this->db->insert('s_bodypaint', $BodyPaintData);
        return "Successfully Inserted";
    }

    function UpdateBodyPaint($idBodyPaint, $BodyPaintData) {

        $this->db->where('idBodyPaint', $idBodyPaint);
        if ($this->db->update('s_bodypaint', $BodyPaintData)) {
            return "Successfully Update";
        } else {
            return "Failed";
        }
    }

    function DeleteBodyPaint($idBodyPaint) {

        $this->db->set('isActive', 0);
        $this->db->where('idBodyPaint', $idBodyPaint);
        $this->db->update('s_bodypaint');
        return "Successfully Deleted";
    }

    function searchBodyPaint($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_bodypaint');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_bodypaint.idDealer');
        $this->db->like('s_bodypaint.BodyPaintName', $SearchKeyword);
        $this->db->where('s_bodypaint.isActive != 0');
        $searchBodyPaint = $this->db->get();
        return $searchBodyPaint->result_array();
    }

    function selectOneBodyPaint() {
        
    }

    function getIdBodyPaint() {

        $this->db->select('idBodyPaint');
        $this->db->from('s_bodypaint');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idBodyPaint = $this->db->get();
        if ($idBodyPaint->num_rows() > 0) {
            $row = $idBodyPaint->row();
            $idBodyPaint = $row->idBodyPaint;
            return $idBodyPaint;
        }
    }

    function selectAllBodyPaints() {
        
    }

}
