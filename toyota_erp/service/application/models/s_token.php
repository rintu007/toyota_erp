<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_token extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->select('token.*,c.CustomerName,cv.Variants,m.Model,s_category.Name as category')
            ->from('token')
            ->join('s_cutomerdetail c','c.idCustomer = token.idCustomer')
            ->join('car_variants cv','cv.IdVariants = token.make')
            ->join('car_model m','m.IdModel = cv.ModelId')
            ->join('s_category','s_category.idCategory = token.idCategory');

        $this->db->where('date(token.created_at)', 'CURDATE()', FALSE);
//        $this->db->where('DATE(created_at)',now());
        $this->db->order_by('idToken','desc');
       return $this->db->get()->result_array();
    }


    function Updatetoken($idToken, $tokenData) {

        $this->db->where('idToken', $idToken);
        $this->db->update('token', $tokenData);
        return "Successfully Update";
    }

    function Deletetoken($idToken) {

        $this->db->set('isActive', 0);
        $this->db->where('idToken', $idToken);
        $this->db->update('token');
        return "Successfully Deleted";
    }

    function selectOnetoken() {

        $this->db->select('idToken');
        $this->db->from('token');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idToken = $this->db->get();
        if ($idToken->num_rows() > 0) {
            $row = $idToken->row();
            $idToken = $row->idToken;
            return $idToken;
        }
    }

    function selectAlltokens($ContactNumber) {
        $this->db->select('*');
        $this->db->from('token');
        $this->db->like('token.Cellphone', $ContactNumber);
        $this->db->where('token.isActive != 0');
        $servicetoken = $this->db->get();
        if ($servicetoken != NULL) {
            return $servicetoken->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('car_token');
            $this->db->like('car_token.Telephone', $ContactNumber);
            $cartoken = $this->db->get();
            if ($cartoken != NULL) {
                return $cartoken->result_array();
            } else {
                $this->db->select('*');
                $this->db->from('cr_tokendetail');
                $this->db->like('cr_tokendetail.Telephone', $ContactNumber);
                $crtoken = $this->db->get();
                if ($crtoken != NULL) {
                    return $crtoken->result_array();
                }
            }
        }
    }

    function searchtoken($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('token');
//        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = token.idDealer');
//        $this->db->like('token.tokenName', $SearchKeyword);
        $this->db->where('token.isActive != 0');
        $searchtoken = $this->db->get();
        return $searchtoken->result_array();
    }

    function isExisttoken($name, $contactNumber) {

        $whereClause = "tokenName = '$name' AND Cellphone = '$contactNumber' AND isActive = 1";
        $this->db->select('*');
        $this->db->from('token');
        $this->db->where($whereClause);
        $this->db->limit(1);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            $row = $isExist->row();
            $isExist = $row->idToken;
            return $isExist;
        }
    }

    function get_variants()
    {
        return $this->db->get('car_variants')->result_array();
    }

    function get_s_category()
    {
        return $this->db->get('s_category')->result_array();
    }


    function customer_list()
    {
        $this->db->select('v.idVehicle,v.idVariant,v.idCustomer,v.RegistrationNumber,v.EngineNumber,v.ChassisNumber,
        c.CustomerName,c.AddressDetails,c.Cellphone,c.CompanyContact,c.CustomerEmail,
        cv.Variants
        ')
            ->from('s_vehicle v')
            ->join('s_cutomerdetail c','c.idCustomer = v.idCustomer')
            ->join('car_variants cv','cv.IdVariants = v.idVariant');
           // ->where('v.RegistrationNumber',$reg);

        return $data = $this->db->get()->result_array();
    }

    function get_tokenNumber()
    {
        $this->db->where('date(token.created_at)', 'CURDATE()', FALSE);
        $this->db->order_by('tokenNumber','desc');

        $query =  $this->db->get('token');

//        echo $this->db->last_query();

        if($query->num_rows() > 0)
        {

            $token = $query->row('tokenNumber');

            return ++$token;

        }
        return 1;

    }

    function insert()
    {
//        var_dump($_POST);die;
        $idCustomer ='';
        if($_POST['idCustomer']!='')
        {
            $idCustomer = $_POST['idCustomer'];

        }else{
            $cust = array(
                "CustomerName"   =>$_POST['CustomerName'],
                "CompanyContact" =>$_POST['CompanyContact'],
                "Cellphone"      =>$_POST['Cellphone'],
                "AddressDetails" =>$_POST['AddressDetails'],
                "CustomerEmail"  =>$_POST['CustomerEmail']

            );
            $this->db->insert('s_cutomerdetail',$cust);
            $idCustomer = $this->db->insert_id();
        }
            $data = array(
                'idCustomer'    => $idCustomer,
                'tokenNumber'    => $this->get_tokenNumber(),
                'idEstimate'    => $_POST['idEstimate'],
                'idAppointment' => $_POST['idAppointment'],
                'regNo'         => $_POST['regNo'],
                'chasis'        => $_POST['ChassisNumber'],
                'idCategory'    => $_POST['idCategory'],
                'make'          => $_POST['make'],
                'msitype'       => $_POST['msitype'],
                'remarks'       => $_POST['remarks']
            );

            $this->db->insert('token',$data);
            return $this->db->insert_id();

    }

}
