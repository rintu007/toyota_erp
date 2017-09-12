<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_visitplanpost extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

//////////////////////////////////////////////////
    public function getEnteryNo() {
        $this->db->select_max('idvisitplanpost');
        $result = $this->db->get('visit_plan_post')->row_array();
        return ((int) $result['idvisitplanpost'] + 1 );
    }
    public function getallEntry()
    {
        return $this->db->select('idvisitplan')->from('visit_plan')->order_by('idvisitplan','desc')->get()->result();
    }

/////////////////////////////////////////

    public function getSalePersonCustomerName() {
        $this->db->select("*");
        $result = $this->db->get('car_customer')->result_array();
        return $result;
    }

    public function getLocationCustomerAdress() {
        $this->db->select("*");
        $result = $this->db->get('car_customer')->result_array();
        return $result;
    }

    public function save() {
        
        $data_visitplan_post = array(
            'entery_no' => $this->input->post('entery_no')
        );

        $this->db->insert('visit_post', $data_visitplan_post);

        $idvisitplanpost = $this->db->insert_id();


        $customername = $this->input->post('customername');
        $address = $this->input->post('address');
        $mobile = $this->input->post('mobile');
        $telephone = $this->input->post('telephone');
        $email = $this->input->post('email');
        $businessname = $this->input->post('businessname');
        $businessaddress = $this->input->post('businessaddress');

        $IdCustomer = $this->input->post('IdCustomer');

        $custId ='';
        for ($i = 0; $i < count($customername); $i++) {

            if($IdCustomer[$i]=='')
            {
                $newCust = array(
                    'CustomerName'      => $customername[$i],
                    'AddressDetails'    => $address[$i],
                    'Cellphone'         => $mobile[$i],
                    'Telephone'         => $telephone[$i],
                    'Email'             => $email[$i],
                );

                $this->db->insert('car_customer',$newCust);
                $custId = $this->db->insert_id();

            }else{
                $custId = ($IdCustomer[$i]);
            }


            $data_visitplandetailpost = array(
                'idvisitplanpost' => $idvisitplanpost,
                'customername' => $custId,
                'address' => $address[$i],
                'mobile' => $mobile[$i],
                'telephone' => $telephone[$i],
                'email' => $email[$i],
                'businessname' => $businessname[$i],
                'businessaddress' => $businessaddress[$i]
            );
            
            $this->db->insert('visit_plan_post', $data_visitplandetailpost);
        }
    }

/////////////////////////////////////
    ////////////////

    public function edit() {
        // print_r($this->input->post('enterNumber'));
        //  $this->input->post();
        //die;
        $idvisitplanpost = $this->input->post('enterNumber');
        $this->db->where('idvisitplanpost', $idvisitplanpost[0]);
        $this->db->delete('visit_plan_post');
        //die;


        $customername = $this->input->post('customername');
        $address = $this->input->post('address');
        $mobile = $this->input->post('mobile');
        $telephone = $this->input->post('telephone');
        $email = $this->input->post('email');
        $businessname = $this->input->post('businessname');
        $businessaddress = $this->input->post('businessaddress');

        for ($i = 0; $i < count($customername); $i++) {

            $data_visitplandetailpost = array(
                'idvisitplanpost' => $idvisitplanpost[0],
                'customername' => $customername[$i],
                'address' => $address[$i],
                'mobile' => $mobile[$i],
                'telephone' => $telephone[$i],
                'email' => $email[$i],
                'businessname' => $businessname[$i],
                'businessaddress' => $businessaddress[$i]
            );
            $this->db->insert('visit_plan_post', $data_visitplandetailpost);
        }
    }

    ////////////

    public function getVisitPosts() {


        $this->db->select('visit_post.*, visit_plan_post.*, car_customer.CustomerName, car_customer.IdCustomer');
        $this->db->from('visit_post');
        $this->db->join('visit_plan_post', 'visit_plan_post.idvisitplanpost = visit_post.idvisitplanpost');
        $this->db->order_by('visit_post.entery_no', 'DESC');
        ////////////////////////////////////////////////////
        $this->db->join('car_customer', 'visit_plan_post.Customername = car_customer.IdCustomer');
        $this->db->order_by('visit_plan_post.idvisitplanpost','desc');
        ///////////////////////////////////////////////////////
        $result = $this->db->get();

        return $result->result_array();
    }

