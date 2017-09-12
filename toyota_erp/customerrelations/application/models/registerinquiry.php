<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Registerinquiry extends My_Model {

    public function __construct() {

        parent::__construct();
        $mymodel = new My_Model();
    }

    public function loadedmodel() {
        echo " This is my Model ";
    }

    public function getvehicle() {

        $mymodel = new My_Model();
        $selectcity = $mymodel->methodgetroute();
        return $selectcity;
    }

    public function getorderbydata() {
        $mymodel = new My_Model();
        $selectcity = $mymodel->methodgetorderbydata();
        return $selectcity;
    }

    public function getroute() {

        $mymodel = new My_Model();
        $getroute = $mymodel->methodgetroute();
        return $getroute;
    }

    public function getcomplaintmode() {

        $mymodel = new My_Model();
        $selectcountry = $mymodel->methodgetcomplaintmode();
        return $selectcountry;
    }

    public function getinquiryrelation() {

        $mymodel = new My_Model();
        $selectrequestedtime = $mymodel->methodgetinquiryrelation();
        return $selectrequestedtime;
    }

    public function getinquirydepart() {

        $mymodel = new My_Model();
        $selectrequestedtime = $mymodel->methodgetinquirydepart();
        return $selectrequestedtime;
    }

    public function getcomplainstatus() {

        $mymodel = new My_Model();
        $selectrequestedtime = $mymodel->methodgetcomplainstatus();
        return $selectrequestedtime;
    }

    public function getuserskills() {

        $mymodel = new My_Model();
        $getuserskills = $mymodel->methodgetuserskills();
        return $getuserskills;
    }

    public function getapproles() {


        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetapproles();
        return $getapproles;
    }

    public function getexistingcustomer() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetexistingcustomer();
        return $getapproles;
    }

    public function getallinquiries() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetallinquiries();
        return $getallcomplaints;
    }

    public function getallnonfcrinquiries() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetallnonfcrinquiries();
        return $getallcomplaints;
    }

    public function getallclosedinquiries() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetallcloseinquiriess();
        return $getallcomplaints;
    }

    public function getfilteredinquiry() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetfilteredinquiry();
        return $getallcomplaints;
    }

    public function getfilteredinquirysharing() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetfilteredinquirysharing();
        return $getallcomplaints;
    }

    public function getfilterednonfcrinquiry() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetfilterednonfcrinquiry();
        return $getallcomplaints;
    }

    public function registernonfcrform_() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetregisternonfcrform();
        return $getallcomplaints;
    }

    public function getcontactdetaildescription() {

        $mymodel = new My_Model();
        $contactdetaildescription = $mymodel->methodgetcontactdetaildescription();
        return $contactdetaildescription;
    }

    public function getsaleprocessdescription() {

        $mymodel = new My_Model();
        $saleprocessdescription = $mymodel->methodgetfilteredprocessdescription();
        return $saleprocessdescription;
    }

    public function getsalesubprocessdescription() {

        $mymodel = new My_Model();
        $salesubprocessdescription = $mymodel->methodgetfilteredsalesubprocessdescription();
        return $salesubprocessdescription;
    }

    public function getfilteredclosedinquiry() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetfilteredclosedinquiry();
        return $getallcomplaints;
    }

    public function getuserinfo() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetuserinfo();
        return $getapproles;
    }

    public function getvariants() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetvariants();
        return $getapproles;
    }

    public function registerinquiry_() {

        $mymodel = new My_Model();
        $registercomplain = $mymodel->doregisterinquiry();
        return $registercomplain;
    }

    public function addmodes_() {

        $mymodel = new My_Model();
        $addmodes = $mymodel->doaddmodes();
        return $addmodes;
    }

    public function updatemodes_() {

        $mymodel = new My_Model();
        $addmodes = $mymodel->doupdatemodes();
        return $addmodes;
    }

