<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_psfu extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertPSFU($PSFUData) {

        $this->db->insert('s_psfu', $PSFUData);
        return "Successfully Inserted";
    }

    function UpdatePSFU($idRO, $PSFUData) {

        $this->db->where('idRO', $idRO);
        $this->db->update('s_psfu', $PSFUData);
        return "Successfully Updated";
    }

    function DeletePSFU($idPSFU) {

        $this->db->set('isActive', 0);
        $this->db->where('idPSFU', $idPSFU);
        $this->db->update('s_psfu');
        return "Successfully Deleted";
    }

    function searchPSFU($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_psfu');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_psfu.idDealer');
        $this->db->like('s_psfu.PSFUName', $SearchKeyword);
        $this->db->where('s_psfu.isActive != 0');
        $searchPSFU = $this->db->get();
        return $searchPSFU->result_array();
    }

    function getIdPsfu() {
        $this->db->select('idPSFU');
        $this->db->from('s_psfu');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idPSFU = $this->db->get();
        if ($idPSFU->num_rows() > 0) {
            $row = $idPSFU->row();
            $idPSFU = $row->idPSFU;
            return $idPSFU;
        }
    }

    function getCountRO() {
        $this->db->select('count(*) as count');
        $this->db->from('viewduepsfu');
        $countRO = $this->db->get();
        if ($countRO->num_rows() > 0) {
            $row = $countRO->row();
            return $countRO = $row->count;
        }
    }

    function getRO() {
        $this->db->select('*');
        $this->db->from('viewduepsfu');
        $getRO = $this->db->get();
        return $getRO->result_array();
    }

    function getAllQuestions() {
        $this->db->select('*');
        $this->db->from('s_firquestions');
		$this->db->where('isActive',1);
        $getQues = $this->db->get();
        return $getQues->result_array();
    }

    function getPSFUStdDuration() {
        $this->db->select('Duration');
        $this->db->from('s_psfu_duration');
        $getDuration = $this->db->get();
        if ($getDuration->num_rows() > 0) {
            $row = $getDuration->row();
            $getDuration = $row->Duration;
            return $getDuration;
        } else {
            return 0;
        }
    }

    function selectOnePSFU() {
        
    }

    function selectAllPSFUs() {
        
    }
    
    public function insert_spin_data($fb, $winningamount, $islst) {
        date_default_timezone_set('Asia/Karachi');
        $date = date('Y/m/d H:i:s');
        $query_turn = "SELECT UserTurn,Amount FROM userinfo WHERE FbId = '" . $fb . "'";
        $result_turn = $this->getConnection()->query($query_turn);
//        $result_turn_result = mysqli_fetch_array($result_turn, MYSQLI_ASSOC);

        while ($row_turn = $result_turn->fetch_assoc()) {
            $prev_turn = $row_turn['UserTurn'];
            $amount = $row_turn['Amount'];
        }

        if ($islst == true) {
            if ($prev_turn == 0) {
                
            } else {
                $upd_turn = $prev_turn - 1;
                $query = "UPDATE userinfo SET UserTurn = " . $upd_turn . " WHERE FbId='" . $fb . "'";
                $result_upd = $this->getConnection()->query($query);
            }
        }

        $query = "INSERT INTO usercredithistory(FbId,WinningAmount,DateTime,IsLast) VALUES('" . $fb . "','" . $winningamount . "','" . $date . "','" . $islst . "')";
        $result = $this->getConnection()->query($query);

        $user_update_query = "UPDATE `userinfo` SET `Amount` = `Amount` + $winningamount WHERE `FbId`='" . $fb . "'";
        $result_update_user_amount = $this->getConnection()->query($user_update_query);

        return $result;
    }

  public function insert_user_shopping($id, $data, $add, $nic) {
        date_default_timezone_set('Asia/Karachi');
        $price = 0;
        $date = date('Y/m/d H:i:s');
        $query_update = "UPDATE userinfo SET Address='" . $add . "',Cnic='" . $nic . "' WHERE FbId='" . $id . "'";
        $result_update = $this->getConnection()->query($query_update);
        foreach ($data as $item) {
            $price = $price + $item['price'];
            $query = "INSERT INTO useriteminfo(ItemName,ItemPrice,ItemQuantity,DateTime,FbId) VALUES('" . $item['name'] . "','" . $item['price'] . "','" . $item['qty'] . "','" . $date . "','" . $id . "')";
            $result = $this->getConnection()->query($query);
        }

        $user_update_query = "UPDATE `userinfo` SET `Amount` = $price WHERE `FbId`='" . $id . "'";
        $result_update_user_amount = $this->getConnection()->query($user_update_query);

        $select_user = "SELECT Amount FROM userinfo WHERE FbId='" . $id . "'";
        $result_user = $this->getConnection()->query($select_user);
        while ($row_user = $result_user->fetch_assoc()) {
            $user_amount = $row_user['Amount'];
        }
        return $user_amount;
    }
}