//////////////////////////////////////////////////////////
    public function getSalePerson() {
        $this->db->select("*");
        $result = $this->db->get('car_user_profile')->result_array();
        return $result;
    }

    /////////////////////////////
    public function getOneVisitPost($id) {
        $this->db->select("*");
        //$this->db->where('idvisitplanpost', $id);
        $this->db->join('visit_plan_post', 'visit_plan_post.idvisitplanpost = visit_post.idvisitplanpost');
        $this->db->where('visit_post.idvisitplanpost', $id);
        $result = $this->db->get('visit_post')->result_array();
        return $result;
    }

    public function getVisitPlanPost($id) {
        $this->db->select("*");
        $this->db->where('idvisitplanpost', $id);
        $result = $this->db->get('visit_plan_post')->result_array();
        return $result;
    }

    public function getexistingcustomer() {

        $getsearchby = $_POST['searchby'];
        $getsearchnow = $_POST['searchnow'];

        if ($getsearchby == "Contact Number") {
            if ($getsearchnow != Null) {
                $where = "PhoneNumber = '$getsearchnow' OR MobileNumber = '$getsearchnow'";
                $this->db->select('*');
                $this->db->from('viewcrcustomercompleteinfo');
                $this->db->where($where);
                $customer = $this->db->get();

//                $this->db->select('*');
//                $this->db->from('viewcrcustomervehicle');
//                $this->db->where($where);
//                $crcustomer = $this->db->get();
//
//                $this->db->select('*');
//                $this->db->from('s_vehicle veh');
//                $this->db->join('s_allvehicles allveh', 'allveh.idAllVehicles = veh.idVariant', 'left');
//                $this->db->join('s_cutomerdetail customer', 'customer.idCustomer = veh.idCustomer', 'left');
//                $this->db->join('s_repairorderbill r', 'r.idCustomerDetail = customer.idCustomer', 'left');
//                $this->db->join('s_ro_workperformed w', 'w.idRepairOrderBill = r.idRepairOrderBill', 'left');
//                $this->db->like('customer.Cellphone', $getsearchnow);
//                $this->db->or_like('customer.PhoneOne', $getsearchnow);
//                $this->db->or_like('customer.PhoneTwo', $getsearchnow);
//                $this->db->or_like('customer.CompanyContact', $getsearchnow);
//                $this->db->distinct();
//                $serviceCustomer = $this->db->get();
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
//        $resultarray['crcustomer'] = $crcustomer->result_array();
//        $resultarray['serviceCustomer'] = $serviceCustomer->result_array();
        return $resultarray;
    }


///////////////////////////////////////////
    /*
      public function edit() {
      print_r($_POST);






      $this->db->where('idvisitplanpost', $this->input->post('entery_no'));
      $this->db->delete('visit_plan_post');
      die;


      $idvisitplanpost = $this->input->post('entery_no');
      $customername = $this->input->post('customername');
      $address = $this->input->post('address');
      $mobile = $this->input->post('mobile');
      $telephone = $this->input->post('telephone');
      $email = $this->input->post('email');
      $businessname = $this->input->post('businessname');
      $businessaddress = $this->input->post('businessaddress');

      for ($i = 0; $i < count($customername); $i++) {

      $data_visitplandetailpost = array(
      'idvisitplanpost' => $idvisitplanpost,
      'customername' => $customername[$i],
      'address' => $address[$i],
      'mobile' => $mobile[$i],
      'telephone' => $telephone[$i],
      'email' => $email[$i],
      'businessname' => $businessname[$i],
      'businessaddress' => $businessaddress[$i]
      );
      $this->db->update('visit_plan_post', $data_visitplandetailpost);

      }
      }
     */
}

?>