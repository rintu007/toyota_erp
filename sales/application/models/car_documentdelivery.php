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

        $result = $this->db->get('car_documentdelivery');

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
        $this->db->where('iddocumentdelivery', $id);
        $result = $this->db->get('car_documentdelivery');

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





            
        );

        return $data;
    }   

public function save() 
    {
        $data = array(
        
                'entry_no' => $this->input->post('entry_no'),
            
                'entry_date' => $this->input->post('entry_date'),
            
                'chasis_no' => $this->input->post('chasis_no'),
            
                'transfer_date' => $this->input->post('transfer_date'),
            
                'engine_no' => $this->input->post('engine_no'),
            
                'IdVariants' => $this->input->post('IdVariants'),
            
                'IdColor' => $this->input->post('IdColor'),
            
                'idordertype' => $this->input->post('idordertype'),
            
                'delivered_to' => $this->input->post('delivered_to'),
            
                'current_address' => $this->input->post('current_address'),
            
                'city' => $this->input->post('city'),
                
                'telephone_no' => $this->input->post('telephone_no'),

                'mobile' => $this->input->post('mobile'),

                'email' => $this->input->post('email'),

                'nic_no' => $this->input->post('nic_no'),

                'sales_certificate' => $this->input->post('sales_certificate'),

                'transfer_letter' => $this->input->post('transfer_letter'),

                'sale_invoice' => $this->input->post('sale_invoice'),

                'navigation_card' => $this->input->post('navigation_card'),

                'warranty_book' => $this->input->post('warranty_book'),
        
        );
        
        
        $this->db->insert('car_documentdelivery', $data);
    }

public function update($id)
    {
        $data = array(
        
                'entry_no' => $this->input->post('entry_no'),
            
                'entry_date' => $this->input->post('entry_date'),
            
                'chasis_no' => $this->input->post('chasis_no'),
            
                'transfer_date' => $this->input->post('transfer_date'),
            
                'engine_no' => $this->input->post('engine_no'),
            
                'IdVariants' => $this->input->post('IdVariants'),
            
                'IdColor' => $this->input->post('IdColor'),
            
                'idordertype' => $this->input->post('idordertype'),
            
                'delivered_to' => $this->input->post('delivered_to'),
            
                'current_address' => $this->input->post('current_address'),
            
                'city' => $this->input->post('city'),
                
                'telephone_no' => $this->input->post('telephone_no'),

                'mobile' => $this->input->post('mobile'),

                'email' => $this->input->post('email'),

                'nic_no' => $this->input->post('nic_no'),

                'sales_certificate' => $this->input->post('sales_certificate'),

                'transfer_letter' => $this->input->post('transfer_letter'),

                'sale_invoice' => $this->input->post('sale_invoice'),

                'navigation_card' => $this->input->post('navigation_card'),

                'warranty_book' => $this->input->post('warranty_book'),
        
        );
        
        
        $this->db->where('iddocumentdelivery', $id);
        $this->db->update('car_documentdelivery', $data);
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

}