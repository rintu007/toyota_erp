<?php 

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_vehicle_registeration extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


    public function record_count()
    {
    	$this->db->from('vehicle_registeration');
        return $this->db->count_all_results();
    }

    public function getAll($limit , $start)
    {
        $this->db->select('*');
        $this->db->order_by('entry_date','desc');
        $this->db->limit($limit, $start);
        $result =  $this->db->get('vehicle_registeration')->result_array();
        return $result;
    }


    public function get_one($id) 
    {
        $this->db->where('entry_no', $id);
        $result = $this->db->get('vehicle_registeration');

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
    		'chasis_no'  => '',
    		'invoice_date' => '',
    		'engine_no'    => '',
    		'registered_for' => '',
    		'registeration_no' => '',
    		'registeration_city' => '',
    		'requested_registeration_city' => '',
    		'requested_registeration_no'   => '',
    		'father_name'     => '',
    		'idvariant'       => '',
    		'address'         => '',
    		'idcolor'         => '',
    		'nic_no'          => '',
    		'broker'          => '',
    		'idsalesman'      => '',
    		'cheque_no'       => '',
    		'cheque_date'     => '',
    		'amount'          => '',
    		'credit_account'  => '',
    		'debit_account'   => '',
    		'service_amount'  => '',



    		);

    	return $data;
    }

    public function save() 
    {
         $data =  array(

            'entry_no' => $this->input->post('entry_no'),

    		'entry_date' => $this->input->post('entry_date'),
          
            'chasis_no'   =>  $this->input->post('chasis_no'),

    		'registered_for' => $this->input->post('registered_for'),

    		'registeration_no' => $this->input->post('registeration_no'),

    		'registeration_city' => $this->input->post('registeration_city'),

    		'requested_registeration_city' => $this->input->post('requested_registeration_city'),

    		'requested_registeration_no'   => $this->input->post('requested_registeration_no'),

    		'broker'          => $this->input->post('broker'),

    		'idsalesman'      => $this->input->post('idsalesman'),

    		'cheque_no'       => $this->input->post('cheque_no'),

    		'cheque_date'     => $this->input->post('cheque_date'),

    		'amount'          => $this->input->post('amount'),

    		'credit_account'  => $this->input->post('credit_account'),

    		'debit_account'   => $this->input->post('debit_account'),

    		'service_amount'  => $this->input->post('service_amount'),
    		);
        
        
        $this->db->insert('vehicle_registeration', $data);
    }

    public function update($id) 
    {
         $data =  array(

            'entry_no' => $this->input->post('entry_no'),

    		'entry_date' => $this->input->post('entry_date'),
          
            'chasis_no'   =>  $this->input->post('chasis_no'),

    		'registered_for' => $this->input->post('registered_for'),

    		'registeration_no' => $this->input->post('registeration_no'),

    		'registeration_city' => $this->input->post('registeration_city'),

    		'requested_registeration_city' => $this->input->post('requested_registeration_city'),

    		'requested_registeration_no'   => $this->input->post('requested_registeration_no'),

    		'broker'          => $this->input->post('broker'),

    		'idsalesman'      => $this->input->post('idsalesman'),

    		'cheque_no'       => $this->input->post('cheque_no'),

    		'cheque_date'     => $this->input->post('cheque_date'),

    		'amount'          => $this->input->post('amount'),

    		'credit_account'  => $this->input->post('credit_account'),

    		'debit_account'   => $this->input->post('debit_account'),

    		'service_amount'  => $this->input->post('service_amount'),
    		);
        
        
        $this->db->where('entry_no', $id);
        $this->db->update('vehicle_registeration', $data);
    }

    public function getVariants()
    {
    	$this ->db->select('*');
    	$result =  $this->db->get('car_variants')->result_array();
    	return $result;

    }

    public function getColor()
    {
    	$this ->db->select('*');
    	$result =  $this->db->get('car_color')->result_array();
    	return $result;
    }

    public function getSalePerson()
    {
    	$this ->db->select('*');
    	$result =  $this->db->get('car_user_profile')->result_array();
    	return $result;
    }

    public function getAccount()
    {
    	$this ->db->select('*');
    	$result =  $this->db->get('chart_of_account')->result_array();
    	return $result;
    }

    public function getEntryNo()
    {
      $this->db->select_max('entry_no');
      $result =  $this->db->get('vehicle_registeration')->row_array(); 
      return ((int)$result['entry_no']  + 1) ;
    }

    public function getChasisNo()
    {
    	$this ->db->select('ChasisNo,EngineNo');
    	$result =  $this->db->get('car_dispatch')->result_array();
    	return $result;
    }

    public function getDetail()
    {
    	$chasis_no =  $this->input->post('chasis_no');
    	$this ->db->select('EngineNumber,InvoiceDate,IdVariants,IdColor,FatherName,Cnic,AddressDetails');
    	$this->db->where('ChasisNumber',$chasis_no);
    	$result =  $this->db->get('viewinvoice')->row_array();
    	return $result;
    }

    public function getEditDetail($chasis_no)
    {
    	$this ->db->select('EngineNumber,InvoiceDate,IdVariants,IdColor,FatherName,Cnic,AddressDetails');
    	$this->db->where('ChasisNumber',$chasis_no);
    	$result =  $this->db->get('viewinvoice')->row_array();
    	return $result;
    }

}














?>