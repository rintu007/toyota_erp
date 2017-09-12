<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_jobprogresssheet extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertJobData($jobData) {

        $this->db->insert('s_jobprogresssheet', $jobData);
        return "Job Progress Sheet has been created";
    }

    function getIdJobData() {

        $this->db->select('idJobProgressSheet');
        $this->db->from('s_jobprogresssheet');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idJobProgress = $this->db->get();
        if ($idJobProgress->num_rows() > 0) {
            $row = $idJobProgress->row();
            $idJobProgress = $row->idJobProgressSheet;
            return $idJobProgress;
        }
    }

    function getIdDiagnosis() {

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

    function getIdJob() {

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

    function getIdJobPMPackage() {

        $this->db->select('idJobProgPMPackage');
        $this->db->from('s_jobprog_pmpackage');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idJobPMPackage = $this->db->get();
        if ($idJobPMPackage->num_rows() > 0) {
            $row = $idJobPMPackage->row();
            $idJobPMPackage = $row->idJobProgPMPackage;
            return $idJobPMPackage;
        }
    }

    function getIdAdditionalJob() {

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

    function getIdJobStoppage() {

        $this->db->select('idJobStoppage');
        $this->db->from('s_jobstoppage');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idJobStoppage = $this->db->get();
        if ($idJobStoppage->num_rows() > 0) {
            $row = $idJobStoppage->row();
            $idJobStoppage = $row->idJobStoppage;
            return $idJobStoppage;
        }
    }

    function getJobDetails($RONumber) {

        echo $RONumber;
//        $this->db->select('ro.idRepairOrderBill AS idRO,ro.RONumber AS RONumber,GROUP_CONCAT(jobref.JobTask) AS JobTask,pmd.Amount');
        $this->db->select('ro.idRepairOrderBill AS idRO,ro.RONumber AS RONumber,pmpack.idPeriodicMaintenanceDetail AS idPMD,pm.PeriodName AS PMPackage,pmjobs.idJobRef AS idPmdJobs,packjobs.JobTask AS PMDJobs,'
                . 'mr.idJobRefManual AS idMJob,mj.JobTask AS MechJobs,bpjob.idJobRefManual AS idBPJobs,bjob.JobTask AS BPJobs');
        $this->db->from('s_repairorderbill ro');
        $this->db->join('s_ro_mechrepairs mr', 'mr.idRepairOrderBill = ro.idRepairOrderBill');
        $this->db->join('s_jobreferencemanual mj', 'mj.idJobRef = mr.idJobRefManual');
        $this->db->join('s_bodypaint bpaint', 'bpaint.idRepairOrderBill = ro.idRepairOrderBill');
        $this->db->join('s_bodypaint_jobref bpjob', 'bpjob.idBodyPaint = bpaint.idBodyPaint');
        $this->db->join('s_jobreferencemanual bjob', 'bjob.idJobRef = bpjob.idJobRefManual');
        $this->db->join('s_ro_pmpackages pmpack', 'pmpack.idRepairOrderBill = ro.idRepairOrderBill');
        $this->db->join('s_periodicmaintenancedetail pmd', 'pmd.idPeriodicMaintenanceDetail = pmpack.idPeriodicMaintenanceDetail');
        $this->db->join('s_periodicmaintenance pm', 'pm.idPeriodicMaintenance = pmd.idPeriodicMaintenance');
        $this->db->join('s_ro_pm_jobs pmjobs', 'pmjobs.idRoPMPackage = pmpack.idRoPMPackage');
        $this->db->join('s_jobreferencemanual packjobs', 'packjobs.idJobRef = pmjobs.idJobRef');
        $this->db->where('ro.RONumber', $RONumber);
        $this->db->where('ro.isActive', 1);
//        $this->db->group_by('mr.idJobRefManual,bpjob.idJobRefManual,pmjobs.idJobRef');
//        $this->db->group_by('pmjobs.idJobRef');
        $jobsData = $this->db->get();
        return $jobsData->result_array();
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

    // Body Shop Progress Functions

    function InsertBodyPaintProgressData($data) {

        $this->db->insert('s_bodypaint_progress_sheet', $data);
        return "Body Shop Progress Sheet has been created ";
    }

    function getDentPanals() {
        $this->db->select('*');
        $this->db->from('s_panal_dent s');
        $this->db->where('s.isActive', 1);
        $denterList = $this->db->get();
        return $denterList->result_array();
    }

    function getPaintPanals() {
        $this->db->select('*');
        $this->db->from('s_panal_paint s');
        $this->db->where('s.isActive', 1);
        $painterList = $this->db->get();
        return $painterList->result_array();
    }

    function getIdBodyPaintProgress() {

        $this->db->select('idBodyPaintProgressSheet');
        $this->db->from('s_bodypaint_progress_sheet');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idBodyPaintProgress = $this->db->get();
        if ($idBodyPaintProgress->num_rows() > 0) {
            $row = $idBodyPaintProgress->row();
            $idBodyPaintProgress = $row->idBodyPaintProgressSheet;
            return $idBodyPaintProgress;
        }
    }

}
