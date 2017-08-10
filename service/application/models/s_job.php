<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_job extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertJob($JobData) {

        $this->db->insert('s_job', $JobData);
        return "Successfully Inserted";
    }

    function UpdateJob($idJob, $JobData) {

        $this->db->where('idJob', $idJob);
        $this->db->update('s_job', $JobData);
        return "Successfully Updated";
    }

    function DeleteJob($idJob) {

        $this->db->set('isActive', 0);
        $this->db->where('idJob', $idJob);
        $this->db->update('s_job');
        return "Successfully Deleted";
    }

    function selectOneJob() {

        $this->db->select('idJob');
        $this->db->from('s_job');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idJob = $this->db->get();
        if ($idJob->num_rows() > 0) {
            $row = $idJob->row();
            $idJob = $row->idJob;
            return $idJob;
        }
    }

    function searchJob($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_job');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_job.idDealer');
        $this->db->like('s_job.JobName', $SearchKeyword);
        $this->db->where('s_job.isActive != 0');
        $searchJob = $this->db->get();
        return $searchJob->result_array();
    }

    function selectAllJobs() {
        
    }

}
