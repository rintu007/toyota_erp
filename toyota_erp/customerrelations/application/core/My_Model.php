<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class My_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
        date_default_timezone_set("Asia/Karachi");
    }

    public function doregistercomplaint() {

        $complaintcreateddate = date("Y-m-d H:i:s");
        $unknowncustomerid = 0;
        $unknownvehicleid = 0;

        $complaintNumber = $this->docheckcomplaintnum();

        /**
         * Register Customer Detail
         */
        if (!empty($_POST['customername'])) {

            $getcustomername = $_POST['customername'];
        } else {

            $getcustomername = "";
        }

        if (!empty($_POST['customermobilenumber'])) {

            $getcustomermobilenumber = $_POST['customermobilenumber'];
        } else {
            $getcustomermobilenumber = "";
        }

        if (!empty($_POST['customerphonenumber'])) {

            $getcustomerphonenumber = $_POST['customerphonenumber'];
        } else {
            $getcustomerphonenumber = "";
        }

        if (!empty($_POST['customeremail'])) {

            $getcustomeremail = $_POST['customeremail'];
        } else {
            $getcustomeremail = "";
        }

        if (!empty($_POST['customeraddress'])) {

            $getcustomeraddress = $_POST['customeraddress'];
        } else {
            $getcustomeraddress = "";
        }

        if (!empty($_POST['customerprofile'])) {

            $getcustomerprofile = $_POST['customerprofile'];
        } else {
            $getcustomerprofile = "";
        }

        if (($getcustomername == null) && ($getcustomermobilenumber == null) && ($getcustomerphonenumber == null) && ($getcustomeremail == null) && ($getcustomeraddress == null) && ($getcustomerprofile == null)) {

            $whereName = "Name = 'unknown'";

            $this->db->select('idcr_customerdetail');
            $this->db->from('cr_customerdetail');
            $this->db->where($whereName);
            $unknowncustomerid = $this->db->get();
            if ($unknowncustomerid->num_rows() > 0) {
                $row = $unknowncustomerid->row();
                $unknowncustomerid = $row->idcr_customerdetail;
            }
        } else {

            $whereisName = "Name = '$getcustomername' AND Cellphone = '$getcustomermobilenumber'";

            $this->db->select('*');
            $this->db->from('cr_customerdetail');
            $this->db->where($whereisName);
            $isName = $this->db->get();

            if ($isName->num_rows() > 0) {

                $row = $isName->row();
                $unknowncustomerid = $row->idcr_customerdetail;
            } else {

                $this->db->set('Name', $getcustomername);
                $this->db->set('Email', $getcustomeremail);
                $this->db->set('Address', $getcustomeraddress);
                $this->db->set('Profile', $getcustomerprofile);
                $this->db->set('CreatedDate', $complaintcreateddate);
                $this->db->set('Telephone', $getcustomerphonenumber);
                $this->db->set('Cellphone', $getcustomermobilenumber);

                $insertcustomerdetail = $this->db->insert('cr_customerdetail');

                $this->db->select('idcr_customerdetail');
                $this->db->from('cr_customerdetail');
                $this->db->order_by("CreatedDate", "desc");
                $this->db->limit(1);
                $unknowncustomerid = $this->db->get();
                if ($unknowncustomerid->num_rows() > 0) {
                    $row = $unknowncustomerid->row();
                    $unknowncustomerid = $row->idcr_customerdetail;
                }
            }
        }

        /**
         * Registe Vehicle Details
         */
        if ($_POST['vehiclename'] == 'Select Variant') {
            $getvehiclename = null;
        } else {
            $getvehiclename = $_POST['vehiclename'];
        }

        if (!empty($_POST['vehicleregnumber'])) {

            $getvehicleregnumber = $_POST['vehicleregnumber'];
        } else {
            $getvehicleregnumber = null;
        }

        if (!empty($_POST['vehiclechassisnumber'])) {

            $getvehiclechassisnumber = $_POST['vehiclechassisnumber'];
        } else {
            $getvehiclechassisnumber = null;
        }

        if (!empty($_POST['vehicleenginenumber'])) {

            $getvehicleenginenumber = $_POST['vehicleenginenumber'];
        } else {
            $getvehicleenginenumber = null;
        }

        if (!empty($_POST['vehiclemileage'])) {

            $getvehiclemileage = $_POST['vehiclemileage'];
        } else {
            $getvehiclemileage = null;
        }

        if (!empty($_POST['vehicledate'])) {
            $getvehicledatepurchase = $_POST['vehicledate'];
        } else {
            $getvehicledatepurchase = "0000-00-00";
        }

        if (!empty($_POST['vehicledeliveredform'])) {

            $getvehicledeliveredform = $_POST['vehicledeliveredform'];
        } else {
            $getvehicledeliveredform = null;
        }

        if (!empty($_POST['Model'])) {

            $getVehicleModel = $_POST['Model'];
        } else {
            $getVehicleModel = "";
        }

        if (!empty($_POST['ModelYear'])) {

            $getModelYear = $_POST['ModelYear'];
        } else {
            $getModelYear = "";
        }

        if (($getvehiclename == null) && ($getvehicleregnumber == null) && ($getvehiclechassisnumber == null) && ($getvehicleenginenumber == null) && ($getvehiclemileage == null) && ($getvehicledatepurchase == null) && ($getvehicledeliveredform == null)) {

            $whereChassisNumber = "ChassisNumber = 'unknown'";

            $this->db->select('idcr_vehicledetail');
            $this->db->from('cr_vehicledetail');
            $this->db->where($whereChassisNumber);
            $unknownvehicleid = $this->db->get();
            if ($unknownvehicleid->num_rows() > 0) {
                $row = $unknownvehicleid->row();
                $unknownvehicleid = $row->idcr_vehicledetail;
            }
        } else {

            $whereisVehicle = "RegNumber = '$getvehicleregnumber'";

            $this->db->select('*');
            $this->db->from('cr_vehicledetail');
            $this->db->where($whereisVehicle);
            $isName = $this->db->get();

            if ($isName->num_rows() > 0) {
                $row = $isName->row();
                $unknownvehicleid = $row->idcr_vehicledetail;
            } else {

                $this->db->set('idcr_customerdetail', $unknowncustomerid);
                $this->db->set('RegNumber', $getvehicleregnumber);
                $this->db->set('Variantid', $getvehiclename);
                $this->db->set('ChassisNumber', $getvehiclechassisnumber);
                $this->db->set('EngineNumber', $getvehicleenginenumber);
                $this->db->set('Mileage', $getvehiclemileage);
                $this->db->set('DateOfPurchase', $getvehicledatepurchase);
                $this->db->set('DeliveredFrom', $getvehicledeliveredform);
                $this->db->set('Model', $getVehicleModel);
                $this->db->set('ModelYear', $getModelYear);
                $this->db->set('CreatedDate', $complaintcreateddate);

                $insertvehicledetail = $this->db->insert('cr_vehicledetail');

                $this->db->select('idcr_vehicledetail');
                $this->db->from('cr_vehicledetail');
                $this->db->order_by("CreatedDate", "desc");
                $this->db->limit(1);
                $unknownvehicleid = $this->db->get();

                if ($unknownvehicleid->num_rows() > 0) {
                    $row = $unknownvehicleid->row();
                    $unknownvehicleid = $row->idcr_vehicledetail;
                }
            }
        }

        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $wherePending = "Name = 'Pending'";

        $this->db->select('idcr_complainstatus');
        $this->db->from('cr_complainstatus');
        $this->db->where($wherePending);
        $this->db->limit(1);
        $statusid = $this->db->get();
        if ($statusid->num_rows() > 0) {
            $row = $statusid->row();
            $statusid = $row->idcr_complainstatus;
        }

        /**
         * Register Complaint
         * 
         */
        if (!empty($_POST['voiceofcustomer'])) {

            $getvoc = $_POST['voiceofcustomer'];
        } else {
            $getvoc = "";
        }

        if (!empty($_POST['customerrequest'])) {

            $getcustomerreq = $_POST['customerrequest'];
        } else {
            $getcustomerreq = "";
        }

        if (!empty($_POST['actiontakendescription'])) {

            $getaction = $_POST['actiontakendescription'];
        } else {
            $getaction = "";
        }

        if (!empty($_POST['kaizendescription'])) {

            $getkaizen = $_POST['kaizendescription'];
        } else {
            $getkaizen = "";
        }
        if (!empty($_POST['regdate'])) {

            $complaintregdatetime = $_POST['regdate'];
            $regtime = date("H:i:s", strtotime($complaintregdatetime));
            $regdate = date("Y-m-d", strtotime($complaintregdatetime));
        } else {
            $complaintregdatetime = null;
        }

        $data = unserialize($_COOKIE['logindata']);
        $this->db->set('idcar_userprofile', $data['userid']);
        $this->db->set('idcr_customerdetail', $unknowncustomerid);
        $this->db->set('idcr_vehicledetail', $unknownvehicleid);
        $this->db->set('idcr_mode', $modeid);
        $this->db->set('idcr_route', $this->input->post('idcrroute'));
        $this->db->set('idcr_complaintmodecategories', $this->input->post('idcrcompmodectgry'));
        $this->db->set('idcr_complainrelation', $this->input->post('idcrcomplainrelation'));
        $this->db->set('idcr_complainstatus', $statusid);
        $this->db->set('RegisterDate', $regdate);
        $this->db->set('RegisterTime', $regtime);
        $this->db->set('idcr_userskills', $this->input->post('idcruserskills'));
        $this->db->set('PadNumber', $complaintNumber + 1);
        $this->db->set('VoiceOfCustomer', $getvoc);
        $this->db->set('CustomerRequest', $getcustomerreq);
        $this->db->set('isShare', 0);
        $this->db->set('isActionTaken', 0);
        $this->db->set('isUpdate', 0);
        $this->db->set('isKaizenTaken', 0);
        $this->db->set('ActionTakenDescription', $getaction);
        $this->db->set('KaizenDescription', $getkaizen);
        $this->db->set('CreatedDate', $complaintcreateddate);

        $insertcomplaint = $this->db->insert('cr_complain');


        $this->db->select('idcr_complain');
        $this->db->from('cr_complain');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $complaintid = $this->db->get();
        if ($complaintid->num_rows() > 0) {
            $row = $complaintid->row();
            $complaintid = $row->idcr_complain;
        }

        /**
         * Insert Variant History
         */
        if (!empty($_POST['repairodernumber'])) {
            if ($_POST['repairodernumber'][0] != 'View All ROs') {
                $getronumber = $_POST['repairodernumber'];
                if (!empty($_POST['trnumber'])) {
                    $gettrnumber = $this->input->post('trnumber');
                } else {
                    $gettrnumber = NULL;
                }
                if (!empty($_POST['trdate'])) {
                    $gettrdate = $this->input->post('trdate');
                } else {
                    $gettrdate = "0000-00-00 00:00:00";
                }

                if (!empty($_POST['variantworkdone'])) {
                    $gethisworkdone = $this->input->post('variantworkdone');
                } else {
                    $gethisworkdone = NULL;
                }
                for ($count = 0; $count < count($_POST['repairodernumber']); $count++) {
                    if (!empty($_POST['deliverydate'][$count])) {
                        if ($_POST['deliverydate'][$count] != 'View Delivery Dates') {
                            $getdeliverdate = $_POST['deliverydate'][$count];
                        } else {
                            $getdeliverdate = "0000-00-00 00:00:00";
                        }
                    } else {
                        $getdeliverdate = "0000-00-00 00:00:00";
                    }

                    if (!empty($_POST['variantmileage'][$count])) {
                        if ($_POST['variantmileage'][$count] != 'NULL' && $_POST['variantmileage'][$count] != 'View Mileages') {
                            $gethismileage = $_POST['variantmileage'][$count];
                        } else {
                            $gethismileage = NULL;
                        }
                    } else {
                        $gethismileage = NULL;
                    }
                    $historyData[] = array(
                        'RONumber' => $getronumber[$count],
                        'TRNumber' => $gettrnumber,
                        'DeliveryDate' => $getdeliverdate,
                        'TRDate' => $gettrdate,
                        'Mileage' => $gethismileage,
                        'WorkDone' => $gethisworkdone,
                        'idcr_complain' => $complaintid
                    );
                }
                $insertMechJob = $this->db->insert_batch('cr_history', $historyData);
            } else {
                
            }
        }
//        if (!empty($_POST['repairodernumber'])) {
//
//            $getronumber = $_POST['repairodernumber'];
//        } else {
//            $getronumber = "";
//        }
//        $this->db->set('RONumber', $getronumber);
//        $this->db->set('TRNumber', $gettrnumber);
//        $this->db->set('DeliveryDate', $getdeliverdate);
//        $this->db->set('TRDate', $gettrdate);
//        $this->db->set('Mileage', $gethismileage);
//        $this->db->set('WorkDone', $gethisworkdone);
//        $this->db->set('idcr_complain', $complaintid);
//
//        $insertvarianthistroy = $this->db->insert('cr_history');

        /**
         *  Sharing Complaint
         */
        $isShare = $_POST['isshare'];
        if ($isShare == 1) {
            $sharingData = array();
            $idcaruserprofile = $_POST['selectedname'];
            for ($count = 0; $count < count($idcaruserprofile); $count++) {
                $sharingData[] = array(
                    'idcr_complain' => $complaintid,
                    'DateSharing' => $complaintcreateddate,
                    'idcar_userprofile' => $idcaruserprofile[$count],
                );
            }
            $insertSharing = $this->db->insert_batch('cr_sharing', $sharingData);
        } else {
            
        }
        return 'Complaint Registered Successfully, Complaint No. ' . $complaintNumber;
    }

    public function doregisterinquiry() {

        $complaintcreateddate = date("Y-m-d H:i:s");
        $unknowncustomerid = 0;
        $unknownvehicleid = 0;

        $a=$this->input->post('isfcr');
        if ($a==1) {
            $isfcr = 1;
        } else {
            $isfcr = 0;
        }

        $inquiryNumber = $this->docheckinquirynum();


        /**
         * Register Customer Detail
         */
        if (!empty($_POST['customername'])) {

            $getcustomername = $_POST['customername'];
        } else {

            $getcustomername = "";
        }

        if (!empty($_POST['customermobilenumber'])) {

            $getcustomermobilenumber = $_POST['customermobilenumber'];
        } else {
            $getcustomermobilenumber = "";
        }

        if (!empty($_POST['customerphonenumber'])) {

            $getcustomerphonenumber = $_POST['customerphonenumber'];
        } else {
            $getcustomerphonenumber = "";
        }

        if (!empty($_POST['customeremail'])) {

            $getcustomeremail = $_POST['customeremail'];
        } else {
            $getcustomeremail = "";
        }

        if (!empty($_POST['customeraddress'])) {

            $getcustomeraddress = $_POST['customeraddress'];
        } else {
            $getcustomeraddress = "";
        }

        if (!empty($_POST['customerprofile'])) {

            $getcustomerprofile = $_POST['customerprofile'];
        } else {
            $getcustomerprofile = "";
        }

        if (($getcustomername == null) && ($getcustomermobilenumber == null) && ($getcustomerphonenumber == null) && ($getcustomeremail == null) && ($getcustomeraddress == null) && ($getcustomerprofile == null)) {

            $whereName = "Name = 'unknown'";

            $this->db->select('idcr_customerdetail');
            $this->db->from('cr_customerdetail');
            $this->db->where($whereName);
            $unknowncustomerid = $this->db->get();
            if ($unknowncustomerid->num_rows() > 0) {
                $row = $unknowncustomerid->row();
                $unknowncustomerid = $row->idcr_customerdetail;
            }
        } else {

            $whereisName = "Name = '$getcustomername' AND Cellphone = '$getcustomermobilenumber'";

            $this->db->select('*');
            $this->db->from('cr_customerdetail');
            $this->db->where($whereisName);
            $isName = $this->db->get();

            if ($isName->num_rows() > 0) {

                $row = $isName->row();
                $unknowncustomerid = $row->idcr_customerdetail;
            } else {

                $this->db->set('Name', $getcustomername);
                $this->db->set('Email', $getcustomeremail);
                $this->db->set('Address', $getcustomeraddress);
                $this->db->set('Profile', $getcustomerprofile);
                $this->db->set('CreatedDate', $complaintcreateddate);
                $this->db->set('Telephone', $getcustomerphonenumber);
                $this->db->set('Cellphone', $getcustomermobilenumber);

                $insertcustomerdetail = $this->db->insert('cr_customerdetail');

                $this->db->select('idcr_customerdetail');
                $this->db->from('cr_customerdetail');
                $this->db->order_by("CreatedDate", "desc");
                $this->db->limit(1);
                $unknowncustomerid = $this->db->get();
                if ($unknowncustomerid->num_rows() > 0) {
                    $row = $unknowncustomerid->row();
                    $unknowncustomerid = $row->idcr_customerdetail;
                }
            }
        }

        /**
         * Registe Vehicle Details
         */
        if ($_POST['vehiclename'] == 'Select Variant') {
            $getvehiclename = null;
        } else {
            $getvehiclename = $_POST['vehiclename'];
        }

        if (!empty($_POST['vehicleregnumber'])) {

            $getvehicleregnumber = $_POST['vehicleregnumber'];
        } else {
            $getvehicleregnumber = "";
        }

        if (!empty($_POST['vehiclechassisnumber'])) {

            $getvehiclechassisnumber = $_POST['vehiclechassisnumber'];
        } else {
            $getvehiclechassisnumber = "";
        }

        if (!empty($_POST['vehicleenginenumber'])) {

            $getvehicleenginenumber = $_POST['vehicleenginenumber'];
        } else {
            $getvehicleenginenumber = "";
        }

        if (!empty($_POST['vehiclemileage'])) {

            $getvehiclemileage = $_POST['vehiclemileage'];
        } else {
            $getvehiclemileage = "";
        }

        if (!empty($_POST['vehicledate'])) {
            $getvehicledatepurchase = $_POST['vehicledate'];
        } else {
            $getvehicledatepurchase = "0000-00-00";
        }

        if (!empty($_POST['vehicledeliveredform'])) {

            $getvehicledeliveredform = $_POST['vehicledeliveredform'];
        } else {
            $getvehicledeliveredform = "";
        }

        if (!empty($_POST['Model'])) {

            $getVehicleModel = $_POST['Model'];
        } else {
            $getVehicleModel = "";
        }

        if (!empty($_POST['ModelYear'])) {

            $getModelYear = $_POST['ModelYear'];
        } else {
            $getModelYear = "";
        }

        if (($getvehiclename == null) && ($getvehicleregnumber == null) && ($getvehiclechassisnumber == null) && ($getvehicleenginenumber == null) && ($getvehiclemileage == null) && ($getvehicledatepurchase == null) && ($getvehicledeliveredform == null) && ($getVehicleModel == null) && ($getModelYear == null)) {

            $whereChassisNumber = "ChassisNumber = 'unknown'";

            $this->db->select('idcr_vehicledetail');
            $this->db->from('cr_vehicledetail');
            $this->db->where($whereChassisNumber);
            $unknownvehicleid = $this->db->get();
            if ($unknownvehicleid->num_rows() > 0) {
                $row = $unknownvehicleid->row();
                $unknownvehicleid = $row->idcr_vehicledetail;
            }
        } else {

            $whereisVehicle = "RegNumber = '$getvehicleregnumber'";

            $this->db->select('*');
            $this->db->from('cr_vehicledetail');
            $this->db->where($whereisVehicle);
            $isName = $this->db->get();

            if ($isName->num_rows() > 0) {
                $row = $isName->row();
                $unknownvehicleid = $row->idcr_vehicledetail;
            } else {
                $this->db->set('idcr_customerdetail', $unknowncustomerid);
                $this->db->set('RegNumber', $getvehicleregnumber);
                $this->db->set('Variantid', $getvehiclename);
                $this->db->set('ChassisNumber', $getvehiclechassisnumber);
                $this->db->set('EngineNumber', $getvehicleenginenumber);
                $this->db->set('Mileage', $getvehiclemileage);
                $this->db->set('DateOfPurchase', $getvehicledatepurchase);
                $this->db->set('DeliveredFrom', $getvehicledeliveredform);
                $this->db->set('Model', $getVehicleModel);
                $this->db->set('ModelYear', $getModelYear);
                $this->db->set('CreatedDate', $complaintcreateddate);

                $insertvehicledetail = $this->db->insert('cr_vehicledetail');

                $this->db->select('idcr_vehicledetail');
                $this->db->from('cr_vehicledetail');
                $this->db->order_by("CreatedDate", "desc");
                $this->db->limit(1);
                $unknownvehicleid = $this->db->get();

                if ($unknownvehicleid->num_rows() > 0) {
                    $row = $unknownvehicleid->row();
                    $unknownvehicleid = $row->idcr_vehicledetail;
                }
            }
        }

        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        if ($isfcr == 1) {
            $wherePending = "Name = 'Close'";
            $this->db->select('idcr_complainstatus');
            $this->db->from('cr_complainstatus');
            $this->db->where($wherePending);
            $this->db->limit(1);
            $statusid = $this->db->get();
            if ($statusid->num_rows() > 0) {
                $row = $statusid->row();
                $statusid = $row->idcr_complainstatus;
            }
        } elseif ($isfcr == 0) {
            $wherePending = "Name = 'Pending'";
            $this->db->select('idcr_complainstatus');
            $this->db->from('cr_complainstatus');
            $this->db->where($wherePending);
            $this->db->limit(1);
            $statusid = $this->db->get();
            if ($statusid->num_rows() > 0) {
                $row = $statusid->row();
                $statusid = $row->idcr_complainstatus;
            }
        }

        /**
         * Register Inquiry
         * 
         */
        if (!empty($_POST['voiceofcustomer'])) {

            $getvoc = $_POST['voiceofcustomer'];
        } else {
            $getvoc = "";
        }

        if (!empty($_POST['customerrequest'])) {

            $getcustomerreq = $_POST['customerrequest'];
        } else {
            $getcustomerreq = "";
        }

        if (!empty($_POST['actiontakendescription'])) {

            $getaction = $_POST['actiontakendescription'];
        } else {
            $getaction = "";
        }

        if (!empty($_POST['kaizendescription'])) {

            $getkaizen = $_POST['kaizendescription'];
        } else {
            $getkaizen = "";
        }

        if (!empty($_POST['regdate'])) {

            $inquiryregdatetime = $_POST['regdate'];
            $regtime = NULL;
//            $regtime = date("H:i:s", strtotime($inquiryregdatetime));
            $regdate = date("Y-m-d", strtotime($inquiryregdatetime));
        } else {
            $inquiryregdatetime = null;
        }
        $data = unserialize($_COOKIE['logindata']);
        $this->db->set('idcar_userprofile', $data['userid']);
        $this->db->set('idcr_customerdetail', $unknowncustomerid);
        $this->db->set('idcr_vehicledetail', $unknownvehicleid);
        $this->db->set('idcr_mode', $modeid);
        $this->db->set('idcr_route', $this->input->post('idcrroute'));
        $this->db->set('idcr_complainrelation', $this->input->post('idcrcomplainrelation'));
        $this->db->set('idcr_complainstatus', $statusid);
        $this->db->set('RegisterDate', $regdate);
        $this->db->set('RegisterTime', $regtime);
        $this->db->set('idcr_userskills', $this->input->post('idcruserskills'));
        $this->db->set('PadNumber', $inquiryNumber + 1);
//        $this->db->set('PadNumber', $this->input->post('padnumber'));
        $this->db->set('VoiceOfCustomer', $getvoc);
        $this->db->set('CustomerRequest', $getcustomerreq);
        $this->db->set('isShare', 0);
        $this->db->set('isActionTaken', 0);
        $this->db->set('isUpdate', 0);
        $this->db->set('isKaizenTaken', 0);
        $this->db->set('ActionTakenDescription', $getaction);
        $this->db->set('KaizenDescription', $getkaizen);
        $this->db->set('DepartmentFeedback', $this->input->post('respondto'));
        $this->db->set('CallStartTime', $this->input->post('starttime'));
        $this->db->set('CallEndTime', $this->input->post('endtime'));
        $this->db->set('CallDurationTime', $this->input->post('calldurationtime'));
        $this->db->set('CreatedDate', $complaintcreateddate);
        $this->db->set('isFcr', $isfcr);

        $insertcomplaint = $this->db->insert('cr_complain');

        $this->db->select('idcr_complain');
        $this->db->from('cr_complain');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $inquiryid = $this->db->get();
        if ($inquiryid->num_rows() > 0) {
            $row = $inquiryid->row();
            $inquiryid = $row->idcr_complain;
        }

        /**
         *  Sharing Inquiry
         */
        $isShare = $_POST['isshare'];
        if ($isShare == 1) {
            $sharingData = array();
            $idcaruserprofile = $this->input->post('selecteddepartmen');
            for ($count = 0; $count < count($idcaruserprofile); $count++) {
                $sharingData[] = array(
                    'idcr_complain' => $inquiryid,
                    'DateSharing' => $complaintcreateddate,
                    'idcar_userprofile' => $idcaruserprofile[$count],
                );
            }
            $insertSharing = $this->db->insert_batch('cr_sharing', $sharingData);
        } else {
            
        }
        return 'Inquiry Registered Successfully, Inquiry No. ' . ($inquiryNumber+1);
    }

    public function doregisterregcustomerdetail() {

//        
//        $getcustomername = $_POST['customername'];
//        $getcustomercontactnumber = $_POST['customercontactnumber'];
//        $getcustomeremail = $_POST['customeremail'];
//        $getcustomeraddress = $_POST['customeraddress'];
//        $getcustomerprofile = $_POST['customerprofile'];
//
//        $this->db->set('Name', $getcustomername);
//        $this->db->set('ContactNumber', $getcustomercontactnumber);
//        $this->db->set('Email', $getcustomeremail);
//        $this->db->set('Address', $getcustomeraddress);
//        $this->db->set('Profile', $getcustomerprofile);
//
//        $insertcustomerdetail = $this->db->insert('cr_customerdetail');
//        return $insertcustomerdetail;
    }

    public function doaddmodes() {

        $getmodename = $_POST['name'];
        $this->db->set('Name', $getmodename);
        $modeadded = $this->db->insert('cr_mode');
        if ($modeadded) {
            return "Successfully Inserted";
        }
        return $modeadded;
    }

    public function doupdatemodes() {

        $this->db->where('idcr_mode', $this->input->post('idMode'));

        $getmodename = $_POST['name'];
        $this->db->set('Name', $getmodename);
        $modeupdated = $this->db->update('cr_mode');
        if ($modeupdated) {
            return "Successfully Updated";
        }
    }

    public function methodgetmodeslist() {

        $this->db->select('idcr_mode,Name');
        $this->db->from('cr_mode');
        $modelist = $this->db->get();
        $modelist->result_array();
        return $modelist;
    }

    public function doaddskills() {

        $getskillname = $_POST['name'];
        $this->db->set('Name', $getskillname);
        $skilladded = $this->db->insert('cr_userskills');
        if ($skilladded) {
            return "Successfully Inserted";
        }
    }

    public function doupdateskills() {

        $this->db->where('idcr_userskills', $this->input->post('uidSkills'));
        $getskillname = $_POST['uSkills'];
        $this->db->set('Name', $getskillname);
        $update = $this->db->update('cr_userskills');
        if ($update) {
            return "Successfully Updated";
        }
    }

    public function methodgetskillslist() {

        $this->db->select('idcr_userskills,Name');
        $this->db->from('cr_userskills');
        $skilllist = $this->db->get();
        $skilllist->result_array();
        return $skilllist;
    }

    public function methodgetorderbydata() {

        $this->db->select('idcr_customerdetail');
        $this->db->from('cr_customerdetail');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $OneCa = $this->db->get();
        $OneCa->result_array();
        return $OneCa;

//        $this->db->select('*');
//        $this->db->from('car_accessory_info');
//        $OneCa = $this->db->get();
//        return $OneCa->row_array();
//        $this->db->order_by("CreatedDate", "desc");
//        $this->db->limit(1);
//        $query = $this->db->get();
//        $getdata->result_array();
//        echo json_encode($query);
//
//        SELECT
//        cr_customerdetail.idcr_customerdetail
//        FROM `cr_customerdetail`
//        ORDER BY
//        cr_customerdetail.CreatedDate DESC
//        limit 1
    }

    public function doaddroutes() {

        $getroutename = $_POST['routename'];
        $getroutedepart = $_POST['departmentname'];

        if ($getroutename != null) {
            $finalname = $getroutename;
            $getroutedepart = 0;
        } else {
            $finalname = $getroutedepart;
            $getroutedepart = 1;
        }

        $this->db->set('Name', $finalname);
        $this->db->set('isDepartment', $getroutedepart);
        $routeadded = $this->db->insert('cr_route');
        if ($routeadded) {
            return "Successfully Inserted";
        }
    }

    public function doupdateroutes() {

        $this->db->where('idcr_route', $this->input->post('idcrroute'));

        $getroutename = $_POST['name'];
        $this->db->set('Name', $getroutename);
        $routeupdated = $this->db->update('cr_route');
        if ($routeupdated) {
            return "Successfully Updated";
        }
    }

    public function methodgetroutelist() {

        $this->db->select('idcr_route,Name,isDepartment');
        $this->db->from('cr_route');
        $routelist = $this->db->get();
        $routelist->result_array();
        return $routelist;
    }

    public function methodgetdepartmentlist() {

        $this->db->select('IdDepartment,Department');
        $this->db->from('car_user_department');
        $departmentslist = $this->db->get();
        $departmentslist->result_array();
        return $departmentslist;
    }

    public function doaddcomplaintmodes() {

        $getcompmodename = $_POST['name'];
        $this->db->set('ModeName', $getcompmodename);
        $complaintmodedded = $this->db->insert('cr_complainmode');
        if ($complaintmodedded) {
            return "Successfully Inserted";
        }
    }

    public function doaddcomplaintcategory() {

        $createddate = date("Y-m-d H:i:s");
        $modifieddate = "0000-00-00 00:00:00";

        if (!empty($_POST['idcrcompmode'])) {

            $idcrcompmode = $_POST['idcrcompmode'];
        } else {
            $idcrcompmode = null;
        }

        if (!empty($_POST['categoryname'])) {

            $categoryname = $_POST['categoryname'];
        } else {
            $categoryname = null;
        }

        if (!empty($_POST['issaftey'])) {

            $issafety = 1;
        } else {
            $issafety = 0;
        }

        $this->db->set('ModeCategory', $categoryname);
        $this->db->set('isSaftey', $issafety);
        $this->db->set('idcr_complainmode', $idcrcompmode);
        $this->db->set('isActive', 1);
        $this->db->set('CreatedDate', $createddate);
        $this->db->set('ModifiedDate', $modifieddate);
        $modecategoryadded = $this->db->insert('cr_complaintmodecategories');
        if ($modecategoryadded) {
            return "Successfully Inserted";
        }
    }

    public function doupdatecomplaintcategories() {

        if (!empty($_POST['uissaftey'])) {

            $issafety = 1;
        } else {
            $issafety = 0;
        }

        $this->db->where('idcr_complaintmodecategories', $this->input->post('idModeCate'));

        $categoryname = $_POST['ucategoryname'];
        $idcrcompmode = $_POST['uidcrcompmode'];
        $this->db->set('ModeCategory', $categoryname);
        $this->db->set('isSaftey', $issafety);
        $this->db->set('idcr_complainmode', $idcrcompmode);
        $categories = $this->db->update('cr_complaintmodecategories');
        if ($categories) {
            return "Successfully Updated";
        }
    }

    public function doupdatecomplaintmodes() {

        $this->db->where('idcr_complainmode', $this->input->post('idcrcomplaintmode'));
        $getcompmodename = $_POST['name'];
        $this->db->set('ModeName', $getcompmodename);
        $complaintmodeupdate = $this->db->update('cr_complainmode');
        if ($complaintmodeupdate) {
            return "Successfully Updated";
        }
    }

    public function methodgetcmplntmodelist() {

        $this->db->select('*');
        $this->db->from('cr_complainmode');
        $compmodelist = $this->db->get();
        $compmodelist->result_array();
        return $compmodelist;
    }

    public function methodgetcomplaintmodesandcategory() {

        $this->db->select('*');
        $this->db->from('viewcompmodeandcategory');
        $compmodelist = $this->db->get();
        $compmodelist->result_array();
        return $compmodelist;
    }

    public function doaddcomplaintrel() {

        $getcomprelname = $_POST['name'];
        $this->db->set('Name', $getcomprelname);
        $complaintreldded = $this->db->insert('cr_complainrelation');
        if ($complaintreldded) {
            return "Successfully Inserted";
        }
    }

    public function doupdatecomplaintrel() {

        $this->db->where('idcr_complainrelation', $this->input->post('idcrrelation'));
        $getrelname = $_POST['name'];
        $this->db->set('Name', $getrelname);
        $relUpdated = $this->db->update('cr_complainrelation');
        if ($relUpdated) {
            return "Successfully Updated";
        }
    }

    public function methodgetcmplntrellist() {

        $this->db->select('idcr_complainrelation,Name');
        $this->db->from('cr_complainrelation');
        $comprellist = $this->db->get();
        $comprellist->result_array();
        return $comprellist;
    }

    public function doaddfaqs() {

        $getquestion = $_POST['question'];
        $getanswer = $_POST['answer'];
        $getdate = $_POST['FDate'];
        $gettime = $_POST['FTime'];
        $this->db->set('Question', $getquestion);
        $this->db->set('Answer', $getanswer);
        $this->db->set('Date', $getdate);
        $this->db->set('Time', $gettime);
        $faqsadded = $this->db->insert('cr_faq');
        if ($faqsadded) {
            return "Successfully Inserted";
        }
    }

    public function methodgetfaqslist() {

        $this->db->select('Question,Answer');
        $this->db->from('cr_faq');
        $faqslist = $this->db->get();
        $faqslist->result_array();
        return $faqslist;
    }

    public function methodgetquestionsanswers() {

        if (!empty($_POST['question'])) {

            $question = $_POST['question'];

            $this->db->select('Question,Answer,Date,Time');
            $this->db->from('cr_faq');
            $this->db->like('Question', $question);
            $this->db->order_by("Date", "desc");
            $faqslist = $this->db->get();
            $faqslist->result_array();
            return $faqslist;
        } else {

            $this->db->select('Question,Answer');
            $this->db->from('cr_faq');
            $faqslist = $this->db->get();
            $faqslist->result_array();
            return $faqslist;
        }
    }

    public function doaddcomplaintresptime() {

        if (!empty($_POST['getcompstatus'])) {

            $getcompstatus = $_POST['getcompstatus'];
            if ($getcompstatus == 1) {
                $getcompstatus = 1;
            } else {
                $getcompstatus = 0;
            }
        } else {
            $getcompstatus = null;
        }

        if (!empty($_POST['getinquirystatus'])) {

            $getinquirystatus = $_POST['getinquirystatus'];
            if ($getinquirystatus == 1) {
                $getinquirystatus = 1;
            } else {
                $getinquirystatus = 0;
            }
        } else {
            $getinquirystatus = null;
        }

        if (!empty($_POST['idcrmode'])) {
            $getidmode = $_POST['idcrmode'];
        } else {
            $getidmode = null;
        }

        if (!empty($_POST['targettimedays'])) {

            $gettargettimedays = $_POST['targettimedays'];
            echo $gettargettimedays;
        } else {
            $gettargettimedays = 0;
        }

        if (!empty($_POST['targettimehours'])) {

            $gettargettimehours = $_POST['targettimehours'];
            echo $gettargettimehours;
        } else {
            $gettargettimehours = 0;
        }

        $this->db->set('isSerious', $getcompstatus);
        $this->db->set('isFcr', $getinquirystatus);
        $this->db->set('idcr_mode', $getidmode);
        $this->db->set('Timeindays', $gettargettimedays);
        $this->db->set('Timeinhours', $gettargettimehours);

        $comprestimeadded = $this->db->insert('cr_targettime');
        if ($comprestimeadded) {
            return "Successfully Inserted";
        }
    }

    public function doadddetailrules() {

        $createddate = date("Y-m-d H:i:s");

        if (!empty($_POST['idcrcomplainrelation'])) {

            $idrelation = $_POST['idcrcomplainrelation'];
        } else {
            $idrelation = "";
        }
        if (!empty($_POST['contactcode'])) {

            $contactcode = $_POST['contactcode'];
        } else {
            $contactcode = "";
        }
        if (!empty($_POST['contactdescription'])) {

            $contactdescription = $_POST['contactdescription'];
        } else {
            $contactdescription = "";
        }

        $this->db->set('ContactDetailsDescription', $contactdescription);
        $this->db->set('ContactDetailsCode', $contactcode);
        $this->db->set('idcr_complainrelation', $idrelation);
        $this->db->set('CreatedDate', $createddate);

        $contactdetailadded = $this->db->insert('cr_contactdetaildescription');
        if ($contactdetailadded) {
            return "Successfully Inserted";
        }
    }

    public function doaddprocessrules() {

        $createddate = date("Y-m-d H:i:s");

        if (!empty($_POST['processcode'])) {

            $processcode = $_POST['processcode'];
        } else {
            $processcode = "";
        }
        if (!empty($_POST['processdescription'])) {

            $processdescription = $_POST['processdescription'];
        } else {
            $processdescription = "";
        }
        if (!empty($_POST['idcrcomplainrelation'])) {

            $processrelation = $_POST['idcrcomplainrelation'];
        } else {
            $processrelation = "";
        }
        if (!empty($_POST['idcrcontactdetaildescription'])) {

            $detaildescription = $_POST['idcrcontactdetaildescription'];
        } else {
            $detaildescription = "";
        }
        $this->db->set('SaleProcessDescription', $processdescription);
        $this->db->set('SaleProcessCode', $processcode);
        $this->db->set('idcr_contactdetaildescription', $detaildescription);
        $this->db->set('idcr_complainrelation', $processrelation);
        $this->db->set('CreatedDate', $createddate);

        $processadded = $this->db->insert('cr_saleprocessdescription');
        if ($processadded) {
            return "Successfully Inserted";
        }
    }

    public function doaddsubprocessrules() {

        $createddate = date("Y-m-d H:i:s");

        if (!empty($_POST['subprocesscode'])) {

            $subprocesscode = $_POST['subprocesscode'];
        } else {
            $subprocesscode = "";
        }

        if (!empty($_POST['subprocessdescription'])) {

            $subprocessdescription = $_POST['subprocessdescription'];
        } else {
            $subprocessdescription = "";
        }

        if (!empty($_POST['idcrsaleprocessdescription'])) {

            $processid = $_POST['idcrsaleprocessdescription'];
        } else {
            $processid = "";
        }

        $this->db->set('SaleSubProcessDescription', $subprocessdescription);
        $this->db->set('SaleSubProcessCode', $subprocesscode);
        $this->db->set('idcr_saleprocessdescription', $processid);
        $this->db->set('CreatedDate', $createddate);

        $subprocessadded = $this->db->insert('cr_salesubprocessdescription');
        if ($subprocessadded) {
            return "Successfully Inserted";
        }
    }

    public function doupdatedetailrules() {

        if (!empty($_POST['idcontactcode'])) {

            $idcontact = $_POST['idcontactcode'];
        } else {
            $idcontact = null;
        }

        if (!empty($_POST['contactcode'])) {

            $contactcode = $_POST['contactcode'];
        } else {
            $contactcode = null;
        }

        if (!empty($_POST['contactdescription'])) {

            $contactdesc = $_POST['contactdescription'];
        } else {
            $contactdesc = null;
        }
        $relatedTo = $_POST['uidcrcomplainrelation'];
        $this->db->set('idcr_complainrelation', $relatedTo);
        $this->db->set('ContactDetailsDescription', $contactdesc);
        $this->db->set('ContactDetailsCode', $contactcode);
        $this->db->where('idcr_contactdetaildescription', $idcontact);

        $contactupdated = $this->db->update('cr_contactdetaildescription');
        if ($contactupdated) {
            return "Successfully Updated";
        }
    }

    public function doupdateprocessrules() {

        if (!empty($_POST['idprocess'])) {

            $idcontact = $_POST['idprocess'];
        } else {
            $idcontact = null;
        }

        if (!empty($_POST['processcode'])) {

            $contactcode = $_POST['processcode'];
        } else {
            $contactcode = null;
        }

        if (!empty($_POST['processdescription'])) {

            $contactdesc = $_POST['processdescription'];
        } else {
            $contactdesc = null;
        }
        $relatedTo = $_POST['uidcrcomplainrelation'];
        $detailTo = $_POST['uidcrcontactdetaildescription'];

        $this->db->set('idcr_complainrelation', $relatedTo);
        $this->db->set('idcr_contactdetaildescription', $detailTo);
        $this->db->where('idcr_saleprocessdescription', $idcontact);
        $this->db->set('SaleProcessDescription', $contactdesc);
        $this->db->set('SaleProcessCode', $contactcode);
        $contactupdated = $this->db->update('cr_saleprocessdescription');
        if ($contactupdated) {
            return "Successfully Updated";
        }
    }

    public function doupdatesubprocessrules() {

        if (!empty($_POST['idsubprocess'])) {

            $idcontact = $_POST['idsubprocess'];
        } else {
            $idcontact = null;
        }

        if (!empty($_POST['subprocesscode'])) {

            $contactcode = $_POST['subprocesscode'];
        } else {
            $contactcode = null;
        }

        if (!empty($_POST['subprocessdescription'])) {

            $contactdesc = $_POST['subprocessdescription'];
        } else {
            $contactdesc = null;
        }

        $processid = $_POST['uidcrsaleprocessdescription'];

        $this->db->set('idcr_saleprocessdescription', $processid);
        $this->db->set('SaleSubProcessCode', $contactcode);
        $this->db->where('idcr_salesubprocessdescription', $idcontact);

        $subprocessupdated = $this->db->update('cr_salesubprocessdescription');
        if ($subprocessupdated) {
            return "Successfully Updated";
        }
    }

    public function doupdatecomplaintresponsetime_() {

        $this->db->where('idcr_targettime', $this->input->post('uidcrmode'));
        $offMode = $_POST['offmode'];
        $getdDay = $_POST['utargettimedays'];
        $getHour = $_POST['utargettimehours'];
        if ($offMode == "Complaint") {
            $compStatus = $_POST['ugetcompstatus'];
            if ($compStatus == "1") {
                $compStatus = 1;
            } else {
                $compStatus = 0;
            }
            $this->db->set('Timeindays', $getdDay);
            $this->db->set('Timeinhours', $getHour);
            $this->db->set('isSerious', $compStatus);
            $comprestimeupdated = $this->db->update('cr_targettime');
            if ($comprestimeupdated) {
                return "Successfully Updated";
            }
        } else {
            if ($offMode == "Inquiry") {
                $inquiryStatus = $_POST['ugetinquirystatus'];
                if ($inquiryStatus == "1") {
                    $inquiryStatus = 1;
                } else {
                    $inquiryStatus = 0;
                }
                $this->db->set('Timeindays', $getdDay);
                $this->db->set('Timeinhours', $getHour);
                $this->db->set('isFcr', $inquiryStatus);
                $comprestimeupdated = $this->db->update('cr_targettime');
                if ($comprestimeupdated) {
                    return "Successfully Updated";
                }
            }
        }
    }

    public function methodgetcomplaintresptime() {

        $this->db->select('*');
        $this->db->from('viewcompresolutiontime');
        $restimelist = $this->db->get();
        $restimelist->result_array();
        return $restimelist;
    }

    public function dosharecomplaint() {
        
    }

    public function doupdatecomplaintform() {

        $whereInquiry = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereInquiry);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $inquirynumber = $_POST['padnumber'];
        $idCrRoute = $_POST['idcrroute'];
        $idComplaintMode = $_POST['idcrcomplainmode'];
        $idComplaintCategory = $_POST['idcrcompmodectgry'];
        $idRelatedTo = $_POST['idcrcomplainrelation'];
        $idUsersSkills = $_POST['idcruserskills'];
        $regdate = $_POST['regdate'];
        $voc = $_POST['voiceofcustomer'];
        $customerrequest = $_POST['customerrequest'];
        $actiontaken = $_POST['actiontaken'];
        $kaizentaken = $_POST['kaizentaken'];

        $this->db->set('idcr_route', $idCrRoute);
        $this->db->set('idcr_complainmode', $idComplaintMode);
        $this->db->set('idcr_complaintmodecategories', $idComplaintCategory);
        $this->db->set('idcr_complainrelation', $idRelatedTo);
        $this->db->set('RegisterDate', $regdate);
        $this->db->set('idcr_userskills', $idUsersSkills);
        $this->db->set('VoiceOfCustomer', $voc);
        $this->db->set('CustomerRequest', $customerrequest);
        $this->db->set('ActionTakenDescription', $actiontaken);
        $this->db->set('KaizenDescription', $kaizentaken);
        $this->db->set('isUpdate', 1);
        $this->db->where('PadNumber', $inquirynumber);
        $this->db->where('idcr_mode', $modeid);
        $update = $this->db->update('cr_complain');
        if ($update) {
            return "Successfully Updated";
        }
    }

    public function doupdateinquiryform() {

        $whereInquiry = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereInquiry);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $inquirynumber = $_POST['padnumber'];
        $idCrRoute = $_POST['idcrroute'];
        $idRelatedTo = $_POST['idcrcomplainrelation'];
        $idUserSkills = $_POST['idcruserskills'];
        $regdate = $_POST['regdate'];
        $voc = $_POST['voiceofcustomer'];
        $replyaction = $_POST['replyaction'];
        $kaizentaken = $_POST['kaizentaken'];
        $respondTo = $_POST['respondto'];
        $startTime = $_POST['starttime'];
        $endTime = $_POST['endtime'];
        $callDuration = $_POST['calldurationtime'];
        $FeedBack = $_POST['FeedBack'];
        $Remarks = $_POST['Remarks'];

        $this->db->set('idcr_route', $idCrRoute);
        $this->db->set('idcr_complainrelation', $idRelatedTo);
        $this->db->set('RegisterDate', $regdate);
        $this->db->set('idcr_userskills', $idUserSkills);
        $this->db->set('VoiceOfCustomer', $voc);
        $this->db->set('ActionTakenDescription', $replyaction);
        $this->db->set('KaizenDescription', $kaizentaken);
        $this->db->set('DepartmentFeedback', $respondTo);
        $this->db->set('CallStartTime', $startTime);
        $this->db->set('CallEndTime', $endTime);
        $this->db->set('CallDurationTime', $callDuration);
        $this->db->set('Remarks', $Remarks);
        $this->db->set('InquiryPotential', $FeedBack);
        $this->db->set('isUpdate', 1);
        $this->db->where('PadNumber', $inquirynumber);
        $this->db->where('idcr_mode', $modeid);
        $update = $this->db->update('cr_complain');
        if ($update) {
            return "Successfully Updated";
        }
    }

    public function doupdatecomplaint() {
        $updatecomplaint = array(
            'ActionTakenDescription' => $title,
            'KaizenDescription' => $name
        );

        $this->db->where('id', $id);
        $this->db->update('mytable', $updatecomplaint);
    }

    public function methodgetexistcustomerdata() {
        $this->db->select('Mode');
        $this->db->from('viewcompresolutiontime');
        $result = $this->db->get();
        $result->result_array();
        return $result;
    }

    public function doupdatecomplaintataken() {

        $voccreatedate = date("Y-m-d H:i:s");

        $whereInquiry = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereInquiry);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $updatecomplaint = array(
            'PadNumber' => $_POST['rpadnumber'],
            'ActionTakenDescription' => $_POST['actiontakendescription'],
            'KaizenTakenDescription' => $_POST['kaizendescription'],
            'ClosingDate' => $_POST['closingdate'],
        );

        $this->db->set('DateFeedBack', $voccreatedate);
        $this->db->where('idcr_complain', $this->input->post('idcrcomplain'));
        $result = $this->db->update('cr_sharing');

        if (!empty($_POST['isinfofile'])) {

            $infofile = 1;
        } else {
            $infofile = 0;
        }

        if (!empty($_POST['isfaqs'])) {

            $isfaqs = 1;
        } else {
            $isfaqs = 0;
        }

        if (!empty($_POST['isreqtraining'])) {

            $isreq = 1;
        } else {
            $isreq = 0;
        }

        if (!empty($_POST['isupdatevoc'])) {

            $isupdatevoc = 1;
        } else {
            $isupdatevoc = 0;
        }

        if (!empty($_POST['contactdetaildescription'])) {

            $iscontactdetailexist = $_POST['contactdetaildescription'];
        } else {
            $iscontactdetailexist = null;
        }

        $complaintnum = $updatecomplaint['PadNumber'];

        $this->db->set('idcr_complain', $this->input->post('idcrcomplain'));
        $this->db->set('idcr_complainrelation', $this->input->post('idcrcomplainrelation'));
        $this->db->set('idcr_contactdetaildescription', $iscontactdetailexist);
        $this->db->set('idcr_saleprocessdescription', $this->input->post('saleprocessdescription'));
        $this->db->set('idcr_salesubprocessdescription', $this->input->post('salesubprocessdescription'));
        $this->db->set('CreatedDate', $voccreatedate);
        $this->db->set('IsDeleted', 0);

        $insertvoc = $this->db->insert('cr_voc');

        $where = "PadNumber = '$complaintnum'";

        $this->db->select('ActionTakenDescription,KaizenDescription,isActionTaken,isKaizenTaken,idcr_complainstatus');
        $this->db->from('cr_complain');
        $this->db->where($where);
        $complaintdata = $this->db->get();

        if ($complaintdata->num_rows() > 0) {
            $row = $complaintdata->row();
            $actiondescription = $row->ActionTakenDescription;
            $kizendescription = $row->KaizenDescription;
            $isactiontaken = $row->isActionTaken;
            $iskaizentaken = $row->isKaizenTaken;
            $isclose = $row->idcr_complainstatus;
        } else {
            
        }

        if ($isactiontaken == 1) {

            if ($updatecomplaint['ActionTakenDescription'] == null) {
                
            } else {

                $this->db->set('ActionTakenDescription', $updatecomplaint['ActionTakenDescription']);
                $this->db->where('PadNumber', $complaintnum);
                $this->db->where('idcr_mode', $modeid);
                $result = $this->db->update('cr_complain');
            }
        } else {

            if ($updatecomplaint['ActionTakenDescription'] == null) {
                
            } else {

                $this->db->set('ActionTakenDescription', $updatecomplaint['ActionTakenDescription']);
                $this->db->set('isActionTaken', 1);
                $this->db->where('PadNumber', $complaintnum);
                $this->db->where('idcr_mode', $modeid);

                $result = $this->db->update('cr_complain');
            }
        }

        if ($iskaizentaken == 1) {

            if ($updatecomplaint['KaizenTakenDescription'] == null) {
                
            } else {

                $this->db->set('KaizenDescription', $updatecomplaint['KaizenTakenDescription']);
                $this->db->where('PadNumber', $complaintnum);
                $this->db->where('idcr_mode', $modeid);

                $result = $this->db->update('cr_complain');
            }
        } else {

            if ($updatecomplaint['KaizenTakenDescription'] == null) {
                
            } else {

                $this->db->set('KaizenDescription', $updatecomplaint['KaizenTakenDescription']);
                $this->db->set('isKaizenTaken', 1);
                $this->db->where('PadNumber', $complaintnum);
                $this->db->where('idcr_mode', $modeid);

                $result = $this->db->update('cr_complain');
            }
        }

        if (!empty($_POST['isclose'])) {

            $this->db->select('idcr_complainstatus');
            $this->db->from('cr_complainstatus');
            $this->db->where('Name', 'Close');
            $this->db->limit(1);
            $idClose = $this->db->get();
            if ($idClose->num_rows() > 0) {
                $row = $idClose->row();
                $idClose = $row->idcr_complainstatus;
            }

            $complaintclosingdatetime = $updatecomplaint['ClosingDate'];
            $closingtime = date("H:i:s", strtotime($complaintclosingdatetime));
            $closingdate = date("Y-m-d", strtotime($complaintclosingdatetime));

            $this->db->set('idcr_complainstatus', $idClose);
            $this->db->set('ClosingDate', $closingdate);
            $this->db->set('ClosingTime', $closingtime);
            $this->db->set('isInformationFile', $infofile);
            $this->db->set('isFaqs', $isfaqs);
            $this->db->set('isRequiredTraining', $isreq);
            $this->db->set('isUpdateVoc', $isupdatevoc);
            $this->db->where('PadNumber', $complaintnum);
            $this->db->where('idcr_mode', $modeid);

            $result = $this->db->update('cr_complain');
        } else {

            $this->db->select('idcr_complainstatus');
            $this->db->from('cr_complainstatus');
            $this->db->where('Name', 'Pending');
            $this->db->limit(1);
            $idClose = $this->db->get();
            if ($idClose->num_rows() > 0) {
                $row = $idClose->row();
                $idClose = $row->idcr_complainstatus;
            }
            $this->db->set('idcr_complainstatus', $idClose);
            $this->db->set('isInformationFile', $infofile);
            $this->db->set('isFaqs', $isfaqs);
            $this->db->set('isRequiredTraining', $isreq);
            $this->db->set('isUpdateVoc', $isupdatevoc);
            $this->db->where('PadNumber', $complaintnum);
            $this->db->where('idcr_mode', $modeid);

            $result = $this->db->update('cr_complain');
        }
        return "Action Has Been Taken Successfully";
    }

    public function doupdatereplyaction() {

        $voccreatedate = date("Y-m-d H:i:s");

        $whereInquiry = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereInquiry);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $updatecomplaint = array(
            'PadNumber' => $_POST['ripadnumber'],
            'ActionTakenDescription' => $_POST['actiontakendescription'],
            'Remarks' =>  $_POST['Remarks'],
            'InquiryPotential' =>  $_POST['InquiryPotential'],
            'KaizenTakenDescription' => $_POST['kaizendescription'],
            'ClosingDate' => $_POST['closingdate'],
        );

        if (!empty($_POST['isinfofile'])) {

            $infofile = 1;
        } else {
            $infofile = 0;
        }

        if (!empty($_POST['isfaqs'])) {

            $isfaqs = 1;
        } else {
            $isfaqs = 0;
        }

        if (!empty($_POST['isreqtraining'])) {

            $isreq = 1;
        } else {
            $isreq = 0;
        }

        if (!empty($_POST['isupdatevoc'])) {

            $isupdatevoc = 1;
        } else {
            $isupdatevoc = 0;
        }

        $complaintnum = $updatecomplaint['PadNumber'];

        $this->db->set('idcr_complain', $this->input->post('idcrcomplain'));
        $this->db->set('idcr_complainrelation', $this->input->post('idcrcomplainrelation'));
        $this->db->set('idcr_contactdetaildescription', $this->input->post('contactdetaildescription'));
        $this->db->set('idcr_saleprocessdescription', $this->input->post('saleprocessdescription'));
        $this->db->set('idcr_salesubprocessdescription', $this->input->post('salesubprocessdescription'));
        $this->db->set('CreatedDate', $voccreatedate);
        $this->db->set('IsDeleted', 0);

        $insertvoc = $this->db->insert('cr_voc');

        $where = "PadNumber = '$complaintnum'";

        $this->db->select('ActionTakenDescription,KaizenDescription,isActionTaken,isKaizenTaken,idcr_complainstatus');
        $this->db->from('cr_complain');
        $this->db->where($where);
        $complaintdata = $this->db->get();

        if ($complaintdata->num_rows() > 0) {
            $row = $complaintdata->row();
            $actiondescription = $row->ActionTakenDescription;
            $kizendescription = $row->KaizenDescription;
            $isactiontaken = $row->isActionTaken;
            $iskaizentaken = $row->isKaizenTaken;
            $isclose = $row->idcr_complainstatus;
        } else {
            
        }

        if ($isactiontaken == 1) {

            if ($updatecomplaint['ActionTakenDescription'] == null) {
                
            } else {

                $this->db->set('ActionTakenDescription', $updatecomplaint['ActionTakenDescription']);
                $this->db->set('Remarks', $updatecomplaint['Remarks']);
                $this->db->set('InquiryPotential', $updatecomplaint['InquiryPotential']);
                $this->db->where('PadNumber', $complaintnum);
                $this->db->where('idcr_mode', $modeid);

                $result = $this->db->update('cr_complain');
            }
        } else {

            if ($updatecomplaint['ActionTakenDescription'] == null) {
                
            } else {


                $this->db->set('ActionTakenDescription', $updatecomplaint['ActionTakenDescription']);
                $this->db->set('Remarks', $updatecomplaint['Remarks']);
                $this->db->set('InquiryPotential', $updatecomplaint['InquiryPotential']);
                $this->db->set('isActionTaken', 1);
                $this->db->where('PadNumber', $complaintnum);
                $this->db->where('idcr_mode', $modeid);

                $result = $this->db->update('cr_complain');
            }
        }

        if ($iskaizentaken == 1) {

            if ($updatecomplaint['KaizenTakenDescription'] == null) {
                
            } else {

                $this->db->set('KaizenDescription', $updatecomplaint['KaizenTakenDescription']);
                $this->db->where('PadNumber', $complaintnum);
                $this->db->where('idcr_mode', $modeid);

                $result = $this->db->update('cr_complain');
            }
        } else {

            if ($updatecomplaint['KaizenTakenDescription'] == null) {
                
            } else {

                $this->db->set('KaizenDescription', $updatecomplaint['KaizenTakenDescription']);
                $this->db->set('isKaizenTaken', 1);
                $this->db->where('PadNumber', $complaintnum);
                $this->db->where('idcr_mode', $modeid);

                $result = $this->db->update('cr_complain');
            }
        }

        if (!empty($_POST['isclose'])) {

            $this->db->select('idcr_complainstatus');
            $this->db->from('cr_complainstatus');
            $this->db->where('Name', 'Close');
            $this->db->limit(1);
            $idClose = $this->db->get();
            if ($idClose->num_rows() > 0) {
                $row = $idClose->row();
                $idClose = $row->idcr_complainstatus;
            }

            $inquiryclosingdatetime = $updatecomplaint['ClosingDate'];
            $closingtime = date("H:i:s", strtotime($inquiryclosingdatetime));
            $closingdate = date("Y-m-d", strtotime($inquiryclosingdatetime));
$closing_satisfy_status=$this->input->post('closing_satisfy_status');
            
            $this->db->set('idcr_complainstatus', $idClose);
            $this->db->set('ClosingDate', $closingdate);
            $this->db->set('ClosingTime', $closingtime);
            $this->db->set('isInformationFile', $infofile);
            $this->db->set('isFaqs', $isfaqs);
            $this->db->set('closing_satisfy_status', $closing_satisfy_status);
            $this->db->set('isRequiredTraining', $isreq);
            $this->db->set('isUpdateVoc', $isupdatevoc);
            $this->db->where('PadNumber', $complaintnum);
            $this->db->where('idcr_mode', $modeid);

            $result = $this->db->update('cr_complain');
        } else {

            $this->db->select('idcr_complainstatus');
            $this->db->from('cr_complainstatus');
            $this->db->where('Name', 'Pending');
            $this->db->limit(1);
            $idClose = $this->db->get();
            if ($idClose->num_rows() > 0) {
                $row = $idClose->row();
                $idClose = $row->idcr_complainstatus;
            }

            $this->db->set('idcr_complainstatus', $idClose);
            $this->db->set('isInformationFile', $infofile);
            $this->db->set('isFaqs', $isfaqs);
            $this->db->set('isRequiredTraining', $isreq);
            $this->db->set('isUpdateVoc', $isupdatevoc);
            $this->db->where('PadNumber', $complaintnum);
            $this->db->where('idcr_mode', $modeid);

            $result = $this->db->update('cr_complain');
        }
        return "Reply Action Has Been Taken Successfully";
    }

    public function doupdatecomplaintktaken() {

        $updatecomplaint = array(
            'PadNumber' => $_POST['padnumber'],
            'KizenTakenDescription' => $_POST['kaizendescription']
        );

        $this->db->where('PadNumber', $updatecomplaint['PadNumber']);
        $this->db->set('KaizenDescription', $updatecomplaint['KizenTakenDescription']);
        $this->db->set('isKaizenTaken', 1);
        $result = $this->db->update('cr_complain');
        return $result;
    }

    public function doupdatecomplaintfeedback() {
        $data = unserialize($_COOKIE['logindata']);
        if (!empty($_POST['compid'])) {

            $idcomplaint = $_POST['compid'];

            if (!empty($_POST['compfeedback'])) {

                $feedback = $_POST['compfeedback'];
            } else {
                $feedback = "null";
            }

            $iduserprofile = $data['userid'];

            $this->db->set('FeedBack', $feedback);
            $this->db->where('idcr_complain', $idcomplaint);
      //     $this->db->where('idcar_userprofile', $iduserprofile);

            $givecompfbk = $this->db->update('cr_sharing');
            if ($givecompfbk) {
                return "Feedback Has Been Given Successfully";
            } else {
                return "Feedback Has Not Been Given Successfully";
            }
        } else {
            
        }
    }

    public function methodgetvehicle() {

        $this->db->select('idcr_vehicle,Name');
        $this->db->from('cr_vehicle');
        $city = $this->db->get();
        $city->result_array();
        return $city;
    }

    public function methodgetroute() {

        $this->db->select('idcr_route,Name');
        $this->db->from('cr_route');
        $route = $this->db->get();
        $route->result_array();
        return $route;
    }

    public function methodgetcomplaintmode() {

        $this->db->select('*');
        $this->db->from('cr_complainmode');
        $complainmode = $this->db->get();
        $complainmode->result_array();
        return $complainmode;
    }

    public function methodgetcompmodecategory() {

        if (!empty($_POST['compmode'])) {

            $idcompmode = $_POST['compmode'];
            $wherecompmode = "idcr_complainmode = '$idcompmode'";
            $this->db->select('*');
            $this->db->from('cr_complaintmodecategories');
            $this->db->where($wherecompmode);
            $complainmode = $this->db->get();
            $complainmode->result_array();
            return $complainmode;
        }
    }

    public function methodgetcomplaintrelation() {

        $where = "Name != 'Others'";

        $this->db->select('idcr_complainrelation,Name');
        $this->db->from('cr_complainrelation');
        $this->db->where($where);
        $complainrelation = $this->db->get();

        $complainrelation->result_array();
        return $complainrelation;
    }

    public function methodgetinquiryrelation() {

        $this->db->select('idcr_complainrelation,Name');
        $this->db->from('cr_complainrelation');
        $complainrelation = $this->db->get();
        $complainrelation->result_array();
        return $complainrelation;
    }

    public function methodgetinquirydepart() {

        $this->db->select('idcr_complainrelation,Name');
        $this->db->from('cr_complainrelation');
        $complainrelation = $this->db->get();
        $complainrelation->result_array();
        return $complainrelation;
    }

    public function methodgetcomplainstatus() {

        $this->db->select('idcr_complainstatus,Name');
        $this->db->from('cr_complainstatus');
        $complainstatus = $this->db->get();
        $complainstatus->result_array();
        return $complainstatus;
    }

    public function methodgetuserskills() {

        $this->db->select('idcr_userskills,Name');
        $this->db->from('cr_userskills');
        $userskills = $this->db->get();
        $userskills->result_array();
        return $userskills;
    }

    public function methodgetapproles() {

        $this->db->select('RoleId,RoleName,IsAdmin');
        $this->db->from('car_app_role');
        $approles = $this->db->get();
        $approles->result_array();
        return $approles;
    }

    public function methodgetvariants() {

        $this->db->select('*');
        $this->db->from('car_variants');
    //  $this->db->where('isActive', 1);
        $variants = $this->db->get();
        $variants->result_array();
        return $variants;
    }

    public function methodgetexistingcustomer() {

        $getsearchby = $_POST['searchby'];
        $getsearchnow = $_POST['searchnow'];

        if ($getsearchby == "Contact Number") {
            if ($getsearchnow != Null) {
                $where = "PhoneNumber = '$getsearchnow' OR MobileNumber = '$getsearchnow'";
                $this->db->select('*');
                $this->db->from('viewcrcustomercompleteinfo');
                $this->db->where($where);
                $customer = $this->db->get();

                $this->db->select('*');
                $this->db->from('viewcrcustomervehicle');
                $this->db->where($where);
                $crcustomer = $this->db->get();

                $this->db->select('*');
                $this->db->from('s_vehicle veh');
                $this->db->join('s_allvehicles allveh', 'allveh.idAllVehicles = veh.idVariant', 'left');
                $this->db->join('s_cutomerdetail customer', 'customer.idCustomer = veh.idCustomer', 'left');
                $this->db->join('s_repairorderbill r', 'r.idCustomerDetail = customer.idCustomer', 'left');
                $this->db->join('s_ro_workperformed w', 'w.idRepairOrderBill = r.idRepairOrderBill', 'left');
                $this->db->like('customer.Cellphone', $getsearchnow);
                $this->db->or_like('customer.PhoneOne', $getsearchnow);
                $this->db->or_like('customer.PhoneTwo', $getsearchnow);
                $this->db->or_like('customer.CompanyContact', $getsearchnow);
                $this->db->distinct();
                $serviceCustomer = $this->db->get();
              //  return $serviceCustomer ;
            }
        } else if ($getsearchby == "Chassis Number") {
            if ($getsearchnow != Null) {
                $wherechassis = "ChassisNumber = '$getsearchnow'";
                $this->db->select('*');
                $this->db->from('viewcrcustomercompleteinfo');
                $this->db->where($wherechassis);
                $customer = $this->db->get();

                $this->db->select('*');
                $this->db->from('viewcrcustomervehicle');
                $this->db->where($wherechassis);
                $crcustomer = $this->db->get();

                $this->db->select('*');
                $this->db->from('s_vehicle veh');
                $this->db->join('s_allvehicles allveh', 'allveh.idAllVehicles = veh.idVariant', 'left');
                $this->db->join('s_cutomerdetail customer', 'customer.idCustomer = veh.idCustomer', 'left');
                $this->db->join('s_repairorderbill r', 'r.idCustomerDetail = customer.idCustomer', 'left');
                $this->db->join('s_ro_workperformed w', 'w.idRepairOrderBill = r.idRepairOrderBill', 'left');
                $this->db->like('veh.ChassisNumber', $getsearchby, 'after');
                $this->db->distinct();
                $serviceCustomer = $this->db->get();
            } else {
                
            }
        } else if ($getsearchby == "Registration Number") {
            if ($getsearchnow != Null) {
                $whereRegNumber = "RegistrationNumber = '$getsearchnow'";
                $this->db->select('*');
                $this->db->from('viewcrcustomercompleteinfo');
                $this->db->where($whereRegNumber);
                $customer = $this->db->get();

                $this->db->select('*');
                $this->db->from('viewcrcustomervehicle');
                $this->db->where($whereRegNumber);
                $crcustomer = $this->db->get();

                $this->db->select('*');
                $this->db->from('s_vehicle veh');
                $this->db->join('s_allvehicles allveh', 'allveh.idAllVehicles = veh.idVariant', 'left');
                $this->db->join('s_cutomerdetail customer', 'customer.idCustomer = veh.idCustomer', 'left');
                $this->db->join('s_repairorderbill r', 'r.idCustomerDetail = customer.idCustomer', 'left');
                $this->db->join('s_ro_workperformed w', 'w.idRepairOrderBill = r.idRepairOrderBill', 'left');
                $this->db->like('veh.RegistrationNumber', $getsearchby, 'after');
                $this->db->distinct();
                $serviceCustomer = $this->db->get();
            } else {
                
            }
        }

        $resultarray['customer'] = $customer->result_array();
        $resultarray['crcustomer'] = $crcustomer->result_array();
        $resultarray['serviceCustomer'] = $serviceCustomer->result_array();
        return $resultarray;
    }

    function searchisExistCustomer($searchKeyword) {
        
    }

    public function methodgetallcomplaints() {

        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }


        $where = "ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $allcomplaints = $this->db->get();
        $allcomplaints->result_array();
        return $allcomplaints;
    }

    public function methodsearchallcomplaints() {


        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $getsearchbypadnum = $_POST['padnumber'];

        if ($getsearchbypadnum != Null) {

            $wherepadnum = "ComplaintPadNumber = '$getsearchbypadnum' AND ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";
            $this->db->select('*');
            $this->db->from('viewcrallcomplaints');
            $this->db->where($wherepadnum);
            $allcomplaints = $this->db->get();
            return $allcomplaints->result_array();
        } else {

            $where = "ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";
            $this->db->select('*');
            $this->db->from('viewcrallcomplaints');
            $this->db->where($where);
            $allcomplaints = $this->db->get();
            return $allcomplaints->result_array();
        }
    }

    public function methodcomplaintsformessage() {
        $data = unserialize($_COOKIE['logindata']);
        $whereComplaint = "Name = 'Complaint'";
        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $iduserprofile = $data['userid'];
        $where = "idUserProfile = '$iduserprofile' AND idcr_mode = '$modeid' AND FeedBack = '-'";

        $this->db->select('*');
        $this->db->from('viewcomplainshare');
        $this->db->where($where);
        $allcomplaints = $this->db->get();
        $allcomplaints->result_array();
        return $allcomplaints;
    }

    public function methodgetfilteredcomplaintmessage() {

        $data = unserialize($_COOKIE['logindata']);
        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $iduserprofile = $data['userid'];
        $getsearchbypadnum = $_POST['padnumber'];

        if ($getsearchbypadnum != null) {

            $wherepadnum = "idUserProfile = '$iduserprofile' AND ComplaintPadNumber = '$getsearchbypadnum' AND idcr_mode = '$modeid' AND FeedBack = '-'";
            $this->db->select('*');
            $this->db->from('viewcomplainshare');
            $this->db->where($wherepadnum);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        } else {

            $where = "idUserProfile = '$iduserprofile' AND idcr_mode = '$modeid' AND FeedBack = '-'";

            $this->db->select('*');
            $this->db->from('viewcomplainshare');
            $this->db->where($where);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        }
    }

    public function methodinquiriesformessage() {

        $data = unserialize($_COOKIE['logindata']);

        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $iduserprofile = $data['userid'];


        $where = "idUserProfile = '$iduserprofile' AND idcr_mode = '$modeid' AND FeedBack = '-'";

        $this->db->select('*');
        $this->db->from('viewcomplainshare');
        $this->db->where($where);
        $allcomplaints = $this->db->get();
        $allcomplaints->result_array();
        return $allcomplaints;
    }

    public function methodgetfilteredinquirymessage() {

        $data = unserialize($_COOKIE['logindata']);

        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $iduserprofile = $data['userid'];
        $getsearchbypadnum = $_POST['padnumber'];

        if ($getsearchbypadnum != null) {

            $wherepadnum = "idUserProfile = '$iduserprofile' AND ComplaintPadNumber = '$getsearchbypadnum' AND idcr_mode = '$modeid' AND FeedBack = '-'";

            $this->db->select('*');
            $this->db->from('viewcomplainshare');
            $this->db->where($wherepadnum);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        } else {

            $where = "idUserProfile = '$iduserprofile' AND idcr_mode = '$modeid' AND FeedBack = '-'";
            $this->db->select('*');
            $this->db->from('viewcomplainshare');
            $this->db->where($where);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        }
    }

    public function methodcountcomplaintsformessage() {
        $data = unserialize($_COOKIE['logindata']);
        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $iduserprofile = $data['userid'];
        $where = "idUserProfile = '$iduserprofile' AND idcr_mode = '$modeid' AND FeedBack = '-'";

        $this->db->select('count(*) as count');
        $this->db->from('viewcomplainshare');
        $this->db->where($where);
        $allcomplaints = $this->db->get();

        if ($allcomplaints->num_rows() > 0) {
            $row = $allcomplaints->row();
            return $modeid = $row->count;
        }
    }

    public function methodcountinquiryformessage() {
        $data = unserialize($_COOKIE['logindata']);
        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }
        $iduserprofile = $data['userid'];
        $where = "idUserProfile = '$iduserprofile' AND idcr_mode = '$modeid' AND FeedBack = '-'";

        $this->db->select('count(*) as count');
        $this->db->from('viewcomplainshare');
        $this->db->where($where);
        $allcomplaints = $this->db->get();

        if ($allcomplaints->num_rows() > 0) {
            $row = $allcomplaints->row();
            return $modeid = $row->count;
        }
    }

    public function methodgetallinquiries() {


        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }


        $where = "ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $allinquiries = $this->db->get();
        $allinquiries->result_array();
        return $allinquiries;
    }

    public function methodgetallnonfcrinquiries() {

        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $where = "FCR = 'Non FCR' AND ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $allinquiries = $this->db->get();
        $allinquiries->result_array();
        return $allinquiries;
    }

    public function methodgetallclosecomplaint() {


        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $where = "ComplaintStatus = 'Close' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $allclosecomplaints = $this->db->get();
        $allclosecomplaints->result_array();
        return $allclosecomplaints;
    }

    public function methodgetallcloseinquiriess() {

        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $where = "ComplaintStatus = 'Close' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $allclosecomplaints = $this->db->get();
        $allclosecomplaints->result_array();
        return $allclosecomplaints;
    }

    public function methodgetcontactdetaildescription() {

        if (!empty($_POST['detail'])) {

            $getsearchbyrelation = $_POST['detail'];

            $where = "idcr_complainrelation = '$getsearchbyrelation'";

            $this->db->select('*');
            $this->db->from('cr_contactdetaildescription');
            $this->db->where($where);
            $this->db->order_by("idcr_contactdetaildescription", "asc");
            $this->db->group_by("ContactDetailsDescription");
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        } else {
            
        }
    }

    public function methodgetfilteredprocessdescription() {

        $getsearchcontactdetail = $_POST['process'];
        $where = "idContactDetail = $getsearchcontactdetail";

        $this->db->select('*');
        $this->db->from('viewsaleprocess');
        $this->db->where($where);
        $this->db->order_by("idSaleProcess", "asc");
        $this->db->group_by("idSaleProcess");
        $all = $this->db->get();
        $all->result_array();
        return $all;
//        if (!empty($_POST['process'])) {
//            $getsearchcontactdetail = $_POST['process'];
//
//            echo 'idcontactdetail';
//            echo $getsearchcontactdetail;
//
//            $where = "idContactDetail = $getsearchcontactdetail";
//
//            $this->db->select('*');
//            $this->db->from('viewsaleprocess');
//            $this->db->where($where);
//            $this->db->order_by("idSaleProcess", "asc");
//            $this->db->group_by("idSaleProcess");
//            $all = $this->db->get();
//            $all->result_array();
//            return $all;
//        }
//        } else {
//            if (!empty($_POST['relation'])) {
//
//                $getsearchrelation = $_POST['relation'];
//                $where = "idComplainRelation = $getsearchrelation";
//
//                $this->db->select('*');
//                $this->db->from('viewsaleprocess');
//                $this->db->where($where);
//                $this->db->order_by("idSaleProcess", "asc");
//                $this->db->group_by("idSaleProcess");
//                $all = $this->db->get();
//                $all->result_array();
//                return $all;
//            } else {
//                
//            }
//        }
    }

    public function methodgetfilteredsalesubprocessdescription() {

        if (!empty($_POST['subprocess'])) {

            $searchsubprocess = $_POST['subprocess'];
            $where = "idSaleProcess = '$searchsubprocess' GROUP BY idSaleSubProcess";

            $this->db->select('*');
            $this->db->from('viewsalesubprocess');
            $this->db->where($where);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        } else {
            $searchsubprocess = null;
        }
    }

    public function methodgetfilteredcomplaint() {

        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode,');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->
                    idcr_mode;
        }

        $getsearchbypadnum = $_POST['padnumber'];

        $where = "ComplaintPadNumber = '$getsearchbypadnum' AND ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $this->db->limit(1);
        $allcomplaints = $this->db->get();
        return $allcomplaints->result_array();
    }

    public function methodgetfilteredcomplaintsharing() {
        /*
         * 
         * new logic
         */
//        $resultarray['total'] = $totalciquery->result_array();
//        $resultarray['totalinquiries'] = $totalinquiries->result_array();
//        return $resultarray;
//
//        $totalinquiries = $this->db->query('SELECT
//            vct.ComplaintRelatedTo AS Title,
//            vct.ComplaintRelatedTo,
//            vct.`Mode`,
//            vct.ModeType,
//            count(vct.TotalComplaints) AS Count FROM v_contacttrend vct WHERE' . $whereinquiries . 'limit 3');

        /*
         * old logic
         */

        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode,');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->
                    idcr_mode;
        }

        $getsearchbypadnum = $_POST['padnumber'];
        $idcrcomplain = $_POST['idcomplaints'];

        $where = "ComplaintPadNumber = '$getsearchbypadnum' AND ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $this->db->limit(1);
        $allcomplaints = $this->db->get();

        $whereSharing = "idcomplain = '$idcrcomplain'";

        $this->db->select('*');
        $this->db->from('viewsharedcomplaints');
        $this->db->where($whereSharing);
        $sharingdata = $this->db->get();
