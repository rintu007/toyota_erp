<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_diagnosis extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertDiagnosis($DiagnosisData) {

        $this->db->insert('s_diagnosis', $DiagnosisData);
        return "Successfully Inserted";
    }

    function UpdateDiagnosis($idDiagnosis, $DiagnosisData) {

        $this->db->where('idDiagnosis', $idDiagnosis);
        $this->db->update('s_diagnosis', $DiagnosisData);
        return "Successfully Updated";
    }

    function DeleteDiagnosis($idDiagnosis) {

        $this->db->set('isActive', 0);
        $this->db->where('idDiagnosis', $idDiagnosis);
        $this->db->update('s_diagnosis');
        return "Successfully Deleted";
    }

    function selectOneDiagnosis() {

        $this->db->select('idDiagnosis');
        $this->db->from('s_diagnosis');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idDiagnosis = $this->db->get();
        if ($idDiagnosis->num_rows() > 0) {
            $row = $idDiagnosis->row();
            $idDiagnosis = $row->idDiagnosis;
            return $idDiagnosis;
        }
    }

    function searchDiagnosis($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_diagnosis');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_diagnosis.idDealer');
        $this->db->like('s_diagnosis.DiagnosisName', $SearchKeyword);
        $this->db->where('s_diagnosis.isActive != 0');
        $searchDiagnosis = $this->db->get();
        return $searchDiagnosis->result_array();
    }

    function selectAllDiagnosiss() {
        
    }

}
