<?php

/**
 *  This file is part of amfPHP
 *
 * LICENSE
 *
 * This source file is subject to the license that is bundled
 * with this package in the file license.txt.
 */

/**
 * This is a test/example service. Remove it for production use
 *
 * @package Amfphp_Services
 * @author Ariel Sommeria-klein
 */
class NaurusService {

    public function __construct() {
        date_default_timezone_set("Asia/Karachi");
    }

    public function insert_user_info($name, $email, $cno, $add, $fb, $dob, $nic, $city) {
        $dbirth = date('Y/m/d', strtotime($dob));
        $userTurn = '3';
        $startAmount = '200';
        $spinRemaining = '3';
        $createdDate = $this->getFieldsValue()['CreatedDate'];
        $isActive = $this->getFieldsValue()['isActive'];
        $result = "INSERT INTO userinfo(Name,Email,ContactNumber,Address,FbId,DateOfBirth,Cnic,City,UserTurn,Amount,SpinRemaining,CreatedDate,isActive) VALUES('" . $name . "','" . $email . "','" . $cno . "','" . $add . "','" . $fb . "','" . $dbirth . "','" . $nic . "','" . $city . "',$userTurn,$startAmount,$spinRemaining,$createdDate,$isActive)";
        if ($this->getConnection()->query($result) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_user($fb) {
        $user_tot = 0;
        date_default_timezone_set('Asia/Karachi');
        $date = date('Y/m/d');
        $current_time = date('Y/m/d H:i:s');
        $current_date = date('Y-m-d');
        $result_arr = array();
        $userTurnRemaining = 0;
        $userSpinRemaining = 0;
        $timeInterval = '00:00:00';
//        Old-Logic
//        $query_time = "SELECT DATE_FORMAT(DateTime + INTERVAL 2 MINUTE, '%Y-%m-%d %H:%i:%s') AS time FROM usercredithistory WHERE FbId='" . $fb . "' AND IsLast=1 AND DATE_FORMAT(DateTime,'%Y-%m-%d')='" . $current_date . "'";
//        $result_time = $this->getConnection()->query($query_time);
//        $count = 0;
//        if ($result_time->num_rows > 0) {
//            while ($row_time = $result_time->fetch_assoc()) {
//                $count++;
//                $prev_spin_time = $row_time['time'];
//            }
//
//            if (strtotime($current_time) > strtotime($prev_spin_time)) {
//                $resp = "00:00:00";
//            } else {
//                $new = strtotime($prev_spin_time) - strtotime($current_time);
//                $resp = date('H:i:s', $new - 60 * 60 * 5);
//            }
//        }
//        
//        Fetching User Data
        $getLastTurnTime = "SELECT DateTime AS lasttime FROM usercredithistory WHERE FbId='" . $fb . " ORDER BY DateTime DESC LIMIT 1'";
        $lastTurnTimeData = $this->getConnection()->query($getLastTurnTime);
        if ($lastTurnTimeData->num_rows > 0) {
            while ($row = $lastTurnTimeData->fetch_assoc()) {
                $lastTurnDateTime = $row['DateTime'];
            }
        }
        $getUserTurns = "SELECT UserTurn AS UserTurn,SpinRemaining FROM userinfo WHERE FbId='" . $fb . "' LIMIT 1";
        $lastTurnData = $this->getConnection()->query($getUserTurns);
        if ($lastTurnData->num_rows > 0) {
            while ($row = $lastTurnTimeData->fetch_assoc()) {
                $userTurnRemaining = $row['UserTurn'];
                $userSpinRemaining = $row['SpinRemaining'];

//                $userTurnRemaining = date("H:i:s", strtotime($row['UserTurn']));
//                $userSpinRemaining = date("H:i:s", strtotime($row['SpinRemaining']));
            }
        }
// Code For Browser Close and Day Change
//Applying Check, return time-interval if span time is less than current time other wise return 00:00:00 
        if ($userTurnRemaining === "0") {
            $lastDate = date_create($lastTurnDateTime);
            $currentDate = date('Y-m-d H:i:s');
            $difference = date_diff($lastDate, $currentDate);
            $result = $difference->format("%R%a days");
            $timeInterval = '00:00:00';
            if ($result > 0) {
                $queryUpdate = "UPDATE userinfo SET UserTurn = '3',SpinRemaining = '3' WHERE FbId='" . $fb . "'";
                $updateUserTurn = $this->getConnection()->query($queryUpdate);
            }
        } elseif (($userTurnRemaining === "2" && $userSpinRemaining === "3") || ($userTurnRemaining === "1" && $userSpinRemaining === "3")) {
            $lastTime = new DateTime($lastTurnDateTime);
            $resultant = $lastTime->diff(new DateTime(date('Y-m-d H:i:s')));
            $timeInterval = $resultant->h . ':' . $resultant->i . ':' . $resultant->s;
            $spanInterval = '00:00:30';
            if ($timeInterval > $spanInterval) {
                $timeInterval = $resultant->h . ':' . $resultant->i . ':' . $resultant->s;
            } else {
                $timeInterval = '00:00:00';
            }
        }


        $query_total = "SELECT SUM(WinningAmount) AS total FROM usercredithistory WHERE FbId='" . $fb . "'";
        $result_total = $this->getConnection()->query($query_total);
        if ($result_total->num_rows > 0) {
// $user_tot = $row_t['total'];
            while ($row_t = $result_total->fetch_assoc()) {
                $user_tot = $row_t['total'];
            }
        }
        if ($user_tot == null) {
            $user_tot = 0;
        }

        $query = "SELECT * FROM userinfo WHERE FbId='" . $fb . "'";
        $res = $this->getConnection()->query($query);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $result_arr['data'] = array('Name' => $row['Name'], 'Email' => $row['Email'], 'ContactNumber' => $row['ContactNumber'], 'Address' => $row['Address'], 'DateOfBirth' => $row['DateOfBirth'], 'Cnic' => $row['Cnic'], 'City' => $row['City'], 'TurnLeft' => $row['UserTurn'], 'SpinLeft' => ['SpinRemaining'], 'TotalAmount' => $row['Amount'], 'time' => $timeInterval, 'time_interval' => '02:59:59', 'daily_time' => '23:59:59');
            }
            return $result_arr;
        } else {
            return false;
        }
    }

