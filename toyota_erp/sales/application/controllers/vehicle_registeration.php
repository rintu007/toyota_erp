<?php


if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vehicle_registeration extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Car_vehicle_registeration');
        $this->load->library('form_validation');
    }


    public function index(){


    	$config = array();
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 1;
        $config["base_url"] = base_url() . "index.php/vehicle_registeration/index";
        $config["total_rows"] = $this->Car_vehicle_registeration->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $data["vehicle_registeration"] = $this->Car_vehicle_registeration->getAll($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $this->load->view('header');
        $this->load->view('view_vehicle_registeration', $data);
        $this->load->view('footer');
    }


    public function add() 
    {       
        $data['vehicle_registeration'] = $this->Car_vehicle_registeration->add();
        $data['variants']              = $this->Car_vehicle_registeration->getVariants();
        $data['color']                 = $this->Car_vehicle_registeration->getColor();
        $data['saleperson']            = $this->Car_vehicle_registeration->getSalePerson();
        $data['account']               = $this->Car_vehicle_registeration->getAccount();
        $data['chasis_no']             = $this->Car_vehicle_registeration->getChasisNo();
        $data['action']  = 'vehicle_registeration/save';
        $this->load->view('header');
        $this->load->view('vehicle_registration', $data);
        $this->load->view('footer');

    }


    public function save($id =NULL) 
    {
        
        if(!$id)
        {    
                 

                  
                      if ($this->input->post()) 
                      {
                          
                          $this->Car_vehicle_registeration->save();
                          redirect('vehicle_registeration');
                      }
                  
                  
         }
         else // Update data if Form Edit send Post and ID available
         {               

                    if ($this->input->post()) 
                    {
                        $this->Car_vehicle_registeration->update($id);
                        redirect('index.php/vehicle_registeration');
                    }
                
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }


    public function edit($id='') 
    {
        if ($id != '') 
        {

        $data['vehicle_registeration'] = $this->Car_vehicle_registeration->get_one($id);
        $result                        = $this->Car_vehicle_registeration->getEditDetail($data['vehicle_registeration']['chasis_no']);              $data['vehicle_registeration']['invoice_date']  = $result['InvoiceDate'];
        $data['vehicle_registeration']['engine_no']     = $result['EngineNumber'];
        $data['vehicle_registeration']['idvariant']     = $result['IdVariants'];
        $data['vehicle_registeration']['idcolor']     = $result['IdColor'];
        $data['vehicle_registeration']['father_name']     = $result['FatherName'];
        $data['vehicle_registeration']['nic_no']     = $result['Cnic'];
        $data['vehicle_registeration']['address']     = $result['AddressDetails'];
        $data['variants']              = $this->Car_vehicle_registeration->getVariants();
        $data['color']                 = $this->Car_vehicle_registeration->getColor();
        $data['saleperson']            = $this->Car_vehicle_registeration->getSalePerson();
        $data['account']               = $this->Car_vehicle_registeration->getAccount();
        $data['chasis_no']             = $this->Car_vehicle_registeration->getChasisNo();
        $data['action']  = 'vehicle_registeration/save/' . $id;
        $this->load->view('header');
        $this->load->view('vehicle_registration', $data);
        $this->load->view('footer');
        }
        else 
        {
            
            redirect(site_url('index.php/vehicle_registration'));
        }
    }


    public function getDetail()
    {
    	$result =  $this->Car_vehicle_registeration->getDetail();
    	echo json_encode($result);
    }


}











?>