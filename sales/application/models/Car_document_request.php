<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_document_request extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
////////////////////////////////////////////////////////////////////
public function getEnteryNo()
{
	$this->db->select('entry_no');
	$this->db->from ('s_doc_rq');
	$this->db->limit('1');
	$this->db->order_by('id_request','desc');
	$query=$this->db->get();
	
	return $query->result_array();
	
	
	
	
	}	
	////////////////////////////////////////////////////////////////////
	public function getDocumentRequest(){
	
	    $this->db->select('s_doc_rq.*,car_customer.IdCustomer,car_customer.CustomerName');
		$this->db->from('s_doc_rq');
                $this->db->join('car_customer', 's_doc_rq.sold_to = car_customer.IdCustomer');
		
	
		$result = $this->db->get();
		return $result->result_array();
           // print_r($result);
}
///////////////////////////////////////////////////////////////////
 public function getOneDocumentRequest($editKeyId) {
	 
        //$this->db->select("s_test_drive.*, s_testdrive_question.*");
		$this->db->select("s_doc_rq.*,car_user_profile.Id,car_user_profile.Username,car_customer.IdCustomer,car_customer.CustomerName,car_variants.Idvariants,car_variants.Variants");
		$this->db->join('car_customer', 's_doc_rq.sold_to = car_customer.IdCustomer');
                $this->db->join('car_variants', 's_doc_rq.vehicle = car_variants.Idvariants');
                $this->db->join('car_user_profile', 's_doc_rq.salesman = car_user_profile.Id');
                $this->db->from('s_doc_rq');
                
		
                
                //$this->db->join('car_color', 's_doc_rq.vehicle_color = car_color.IdColor');
                //$this->db->join('car_model', 's_doc_rq.model = car_model.IdModel');
				
		
		$this->db->where('s_doc_rq.id_request', $editKeyId);
	
        $result = $this->db->get()->result_array()[0];
		
        return $result;
		
    }
	////////////////////////////////////////////////////////////////////
	 public function getVariant() {
        $this->db->select("*");
		$this->db->where ('car_variants.test_drive = 1');
        $result = $this->db->get('car_variants')->result_array();
		//$this->db->join('car_variants', 's_test_drive.idvariants = car_variants.Idvariants');
        
		return $result;
    }
	 public function getSaleman() {
	// print_r($_POST);
        $this->db->select("*");
		$this->db->join ('car_app_role',' car_app_role.RoleId = car_user_profile.RoleId');
		$this->db->where ('car_app_role.RoleId = 3');
        $result = $this->db->get('car_user_profile')->result_array();
	return $result;
    }
////////////////////////////////////////////////////////////////////////////////

  	 public function getVariantColor() {
        $this->db->select("*");
		$result = $this->db->get('car_color')->result_array();
		//$this->db->join('car_variants', 's_test_drive.idvariants = car_variants.Idvariants');
        
		return $result;
    }
 public function getCustomer() {
        $this->db->select("*");
		$result = $this->db->get('car_customer')->result_array();
		//$this->db->join('car_variants', 's_test_drive.idvariants = car_variants.Idvariants');
        
		return $result;
    }
////////////////////////////////////////////////
	
///////////////////////////////////////////////
public function getCarModel() {
	// print_r($_POST);
        $this->db->select("*");
		 $result = $this->db->get('car_model')->result_array();
		//$this->db->join('car_variants', 's_test_drive.idvariants = car_variants.Idvariants');
        
		return $result;
    }
	//////////////////////////////////////////////////////////////////////////
    public function save() {
	
		//echo"haseeb";
		/*array(
			'database column key' => $this->input->post(''),
		);*/
		$testData = array(
///////////////////////////////////////////////////////////////////////
        'entry_no' => $this->input->post('entery_no'),
		'entry_date' => $this->input->post('entry_date'),
		'document_tx' => $this->input->post('document_tx'),
		'document' => $this->input->post('document'),
		'invoice_date' => $this->input->post('invoice_date'),
		'invoice_no' => $this->input->post('invoice_no'),
        'chasis_no' => $this->input->post('chasis_no'),
        'engine_no' => $this->input->post('engine_no'),
		'order_form_no' => $this->input->post('order_form_no'),
        'reg_no' => $this->input->post('reg_no'),
		'vehicle' => $this->input->post('vehicle'),
        'application' => $this->input->post('application'),
        'no_plate' => $this->input->post('no_plate'),
       'reg_book' => $this->input->post('reg_book'),
        'document' => $this->input->post('document'),
        'sold_to' => $this->input->post('sold_to'),
        'salesman' => $this->input->post('saleman'),
		'd_saleman' => $this->input->post('d_saleman'),
		
		
////////////////////////////////////////////////////////////////////////////
		);
		$this->db->insert('s_doc_rq', $testData);
		//$testData = $this->db->insert_id();
		//print_r($testData);
		//die;

    }
//////////////////////////////////////////////////////////////////////////////
  public function update() {

		$testData = array(

        'entry_no' => $this->input->post('entery_no'),
		'entry_date' => $this->input->post('entry_date'),
		'document_tx' => $this->input->post('document_tx'),
		'document' => $this->input->post('document'),
		'invoice_date' => $this->input->post('invoice_date'),
		'invoice_no' => $this->input->post('invoice_no'),
        'chasis_no' => $this->input->post('chasis_no'),
        'engine_no' => $this->input->post('engine_no'),
		'order_form_no' => $this->input->post('order_form_no'),
        'reg_no' => $this->input->post('reg_no'),
		'vehicle' => $this->input->post('vehicle'),
        'application' => $this->input->post('application'),
        'no_plate' => $this->input->post('no_plate'),
       'reg_book' => $this->input->post('reg_book'),
        'document' => $this->input->post('document'),
        'sold_to' => $this->input->post('sold_to'),
        'salesman' => $this->input->post('saleman'),
		'd_saleman' => $this->input->post('d_saleman'),
		
////////////////////////////////////////////////////////////////////////////
		);

		$this->db->where('s_doc_rq.entry_no',$this->input->post('entery_no'));
		$this->db->update('s_doc_rq', $testData);
		//$testData = $this->db->insert_id();
		//print_r($_POST);
		//die;

       
    }

//////////////////////////////////////////////////////////////////////////////////
}
