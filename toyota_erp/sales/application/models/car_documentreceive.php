<?php
/**
 * Created by PhpStorm.
 * User: Shah Saqib
 * Date: 8/30/2017
 * Time: 11:49 AM
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class car_documentreceive extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function count_all_imc()
    {
        $this->db->from('document_receive');
        return $this->db->count_all_results();
    }

    function get_all_imc()
    {
        return $this->db->query("
        select drfs.*,u.Username,cd.ChasisNo,cd.EngineNo,cd.RegistrationNumber
        from document_receive drfs
        
        
        
        left join car_user_profile u
        on u.Id=drfs.userid
        
        join car_dispatch cd
        on cd.idDispatch = drfs.idDispatch
        group by drfs.idDispatch
        order by drfs.created_at
        ")->result_array();
    }

    public function get_all_docs()
    {
        return $this->db->get('document')->result_array();
    }

    public function get_all_dist_docs()
    {
        return $this->db->query('
select cd.idDispatch,PboId,ChasisNo,EngineNo,RegistrationNumber 
from car_dispatch cd
                left join document_receive dr
                on cd.idDispatch =dr.idDispatch
                where dr.id is null')->result_array();
    }

    public function get_all_docs_req($idDispatch)
    {
        return $this->db->query("
        select document.* ,dr.idDispatch,dr.action
                from document
                left join document_receive_from_sales dr  
                on dr.iddocument=document.iddocument and dr.idDispatch=$idDispatch
        ")->result_array();
    }

    public function get_all_excise_doc_req($idDispatch)
    {
        return $this->db->query("
        select document.* ,dr.idDispatch,dr.action,dr.id,dr.created_at
                from document
                left join document_receive_from_excise dr  
                on dr.iddocument=document.iddocument and dr.idDispatch=$idDispatch
        ")->result_array();
    }

    public function get_dist_dispatch()
    {
        return $this->db
            ->query("select cd.idDispatch,PboId,ChasisNo,EngineNo,RegistrationNumber from car_dispatch cd
                left join document_receive dr
                on cd.idDispatch =dr.idDispatch
                where dr.id is null")
            ->result_array();

    }
    public function get_dispatch($idDispatch)
    {
        return $this->db
            ->query("select cd.idDispatch,PboId,ChasisNo,EngineNo,RegistrationNumber from car_dispatch cd
                left join document_receive dr
                on cd.idDispatch =dr.idDispatch
                where cd.idDispatch=$idDispatch")
            ->result_array();

    }
    public function get_all_req_filtered_dispatch()
    {
        return $this->db
            ->query("SELECT cd.idDispatch,PboId,ChasisNo,EngineNo,RegistrationNumber,dr.id
FROM car_dispatch cd
LEFT JOIN document_receive_from_sales dr ON cd.idDispatch =dr.idDispatch
WHERE dr.id IS NULL")
//            ->select('idDispatch,PboId,ChasisNo,EngineNo,RegistrationNumber')
//            ->get('car_dispatch')
            ->result_array();

    }

    public function get_all_doc_request()
    {
       return $this->db->query('SELECT drfs.*,cd.ChasisNo,cd.EngineNo,cd.RegistrationNumber,drfs.created_at
                            FROM document_receive_from_sales drfs
                            JOIN car_dispatch cd ON cd.idDispatch = drfs.idDispatch
                            ORDER BY drfs.created_at desc')->result_array();

    }

    public function receive()
    {

        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];

        if(isset($_POST) and count($_POST)>0)
        {
            foreach ($_POST['iddocument'] as $row)
            {
               if( ($this->exist($row,$_POST['idDispatch'])) == 0) {
                   $data = array(
                       'iddocument' => $row,
                       'idDispatch' => $_POST['idDispatch'],
                       'userid'     => $UserId
                   );
                   $this->db->insert('document_receive', $data);
               }
            }
        return true;
        }
        return false;
    }

    function getDocumentreceive($idDispatch)
    {
        return $this->db->
        select('document_receive.idDispatch,document.iddocument,document.documentname')
            ->from('document_receive')
            ->where('idDispatch', $idDispatch)
            ->join('document', 'document.iddocument = document_receive.iddocument')->get()
            ->result_array();

    }

    function getRequestedDocument($id)
    {
        return $this->db->
        select('document_request_detail.idDocument,document_request_detail.status,document.iddocument,document.documentname,document_receive_from_sales.remarks')
            ->from('document_request_detail')
            ->where('idRequest', $id)
            ->join('document', 'document.iddocument = document_request_detail.idDocument')
            ->join('document_receive_from_sales', 'document_receive_from_sales.id = document_request_detail.idRequest')->get()
            ->result_array();

    }

    function getDispatch($idDispatch)
    {
        return $this->db->where('idDispatch',$idDispatch)->get('car_dispatch')->row();

    }


    function exist($iddocument,$idDispatch)
    {
        return $this->db
            ->where('iddocument',$iddocument)
            ->where('idDispatch',$idDispatch)
        ->get('document_receive')->num_rows();
    }

    function doc_sales_request_insert()
    {
//        var_dump($_POST);die;
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];


        $data = array(
            'userid'    =>  $UserId,
            'idDispatch'=>  $_POST['idDispatch'],
            'type'=>  $_POST['type'],
            'remarks' =>$_POST['remarks']
        );
        $this->db->insert('document_receive_from_sales',$data);

        $id = $this->db->insert_id();
        foreach ($_POST['iddocument'] as $row)
        {
            $data = array(
              'idRequest'       =>  $id,
              'idDocument'      =>  $row
            );
            $this->db->insert('document_request_detail',$data);
        }

        return true;

    }

    function doc_sales_request_update()
    {
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];

        $count = 0;
        foreach ($_POST['iddocument'] as $item) {
            $count++;
            $this->db->where('idRequest',$_POST['id'])
                ->where('idDocument',$item)
                ->update('document_request_detail',array('status'=>$_POST['status']));
            echo $this->db->last_query();
        }
        if($count >0)
        {
            $this->db->where('id',$_POST['id'])->update('document_receive_from_sales',array('status'=>'DISPATCHED'));
        }



        return true;

    }

    function doc_receive_documents()
    {
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];

        foreach ($_POST['iddocument'] as $item) {
            $this->db->where('idRequest',$_POST['id'])
                ->where('idDocument',$item)
                ->update('document_request_detail',array('status'=>$_POST['status']));
        }

        if(($this->count_of($_POST['id'],'DISPATCHED') ==0) and ($this->count_of($_POST['id'],'REQUESTED') ==0))
        {
            $this->db->
               where('id',$_POST['id'])
                ->update('document_receive_from_sales',array('status'=>'CLOSED'));

        }

        if($_POST['type']=='Excise')
        {
            if(($this->count_of($_POST['id'],'REQUESTED') ==0))
            {
                $this->db->
                where('id',$_POST['id'])
                    ->update('document_receive_from_sales',array('status'=>'CLOSED'));

            }
        }



        return true;

    }

    function count_of($id,$status)
    {
        $query = $this->db->where('idRequest',$id)
            ->where('status',$status)
            ->get('document_request_detail');

        return $query->num_rows();
    }
    function doc_sales_request_response($id,$action)
    {
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];


        $this->db->where('id',$id)->update('document_receive_from_sales',array('action'=>$action,'respondent'=>$UserId));
        return true;

    }

    function get_doc_sales_request()
    {
        return $this->db->query("
                    SELECT drfs.*,cd.ChasisNo,cd.EngineNo,cd.RegistrationNumber,drfs.created_at
                    FROM document_receive_from_sales drfs
                    JOIN car_dispatch cd ON cd.idDispatch = drfs.idDispatch
                
                    ORDER BY drfs.created_at desc
        ")->result_array();
    }

    function get_doc_excise()
    {
        return $this->db->query("
                    SELECT drfs.*,cd.ChasisNo,cd.EngineNo,cd.RegistrationNumber,drfs.created_at
                    FROM document_receive_from_sales drfs
                    JOIN car_dispatch cd ON cd.idDispatch = drfs.idDispatch
                    where drfs.type = 'Excise' and status = 'CLOSED'
                
                    ORDER BY drfs.created_at desc
        ")->result_array();
    }

    function doc_excise_request_insert()
    {
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];


        $data = array(
            'userid'    =>  $UserId,
            'idDispatch'=>  $_POST['idDispatch'],
            'iddocument'=>  $_POST['iddocument']
        );
        $this->db->insert('document_receive_from_excise',$data);

        return true;

    }
    function doc_excise_request_response($id,$action)
    {
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];


        $this->db->where('id',$id)->update('document_receive_from_excise',array('action'=>$action,'respondent'=>$UserId));
        return true;

    }

  function  get_document_receive_from_sales($idDispatch)
  {
      return $this->db->where('idDispatch',$idDispatch)->get('document_receive_from_sales')->row();
  }

  function update_excise()
  {

          foreach ($_POST['iddcoument'] as $row)
          {

                  $data = array(
                      'idDocument'  => $row,
                      'idRequest'   => $_POST['id'],
                      'status'      => 'RECEIVED'

                  );
                  $this->db->insert('document_request_detail', $data);
          }

          $this->db->where('idDispatch', $_POST['idDispatch'])->update('document_receive_from_sales',array('registered'=>1));
          return true;


  }



}