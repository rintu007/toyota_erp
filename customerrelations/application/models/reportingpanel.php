<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reportingpanel extends My_Model {

    public function __construct() {

        parent::__construct();
    }

    public function getfivesheetreport($dateone, $datetwo) {

        $mymodel = new My_Model();
        $selectcity = $mymodel->methodgetfivesheetreport($dateone, $datetwo);
        return $selectcity;
    }

}
