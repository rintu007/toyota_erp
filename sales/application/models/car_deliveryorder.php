<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_deliveryorder extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allDo() {
        $variants = $this->db->select('*')->from('do')->get();
        return $variants->result_array();
    }



    function get_data($iddispatch)
    {
        $query = "SELECT car_receive.*, car_dispatch.ChasisNo, car_dispatch.EngineNo,car_pbo.RegistrationNumber,p.name as parkingname, s.name as sourcename,
                car_pbo.PboNumber, car_dispatch.WarrantyBook,
                car_variants.Variants, car_color.ColorName,car_pbo.ActualSalePerson,
                cc.* ,car_invoice.idInvoice,car_invoice.InvoiceNumber,car_invoice.InvoiceDate
               
                FROM car_receive
                join parking_row p on p.id=car_receive.idparking_row
                join source s on s.id =car_receive.idsource
					 join car_dispatch on car_dispatch.idDispatch=car_receive.idDispatch
					                 LEFT  JOIN car_pbo ON car_dispatch.PboId = car_pbo.Id
                LEFT  JOIN car_resource_book ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
                LEFT  JOIN car_variants ON car_dispatch.VariantId = car_variants.IdVariants 
                LEFT  JOIN car_color ON car_dispatch.ColorId = car_color.IdColor
                
                left join car_customer cc on cc.IdCustomer = car_resource_book.CustomerId
                 left join car_invoice on car_invoice.DispatchId = car_dispatch.idDispatch
                where car_receive.idDispatch =$iddispatch
                ";
        return $this->db->query($query)->row();
    }

    function get_do_list()
    {
        return $this->db
            ->select('deliveryorder.*,car_gatepass.idGatePass')
            ->from('deliveryorder')
            ->join('car_gatepass','car_gatepass.dispatchId = deliveryorder.idDispatch','left')->get()->result_array();
    }

    function get_do($id)
    {
        return $this->db
            ->select('deliveryorder.*,cc.CustomerName')
            ->from('deliveryorder')
            ->join('car_customer cc','cc.IdCustomer = deliveryorder.custId','left')
            ->where('deliveryorder.id',$id)
            ->get()
            ->row();
    }

    function get_max_do_id()
    {
        $num = $this->db->select('id')->order_by('id','desc')->get('deliveryorder')->row('id');
        return $num + 1;
    }

    function get_sub_account()
    {
        return $this->db->get('sub_account')->result_array();
    }

    function inser_do()
    {
        $data = array(
            'entrydate'             =>  $_POST['entrydate'],
            'idDispatch'             =>  $_POST['idDispatch'],
            'custId'                =>  $_POST['custId'],
            'driver'                =>  $_POST['driver'],
            'soldto'                =>  $_POST['soldto'],
            'careof'                =>  $_POST['careof'],
            'code_sub_account'      =>  isset($_POST['code_sub_account'])?1:0,
            'FFSFollowup'           =>  $_POST['FFSFollowup'],
            'FFSFollowupdate'       =>  $_POST['FFSFollowupdate'],
            'cashdeliveryorder'     =>  isset($_POST['cashdeliveryorder'])?1:0,
            'receivedoinfinance'    =>  isset($_POST['receivedoinfinance'])?1:0,
            'loyaltycardoffer'      =>  isset($_POST['loyaltycardoffer'])?1:0,
            'resale'                =>  isset($_POST['resale'])?1:0

        );

       return $this->db->insert('deliveryorder',$data);
    }

}
