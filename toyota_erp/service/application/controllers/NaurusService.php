<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// New Code written On 20-April-2015

class NaurusService {

    public function __construct() {
        date_default_timezone_set("Asia/Karachi");
    }

    // Insert Data Functions

    public function insertUserInfo($name, $email, $cno, $add, $fb, $dob, $nic, $city) {
        $dbirth = date('Y/m/d', strtotime($dob));
        $userTurn = '3';
        $startAmount = '200';
        $spinRemaining = '3';
        $extraTurns = '0';
        $createdDate = $this->getFieldsValue()['CreatedDate'];
        $isActive = $this->getFieldsValue()['isActive'];
        $result = "INSERT INTO userinfo(Name,Email,ContactNumber,Address,FbId,DateOfBirth,Cnic,City,UserTurn,Amount,SpinRemaining,ExtraTurns,CreatedDate,isActive) VALUES('" . $name . "','" . $email . "','" . $cno . "','" . $add . "','" . $fb . "','" . $dbirth . "','" . $nic . "','" . $city . "',$userTurn,$startAmount,$spinRemaining,$extraTurns ,$createdDate,$isActive)";
        if ($this->getConnection()->query($result) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insertSpinData($fb, $winningamount, $islst, $isExtra, $newExtraTurn) {
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
            if ($isExtra == 1) {
                $prevExtraTurns = $prevExtraTurns - 1;
                $totalExtraTurns = $prevExtraTurns + $newExtraTurn;
                $user_update_query = "UPDATE `userinfo` SET `Amount` = " . $totalAmount . ", `ExtraTurns` = " . $totalExtraTurns . "  WHERE `FbId`='" . $fb . "'";
                $this->getConnection()->query($user_update_query);
            } else {
                $newPrevExtraTurns = $prevExtraTurns - 1;
                $user_update_query = "UPDATE `userinfo` SET `Amount` = " . $totalAmount . ", `ExtraTurns` = " . $newPrevExtraTurns . "  WHERE `FbId`='" . $fb . "'";
                $this->getConnection()->query($user_update_query);
            }
        } else {
            if ($isExtra == 1) {
                $totalExtraTurns = $prevExtraTurns + $newExtraTurn;
                $user_update_query = "UPDATE `userinfo` SET `ExtraTurns` = " . $totalExtraTurns . "  WHERE `FbId`= '" . $fb . "'";
                $this->getConnection()->query($user_update_query);
            } else {
                if ($islst === true) {
                    if ($lastSpin != 0) {
                        $spinRemaining = $lastSpin - 1;
                    } else {
                        $spinRemaining = 0;
                    }
                    if ($prev_turn == 0) {
                        $upd_turn = 0;
                    } else {
                        $upd_turn = $prev_turn - 1;
                    }
                } else {
                    $upd_turn = $prev_turn;
                    if ($lastSpin != 0) {
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
        $query = "SELECT * FROM userinfo WHERE FbId='" . $fb . "'";
        $res = $this->getConnection()->query($query);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $result_arr['data'] = array('Name' => $row['Name'], 'Email' => $row['Email'], 'ContactNumber' => $row['ContactNumber'], 'Address' => $row['Address'], 'DateOfBirth' => $row['DateOfBirth'], 'Cnic' => $row['Cnic'], 'City' => $row['City'], 'TurnLeft' => $row['UserTurn'], 'SpinLeft' => $row['SpinRemaining'], 'TotalAmount' => $row['Amount'], 'extraturns' => $row['ExtraTurns']);
            }
            return $result_arr;
        } else {
            return false;
        }
    }

    public function insertUserShopping($id, $data, $add, $nic, $remPrice) {
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

    // Query Functions
    public function checkUser($fb) {
        $user_tot = 0;
        $result_arr = array();
        $userTurnRemaining = 0;
        $userSpinRemaining = 0;
        $timeInterval = '00:00:00';
        $dailyTimeDifference = $this->getDailyTimeDifference(date('Y-m-d H:i:s'));
        $getLastTurnTime = "SELECT DateTime AS lasttime FROM usercredithistory WHERE FbId='" . $fb . "' ORDER BY DateTime DESC LIMIT 1";
        $lastTurnTimeData = $this->getConnection()->query($getLastTurnTime);
        if ($lastTurnTimeData->num_rows > 0) {
            while ($row = $lastTurnTimeData->fetch_assoc()) {
                $lastTurnDateTime = date('H:i:s', strtotime($row['lasttime']));
                $lastTime = $row['lasttime'];
            }
        } else {
            return false;
        }
        $getUserTurns = "SELECT UserTurn,SpinRemaining FROM userinfo WHERE FbId='" . $fb . "'";
        $lastTurnData = $this->getConnection()->query($getUserTurns);
        if ($lastTurnData->num_rows > 0) {
            while ($row = $lastTurnData->fetch_assoc()) {
                $userTurnRemaining = $row['UserTurn'];
                $userSpinRemaining = $row['SpinRemaining'];
            }
        } else {
            return false;
        }
        if ($userTurnRemaining == 0) {
            $lastDate = date_create($lastTurnDateTime);
            $currentDate = new DateTime(date('H:i:s'));
            $difference = date_diff($lastDate, $currentDate);
            $result = $difference->format("%R%a days");
            $timeInterval = '00:00:00';
            if ($result < 1) {
                $queryUpdate = "UPDATE userinfo SET UserTurn = '3',SpinRemaining = '3',ExtraTurns= '0' WHERE FbId='" . $fb . "'";
                $this->getConnection()->query($queryUpdate);
            }
        } elseif (($userTurnRemaining == 3 && $userSpinRemaining == 0) || ($userTurnRemaining == 2 && $userSpinRemaining == 0) || ($userTurnRemaining == 1 && $userSpinRemaining == 0)) {
            $timeInterval = $this->getTimeDifference($lastTime, $fb);
        }
        $query_total = "SELECT SUM(WinningAmount) AS total FROM usercredithistory WHERE FbId='" . $fb . "'";
        $result_total = $this->getConnection()->query($query_total);
        if ($result_total->num_rows > 0) {
            while ($row_t = $result_total->fetch_assoc()) {
                $user_tot = $row_t['total'];
            }
        } else {
            return false;
        }
        if ($user_tot == null) {
            $user_tot = 0;
        }

        $query = "SELECT * FROM userinfo WHERE FbId='" . $fb . "'";
        $res = $this->getConnection()->query($query);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $result_arr['data'] = array('Name' => $row['Name'], 'Email' => $row['Email'], 'ContactNumber' => $row['ContactNumber'], 'Address' => $row['Address'], 'DateOfBirth' => $row['DateOfBirth'], 'Cnic' => $row['Cnic'], 'City' => $row['City'], 'TurnLeft' => $row['UserTurn'], 'SpinLeft' => $row['SpinRemaining'], 'TotalAmount' => $row['Amount'], 'time' => $timeInterval, 'time_interval' => '00:00:30', 'daily_time' => $dailyTimeDifference, 'extraturns' => $row['ExtraTurns']);
            }
            return $result_arr;
        } else {
            return false;
        }
    }

    public function initialMethod() {
        $user_tot = 0;
        $result_arr = array();
        $userTurnRemaining = 0;
        $userSpinRemaining = 0;
        $timeInterval = '00:00:00';
        $dailyTimeDifference = $this->getDailyTimeDifference(date('Y-m-d H:i:s'));
        $getLastTurnTime = "SELECT DateTime AS lasttime FROM usercredithistory WHERE FbId='" . $fb . "' ORDER BY DateTime DESC LIMIT 1";
        $lastTurnTimeData = $this->getConnection()->query($getLastTurnTime);
        if ($lastTurnTimeData->num_rows > 0) {
            while ($row = $lastTurnTimeData->fetch_assoc()) {
                $lastTurnDateTime = date('H:i:s', strtotime($row['lasttime']));
                $lastTime = $row['lasttime'];
            }
        } else {
            return false;
        }
        $getUserTurns = "SELECT UserTurn,SpinRemaining FROM userinfo WHERE FbId='" . $fb . "'";
        $lastTurnData = $this->getConnection()->query($getUserTurns);
        if ($lastTurnData->num_rows > 0) {
            while ($row = $lastTurnData->fetch_assoc()) {
                $userTurnRemaining = $row['UserTurn'];
                $userSpinRemaining = $row['SpinRemaining'];
            }
        } else {
            return false;
        }
        if ($userTurnRemaining == 0) {
            $lastDate = date_create($lastTurnDateTime);
            $currentDate = new DateTime(date('H:i:s'));
            $difference = date_diff($lastDate, $currentDate);
            $result = $difference->format("%R%a days");
            $timeInterval = '00:00:00';
            if ($result < 1) {
                $queryUpdate = "UPDATE userinfo SET UserTurn = '3',SpinRemaining = '3',ExtraTurns= '0' WHERE FbId='" . $fb . "'";
                $this->getConnection()->query($queryUpdate);
            }
        } elseif (($userTurnRemaining == 3 && $userSpinRemaining == 0) || ($userTurnRemaining == 2 && $userSpinRemaining == 0) || ($userTurnRemaining == 1 && $userSpinRemaining == 0)) {
            $timeInterval = $this->getTimeDifference($lastTime, $fb);
        }
        $query_total = "SELECT SUM(WinningAmount) AS total FROM usercredithistory WHERE FbId='" . $fb . "'";
        $result_total = $this->getConnection()->query($query_total);
        if ($result_total->num_rows > 0) {
            while ($row_t = $result_total->fetch_assoc()) {
                $user_tot = $row_t['total'];
            }
        } else {
            return false;
        }
        if ($user_tot == null) {
            $user_tot = 0;
        }

        $query = "SELECT * FROM userinfo WHERE FbId='" . $fb . "'";
        $res = $this->getConnection()->query($query);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $result_arr['data'] = array('Name' => $row['Name'], 'Email' => $row['Email'], 'ContactNumber' => $row['ContactNumber'], 'Address' => $row['Address'], 'DateOfBirth' => $row['DateOfBirth'], 'Cnic' => $row['Cnic'], 'City' => $row['City'], 'TurnLeft' => $row['UserTurn'], 'SpinLeft' => $row['SpinRemaining'], 'TotalAmount' => $row['Amount'], 'time' => $timeInterval, 'time_interval' => '00:00:30', 'daily_time' => $dailyTimeDifference, 'extraturns' => $row['ExtraTurns']);
            }
            return $result_arr;
        } else {
            return false;
        }
    }