//    public function getmodeslist() {
//        $getmodeslist = $mymodel->methodgetmodelist();
//        return $getmodeslist;
//    }

    public function addoutes_() {

        $mymodel = new My_Model();
        $addroutes = $mymodel->doaddroutes();
        return $addroutes;
    }

    public function updateroutes_() {

        $mymodel = new My_Model();
        $addroutes = $mymodel->doupdateroutes();
        return $addroutes;
    }

    public function getrouteslist() {

        $mymodel = new My_Model();
        $getrouteslist = $mymodel->methodgetroutelist();
        return $getrouteslist;
    }

    public function getdepartmentlist() {

        $mymodel = new My_Model();
        $getdepartmentlist = $mymodel->methodgetdepartmentlist();
        return $getdepartmentlist;
    }

    public function addcomplaintmodes_() {

        $mymodel = new My_Model();
        $addcompmodes = $mymodel->doaddcomplaintmodes();
        return $addcompmodes;
    }

    public function updatecomplaintmodes_() {

        $mymodel = new My_Model();
        $addcompmodes = $mymodel->doupdatecomplaintmodes();
        return $addcompmodes;
    }

    public function getcomplaintmodeslist() {

        $mymodel = new My_Model();
        $getmodelist = $mymodel->methodgetcmplntmodelist();
        return $getmodelist;
    }

    public function addcomplaintrelation_() {

        $mymodel = new My_Model();
        $addcomplaintrel = $mymodel->doaddcomplaintrel();
        return $addcomplaintrel;
    }

    public function updatecomplaintrelation_() {

        $mymodel = new My_Model();
        $addcomplaintrel = $mymodel->doupdatecomplaintrel();
        return $addcomplaintrel;
    }

    public function getcomplaintrelationlist() {

        $mymodel = new My_Model();
        $getcomplaintrellist = $mymodel->methodgetcmplntrellist();
        return $getcomplaintrellist;
    }

    public function addfaqs_() {

        $mymodel = new My_Model();
        $addfaqs = $mymodel->doaddfaqs();
        return $addfaqs;
    }

    public function getfaqslist() {

        $mymodel = new My_Model();
        $getfaqslist = $mymodel->methodgetfaqslist();
        return $getfaqslist;
    }

    public function addcomplaintresponsetime_() {
        $mymodel = new My_Model();
        $addcompresptime = $mymodel->doaddcomplaintresptime();
        return $addcompresptime;
    }

    public function updatecomplaintresponsetime_() {
        $mymodel = new My_Model();
        $addcompresptime = $mymodel->doupdatecomplaintresponsetime_();
        return $addcompresptime;
    }

    public function getcomplaintresponsetime_() {
        $mymodel = new My_Model();
        $getcompresptime = $mymodel->methodgetcomplaintresptime();
        return $getcompresptime;
    }

    public function registervehicledetail_() {
        $mymodel = new My_Model();
        $registervehicledetail = $mymodel->doregisterregvehicledetail();
        return $registervehicledetail;
    }

    public function updateinquiryform() {
        $mymodel = new My_Model();
        $updatecomplaint = $mymodel->doupdateinquiryform();
        return $updatecomplaint;
    }

    public function updatecomplaint_() {
        $mymodel = new My_Model();
        $updatecomplaint = $mymodel->doupdatecomplaint();
        return $updatecomplaint;
    }

    public function getexistcustomerdata_() {
        $mymodel = new My_Model();
        $results = $mymodel->methodgetexistcustomerdata();
        return $results;
    }

    public function updatereplyaction_() {
        $mymodel = new My_Model();
        $updateaction = $mymodel->doupdatereplyaction();
        return $updateaction;
    }

    public function updatecomplaintkizentaken__() {
        $mymodel = new My_Model();
        $updatekizen = $mymodel->doupdatecomplaintktaken();
        return $updatekizen;
    }

    public function checkinquirynum() {
        $mymodel = new My_Model();
        $updatekizen = $mymodel->docheckinquirynum();
        return $updatekizen;
    }

    public function getdepartments() {

        $mymodel = new My_Model();
        $selectrequestedtime = $mymodel->methodgetdepartmentlist();
        return $selectrequestedtime;
    }
    
    
    public function getallinquiriessale() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetallinquiriessale();
        return $getallcomplaints;
    }
    
     public function getallinquiriesservice() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetallinquiriesservice();
        return $getallcomplaints;
    }
    
     public function getallinquiriesparts() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetallinquiriesparts();
        return $getallcomplaints;
    }
     public function getallinquiriesfinance() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetallinquiriesfinance();
        return $getallcomplaints;
    }

    
}