    public function select_item_info() {

        $sql = "SELECT * FROM iteminfo";
        $result = $this->getConnection()->query($sql);

        if ($result->num_rows > 0) {
// output data of each row
            while ($row = $result->fetch_assoc()) {
                $result_array[] = array(
                    "image_Path" => "http://www.socialingenious.com/fawwad_878/naurus/images/" . $row['Image'],
                    "Name" => $row['Name'],
                    "Price" => $row['Price']
                );
            }
        } else {
            
        }
        return $result_array;
    }

    public function insert_spin_data($fb, $winningamount, $islst) {
        date_default_timezone_set('Asia/Karachi');
        $date = date('Y/m/d H:i:s');
        $query_turn = "SELECT UserTurn,SpinRemaining,Amount FROM userinfo WHERE FbId = '" . $fb . "'";
        $result_turn = $this->getConnection()->query($query_turn);
//        $result_turn_result = mysqli_fetch_array($result_turn, MYSQLI_ASSOC);

        while ($row_turn = $result_turn->fetch_assoc()) {
            $prev_turn = $row_turn['UserTurn'];
            $amount = $row_turn['Amount'];
            $lastSpin = $row_turn['SpinRemaining'];
        }

        if ($islst == true) {
            if ($lastSpin !== 0) {
                $spinRemaining = $lastSpin - 1;
            } else {
                $spinRemaining = 0;
            }
            if ($prev_turn == 0) {
                $upd_turn = 3;
            } else {
                $upd_turn = $prev_turn - 1;
                $query = "UPDATE userinfo SET UserTurn = " . $upd_turn . " WHERE FbId='" . $fb . "'";
                $result_upd = $this->getConnection()->query($query);
            }
        } else {
            $upd_turn = $prev_turn;
            if ($lastSpin !== 0) {
                $spinRemaining = $lastSpin - 1;
            } else {
                $spinRemaining = 3;
            }
        }

        $user_update_query = "UPDATE `userinfo` SET `Amount` = " . $winningamount . ",`UserTurn` = " . $upd_turn . ",`SpinRemaining` = " . $spinRemaining . ", WHERE `FbId`='" . $fb . "'";
        $this->getConnection()->query($user_update_query);

        $query = "INSERT INTO usercredithistory(FbId,WinningAmount,DateTime,IsLast) VALUES('" . $fb . "','" . $winningamount . "','" . $date . "','" . $islst . "')";
        $result = $this->getConnection()->query($query);
        return $result;
    }

