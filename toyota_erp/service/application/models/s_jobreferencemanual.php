<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_jobreferencemanual extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertJrm($jrmData) {

        $this->db->insert('s_jobreferencemanual', $jrmData);
        return "Successfully Inserted";
    }

    function UpdateJrm($idJrm, $jrmData) {

        $this->db->where('idJobRef', $idJrm);
        $this->db->update('s_jobreferencemanual', $jrmData);
        return "Successfully Updated";
    }

    function DeleteJrm($idJrm) {

        $this->db->set('isActive', 0);
        $this->db->where('idJobRef', $idJrm);
        $this->db->update('s_jobreferencemanual');
        return "Successfully Deleted";
    }

    function searchJrm($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->like('JobTask', $SearchKeyword);
        $this->db->where('isActive', 1);
        $searchJrm = $this->db->get();
        return $searchJrm->result_array();
    }

    function AllJobRef() {
        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->where('s_jobreferencemanual.isActive != 0');
        $jrmList = $this->db->get();
        return $jrmList->result_array();
    }

    function getAllJrm() {

        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->where('s_jobreferencemanual.isActive != 0');
        $jrmList = $this->db->get();
        return $jrmList->result_array();
    }

    function getMechanicalJobs() {

//        $ofMechanical = " isActive != 0";

        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->where('isActive',1);
        $this->db->order_by('JobTask');
        $mechanicalJobs = $this->db->get();
        return $mechanicalJobs->result_array();
    }

    function getBodyPaintJobs() {

        $ofBodyPaint = "isBodyPaint = 0 AND isActive != 0";

        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->where($ofBodyPaint);
        $bodyPaintJobs = $this->db->get();
        return $bodyPaintJobs->result_array();
    }

    function getMechJobDetails($idJob) {
        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->where('idJobRef', $idJob);
        $this->db->where('isActive', 1);
        $getJobDetails = $this->db->get();
        return $getJobDetails->result_array();
    }

    function getBPJobDetails($idJob) {
        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->where('idJobRef', $idJob);
        $this->db->where('isActive', 1);
        $getJobDetails = $this->db->get();
        return $getJobDetails->result_array();
    }

    function getJobRangeDetail($range, $idJob) {
        if ($range == 1) {
            $select = 'RangeOneAmount';
        } else {
            if ($range == 2) {
                $select = 'RangeTwoAmount';
            } else {
                $select = 'RangeThreeAmount';
            }
        }
        $this->db->select($select);
        $this->db->from('s_jobreferencemanual');
        $this->db->where('idJobRef', $idJob);
        $getRange = $this->db->get();
        if ($getRange->num_rows() > 0) {
            $row = $getRange->row();
            $getRange = $row->$select;
            return $getRange;
        } else {
            return 0;
        }
    }

    function selectAllJobs() {

        $ofJobs = "isDefault = 0 AND isActive != 0";
        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->where($ofJobs);
        $mechanicalJobs = $this->db->get();
        return $mechanicalJobs->result_array();
    }
    
    function selectAllOtherJobs() {

        $ofJobs = "isBodyPaint != 1 AND isActive != 0";
        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->where($ofJobs);
        $mechanicalJobs = $this->db->get();
        return $mechanicalJobs->result_array();
    }

    function selectOne() {
        
    }

}
