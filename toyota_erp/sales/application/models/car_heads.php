<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_heads extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function getEnteryNo() {
        $this->db->select_max('idheading');
        $result = $this->db->get('pds_inputs')->row_array();
        return ((int) $result['idheading'] + 1 );
    }
///////////////////
    public function save() {

        $data_visitplan = array(
            'entery_no' => $this->input->post('entery_no'),
			'heading' => $this->input->post('heading'),
           
        );

        $this->db->insert('pds_headings', $data_visitplan);

        $idvisitplan = $this->db->insert_id();

        $sale_person = $this->input->post('sale_person');
       

        for ($i = 0; $i < count($sale_person); $i++) {

            $data_visitplandetail = array(
                'idheading' => $idvisitplan,
                'name' => $sale_person[$i],
              
            );

            $this->db->insert('pds_inputs', $data_visitplandetail);
        }
    }
/////////////////////////////////////////////////
		 public function edit() {
			  $data_visitplan = array(
            'entery_no' => $this->input->post('entery_no'),
			'heading' => $this->input->post('heading'),
           
        );
		
		$this->db->where('entery_no', $data_visitplan['entery_no']);
        $this->db->update('pds_headings', $data_visitplan);
		
		
		$id = $this->input->post('idInput');
		$idsaleman = $this->input->post('idsaleman');
		
       for ($i = 0; $i < count($id); $i++) {

            $data_visitplandetail = array(
                'id' => $id[$i],
                'name' => $idsaleman[$i],
              
            );

            $this->db->where('id', $id[$i]);
        $this->db->update('pds_inputs', $data_visitplandetail);
			
        }
		
		
       
    }
    

   
	//////////////////////////////
    public function getSalePerson() {
        $this->db->select("*");
        $result = $this->db->get('pds_headings')->result_array();
        return $result;
		
    }
	
	////////////////////////////////
    public function getLocation() {
       $this->db->select("*");
        $result = $this->db->get('car_location')->result_array();
        return $result;
     }

    public function getOneVisitPlan($id) {
        $this->db->select("*");
        $this->db->where('id', $id);
        $result = $this->db->get('pds_headings')->row_array();
        return $result;
		
    }

    public function getVisitPlanDetail($id) {
        $this->db->select("*");
        $this->db->where('idheading', $id);
        $result = $this->db->get('pds_inputs')->result_array();
        return $result;
		
    }
		///////////////////////////
		public function getPds() {
        $this->db->select("pds_headings.*");
       // $this->db->join('pds_headings', 'pds_headings.id =  pds_inputs.idheading');
       //$this->db->order_by('pds_headings.entery_no', 'DESC');
        $result = $this->db->get('pds_headings')->result_array();
        return $result;
		//print_r($result);
    }
}

?>