    public function insert_user_shopping($id, $data, $add, $nic, $remPrice) {
        date_default_timezone_set('Asia/Karachi');
        $price = 0;
        $date = date('Y/m/d H:i:s');
        $query_update = "UPDATE userinfo SET Address='" . $add . "',Cnic='" . $nic . "' WHERE FbId='" . $id . "'";
        $result_update = $this->getConnection()->query($query_update);
        $array = json_decode(json_encode($data), true);
        foreach ($array as $item) {
            $price = $price + $item['price'];
            $query = "INSERT INTO useriteminfo(ItemName,ItemPrice,ItemQuantity,DateTime,FbId) VALUES('" . $item['name'] . "','" . $item['price'] . "','" . $item['qty'] . "','" . $date . "','" . $id . "')";
            $result = $this->getConnection()->query($query);
        }
        $user_update_query = "UPDATE userinfo SET Amount = $remPrice WHERE FbId = '" . $id . "'";
        $updateAmount = $this->getConnection()->query($user_update_query);
        if ($updateAmount) {
            return true;
        } else {
            return false;
        }
    }

    public function subtractValue($varOne, $varTwo) {
        return floatVal($varOne) - intval(varTwo);
    }

    public function getConnection() {
        $servername = "localhost";
        $username = "interae3_ahmer";
        $password = "Diamonds1";
        $db = "interae3_naurus";
        $conn = new mysqli($servername, $username, $password, $db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            return $conn;
        }
    }

