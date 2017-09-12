<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_test_drive extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
 
	
	
//////////////////////////////////////////////////
 
/////////////////////////////////////////

public function getEnteryNo()
{
	$this->db->select('entry_no');
	$this->db->from ('s_test_drive');
	$this->db->limit('1');
	$this->db->order_by('id_testdrive','desc');
	$query=$this->db->get();
	
	return $query->result_array();
	
	
	
	
	}
//////////////////////////////////

 public function getVariant() {
        $this->db->select("*");
		$this->db->where ('car_variants.test_drive = 1');
        $result = $this->db->get('car_variants')->result_array();
		//$this->db->join('car_variants', 's_test_drive.idvariants = car_variants.Idvariants');
        
		return $result;
    }
////////////////////////////////////////////////////////////////////////////////
 public function getSaleman() {
	// print_r($_POST);
        $this->db->select("*");
		$this->db->join ('car_app_role',' car_app_role.RoleId = car_user_profile.RoleId');
		$this->db->where ('car_app_role.RoleId = 3');
        $result = $this->db->get('car_user_profile')->result_array();
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
/////////////////////////////////////////////////////////////////////////

public function getTestDrive(){
	
	    $this->db->select('*');
		$this->db->from('s_test_drive');
		$this->db->join('s_testdrive_question', 's_test_drive.id_testdrive = s_testdrive_question.id_testdrive');
	
		$result = $this->db->get();
		return $result->result_array();
}



 public function getOneTestDrive($editKeyId) {
	 
        //$this->db->select("s_test_drive.*, s_testdrive_question.*");
		$this->db->select("
			s_test_drive.*,
			s_testdrive_question.*,
			car_model.IdModel,car_model.Model,
			car_variants.Variants,car_variants.IdVariants,
			car_user_profile.FullName,car_user_profile.Id AS SALEMAN
			
		");
		$this->db->from('s_test_drive');
		$this->db->join('car_model', 's_test_drive.existing_vehical = car_model.IdModel');
		
		$this->db->join('car_variants', 's_test_drive.id_variants = car_variants.IdVariants');
		
		$this->db->join('car_user_profile', 's_test_drive.id_saleman = car_user_profile.Id');
      	$this->db->join('s_testdrive_question', 's_test_drive.id_testdrive = s_testdrive_question.id_testdrive');
		$this->db->where('s_test_drive.id_testdrive', $editKeyId);
		///////////////////////
		
		////////////////////////////////////////////////////////////////
        $result = $this->db->get()->result_array()[0];
		
        return $result;
		
    }
	 public function getTest($id) {
        $this->db->select("*");
        $this->db->where('id_testdrive', $id);
        $result = $this->db->get('s_test_drive')->result_array();
        return $result;
    }   
///////////////////////////////////////////////////////////////////////
public function update() {
		
		$testData = array(
///////////////////////////////////////////////////////////////////////
        'entry_no' => $this->input->post('entery_no'),
		'entry_date' => $this->input->post('entry_date'),
        'suggetion' => $this->input->post('suggestion'),
        'customer_name' => $this->input->post('customer_name'),
        'address' => $this->input->post('address'),
		'mobile_no' => $this->input->post('mobile_no'),
        'telephone' => $this->input->post('telephone'),
        'email_address' => $this->input->post('email_address'),
       'occupation' => $this->input->post('occupation'),
        'license_no' => $this->input->post('license_no'),
        'id_variants' => $this->input->post('ExistingVehicle'),
        'existing_vehical' => $this->input->post('Model'),
		'id_saleman' => $this->input->post('Saleman'),
        'is_interest' => $this->input->post('is_interest'),
        'is_intended' => $this->input->post('is_intended')
////////////////////////////////////////////////////////////////////////////
		);
		
		$this->db->where('s_test_drive.entry_no',$this->input->post('entery_no'));
		$this->db->update('s_test_drive', $testData);
	
		$testDriveData = array(
		'id_testdrive' => $this->input->post('id_testdrive'),
		'shifting_gear' => $this->input->post('shifting_gear'),
        'ease_drive' => $this->input->post('ease_drive'),
        'acceleration' => $this->input->post('acceleration'),
       'quitness_engine' => $this->input->post('quitness_engine'),
		'brake_impact' => $this->input->post('brake_impact'),
        'driving_experience' => $this->input->post('drive_experience')
//////////////////////////////////////////////////////////////////////////////
  		 );
	
			$this->db->where('s_testdrive_question.id_testdrive',$this->input->post('id_testdrive'));
		$this->db->update('s_testdrive_question', $testDriveData);
	
        
    }
///////////////////////////////////////////////////////////////////////
 public function save() {
		//print_r($_POST);
		//die;
		
		/*array(
			'database column key' => $this->input->post(''),
		);*/
		$testData = array(
///////////////////////////////////////////////////////////////////////
        'entry_no' => $this->input->post('entery_no'),
		'entry_date' => $this->input->post('entry_date'),
        'suggetion' => $this->input->post('suggestion'),
        'customer_name' => $this->input->post('customer_name'),
        'address' => $this->input->post('address'),
		'mobile_no' => $this->input->post('mobile_no'),
        'telephone' => $this->input->post('telephone'),
        'email_address' => $this->input->post('email_address'),
       'occupation' => $this->input->post('occupation'),
        'license_no' => $this->input->post('license_no'),
        'id_variants' => $this->input->post('ExistingVehicle'),
        'existing_vehical' => $this->input->post('Model'),
		'id_saleman' => $this->input->post('Saleman'),
        'is_interest' => $this->input->post('is_interest'),
        'is_intended' => $this->input->post('is_intended')
////////////////////////////////////////////////////////////////////////////
		);
		$this->db->insert('s_test_drive', $testData);
		$testData = $this->db->insert_id();
		
///////////////////////////////////////////////////////////////
		$testDriveData = array(
		'id_testdrive' => $testData,
		'shifting_gear' => $this->input->post('shifting_gear'),
        'ease_drive' => $this->input->post('ease_drive'),
        'acceleration' => $this->input->post('acceleration'),
       'quitness_engine' => $this->input->post('quitness_engine'),
		'brake_impact' => $this->input->post('brake_impact'),
        'driving_experience' => $this->input->post('drive_experience')
   //////////////////////////////////////////////////////////////////////////////
  		 );
		$this->db->insert('s_testdrive_question', $testDriveData);
	

//////////////////////////////////////////////////////////////////////////////////
       
    }


//////////////////////////////////
}
