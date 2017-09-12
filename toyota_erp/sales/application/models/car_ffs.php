<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_ffs extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_ffs($id)
    {
        return $this->db->where('id',$id)->get('car_ffs')->row();
    }

    function get_ffs_detail($id)
    {
        return $this->db->where('idffs',$id)->get('car_ffs_detail')->result_array();
    }

    function get_gatepass()
    {
        return $this->db->query("
                                    SELECT cg.*, ffs.id AS idffs ,ffs.close
                                    FROM car_gatepass cg
                                    LEFT JOIN car_ffs ffs ON ffs.idGatePass = cg.idGatePass
                                    WHERE cg.GatePassDate < DATE_SUB(NOW(), INTERVAL 30 DAY)
        ")->result_array();
    }

    function get_gp_detail($idgatepass)
    {
        return $this->db->query("
                                    SELECT cg.*, ffs.id AS idffs,cd.ChasisNo,cd.RegistrationNumber,cc.CustomerName,cc.AddressDetails,cc.Telephone,cv.Variants,cc.Cellphone
                                    FROM car_gatepass cg
                                    LEFT JOIN car_ffs ffs ON ffs.idGatePass = cg.idGatePass
                                    LEFT JOIN car_dispatch cd ON cd.idDispatch = cg.dispatchId
                                    LEFT JOIN car_salenote cs ON cs.Dispatch=cd.idDispatch
                                    LEFT JOIN car_pbo pb ON pb.Id=cd.PboId
                                    LEFT JOIN car_resource_book rb ON rb.IdResourceBook=pb.ResourcebookId
                                    LEFT JOIN car_customer cc ON cc.IdCustomer = rb.CustomerId OR cs.Customer
                                    
                                    left join car_variants cv on cv.IdVariants = cd.VariantId
                                    WHERE cg.idGatePass = $idgatepass
        ")->row();
    }

    function insert_ffs()
    {
        $data = array(
            "idGatePass"    => $_POST['idGatePass'],
            "listupdate"    => $_POST['listupdate'],
            "drivername"    => $_POST['drivername'],
            "drivercontact" => $_POST['drivercontact'],
            "exvisitdate"   => $_POST['exvisitdate'],
            "maintype"      => $_POST['maintype'],
            "appointmentdate" => $_POST['appointmentdate'],
            "contact_type"  => $_POST['contact_type']
        );
        $this->db->insert('car_ffs',$data);
        $id = $this->db->insert_id();
       $i = 0;
        foreach ($_POST['followupdate'] as $item) {
            if($i <6) {
                $Data = array(
                    'idffs'         => $id,
                    'followupdate'  => $_POST['followupdate'][$i],
                    'app'           => $_POST['app'][$i],
                    'reason'        => $_POST['reason'][$i],
                    'problem'       => $_POST['problem'][$i],
                    'actiontaken'   => $_POST['actiontaken'][$i],
                    'actioncompleted' => $_POST['actioncompleted'][$i]
                );
                $i++;
                $this->db->insert('car_ffs_detail',$Data);
            }


        }

        return $id;
    }

    function update_ffs($id)
    {
        if($_POST['typesubmit']=='Update and Close FFS')
        {
            $this->db->where('id',$id)->update('car_ffs',array('close'=>1));
        }

        $data = array(
            "listupdate"    => $_POST['listupdate'],
            "drivername"    => $_POST['drivername'],
            "drivercontact" => $_POST['drivercontact'],
            "exvisitdate"   => $_POST['exvisitdate'],
            "maintype"      => $_POST['maintype'],
            "appointmentdate" => $_POST['appointmentdate'],
            "contact_type"  => $_POST['contact_type']
        );
        $this->db->where('id',$id)->update('car_ffs',$data);

        $this->db->where('idffs',$id)->delete('car_ffs_detail');
        $i = 0;
        foreach ($_POST['followupdate'] as $item) {
            if($i <6) {
                $Data = array(
                    'idffs'         => $id,
                    'followupdate'  => $_POST['followupdate'][$i],
                    'app'           => $_POST['app'][$i],
                    'reason'        => $_POST['reason'][$i],
                    'problem'       => $_POST['problem'][$i],
                    'actiontaken'   => $_POST['actiontaken'][$i],
                    'actioncompleted' => $_POST['actioncompleted'][$i]
                );
                $i++;
                $this->db->insert('car_ffs_detail',$Data);
            }


        }

        return $id;

    }

    function get_max_id()
    {
        $this->db->select_max('id');
        $id =  $this->db->get('car_ffs')->row('id');
        return ($id)?($id+1):1;

    }



}
