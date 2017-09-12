<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_jobresultexplanation extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertJobResult($jobResultData) {

        $this->db->insert('s_jobresultexplanaition', $jobResultData);
        return "Successfully Inserted";
    }

    function UpdateJobResult($idJobResultExplanaition, $jobResultData) {

        $this->db->where('idJobResultExplanaition', $idJobResultExplanaition);
        $this->db->update('s_jobresultexplanaition', $jobResultData);
        return "Successfully Updated";
    }

    function DeleteJobResult($idJobResultExplanaition) {

        $this->db->set('isActive', 0);
        $this->db->where('idJobResultExplanaition', $idJobResultExplanaition);
        $this->db->update('s_jobresultexplanaition');
        return "Successfully Deleted";
    }

    function searchJobResult($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_jobresultexplanaition');
        $this->db->like('s_jobresultexplanaition.Name', $SearchKeyword);
        $this->db->where('s_jobresultexplanaition.isActive != 0');
        $searchJobResult = $this->db->get();
        return $searchJobResult->result_array();
    }

    function getJobResult() {

        $this->db->select('*');
        $this->db->from('s_jobresultexplanaition');
        $this->db->where('s_jobresultexplanaition.isActive != 0');
        $jobResultList = $this->db->get();
        return $jobResultList->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