    public function selectItemInfo() {
        $sql = "SELECT * FROM iteminfo";
        $result = $this->getConnection()->query($sql);
        if ($result->num_rows > 0) {
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

    public function updateRecordOnNewDay($fb) {
        $dailyTimeDifference = $this->getDailyTimeDifference(date('Y-m-d H:i:s'));
        $queryUpdate = "UPDATE userinfo SET UserTurn = '3',SpinRemaining = '3',ExtraTurns= '0' WHERE FbId='" . $fb . "'";
        $update = $this->getConnection()->query($queryUpdate);
        if ($update) {
            $query = "SELECT * FROM userinfo WHERE FbId='" . $fb . "'";
            $res = $this->getConnection()->query($query);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $result_arr['data'] = array('Name' => $row['Name'], 'Email' => $row['Email'], 'ContactNumber' => $row['ContactNumber'], 'Address' => $row['Address'], 'DateOfBirth' => $row['DateOfBirth'], 'Cnic' => $row['Cnic'], 'City' => $row['City'], 'TurnLeft' => $row['UserTurn'], 'SpinLeft' => $row['SpinRemaining'], 'TotalAmount' => $row['Amount'], 'time' => '00:00:00', 'time_interval' => '00:00:30', 'daily_time' => $dailyTimeDifference, 'extraturns' => $row['ExtraTurns']);
                }
                return $result_arr;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Get Time Calculations
    public function subtractValue($varOne, $varTwo) {
        return floatVal($varOne) - intval($varTwo);
    }

    public function getTimeDifference($dateTime, $fb) {
        $seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($dateTime);
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours * 3600)) / 60);
        $secs = floor($seconds % 60);
        if ($hours < 10) {
            $hours = '0' . $hours;
        } else {
            $hours = $hours;
        }
        if ($mins < 10) {
            $mins = '0' . $mins;
        } else {
            $mins = $mins;
        }
        if ($secs < 10) {
            $secs = '0' . $secs;
        } else {
            $secs = $secs;
        }
        $timeInterval = $hours . ':' . $mins . ':' . $secs;
        $spanInterval = '00:00:30';
        if ($spanInterval > $timeInterval) {
            $startTime = strtotime($timeInterval);
            $timeEnd = strtotime($spanInterval);
            $difference = ($timeEnd - $startTime);
            $diffHours = floor($difference / 3600);
            $diffMins = floor(($difference - ($diffHours * 3600)) / 60);
            $diffSecs = floor($difference % 60);
            if ($diffHours < 10) {
                $diffHours = '0' . $diffHours;
            } else {
                $diffHours = $diffHours;
            }
            if ($diffMins < 10) {
                $diffMins = '0' . $diffMins;
            } else {
                $diffMins = $diffMins;
            }
            if ($diffSecs < 10) {
                $diffSecs = '0' . $diffSecs;
            } else {
                $diffSecs = $diffSecs;
            }
            $intervalDifference = $diffHours . ':' . $diffMins . ':' . $diffSecs;
            return $intervalDifference;
        } else {
            $user_update_query = "UPDATE userinfo SET SpinRemaining = '3' WHERE FbId='" . $fb . "'";
            $this->getConnection()->query($user_update_query);
            return '00:00:00';
        }
    }

    public function getDailyTimeDifference($currentTime) {
        $time = strtotime('tomorrow');
        $nextDayTime = date('Y-m-d H:i:s', $time);
        $seconds = strtotime($nextDayTime) - strtotime($currentTime);
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours * 3600)) / 60);
        $secs = floor($seconds % 60);
        if ($hours < 10) {
            $hours = '0' . $hours;
        } else {
            $hours = $hours;
        }
        if ($mins < 10) {
            $mins = '0' . $mins;
        } else {
            $mins = $mins;
        }
        if ($secs < 10) {
            $secs = '0' . $secs;
        } else {
            $secs = $secs;
        }
        $timeInterval = $hours . ':' . $mins . ':' . $secs;
        return $timeInterval;
    }

    // Get Fields Value
    public function getFieldsValue() {
        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "ReceivableDate" => date("Y-m-d"), "ReceivableTime" => date("H:i:s"));
        return $fieldsValue;
    }

    // Get Connection Function
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

}
