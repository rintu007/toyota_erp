<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_document_excise extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
////////////////////////////////////////////////////////////////////
public function getEnteryNo()
{
	$this->db->select('entry_no');
	$this->db->from ('s_doc_excise');
	$this->db->limit('1');
	$this->db->order_by('id_excise','desc');
	$query=$this->db->get();
	
	return $query->result_array();
	
	
	
	
	}	
	////////////////////////////////////////////////////////////////////
	public function getDocumentExisce(){
	
	    $this->db->select('s_doc_excise.*,car_customer.IdCustomer,car_customer.CustomerName');
		$this->db->from('s_doc_excise');
                $this->db->join('car_customer', 's_doc_excise.sold_to = car_customer.IdCustomer');
		
	
		$result = $this->db->get();
		return $result->result_array();
           // print_r($result);
}
	////////////////////////////////////////////////////////////////////
	 public function getVariant() {
        $this->db->select("*");
		$this->db->where ('car_variants.test_drive = 1');
        $result = $this->db->get('car_variants')->result_array();
		//$this->db->join('car_variants', 's_test_drive.idvariants = car_variants.Idvariants');
        
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
 public function getOneDocumentExisce($editKeyId) {
	 
        //$this->db->select("s_test_drive.*, s_testdrive_question.*");
		$this->db->select("s_doc_excise.*,car_model.IdModel,car_model.Model,car_color.IdColor,car_color.ColorName,car_customer.IdCustomer,car_customer.CustomerName,car_variants.Idvariants,car_variants.Variants");
		$this->db->from('s_doc_excise');
                
		
                $this->db->join('car_customer', 's_doc_excise.sold_to = car_customer.IdCustomer');
                $this->db->join('car_variants', 's_doc_excise.vehicle = car_variants.Idvariants');
                $this->db->join('car_color', 's_doc_excise.vehicle_color = car_color.IdColor');
                $this->db->join('car_model', 's_doc_excise.model = car_model.IdModel');
		
		$this->db->where('s_doc_excise.id_excise', $editKeyId);
		///////////////////////
		
		////////////////////////////////////////////////////////////////
        $result = $this->db->get()->result_array()[0];
		
        return $result;
		
    }	
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
	//print_r($_POST);
		//die;
		//echo"haseeb";
		/*array(
			'database column key' => $this->input->post(''),
		);*/
		$testData = array(
///////////////////////////////////////////////////////////////////////
        'entry_no' => $this->input->post('entery_no'),
		'entry_date' => $this->input->post('entry_date'),
		'invoice_date' => $this->input->post('invoice_date'),
        'chasis_no' => $this->input->post('chasis_no'),
        'engine_no' => $this->input->post('engine_no'),
        'reg_no' => $this->input->post('reg_no'),
		'vehicle' => $this->input->post('vehicle'),
        'vehicle_color' => $this->input->post('vehicle_color'),
        'no_plate' => $this->input->post('no_plate'),
       'reg_book' => $this->input->post('reg_book'),
        'document' => $this->input->post('document'),
        'sold_to' => $this->input->post('sold_to'),
        'model' => $this->input->post('model'),
		
////////////////////////////////////////////////////////////////////////////
		);
		$this->db->insert('s_doc_excise', $testData);
		//$testData = $this->db->insert_id();
		//print_r($testData);
		//die;

    }
//////////////////////////////////////////////////////////////////////////////
  public function update() {
		print_r($_POST);
		//die;
		//echo"haseeb";
		/*array(
			'database column key' => $this->input->post(''),
		);*/
		$testData = array(
///////////////////////////////////////////////////////////////////////
        'entry_no' => $this->input->post('entery_no'),
		'entry_date' => $this->input->post('entry_date'),
		'invoice_date' => $this->input->post('invoice_date'),
        'chasis_no' => $this->input->post('chasis_no'),
        'engine_no' => $this->input->post('engine_no'),
        'reg_no' => $this->input->post('reg_no'),
		'vehicle' => $this->input->post('vehicle'),
        'vehicle_color' => $this->input->post('vehicle_color'),
        'no_plate' => $this->input->post('no_plate'),
       'reg_book' => $this->input->post('reg_book'),
        'document' => $this->input->post('document'),
        'sold_to' => $this->input->post('sold_to'),
        'model' => $this->input->post('model'),
		
////////////////////////////////////////////////////////////////////////////
		);
		
		$this->db->where('s_doc_excise.entry_no',$this->input->post('entery_no'));
		$this->db->update('s_doc_excise', $testData);
		//$testData = $this->db->insert_id();
		//print_r($_POST);
		//die;

       
    }

//////////////////////////////////////////////////////////////////////////////////
}
