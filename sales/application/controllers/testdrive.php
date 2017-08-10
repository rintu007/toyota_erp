<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testdrive extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_test_drive');
        $this->load->library('form_validation');
    }

   /* public function index() {
        $this->load->view('header');
        $this->load->view('test_drive');
        $this->load->view('footer');
    }*/
	 public function add($id = '') {

        if ($id == '') {
			$enteryNum = $this->Car_test_drive->getEnteryNo();
			//print_r($enteryNum);
			
			
			
			if (isset($enteryNum[0]['entry_no']) && $enteryNum[0]['entry_no']>0){
				$entry=$enteryNum[0]['entry_no']+1;
				}
				else 
				{
				$entry=1;
				}
			
			//echo $entry;
			
		//	die;
            $data = array(
                           
				'Variants' => $this->Car_test_drive ->getVariant(),
				'Salemans' => $this->Car_test_drive ->getSaleman(),  
				'entery_no' => $entry,
				'Model_no' => $this->Car_test_drive ->getCarModel() ,
				
				//'testData' => $this->Car_test_drive ->save() ,
				//'TestDriveData' => $this->Car_test_drive ->save()
				                
            );
			//print_r($data['entery_no']);
			//$this->data['testDrive'] = $this->Car_test_drive->allTestDrive();
            $this->load->view('header');
            $this->load->view('test_drive_add', $data);
			//$this->load->view('view_test_drive', $data);
            $this->load->view('footer');
        } 
	 }
		/////////////////////////////////////////////////
	public function save() {		
        $this->Car_test_drive->save();
       redirect(base_url() . "index.php/testdrive/add");
    }
		
	/////////////////////////////////////////////////////
	
	public function view() {
		  $data = array(
                         
				  'testDrive' => $this->Car_test_drive->getTestDrive()
			                
            );
			//print_r($data['testDrive']);
		
		
        $this->load->view('header');
        $this->load->view('test_drive_show',$data);
        $this->load->view('footer');
    }
		///////////////////////////////////
	
		////////////////////////////////
		public function edit($editKey = '') {
				
			
		 $data = array(
                           
				'Variants' => $this->Car_test_drive ->getVariant(),
				'Salemans' => $this->Car_test_drive ->getSaleman(),  
				'Model_no' => $this->Car_test_drive ->getCarModel() ,
				'testDrivedetail' => $this->Car_test_drive->getOneTestDrive($editKey)
				
				                
            );
			
        $this->load->view('header');
        $this->load->view('test_drive_edit',$data);
        $this->load->view('footer');
    }
		
		public function update() {	
		
        $this->Car_test_drive->update();
       redirect(base_url() . "index.php/testdrive/view");
    }
		
		
		//////////////////////////////
    }

