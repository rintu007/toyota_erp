<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_additionaljob extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertAdditionalJob($AdditionalJobData) {

        $this->db->insert('s_additionaljob', $AdditionalJobData);
        return "Successfully Inserted";
    }

    function UpdateAdditionalJob($idAdditionalJob, $AdditionalJobData) {

        $this->db->where('idAdditionalJob', $idAdditionalJob);
        $this->db->update('s_additionaljob', $AdditionalJobData);
        return "Successfully Updated";
    }

    function DeleteAdditionalJob($idAdditionalJob) {

        $this->db->set('isActive', 0);
        $this->db->where('idAdditionalJob', $idAdditionalJob);
        $this->db->update('s_additionaljob');
        return "Successfully Deleted";
    }

    function searchAdditionalJob($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_additionaljob');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_additionaljob.idDealer');
        $this->db->like('s_additionaljob.AdditionalJobName', $SearchKeyword);
        $this->db->where('s_additionaljob.isActive != 0');
        $searchAdditionalJob = $this->db->get();
        return $searchAdditionalJob->result_array();
    }

    function selectOneAdditionalJob() {

        $this->db->select('idAdditionalJob');
        $this->db->from('s_additionaljob');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idAdditionalJob = $this->db->get();
        if ($idAdditionalJob->num_rows() > 0) {
            $row = $idAdditionalJob->row();
            $idAdditionalJob = $row->idAdditionalJob;
            return $idAdditionalJob;
        }
    }

    function selectAllAdditionalJobs() {
        
    }

}
