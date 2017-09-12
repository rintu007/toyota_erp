<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_documentdelivery extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

 
    public function get_all() 
    {

//        $result = $this->db->get('car_documentdelivery');
        $result = $this->db->query("
        SELECT cdd.iddocumentdelivery,cdd.entry_no,cdd.entry_date,cdd.idDispatch, car_dispatch.ChasisNo, car_dispatch.EngineNo,car_pbo.RegistrationNumber,cdd.delivered_to,
 car_pbo.PboNumber, car_dispatch.WarrantyBook,
 car_variants.Variants, car_color.ColorName,car_pbo.ActualSalePerson,
 cc.*
FROM car_documentdelivery cdd
LEFT JOIN car_dispatch ON cdd.idDispatch = car_dispatch.idDispatch
LEFT JOIN car_pbo ON car_dispatch.PboId = car_pbo.Id
LEFT JOIN car_resource_book ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
LEFT JOIN car_variants ON car_dispatch.VariantId = car_variants.IdVariants
LEFT JOIN car_color ON car_dispatch.ColorId = car_color.IdColor
LEFT JOIN car_customer cc ON cc.IdCustomer = car_resource_book.CustomerId
order by cdd.iddocumentdelivery desc
        ");

        if ($result->num_rows() > 0) 
        {
            return $result->result_array();
        } 
        else 
        {
            return array();
        }
    }

 public function count_all()
    {
        $this->db->from('car_documentdelivery');
        return $this->db->count_all_results();
    }   

 public function get_one($id) 
    {
        $result = $this->db->query("
        SELECT cdd.iddocumentdelivery,cdd.entry_no,cdd.entry_date,cdd.transfer_date,cdd.idDispatch, car_dispatch.ChasisNo, car_dispatch.EngineNo,car_pbo.RegistrationNumber,cdd.delivered_to,
 car_pbo.PboNumber, car_dispatch.WarrantyBook,
 car_variants.Variants, car_color.ColorName,car_pbo.ActualSalePerson,
 cc.*,ci.InvoiceNumber,ci.InvoiceDate,car_pbo.PboNumber
FROM car_documentdelivery cdd
LEFT JOIN car_dispatch ON cdd.idDispatch = car_dispatch.idDispatch
LEFT JOIN car_pbo ON car_dispatch.PboId = car_pbo.Id
LEFT JOIN car_resource_book ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
LEFT JOIN car_variants ON car_dispatch.VariantId = car_variants.IdVariants
LEFT JOIN car_color ON car_dispatch.ColorId = car_color.IdColor

LEFT JOIN car_customer cc ON cc.IdCustomer = car_resource_book.CustomerId
Left join car_invoice ci on ci.DispatchId=car_dispatch.idDispatch 
where iddocumentdelivery = $id
        ");
//        $this->db->where('iddocumentdelivery', $id);
//        $result = $this->db->get('car_documentdelivery');

        if ($result->num_rows() == 1) 
        {
            return $result->row_array();
        } 
        else 
        {
            return array();
        }
    }   

 public function add()
    {
        $data = array(
            
                'entry_no' => $this->getEntryNo(),
            
                'entry_date' => '',
            
                'chasis_no' => '',
            
                'transfer_date' => '',
            
                'engine_no' => '',
            
                'IdVariants' => '',
            
                'IdColor' => '',
            
                'idordertype' => '',
            
                'delivered_to' => '',
            
                'current_address' => '',
            
                'city' => '',
                
                'telephone_no' => '',

                'mobile' => '',

                'email' => '',

                'nic_no' => '',

                'sales_certificate' => '',

                'transfer_letter' => '',

                'sale_invoice' => '',

                'navigation_card' => '',

                'warranty_book' => '',

            'EngineNo'  =>  '',
            'Variants'  =>  '',
            'ColorName' =>  '',
            'AddressDetails'    =>  '',
            'Telephone' =>  '',
            'Cellphone' =>  '',
            'Email' =>  '',
            'Cnic'  =>  '',
            'CustomerName' =>  '',
            'PboNumber' =>  '',
            'InvoiceNumber' =>  '',
            'InvoiceDate'  =>  ''






            
        );

        return $data;
    }   

public function save() 
    {
        $data = array(
        
                'entry_no' => $this->input->post('entry_no'),

                'idDispatch' => $this->input->post('idDispatch'),

                'entry_date' => $this->input->post('entry_date'),
            
                'transfer_date' => $this->input->post('transfer_date'),
            
                'delivered_to' => $this->input->post('delivered_to')
            

        
        );
        
        
        $this->db->insert('car_documentdelivery', $data);

        $id = $this->db->insert_id();
        foreach ($_POST['iddocument'] as $row)
        {
            $data = array(
              'iddocumentdelivery'  => $id,
              'iddocument'          => $row
            );
            $this->db->insert('car_documentdelivery_detail',$data);
        }

    }

public function update($id)
    {
        $data = array(

            'entry_date' => $this->input->post('entry_date'),

            'transfer_date' => $this->input->post('transfer_date'),

            'delivered_to' => $this->input->post('delivered_to')

        );


        $this->db->where('iddocumentdelivery', $id);
        $this->db->update('car_documentdelivery', $data);

        $this->db->where('iddocumentdelivery', $id)
            ->delete('car_documentdelivery_detail');

        foreach ($_POST['iddocument'] as $row)
        {
            $data = array(
                'iddocumentdelivery'  => $id,
                'iddocument'          => $row
            );
            $this->db->insert('car_documentdelivery_detail',$data);
        }


    }

public function getEntryNo()
{
	$this->db->select('entry_no');
	$result =  $this->db->get('car_documentdelivery')->row_array();
	$result = (int) $result + 1 ;
	return $result;
}   

public function getVariant()
{
	$this->db->select('*');
	$result =  $this->db->get('car_variants')->result_array();
	return $result;
}  

public function getColor()
{

	$this->db->select('*');
	$result =  $this->db->get('car_color')->result_array();
	return $result;
}

public function getOrderType()
{
	$this->db->select('*');
	$result =  $this->db->get('car_order_type')->result_array();
	return $result;
}

    public function get_all_dispatch()
    {
        return $this->db
            ->select('idDispatch,PboId,ChasisNo,EngineNo,RegistrationNumber')
            ->where('isDelivered',0)
            ->get('car_dispatch')
            ->result_array();

    }

    public function get_all_doc()
    {
        return $this->db
            ->get('document')
            ->result_array();

    }
    function getReceivedDocument($idDispatch)
    {
        return $this->db->
        select('document_request_detail.idDocument,document_request_detail.status,document.iddocument,document.documentname')
            ->from('document_request_detail')
            ->where('drs.idDispatch', $idDispatch)
            ->where('document_request_detail.status', 'RECEIVED')
            ->join('document', 'document.iddocument = document_request_detail.idDocument')
            ->join('document_receive_from_sales drs', 'drs.id = document_request_detail.idRequest')->get()
            ->result_array();

    }

    public function get_doc_dev_detail($id)
    {
        $data =  $this->db
            ->select('iddocument')
            ->where('iddocumentdelivery',$id)
            ->get('car_documentdelivery_detail')
            ->result_array();
        $res = array();
        foreach ($data as $row)
        {
            array_push($res,$row['iddocument']);
        }
        return $res;

    }
    function get_dispatch_data($iddispatch)
    {
        $query = "SELECT car_dispatch.ChasisNo, car_dispatch.EngineNo,car_pbo.RegistrationNumber,
 car_pbo.PboNumber, car_dispatch.WarrantyBook,
 car_variants.Variants, car_color.ColorName,car_pbo.ActualSalePerson,
 cc.*,ci.InvoiceNumber,ci.InvoiceDate,car_pbo.PboNumber
FROM car_dispatch
LEFT JOIN car_pbo ON car_dispatch.PboId = car_pbo.Id
LEFT JOIN car_resource_book ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
LEFT JOIN car_variants ON car_dispatch.VariantId = car_variants.IdVariants
LEFT JOIN car_color ON car_dispatch.ColorId = car_color.IdColor
LEFT JOIN car_customer cc ON cc.IdCustomer = car_resource_book.CustomerId
Left join car_invoice ci on ci.DispatchId=car_dispatch.idDispatch


WHERE car_dispatch.idDispatch = $iddispatch
                ";
        return $this->db->query($query)->row();
    }

    function get_received_documents($idDispatch)
    {
        return $this->db->query(
          "select d.iddocument,d.documentname,drd.`status`,ds.registered,ds.`type`
            from document_receive_from_sales ds 
            join document_request_detail drd
            on drd.idRequest = ds.id
            join document d
            on d.iddocument = drd.idDocument
            where ds.idDispatch=$idDispatch"
        )->result_array();
    }

}