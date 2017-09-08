<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Documentdelivery extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('car_documentdelivery');
        $this->load->library("pagination");


    }

    public function index() 
    {


        $config['base_url'] = '<?=base_url()?>index.php/documentdelivery';
        $config['total_rows'] = $this->car_documentdelivery->count_all();
        $config['per_page'] = 20;

        $this->pagination->initialize($config);

        $data['documentdelivery'] = $this->car_documentdelivery->get_all();
        $data['pagination']       = $this->pagination->create_links();
        $this->load->view('header');
        $this->load->view('document_deliveryview',$data);
        $this->load->view('footer');
    }

    public function add() 
    {       
        $data['documentdelivery']   = $this->car_documentdelivery->add();
        $data['dispatch']           = $this->car_documentdelivery->get_all_dispatch();
        $data['docs']               = $this->car_documentdelivery->get_all_doc();
        $data['action']             = 'documentdelivery/save';
        
        $this->load->view('header');
        $this->load->view('document_delivery',$data);
        $this->load->view('footer');

    }

    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['documentdelivery']   = $this->car_documentdelivery->get_one($id);
            $data['action']             = 'documentdelivery/save/' . $id;
            $data['docs']               = $this->car_documentdelivery->get_all_doc();
            $data['doc_detail']         = $this->car_documentdelivery->get_doc_dev_detail($id);
            $this->load->view('header');
            $this->load->view('document_delivery',$data);
            $this->load->view('footer');
            
        }
        else 
        {
            redirect(site_url('index.php/documentdelivery'));
        }
    }

    public function save($id =NULL) 
    {
        
        // if id NULL then add new data
        if(!$id) {


            if ($this->input->post()) {

                $this->car_documentdelivery->save();
                $this->session->set_flashdata('message', "Added Successfully");
                redirect('index.php/documentdelivery/add');
            } else // If validation incorrect
            {
                $this->add();
            }
         }
         else // Update data if Form Edit send Post and ID available
         {               
                

                
                    if ($this->input->post()) 
                    {
                        $this->car_documentdelivery->update($id);
                        $this->session->set_flashdata('message', "Record Updated Successfully");
                        redirect('index.php/documentdelivery/index');
                    }
                
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    public function get_dispatch_data()
    {
        $data = $this->car_documentdelivery->get_dispatch_data($_POST['idDispatch']);
        echo json_encode($data);


    }




}
