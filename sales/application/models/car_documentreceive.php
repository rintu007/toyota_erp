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


    public function get_all_docs()
    {
        return $this->db->get('document')->result_array();
    }

    public function get_all_dispatch()
    {
        return $this->db
            ->select('idDispatch,PboId,ChasisNo,EngineNo,RegistrationNumber')
            ->where('isDelivered',0)
            ->get('car_dispatch')
            ->result_array();

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
        return $this->db->where('idDispatch',$idDispatch)->get('document_receive')->result_array();

    }


    function exist($iddocument,$idDispatch)
    {
        return $this->db
            ->where('iddocument',$iddocument)
            ->where('idDispatch',$idDispatch)
        ->get('document_receive')->num_rows();
    }



}