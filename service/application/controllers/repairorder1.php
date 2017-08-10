
<?php
/**
* 
*/
class Repairorder1 extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('s_repairorder');
		$this->load->helper('url');
	}
	public function index(){
		   $this->load->view('header');
        $this->load->view('mrs1' );
        $this->load->view('footer');
	}

public function fa_last(){
	    $repair_model =  new s_repairorder();
	   
	echo $repair_model->fa_la();

}

public function up(){
	 $repair_model =  new s_repairorder();
$repair_model->up_last();
} 

}
?>