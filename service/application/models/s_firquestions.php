<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_firquestions extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function AllFirQuestions() {

        $this->db->select('*');
        $this->db->from('s_firquestions');
        $this->db->where('isActive', 1);
        $FirQuestionsList = $this->db->get();
        $colorCombo = $FirQuestionsList->result();
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            array_push($dropDownList, ["key" => $dropdown->idFirQuestions, "label" => $dropdown->Question]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function InsertFirQuestions($firQuestionsData) {

        $this->db->insert('s_firquestions', $firQuestionsData);
        return "Successfully Inserted";
    }

    function UpdateFirQuestions($idFirQuestions, $firQuestionsData) {

        $this->db->where('idFirQuestions', $idFirQuestions);
        $this->db->update('s_firquestions', $firQuestionsData);
        return "Successfully Updated";
    }

    function DeleteFirQuestions($idFirQuestions) {

        $this->db->set('isActive', 0);
        $this->db->where('idFirQuestions', $idFirQuestions);
        $this->db->update('s_firquestions');
        return "Successfully Deleted";
    }

    function getAllFirQuestions() {

        $this->db->select('*');
        $this->db->from('s_firquestions');
        $this->db->where('s_firquestions.isActive != 0');
        $firQuestionsList = $this->db->get();
        return $firQuestionsList->result_array();
    }

    function isExist($data) {
        $this->db->select('*');
        $this->db->from('s_firquestions');
        $this->db->like('s_firquestions.QuestionNo', $data['QuestionNo']);
        $this->db->where('s_firquestions.isActive != 0');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            $result = $row->QuestionNo;
            return $result;
        }
    }

    function searchFirQuestions($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_firquestions');
        $this->db->like('s_firquestions.Question', $SearchKeyword);
        $this->db->where('s_firquestions.isActive != 0');
        $searchFirQuestions = $this->db->get();
        return $searchFirQuestions->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
