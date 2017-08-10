<?php

/**
* 
*/
class Call_res_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
		$this->load->library('session');
	}

public function fetch(){

$ronum=$this->input->post('RONumber');
$que=$this->db->query('select * from call_res left join call_res2 on call_res2.RONumber=call_res.RONumber where call_res.RONumber="'.$ronum.'"');
$res=$que->result_array();
return json_encode($res);
}




public function insert(){
	$ronum=$this->input->post('RONumber');

$que=$this->db->query('select RONumber from call_res where RONumber="'.$ronum.'"');
$res=$que->result_array();

$c=count($res);
if($c>0)//1=add;0=update;
{
	$bit=0;
}
else{
	$bit=1;	
}


$call_res=array(
'RONumber'=>$ronum,
 'datetime1'=>$this->input->post('datetime1'),
  'contact1'=>$this->input->post('contact1'), 
  'appoin1'=>$this->input->post('appoin1'),
   'rea1'=>$this->input->post('rea1'),
   'drop1'=>$this->input->post('drop1'),
    'act1_1'=>$this->input->post('act1_1'), 
    'act1_2'=>$this->input->post('act1_2'),
     'act1_3'=>$this->input->post('act1_3'),
      'act1_4'=>$this->input->post('act1_4'),
       'datetime2'=>$this->input->post('datetime2'),
        'datetime3'=>$this->input->post('datetime3'),
         'contact2'=>$this->input->post('contact2'),
          'contact3'=>$this->input->post('contact3'), 
          'appoin2'=>$this->input->post('appoin2'),
           'appoin3'=>$this->input->post('appoin3'), 
           'rea2'=>$this->input->post('rea2'),
            'rea3'=>$this->input->post('rea3'), 
            'drop2'=>$this->input->post('drop2'),
             'drop3'=>$this->input->post('drop3'),
              'act2_1'=>$this->input->post('act2_1'),
               'act3_1'=>$this->input->post('act3_1'),
                'act2_2'=>$this->input->post('act2_2'),
                 'act3_2'=>$this->input->post('act3_2'),
                  'act2_3'=>$this->input->post('act2_3'), 
                  'act3_3'=>$this->input->post('act3_3'), 
                  'act2_4'=>$this->input->post('act2_4'),
                   'act3_4'=>$this->input->post('act3_4'),
 'root'=>$this->input->post('root'),
  'mea'=>$this->input->post('mea'),
                   );
$call_res2=array(
'RONumber'=>$ronum,
 '2datetime1'=>$this->input->post('2datetime1'),
  '2contact1'=>$this->input->post('2contact1'), 
  '2appoin1'=>$this->input->post('2appoin1'),
   '2rea1'=>$this->input->post('2rea1'),
   '2drop1'=>$this->input->post('2drop1'),
    '2act1_1'=>$this->input->post('2act1_1'), 
    '2act1_2'=>$this->input->post('2act1_2'),
     '2act1_3'=>$this->input->post('2act1_3'),
      '2act1_4'=>$this->input->post('2act1_4'),
       '2datetime2'=>$this->input->post('2datetime2'),
        '2datetime3'=>$this->input->post('2datetime3'),
         '2contact2'=>$this->input->post('2contact2'),
          '2contact3'=>$this->input->post('2contact3'), 
          '2appoin2'=>$this->input->post('2appoin2'),
           '2appoin3'=>$this->input->post('2appoin3'), 
           '2rea2'=>$this->input->post('2rea2'),
            '2rea3'=>$this->input->post('2rea3'), 
            '2drop2'=>$this->input->post('2drop2'),
             '2drop3'=>$this->input->post('2drop3'),
              '2act2_1'=>$this->input->post('2act2_1'),
               '2act3_1'=>$this->input->post('2act3_1'),
                '2act2_2'=>$this->input->post('2act2_2'),
                 '2act3_2'=>$this->input->post('2act3_2'),
                  '2act2_3'=>$this->input->post('2act2_3'), 
                  '2act3_3'=>$this->input->post('2act3_3'), 
                  '2act2_4'=>$this->input->post('2act2_4'),
                   '2act3_4'=>$this->input->post('2act3_4')

                   );
if($bit==1){
if($this->db->insert('call_res',$call_res) && $this->db->insert('call_res2',$call_res2)){
	$this->session->set_userdata('done','Updated');
	redirect('index.php/call_res','refresh');
}
}
else{

if($this->db->update('call_res',$call_res) && $this->db->update('call_res2',$call_res2)){
	$this->session->set_userdata('done','Updated');
	redirect('index.php/call_res','refresh');
}
}
}

}


?>