    function getFieldsValue() {
        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "ReceivableDate" => date("Y-m-d"), "ReceivableTime" => date("H:i:s"));
        return $fieldsValue;
    }

    public function check_user_($fb) {
        $user_tot = 0;
        $date = date('Y/m/d');
        $current_time = date('Y/m/d H:i:s');
        $current_date = date('Y-m-d');
        $result_arr = array();
        $userTurnRemaining = 0;
        $userSpinRemaining = 0;
        $timeInterval = '00:00:00';

//        Fetching User Data
        $getLastTurnTime = "SELECT DateTime AS lasttime FROM usercredithistory WHERE FbId='" . $fb . "' ORDER BY DateTime DESC LIMIT 1";
        $lastTurnTimeData = $this->getConnection()->query($getLastTurnTime);
        if ($lastTurnTimeData->num_rows > 0) {
            while ($row = $lastTurnTimeData->fetch_assoc()) {
                $lastTurnDateTime = $row['lasttime'];
            }
        }
        $getUserTurns = "SELECT UserTurn AS UserTurn,SpinRemaining AS SpinRemaining FROM userinfo WHERE FbId='" . $fb . "' LIMIT 1";
        $lastTurnData = $this->getConnection()->query($getUserTurns);
        if ($lastTurnData->num_rows > 0) {
            while ($row = $lastTurnTimeData->fetch_assoc()) {
                $userTurnRemaining = $row['UserTurn'];
                $userSpinRemaining = $row['SpinRemaining'];

//                $userTurnRemaining = date("H:i:s", strtotime($row['UserTurn']));
//                $userSpinRemaining = date("H:i:s", strtotime($row['SpinRemaining']));
            }
        }
// Code For Browser Close and Day Change
//Applying Check, return time-interval if span time is less than current time other wise return 00:00:00 
        if ($userTurnRemaining === 0) {
            $lastDate = date_create($lastTurnDateTime);
            $currentDate = new DateTime(date('Y-m-d H:i:s'));
            $difference = date_diff($lastDate, $currentDate);
            $result = $difference->format("%R%a days");
            $timeInterval = '00:00:00';
            if ($result > 0) {
                $queryUpdate = "UPDATE userinfo SET UserTurn = '3',SpinRemaining = '3' WHERE FbId='" . $fb . "'";
                $updateUserTurn = $this->getConnection()->query($queryUpdate);
            }
        } elseif (($userTurnRemaining == 2 && $userSpinRemaining == 0) || ($userTurnRemaining === 1 && $userSpinRemaining === 0)) {
            $lastTime = new DateTime($lastTurnDateTime);
            $resultant = $lastTime->diff(new DateTime(date('Y-m-d H:i:s')));
            $timeInterval = $resultant->h . ':' . $resultant->i . ':' . $resultant->s;
            $spanInterval = '00:00:30';
            if ($spanInterval > $timeInterval) {
                $timeInterval = $resultant->h . ':' . $resultant->i . ':' . $resultant->s;
            } else {
                $timeInterval = '20:00:00';
            }
        }



        $query_total = "SELECT SUM(WinningAmount) AS total FROM usercredithistory WHERE FbId='" . $fb . "'";
        $result_total = $this->getConnection()->query($query_total);
        if ($result_total->num_rows > 0) {
// $user_tot = $row_t['total'];
            while ($row_t = $result_total->fetch_assoc()) {
                $user_tot = $row_t['total'];
            }
        }
        if ($user_tot == null) {
            $user_tot = 0;
        }

        $query = "SELECT * FROM userinfo WHERE FbId='" . $fb . "'";
        $res = $this->getConnection()->query($query);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $result_arr['data'] = array('Name' => $row['Name'], 'Email' => $row['Email'], 'ContactNumber' => $row['ContactNumber'], 'Address' => $row['Address'], 'DateOfBirth' => $row['DateOfBirth'], 'Cnic' => $row['Cnic'], 'City' => $row['City'], 'TurnLeft' => $row['UserTurn'], 'SpinLeft' => $row['SpinRemaining'], 'TotalAmount' => $row['Amount'], 'time' => $timeInterval, 'time_interval' => '00:00:30', 'daily_time' => '00:00:30');
            }
            return $result_arr;
        } else {
            return false;
        }
    }

    public function check_user__($fb) {
        $user_tot = 0;
        $date = date('Y/m/d');
        $current_time = date('Y/m/d H:i:s');
        $current_date = date('Y-m-d');
        $result_arr = array();
        $userTurnRemaining = 0;
        $userSpinRemaining = 0;
        $timeInterval = '00:00:00';

//        Fetching User Data
        $getLastTurnTime = "SELECT DateTime AS lasttime FROM usercredithistory WHERE FbId='" . $fb . "' ORDER BY DateTime DESC LIMIT 1";
        $lastTurnTimeData = $this->getConnection()->query($getLastTurnTime);
        if ($lastTurnTimeData->num_rows > 0) {
            while ($row = $lastTurnTimeData->fetch_assoc()) {
                $lastTurnDateTime = date('H:i:s', strtotime($row['lasttime']));
            }
        }
        $getUserTurns = "SELECT UserTurn,SpinRemaining FROM userinfo WHERE FbId='" . $fb . "'";
        $lastTurnData = $this->getConnection()->query($getUserTurns);
        if ($lastTurnData->num_rows > 0) {
            while ($row = $lastTurnData->fetch_assoc()) {
                $userTurnRemaining = $row['UserTurn'];
                $userSpinRemaining = $row['SpinRemaining'];
                //       $userTurnRemaining = date('H:i:s', strtotime($row['UserTurn']));
                //          $userSpinRemaining = date('H:i:s', strtotime($row['SpinRemaining']));
            }
        }
        // Code For Browser Close and Day Change
        //Applying Check, return time-interval if span time is less than current time other wise return 00:00:00 
        if ($userTurnRemaining === 0) {
            $lastDate = date_create($lastTurnDateTime);
            $currentDate = new DateTime(date('Y-m-d H:i:s'));
            $difference = date_diff($lastDate, $currentDate);
            $result = $difference->format("%R%a days");
            $timeInterval = '00:00:00';
            if ($result > 0) {
                $queryUpdate = "UPDATE userinfo SET UserTurn = '3',SpinRemaining = '3' WHERE FbId='" . $fb . "'";
                $updateUserTurn = $this->getConnection()->query($queryUpdate);
            }
        } elseif (($userTurnRemaining === 2 && $userSpinRemaining === 0) || ($userTurnRemaining === 1 && $userSpinRemaining === 0)) {
            $lastTime = new DateTime($lastTurnDateTime);
            $resultant = $lastTime->diff(new DateTime(date('Y-m-d H:i:s')));
            $timeInterval = $resultant->h . ':' . $resultant->i . ':' . $resultant->s;
            $spanInterval = '00:00:59';
            if ($spanInterval > $timeInterval) {
                $timeInterval = $resultant->h . ':' . $resultant->i . ':' . $resultant->s;
            } else {
                $timeInterval = '10:00:00';
            }
        }
        $query_total = "SELECT SUM(WinningAmount) AS total FROM usercredithistory WHERE FbId='" . $fb . "'";
        $result_total = $this->getConnection()->query($query_total);
        if ($result_total->num_rows > 0) {
// $user_tot = $row_t['total'];
            while ($row_t = $result_total->fetch_assoc()) {
                $user_tot = $row_t['total'];
            }
        }
        if ($user_tot == null) {
            $user_tot = 0;
        }

        $query = "SELECT * FROM userinfo WHERE FbId='" . $fb . "'";
        $res = $this->getConnection()->query($query);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $result_arr['data'] = array('Name' => $row['Name'], 'Email' => $row['Email'], 'ContactNumber' => $row['ContactNumber'], 'Address' => $row['Address'], 'DateOfBirth' => $row['DateOfBirth'], 'Cnic' => $row['Cnic'], 'City' => $row['City'], 'TurnLeft' => $row['UserTurn'], 'SpinLeft' => $row['SpinRemaining'], 'TotalAmount' => $row['Amount'], 'time' => $timeInterval, 'time_interval' => '00:00:59', 'daily_time' => '00:00:30', 'extraturns' => $row['ExtraTurn']);
            }
            return $result_arr;
        } else {
            return false;
        }
    }

    public function insert_spin_data_($fb, $winningamount, $islst) {

        date_default_timezone_set('Asia/Karachi');
        $date = date('Y/m/d H:i:s');
        $query_turn = "SELECT UserTurn,SpinRemaining,Amount FROM userinfo WHERE FbId = '" . $fb . "'";
        $result_turn = $this->getConnection()->query($query_turn);

        while ($row_turn = $result_turn->fetch_assoc()) {
            $prev_turn = $row_turn['UserTurn'];
            $amount = $row_turn['Amount'];
            $lastSpin = $row_turn['SpinRemaining'];
        }
        $totalAmount = $amount + $winningamount;

        if ($islst == true) {
            if ($lastSpin !== 0) {
                $spinRemaining = $lastSpin - 1;
            } else {
                $spinRemaining = 0;
            }
            if ($prev_turn == 0) {
                $upd_turn = 3;
            } else {
                $upd_turn = $prev_turn - 1;
                $query = "UPDATE userinfo SET UserTurn = " . $upd_turn . " WHERE FbId='" . $fb . "'";
                $result_upd = $this->getConnection()->query($query);
            }
        } else {
            $upd_turn = $prev_turn;
            if ($lastSpin !== 0) {
                $spinRemaining = $lastSpin - 1;
            } else {
                $spinRemaining = 3;
            }
        }

        $user_update_query = "UPDATE `userinfo` SET `Amount` = " . $totalAmount . ",`UserTurn` = " . $upd_turn . ", `SpinRemaining` = " . $spinRemaining . " WHERE `FbId`='" . $fb . "'";
        $this->getConnection()->query($user_update_query);

        $query = "INSERT INTO usercredithistory(FbId,WinningAmount,DateTime,IsLast) VALUES('" . $fb . "','" . $winningamount . "','" . $date . "','" . $islst . "')";
        $result = $this->getConnection()->query($query);
        return $result;
    }

    public function insert_spin_data_copied($fb, $winningamount, $islst, $isExtra, $newExtraTurn) {
        date_default_timezone_set('Asia/Karachi');
        $date = date('Y/m/d H:i:s');
        $prevExtraTurns = 0;
        $totalExtraTurns = 0;
        $query_turn = "SELECT UserTurn,SpinRemaining,Amount,ExtraTurns FROM userinfo WHERE FbId = '" . $fb . "'";
        $result_turn = $this->getConnection()->query($query_turn);
        while ($row_turn = $result_turn->fetch_assoc()) {
            $prev_turn = $row_turn['UserTurn'];
            $amount = $row_turn['Amount'];
            $lastSpin = $row_turn['SpinRemaining'];
            $prevExtraTurns = $row_turn['ExtraTurns'];
        }
        $totalAmount = $amount + $winningamount;
        if ($prevExtraTurns > 0) {
            if ($isExtra === 1) {
                $totalExtraTurns = $prevExtraTurns + $newExtraTurn;
                $user_update_query = "UPDATE `userinfo` SET `Amount` = " . $totalAmount . ", `ExtraTurns` = " . $totalExtraTurns . "  WHERE `FbId`='" . $fb . "'";
                $this->getConnection()->query($user_update_query);
            } else {
                $newPrevExtraTurns = $prevExtraTurns - 1;
                $user_update_query = "UPDATE `userinfo` SET `Amount` = " . $totalAmount . ", `ExtraTurns` = " . $newPrevExtraTurns . "  WHERE `FbId`='" . $fb . "'";
                $this->getConnection()->query($user_update_query);
            }
        } else {
            if ($isExtra === 1) {
                $totalExtraTurns = $prevExtraTurns + $newExtraTurn;
                $user_update_query = "UPDATE `userinfo` SET `Amount` = " . $totalAmount . ",`ExtraTurns` = " . $totalExtraTurns . "  WHERE `FbId`='" . $fb . "'";
                $this->getConnection()->query($user_update_query);
            } else {
                if ($islst == true) {
                    if ($lastSpin !== 0) {
                        $spinRemaining = $lastSpin - 1;
                    } else {
                        $spinRemaining = 0;
                    }
                    if ($prev_turn == 0) {
                        $upd_turn = 3;
                    } else {
                        $upd_turn = $prev_turn - 1;
//                    $query = "UPDATE userinfo SET UserTurn = " . $upd_turn . " WHERE FbId='" . $fb . "'";
//                    $result_upd = $this->getConnection()->query($query);
                    }
                } else {
                    $upd_turn = $prev_turn;
                    if ($lastSpin !== 0) {
                        $spinRemaining = $lastSpin - 1;
                    } else {
                        $spinRemaining = 3;
                    }
                }
                $user_update_query = "UPDATE `userinfo` SET `Amount` = " . $totalAmount . ",`UserTurn` = " . $upd_turn . ", `SpinRemaining` = " . $spinRemaining . " WHERE `FbId`='" . $fb . "'";
                $this->getConnection()->query($user_update_query);
            }
        }

        $query = "INSERT INTO usercredithistory(FbId,WinningAmount,DateTime,IsLast) VALUES('" . $fb . "','" . $winningamount . "','" . $date . "','" . $islst . "')";
        $result = $this->getConnection()->query($query);
        return $result;
    }

}

?><?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