//        $this->db->join('viewcruserinfo', 'viewcruserinfo.id = cr_sharing.idcar_userprofile');

        $resultarray['allcomplaints'] = $allcomplaints->result_array();
        $resultarray['sharingdata'] = $sharingdata->result_array();
        return $resultarray;
    }

    public function methodgetfilteredinquiry() {

        $whereComplaint = "ModeName = 'Inquiry'";

        $this->db->select('idcr_complainmode');
        $this->db->from('cr_complainmode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->
                    idcr_complainmode;
        }

        $getsearchbypadnum = $_POST['padnumber'];

        if ($getsearchbypadnum != Null) {

            $wherepadnum = "ComplaintPadNumber = '$getsearchbypadnum' AND ComplaintStatus = 'Pending' AND idComplaintMode = '".$modeid."'";
            $this->db->select('*');
            $this->db->from('viewcrallcomplaints');
            $this->db->where($wherepadnum);
            $this->db->limit(1);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        } else {

            $where = "ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";
            $this->db->select('*');
            $this->db->from('viewcrallcomplaints');
            $this->db->where($where);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        }
    }

    public function methodgetfilteredinquirysharing() {

        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->
                    idcr_mode;
        }

        $getsearchbypadnum = $_POST['padnumber'];
        $idinquiry = $_POST['idinquiry'];

        $where = "ComplaintPadNumber = '$getsearchbypadnum' AND ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $this->db->limit(1);
        $allcomplaints = $this->db->get();
        $allcomplaints->result_array();

        $whereSharing = "idcomplain = '$idinquiry'";

        $this->db->select('*');
        $this->db->from('viewsharedcomplaints');
        $this->db->where($whereSharing);
        $sharingdata = $this->db->get();

        $resultarray['allcomplaints'] = $allcomplaints->result_array();
        $resultarray['sharingdata'] = $sharingdata->result_array();
        return $resultarray;
    }

    public function methodgetregisternonfcrform() {
        $data = unserialize($_COOKIE['logindata']);
        $createddate = date("Y-m-d H:i:s");
        $getiduserprofile = $data['userid'];
        $getinquirynumber = $_POST ['padnumber'];

        if (!empty($_POST['calldone'])) {
            $iscalldoneitself = 1;
        } else {
            $iscalldoneitself = 0;
        }
        if (!empty($_POST['callmadeby'])) {
            $iscallmadeby = 1;
        } else {
            $iscallmadeby = 0;
        }

        $inquiryfeedback = $_POST['feedback'];
        $inquirynonfcrdate = $_POST['nonfcrdate'];
        $isdelbit = 0;
        $isfcrbit = 1;

        $this->db->set('idcaruserprofile', $getiduserprofile);

        $this->db->set('idComplaint', $getinquirynumber);
        $this->db->set('isCallDoneItSelf', $iscalldoneitself);
        $this->db->set('isCallMadeByPersonInvolve', $iscallmadeby);
        $this->db->set('FeedBack', $inquiryfeedback);
        $this->db->set('InquiryNonFcrDate', $inquirynonfcrdate);
        $this->db->set('isFcr', $isfcrbit);
        $this->db->set('CreatedDate', $createddate);
        $this->db->set('isDeleted', $isdelbit);
        $insertnonfcrform = $this->db->insert('cr_inquirynonfcr');
        if ($insertnonfcrform) {
            return "Successfully Inserted";
        }
    }

    public function methodgetfilterednonfcrinquiry() {

        $getsearchbypadnum = $_POST['padnumber'];

        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() >
                0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        if ($getsearchbypadnum != Null) {

            $wherepadnum = "ComplaintPadNumber = '$getsearchbypadnum' AND FCR = 'Non FCR' AND ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";
            $this->db->select('*');
            $this->db->from('viewcrallcomplaints');
            $this->db->where($wherepadnum);
            $this->db->limit(1);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        } else {
            $where = "FCR = 'Non FCR' AND ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";
            $this->db->select('*');
            $this->db->from('viewcrallcomplaints');
            $this->db->where($where);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        }
    }

    public function methodgetfilteredclosedcomplaint() {

        $getsearchbypadnum = $_POST['padnumber'];

        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() >
                0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        if ($getsearchbypadnum != null) {

            $wherepadnum = "ComplaintPadNumber = '$getsearchbypadnum' AND ComplaintStatus = 'Close' AND idcr_mode = '$modeid'";
            $this->db->select('*');
            $this->db->from('viewcrallcomplaints');
            $this->db->where($wherepadnum);
            $this->db->limit(1);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        } else {
            $where = "ComplaintStatus = 'Close' AND idcr_mode = '$modeid'";
            $this->db->select('*');
            $this->db->from('viewcrallcomplaints');
            $this->db->where($where);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();

            return $allcomplaints;
        }
    }

    public function methodgetfilteredclosedinquiry() {

        $getsearchbypadnum = $_POST['padnumber'];

        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() >
                0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        if ($getsearchbypadnum != Null) {

            $wherepadnum = "ComplaintPadNumber = '$getsearchbypadnum' AND ComplaintStatus = 'Close' AND idcr_mode = '$modeid'";
            $this->db->select('*');
            $this->db->from('viewcrallcomplaints');
            $this->db->where($wherepadnum);
            $this->db->limit(1);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        } else {

            $where = "ComplaintStatus = 'Close' AND idcr_mode = '$modeid'";
            $this->db->select('*');
            $this->db->from('viewcrallcomplaints');
            $this->db->where($where);
            $allcomplaints = $this->db->get();
            $allcomplaints->result_array();
            return $allcomplaints;
        }
    }

    public function methodgetuserinfo() {

        $getdepartment = $_POST['department'];
        $getrole = $_POST['role'];

        $where = "Department = '$getdepartment' AND Designation = '$getrole'";

        $this->db->select('*');
        $this->db->from('viewcruserinfo');
        $this->db->where($where);
        $approles = $this->db->get();

        $approles->
                result_array();
        return $approles;
    }

    public function methodgetdetaillist() {

        $where = "Relatedto != 'Product'";

        $this->db->select('*');
        $this->db->from('viewcontactdetail');
        $this->db->where($where);
        $classify = $this->db->get();


        $classify->
                result_array();
        return $classify;
    }

    public function methodgetprocesslist() {

        $this->db->select('*');
        $this->db->from('viewsaleprocess');
        $classify = $this->db->get();

        $classify->
                result_array();
        return $classify;
    }

    public function

    methodgetsubprocesslist() {

        $this->db->select('*');
        $this->db->from('viewsalesubprocess');
        $classify = $this->db->get();

        $classify->
                result_array();
        return $classify;
    }

    public function methodgetvocclassificationlist() {

//        $where = "Relatedto != 'Product'";

        $this->db->select('*');
        $this->db->from('viewvocclassification');
//        $this->db->where($where);
        $classify = $this->db->get();

        $classify->
                result_array();
        return $classify;
    }

    public function methodgetfilteredvocclassification() {

        $relatedto = $_POST['relatedto'];

        if ($relatedto != Null) {

            $where = "Relatedto = '$relatedto'";
            $this->db->select('*');
            $this->db->from('viewvocclassification');
            $this->db->where($where);
            $classify = $this->db->get();
            return $classify->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('viewvocclassification');
            $classify = $this->db->get();

            return $classify->result_array();
        }
    }

    public function docheckcomplaintnum() {

        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }

        $where = "idcr_mode = '$modeid'";

        $this->db->select('PadNumber');
        $this->db->from('cr_complain');
        $this->db->where($where);
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $PadNumber = $this->db->get();
        if ($PadNumber->num_rows() > 0) {
            $row = $PadNumber->row();
            $PadNumber = $row->PadNumber;
            return $PadNumber;
        }
    }

    public function docheckinquirynum() {

        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);

        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->
                    row();
            $modeid = $row->idcr_mode;
        }
        $where = "idcr_mode = '$modeid'";

        $this->db->select('PadNumber');
        $this->db->from('cr_complain');
        $this->db->where($where);
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $PadNumber = $this->db->get();
        if ($PadNumber->num_rows() > 0) {
            $row = $PadNumber->row();
            $PadNumber = $row->PadNumber;
            return $PadNumber;
        }
    }

    /**
     * Reporting
     */
    public function methodgettotalcomplaintsinquiries() {
        $getreport = $this->db->query('SELECT * FROM view_reportingoftotalcomplaintsinquiries');
        $getreport->result_array(
        );
        return $getreport;
    }

    public function methodgetfivesheetreport($dateone, $datetwo) {

        $resultarray = array();
        if (!empty($dateone) && !empty($datetwo)) {
            /**
             *  WHERE Clause
             */
            $where = "vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo' GROUP BY vct. MODE,
            vct.ModeType
            ORDER BY
            count(vct.TotalComplaints) DESC ";

            $whereinquiries = " vct.Mode = 'Inquiry' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo' GROUP BY
            vct.`Mode`,
            vct.ModeType,
            vct.ComplaintRelatedTo
            ORDER BY TotalComplaints DESC ";

            $wherenormal = " vct.ModeType = 'Normal' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo' GROUP BY
            vct.`Mode`,
            vct.ModeType,
            vct.ComplaintRelatedTo ";

            $whereserious = " vct.ModeType = 'Serious' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo' GROUP BY
            vct.ComplaintRelatedTo,
            vct. MODE,
            vct.ModeType ";

//For Normal 
            $wherenormalprocuct = " vrc.ComplaintRelatedTo = 'Product'  AND  vrc.ComplaintMode = 'Normal' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.Count desc ";

            $wherenormalsales = " vrc.ComplaintRelatedTo = 'Sales' AND vrc.ComplaintMode = 'Normal' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.Count desc ";

            $wherenormalservice = " vrc.ComplaintRelatedTo = 'Service' AND  vrc.ComplaintMode = 'Normal' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.Count desc ";

            $wherenormalbodyparts = " vrc.ComplaintRelatedTo = 'Body & Paint' AND  vrc.ComplaintMode = 'Normal' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.Count desc ";

// For Serious 
            $whereseriousprocuct = " vrc.ComplaintRelatedTo = 'Product'  AND  vrc.ComplaintMode = 'Serious' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.Count desc ";

            $whereserioussales = " vrc.ComplaintRelatedTo = 'Sales' AND vrc.ComplaintMode = 'Serious' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.Count desc ";

            $whereseriousservice = " vrc.ComplaintRelatedTo = 'Service' AND  vrc.ComplaintMode = 'Serious' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.Count desc ";

            $whereseriousbodyparts = " vrc.ComplaintRelatedTo = 'Body & Paint' AND  vrc.ComplaintMode = 'Serious' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.Count desc ";

// For Point 4 Normal
            $wherenormalsafety = " vrc.Mode = 'Complaint'
            AND vrc.ComplaintMode = 'Normal'
            AND vrc.ComplaintCases = 'Safety' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.ComplaintStatus DESC ";

            $wherenormalnonsafety = " vrc.Mode = 'Complaint'
            AND vrc.ComplaintMode = 'Normal'
            AND vrc.ComplaintCases = 'NonSafety' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.ComplaintStatus DESC ";

            $wherenormalrepeated = " vrc.Mode = 'Complaint'
            AND vrc.ComplaintMode = 'Normal'
            AND vrc.ModeCategory = 'Repeat Complaint' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.ComplaintStatus DESC ";

// For Point 4 Serious
            $whereserioussafety = " vrc.Mode = 'Complaint'
            AND vrc.ComplaintMode = 'Serious'
            AND vrc.ComplaintCases = 'Safety' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.ComplaintStatus DESC ";

            $whereseriousnonsafety = " vrc.Mode = 'Complaint'
            AND vrc.ComplaintMode = 'Serious'
            AND vrc.ComplaintCases = 'NonSafety' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.ComplaintStatus DESC ";

            $whereseriousrepeated = " vrc.Mode = 'Complaint'
            AND vrc.ComplaintMode = 'Serious'
            AND vrc.ModeCategory = 'Repeat Complaint' AND vrc.RegisteredDate BETWEEN '$dateone' AND '$datetwo' ORDER BY 
            vrc.ComplaintStatus DESC ";

//For Point Inquiry
            $wherenonfcrtarget = " vct.ResoultionStatus = 'ResolveinTarget'
            AND vct.FCR = 'Non FCR' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo'";

            $wherenonfcractual = " vct.ResoultionStatus = 'NotResolveinTarget'
            AND vct.FCR = 'Non FCR' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo'";

            $wherefcrtarget = " vct.ResoultionStatus = 'ResolveinTarget'
            AND vct.FCR = 'FCR' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo'";

            $wherefcractual = " vct.ResoultionStatus = 'NotResolveinTarget'
            AND vct.FCR = 'FCR' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo'";

//For Point Complaint
            $wherenormaltarget = " vct.ResoultionStatus = 'ResolveinTarget'
            AND vct.ComplaintMode = 'Normal' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo'";

            $wherenormalactual = " vct.ResoultionStatus = 'NotResolveinTarget'
            AND vct.ComplaintMode = 'Normal' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo'";

            $whereserioustarget = " vct.ResoultionStatus = 'ResolveinTarget'
            AND vct.ComplaintMode = 'Serious' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo'";

            $whereseriousactual = " vct.ResoultionStatus = 'NotResolveinTarget'
            AND vct.ComplaintMode = 'Serious' AND vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo'";

            /**
             *  Queries
             */
            $totalciquery = $this->db->query('SELECT CONCAT(vct.`Mode`," ",IFNULL(vct.ModeType,"")) as Title,
                    count(vct.TotalComplaints) as Count'
                    . ' FROM v_contacttrend vct WHERE ' . $where . 'limit 3');

            $totalinquiries = $this->db->query('SELECT
            vct.ComplaintRelatedTo AS Title,
            vct.ComplaintRelatedTo,
            vct.`Mode`,
            vct.ModeType,
            count(vct.TotalComplaints) AS Count FROM v_contacttrend vct WHERE' . $whereinquiries . 'limit 3');

            $normalcomplaints = $this->db->query('SELECT
            vct.`ComplaintRelatedTo` AS Title,
            vct.ModeType AS ModeType,
            count(vct.ComplaintRelatedTo) AS Total
            FROM v_contacttrend vct WHERE' . $wherenormal . 'limit 3');

            $seriouscomplaints = $this->db->query('SELECT
            vct.`ComplaintRelatedTo` AS Title,
            vct.ModeType AS ModeType,
            count(vct.ComplaintRelatedTo) AS Total
            FROM
            v_contacttrend vct WHERE' . $whereserious . 'limit 3');

            /**
             *  6-june
             */
//For Normal
            $productnormalcomplaints = $this->db->query('SELECT * FROM `viewreportingvocsaleprocess` vrc
             WHERE' . $wherenormalprocuct . 'limit 3');

            $salesnormalcomplaints = $this->db->query('SELECT * FROM `viewreportingvoccontactdetails` vrc
             WHERE' . $wherenormalsales . 'limit 3');

            $servicenormalcomplaints = $this->db->query('SELECT * FROM `viewreportingvoccontactdetails` vrc
             WHERE' . $wherenormalservice . 'limit 3');

            $bodypartsnormalcomplaints = $this->db->query('SELECT * FROM `viewreportingvoccontactdetails` vrc
             WHERE' . $wherenormalbodyparts . 'limit 3');

// For Serious
            $productseriouscomplaints = $this->db->query('SELECT * FROM `viewreportingvocsaleprocess` vrc
             WHERE' . $whereseriousprocuct . 'limit 3');

            $salesseriouscomplaints = $this->db->query('SELECT * FROM `viewreportingvoccontactdetails` vrc
             WHERE' . $whereserioussales . 'limit 3');

            $serviceseriouscomplaints = $this->db->query('SELECT * FROM `viewreportingvoccontactdetails` vrc
             WHERE' . $whereseriousservice . 'limit 3');

            $bodypartsseriouscomplaints = $this->db->query('SELECT * FROM `viewreportingvoccontactdetails` vrc
             WHERE' . $whereseriousbodyparts . 'limit 3');

//For Point 4 Normal 
            $normalsafetycomplaints = $this->db->query('SELECT
            vrc.ComplaintStatus AS "ComplaintStatus",
            count(vrc.ComplaintStatus) AS "Count" 
            FROM viewreportingofcomplaintstatus vrc 
            WHERE' . $wherenormalsafety . 'limit 3');

            $normalnonsafetycomplaints = $this->db->query('SELECT
            vrc.ComplaintStatus AS "ComplaintStatus",
            count(vrc.ComplaintStatus) AS "Count"
            FROM viewreportingofcomplaintstatus vrc
            WHERE' . $wherenormalnonsafety . 'limit 3');

            $normalrepeatedcomplaints = $this->db->query('SELECT
            vrc.ModeCategory AS "RepeatComplaint",
            count(vrc.ComplaintStatus) AS "Count"
            FROM viewreportingofcomplaintstatus vrc
            WHERE' . $wherenormalrepeated . 'limit 3');

//For Point 4 Serious 
            $serioussafetycomplaints = $this->db->query('SELECT
            vrc.ComplaintStatus AS "ComplaintStatus",
            count(vrc.ComplaintStatus) AS "Count"
            FROM viewreportingofcomplaintstatus vrc
            WHERE' . $whereserioussafety . 'limit 3');

            $seriousnonsafetycomplaints = $this->db->query('SELECT
            vrc.ComplaintStatus AS "ComplaintStatus",
            count(vrc.ComplaintStatus) AS "Count"
            FROM viewreportingofcomplaintstatus vrc
            WHERE' . $whereseriousnonsafety . 'limit 3');

            $seriousrepeatedcomplaints = $this->db->query('SELECT
            vrc.ModeCategory AS "RepeatComplaint",
            count(vrc.ComplaintStatus) AS "Count"
             FROM viewreportingofcomplaintstatus vrc
            WHERE' . $whereseriousrepeated . 'limit 3');

// For Point 5 Inquiry

            $nonfcractual = 'SELECT
            count(*) AS Count,
            "Closure L/T (Actual)" AS Title
            FROM
            ( SELECT * FROM viewreportinquirytargettime vrct ) AS vct WHERE' . $wherenonfcractual . ' UNION ALL ';

            $fcrtarget = 'SELECT
            count(*) AS Count,
            "1st Call Resolution (Target) (FCR)" AS Title
            FROM
            ( SELECT * FROM viewreportinquirytargettime vrct ) AS vct WHERE' . $wherefcrtarget . ' UNION ALL ';

            $fcractual = 'SELECT
            count(*) AS Count,
            "1st Call Resolution (Actual)" AS Title
            FROM
            ( SELECT * FROM viewreportinquirytargettime vrct ) AS vct WHERE ' . $wherefcractual . '';

            $nonfcrtarget = $this->db->query('SELECT
            count(*) AS Count,
            "Closure L/T (Target) (NON FCR)" AS Title
            FROM
            ( SELECT * FROM viewreportinquirytargettime vrct ) AS vct WHERE' . $wherenonfcrtarget . ' UNION ALL  ' . $nonfcractual . $fcrtarget . $fcractual . '');

// For Point 5 Complaint


            $normalactual = 'SELECT
            count(*) AS Count,
            "Normal Closure L/T (Actual)" AS Title
            FROM
            ( SELECT * FROM viewreportingcomptargettime vrct ) AS vct WHERE' . $wherenormalactual . ' UNION ALL ';

            $serioustarget = 'SELECT
            count(*) AS Count,
            "Serious Closure L/T (Target)"AS Title
            FROM
            ( SELECT * FROM viewreportingcomptargettime vrct ) AS vct WHERE' . $whereserioustarget . ' UNION ALL ';

            $seriousactual = 'SELECT
            count(*) AS Count,
            "Serious Closure L/T (Actual)" AS Title
            FROM
            ( SELECT * FROM viewreportingcomptargettime vrct ) AS vct WHERE' . $whereseriousactual . '';

            $normaltarget = $this->db->query('SELECT count(*) AS Count,
                "Normal Closure L/T (Target)" AS Title 
                FROM
            ( SELECT * FROM viewreportingcomptargettime vrct ) AS vct WHERE' . $wherenormaltarget . ' UNION ALL  ' . $normalactual . $serioustarget . $seriousactual . '');

            /**
             * Sending through Arrays
             */
            $resultarray['total'] = $totalciquery->result_array();
            $resultarray['totalinquiries'] = $totalinquiries->result_array();

//For Normal
            $resultarray['normalcomplaints'] = $normalcomplaints->result_array();
            $resultarray['productnormalcomplaints'] = $productnormalcomplaints->result_array();
            $resultarray['salesnormalcomplaints'] = $salesnormalcomplaints->result_array();
            $resultarray['servicenormalcomplaints'] = $servicenormalcomplaints->result_array();
            $resultarray['bodypartsnormalcomplaints'] = $bodypartsnormalcomplaints->result_array();

//For Serious
            $resultarray['seriouscomplaints'] = $seriouscomplaints->result_array();
            $resultarray['productseriouscomplaints'] = $productseriouscomplaints->result_array();
            $resultarray['salesseriouscomplaints'] = $salesseriouscomplaints->result_array();
            $resultarray['serviceseriouscomplaints'] = $serviceseriouscomplaints->result_array();
            $resultarray['bodypartsseriouscomplaints'] = $bodypartsseriouscomplaints->result_array();

//For Point 4 Normal
            $resultarray['normalsafetycomplaints'] = $normalsafetycomplaints->result_array();
            $resultarray['normalnonsafetycomplaints'] = $normalnonsafetycomplaints->result_array();
            $resultarray['normalrepeatedcomplaints'] = $normalrepeatedcomplaints->result_array();

//For Point 4 Serious
            $resultarray['serioussafetycomplaints'] = $serioussafetycomplaints->result_array();
            $resultarray['seriousnonsafetycomplaints'] = $seriousnonsafetycomplaints->result_array();
            $resultarray['seriousrepeatedcomplaints'] = $seriousrepeatedcomplaints->result_array();

//For Point 5 Inquiry
//            $resultarray['complaintresolution'] = $complaintresolution->result_array();
            $resultarray['nonfcrtarget'] = $nonfcrtarget->result_array();
//            $resultarray['nonfcractual'] = $nonfcractual->result_array();
//            $resultarray['fcrtarget'] = $fcrtarget->result_array();
//            $resultarray['fcractual'] = $fcractual->result_array();
//For Point 5 Complaint
            $resultarray['normaltarget'] = $normaltarget->result_array();
//            $resultarray['normalactual'] = $normalactual->result_array();
//            $resultarray['serioustarget'] = $serioustarget->result_array();
//            $resultarray['seriousactual'] = $seriousactual->result_array();


            return $resultarray;
        }
    }

    public function methodgetfilteredinquiries() {

        if (!empty($_POST['dateone']) && !empty($_POST['datetwo'])) {

            $dateone = $_POST['dateone'];
            $datetwo = $_POST['datetwo'];

            $where = "vct.RegisteredDate BETWEEN '$dateone' AND '$datetwo'";
            $getreport = $this->db->query('SELECT * FROM view_reportingofinquiriesviarelatinon WHERE ' . $where);
            $getreport->result_array();

            return $getreport;
        }
    }

    public function methodgetfilterednormalcomplaints() {

        if (!empty($_POST['dateone']) && !empty($_POST['datetwo'])) {

            $dateone = $_POST['dateone'];
            $datetwo = $_POST['datetwo'];

            $where = "RegisteredDate BETWEEN '$dateone' AND '$datetwo'";
            $getreport = $this->db->query('SELECT * FROM view_reportingofnormalcomplaintsviarelation WHERE ' . $where);
            $getreport->result_array();

            return $getreport;
        }
    }

    public function methodgetfilteredseriouscomplaints() {

        if (!empty($_POST['dateone']) && !empty($_POST['datetwo'])) {

            $dateone = $_POST['dateone'];
            $datetwo = $_POST['datetwo'];

            $where = "RegisteredDate BETWEEN '$dateone' AND '$datetwo'";
            $getreport = $this->db->query('SELECT * FROM view_reportingofseriouscomplaintsviarelation WHERE ' . $where);
            $getreport->result_array();
            return $getreport;
        }
    }
    
    
    
     public function methodgetallinquiriessale() {


        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }


        $where = "ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $this->db->where('ComplaintRelatedTo','Sales');
        $allinquiries = $this->db->get();
        $allinquiries->result_array();
        return $allinquiries;
    }
    
     public function methodgetallinquiriesservice() {


        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }


        $where = "ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $this->db->where('ComplaintRelatedTo','Services');
        $allinquiries = $this->db->get();
        $allinquiries->result_array();
         
        return $allinquiries;
    }
    
    public function methodgetallinquiriesparts() {


        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }


        $where = "ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $this->db->where('ComplaintRelatedTo','Parts');
        $allinquiries = $this->db->get();
        $allinquiries->result_array();
        return $allinquiries;
    }
    
     public function methodgetallinquiriesfinance() {


        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }


        $where = "ComplaintStatus = 'Pending' AND idcr_mode = '$modeid'";

        $this->db->select('*');
        $this->db->from('viewcrallcomplaints');
        $this->db->where($where);
        $this->db->where('ComplaintRelatedTo','Finance');
        $allinquiries = $this->db->get();
        $allinquiries->result_array();
        return $allinquiries;
    }
    
    
    public function ReturnComplaintFeedback() {
        $data = unserialize($_COOKIE['logindata']);
        $whereComplaint = "Name = 'Complaint'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }
        $iduserprofile = $data['userid'];
        $where = "idcr_mode = '$modeid' AND FeedBack != '-'";

        $this->db->select('count(FeedBack) as count');
        $this->db->from('viewcomplainshare');
        $this->db->where($where);
        $allcomplaints = $this->db->get();

        if ($allcomplaints->num_rows() > 0) {
            $row = $allcomplaints->row();
            return $modeid = $row->count;
        }
    }
    
       public function ReturnInquiryFeedback() {
        $data = unserialize($_COOKIE['logindata']);
        $whereComplaint = "Name = 'Inquiry'";

        $this->db->select('idcr_mode');
        $this->db->from('cr_mode');
        $this->db->where($whereComplaint);
        $this->db->limit(1);
        $modeid = $this->db->get();
        if ($modeid->num_rows() > 0) {
            $row = $modeid->row();
            $modeid = $row->idcr_mode;
        }
        $iduserprofile = $data['userid'];
        $where = "idcr_mode = '$modeid' AND FeedBack != '-'";

        $this->db->select('count(FeedBack) as count');
        $this->db->from('viewcomplainshare');
        $this->db->where($where);
        $allcomplaints = $this->db->get();

        if ($allcomplaints->num_rows() > 0) {
            $row = $allcomplaints->row();
            return $modeid = $row->count;
        }
    }
}
