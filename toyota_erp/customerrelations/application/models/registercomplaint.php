<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class registercomplaint extends My_Model {

    public function addroute__construct() {

        parent::__construct();
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

    public function getcompmodecategory() {

        $mymodel = new My_Model();
        $selectcountry = $mymodel->methodgetcompmodecategory();
        return $selectcountry;
    }

    public function getcomplaintrelation() {

        $mymodel = new My_Model();
        $selectrequestedtime = $mymodel->methodgetcomplaintrelation();
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

    public function getvariants() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetvariants();
        return $getapproles;
    }

    public function getexistingcustomer() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetexistingcustomer();
        return $getapproles;
    }

    public function getallcomplaints() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetallcomplaints();
        return $getallcomplaints;
    }

    public function getsearchallcomplaints() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodsearchallcomplaints();
        return $getallcomplaints;
    }

    public function complaintsformessage() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodcomplaintsformessage();
        return $getallcomplaints;
    }

    public function getfilteredcomplaintmessage() {

        $mymodel = new My_Model();
        $selectrequestedtime = $mymodel->methodgetfilteredcomplaintmessage();
        return $selectrequestedtime;
    }

    public function inquiriesformessage() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodinquiriesformessage();
        return $getallcomplaints;
    }

    public function getfilteredinquirymessage() {

        $mymodel = new My_Model();
        $selectrequestedtime = $mymodel->methodgetfilteredinquirymessage();
        return $selectrequestedtime;
    }

    public function getNumberComplaintMessage() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodcountcomplaintsformessage();
        return $getallcomplaints;
    }

    public function getNumberInquiryMessage() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodcountinquiryformessage();
        return $getallcomplaints;
    }

    public function getallclosedcomplaints() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetallclosecomplaint();
        return $getallcomplaints;
    }

    public function getfilteredcomplaint() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetfilteredcomplaint();
        return $getallcomplaints;
    }

    public function getfilteredcomplaintsharing() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetfilteredcomplaintsharing();
        return $getallcomplaints;
    }

    public function getfilteredcontactdetaillist() {

        $mymodel = new My_Model();
        $contactdetaildescription = $mymodel->methodgetcontactdetaildescription();
        return $contactdetaildescription;
    }

    public function gefilteredprocesslist() {

        $mymodel = new My_Model();
        $processdescription = $mymodel->methodgetfilteredprocessdescription();
        return $processdescription;
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

    public function getfilteredclosedcomplaint() {

        $mymodel = new My_Model();
        $getallcomplaints = $mymodel->methodgetfilteredclosedcomplaint();
        return $getallcomplaints;
    }

    public function getuserinfo() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetuserinfo();
        return $getapproles;
    }

    public function getdetaillist() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetdetaillist();
        return $getapproles;
    }

    public function getprocesslist() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetprocesslist();
        return $getapproles;
    }

    public function getsubprocesslist() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetsubprocesslist();
        return $getapproles;
    }

    public function getvocclassificationlist() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetvocclassificationlist();
        return $getapproles;
    }

    public function getfilteredvocclassification() {

        $mymodel = new My_Model();
        $getapproles = $mymodel->methodgetfilteredvocclassification();
        return $getapproles;
    }

    public function registercomplaint_() {

        $mymodel = new My_Model();
        $registercomplain = $mymodel->doregistercomplaint();
        return $registercomplain;
    }

    public function addmodes_() {

        $mymodel = new My_Model();
        $addmodes = $mymodel->doaddmodes();
        return $addmodes;
    }

    public function updatemodes_() {

        $mymodel = new My_Model();
        $updatemodes = $mymodel->doupdatemodes();
        return $updatemodes;
        if ($updatemodes) {
            return "Successfully Updated";
        }
    }

    public function getmodesslist() {

        $mymodel = new My_Model();
        $getmodeslist = $mymodel->methodgetmodeslist();
        return $getmodeslist;
    }

    public function addskills_() {

        $mymodel = new My_Model();
        $addskills = $mymodel->doaddskills();
        return $addskills;
    }

    public function updateskills_() {

        $mymodel = new My_Model();
        $addskills = $mymodel->doupdateskills();
        return $addskills;
    }

    public function getskillslist() {

        $mymodel = new My_Model();
        $getskilllist = $mymodel->methodgetskillslist();
        return $getskilllist;
    }

    public function addroute() {

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

    public function insertcomplaintmodes() {

        $mymodel = new My_Model();
        $addcompmodes = $mymodel->doaddcomplaintmodes();
        return $addcompmodes;
    }

    public function updatecomplaintmodes_() {

        $mymodel = new My_Model();
        $addcompmodes = $mymodel->doupdatecomplaintmodes();
        return $addcompmodes;
    }

    public function getcomplaintmodelist() {

        $mymodel = new My_Model();
        $getmodelist = $mymodel->methodgetcmplntmodelist();
        return $getmodelist;
    }

    public function getcomplaintmodesandcategory() {

        $mymodel = new My_Model();
        $getmodelist = $mymodel->methodgetcomplaintmodesandcategory();
        return $getmodelist;
    }

    public function addcomplaintcategory() {

        $mymodel = new My_Model();
        $getmodelist = $mymodel->doaddcomplaintcategory();
        return $getmodelist;
    }

    public function updatecomplaintcategories() {

        $mymodel = new My_Model();
        $getmodelist = $mymodel->doupdatecomplaintcategories();
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

    public function getquestionsanswers() {

        $mymodel = new My_Model();
        $getfaqslist = $mymodel->methodgetquestionsanswers();
        return $getfaqslist;
    }

    public function insertcomplaintresponsetime() {

        $mymodel = new My_Model();
        $addcompresptime = $mymodel->doaddcomplaintresptime();
        return $addcompresptime;
    }

    public function adddetailruless() {

        $mymodel = new My_Model();
        $addcompresptime = $mymodel->doadddetailrules();
        return $addcompresptime;
    }

    public function addprocessruless() {

        $mymodel = new My_Model();
        $addcompresptime = $mymodel->doaddprocessrules();
        return $addcompresptime;
    }

    public function addsubprocessruless() {

        $mymodel = new My_Model();
        $addcompresptime = $mymodel->doaddsubprocessrules();
        return $addcompresptime;
    }

    public function updatetodetailrules() {

        $mymodel = new My_Model();
        $addcompresptime = $mymodel->doupdatedetailrules();
        return $addcompresptime;
    }

    public function updatetoprocessrules() {

        $mymodel = new My_Model();
        $addcompresptime = $mymodel->doupdateprocessrules();
        return $addcompresptime;
    }

    public function updatetosubprocessrules() {

        $mymodel = new My_Model();
        $addcompresptime = $mymodel->doupdatesubprocessrules();
        return $addcompresptime;
    }

    public function updatecomplaintresponsetime_() {

        $mymodel = new My_Model();
        $addcompresptime = $mymodel->doupdatecomplaintresponsetime_();
        return $addcompresptime;
    }

    public function getcomplaintresponsetime() {

        $mymodel = new My_Model();
        $getcompresptime = $mymodel->methodgetcomplaintresptime();
        return $getcompresptime;
    }

    public function registervehicledetail_() {

        $mymodel = new My_Model();
        $registervehicledetail = $mymodel->doregisterregvehicledetail();
        return $registervehicledetail;
    }

    public function sharecomplaint_() {

        $mymodel = new My_Model();
        $sharecomplaint = $mymodel->dosharecomplaint();
        return $sharecomplaint;
    }

    public function updatecomplaintform_() {

        $mymodel = new My_Model();
        $updatecomplaint = $mymodel->doupdatecomplaintform();
        return $updatecomplaint;
    }

    public function updatecomplaint_() {

        $mymodel = new My_Model();
        $updatecomplaint = $mymodel->doupdatecomplaint();
        return $updatecomplaint;
    }

    public function getexistcustomerdata() {

        $mymodel = new My_Model();
        $results = $mymodel->methodgetexistcustomerdata();
        return $results;
    }

    public function updatecomplaintactiontaken_() {

        $mymodel = new My_Model();
        $updateaction = $mymodel->doupdatecomplaintataken();
        return $updateaction;
    }

    public function doupdatecomplaintfeedback() {

        $mymodel = new My_Model();
        $updateaction = $mymodel->doupdatecomplaintfeedback();
        return $updateaction;
    }

    public function checkcomplaintnum() {

        $mymodel = new My_Model();
        $updatekizen = $mymodel->docheckcomplaintnum();
        return $updatekizen;
    }

    public function getdepartments() {

        $mymodel = new My_Model();
        $selectrequestedtime = $mymodel->methodgetdepartmentlist();
        return $selectrequestedtime;
    }

    public function getReturnComplaint() {

        $mymodel = new My_Model();
        $selectrequestedtime = $mymodel->ReturnComplaintFeedback();
        return $selectrequestedtime;
    }
    
     public function getReturnInquiry() {

        $mymodel = new My_Model();
        $selectrequestedtime = $mymodel->ReturnInquiryFeedback();
        return $selectrequestedtime;
    }
}
