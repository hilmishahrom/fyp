<?php
class Common{
    public $conn;
    public $servername = "localhost";
    public $username = "admin";
    public $password = "";
    public $dbname = "ptmsdb";
    public function __construct(){
        //session_start();
        $this->connect();
    }
    public function connect(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

    // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function getData($sql){
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
                
            }
            return $data;
        } else {
            return false;
        }
    }

    public function setSuccessMsg($msg) {
        if ($msg != '') {
            $_SESSION['success'][] = $msg;
        }
    }

    public function getSuccessMsg() {
        $msg = '';
        if (isset($_SESSION['success'])) {
            foreach ($_SESSION['success'] as $k => $v) {
                $msg .= '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="width:300px;">x</button>' . $v . '</div>';
            }
            return $msg;
        }
    }

    public function setErrorMsg($msg) {
        if ($msg != '')
            $_SESSION['error'][] = $msg;
    }

    public function getErrorMsg() {
        $msg = '';
        if (isset($_SESSION['error'])) {
            foreach ($_SESSION['error'] as $k => $v) {
                $msg .= '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>' . $v . '</div>';
            }
            return $msg;
        }
    }

    public function unsetMessage() {
        if (isset($_SESSION['error']) || isset($_SESSION['success'])) {
            unset($_SESSION['error']);
            unset($_SESSION['success']);
        }
    }
    public function validateLogin(){
        if(isset($_POST)){
            $username = $_POST['username'];
            $password = $_POST['password'];
            if(!isset($username) || !isset($password)){
                $this->setErrorMsg("Username or password is empty!");
                header("location:index.php");
                exit;
            }
            $query = "select count(*) as userStatus from tbl_users where email_id='$username' and password='$password' and delflag=0";
            $chkUser = $this->getData($query);
            if($chkUser[0]['userStatus']>0){
                $userData = $this->getData("select * from tbl_users where email_id='$username' and password='$password'");
                $_SESSION['user_id'] = $userData[0]['user_id'];
                $_SESSION['email_id'] = $userData[0]['email_id'];
                $_SESSION['name'] = $userData[0]['name'];
                $_SESSION['rfid_uid'] = $userData[0]['rfid_uid'];
                $_SESSION['user_type'] = $userData[0]['user_type'];
                $_SESSION['user_logged_in'] = 1;

                header("location:viewAttendance.php");
                exit;
            }else{
                $this->setErrorMsg("User does not exists with given credentials!");
                return ;
            }
        }
    }
    public function getMonthly_in_useApi(){
        $rfid_uid = trim($_REQUEST['uid']);
        $loc_id = trim($_REQUEST['loc_id']);
        $sql = "select count(*)as tot from Monthly_Users where rfid_uid='$rfid_uid'";

        $data = $this->getData($sql);
        if(count($data)>0 && $data[0]['tot']>0){
            $sql = "insert into mthly_tag set loc_id = '$loc_id',rfid_uid='$rfid_uid'";
            $flag = $this->conn->query($sql);
            if($flag){
                echo "Welcome!";
                die;
            }else{
                echo "Sorry! Something unexpected happened!";
                die;    
            }

        }else{
            echo "invalid access";die;
        }
    }
    public function checkUIDAlreadyExists(){
        $rfid_uid = trim($_REQUEST['uid']);
        if(!isset($rfid_uid)||strlen($rfid_uid)<8 || empty($rfid_uid)){
            //echo json_encode(array("msg_type"=>"error","msg"=>"RFID Code not Received"));
            echo "2";
            exit;
        }
        $sql = "select count(*)as tot from Monthly_Users where rfid_uid='$rfid_uid'";
        $data = $this->getData($sql);
        if(count($data)>0 && $data[0]['tot']>0){
            //echo json_encode(array("msg_type"=>"error","msg"=>"This RFID Card is already Exists or Registered!"));
            echo "0";
            exit;
        }else{
            echo "1";
            //echo json_encode(array("msg_type"=>"success","msg"=>"This is new RFID Card"));
            exit;
        }
    }

    public function addUser(){
        $name = trim($_REQUEST['name']);
        $rfid_uid = trim($_REQUEST['uid']);        
        $balance = trim($_REQUEST['balance']);
        if(empty($name) || empty($rfid_uid)){
            echo "Name and RFID UID Cannot be empty!";
            exit;
        }
        $sql = "insert into Monthly_Users set name = '$name',rfid_uid = '$rfid_uid'";
        if($this->conn->query($sql)){
            echo "User Added Successfully!";
            exit;
        }else{
            echo "Sorry! Something unexpected happened!";
            exit;
        }
    }

    public function addnormalUser(){
        $rfid_uid = trim($_REQUEST['uid']);
        if(empty($rfid_uid)){
            echo "RFID UID Cannot be empty!";
            exit;
        }
        $sql = "insert into tag set rfid_uid = '$rfid_uid'";
        if($this->conn->query($sql)){
            echo "Ticket Added Successfully!";
            exit;
        }else{
            echo "Sorry! Something unexpected happened!";
            exit;
        }
    }

    public function checkUIDAlreadyExistss(){
        $rfid_uid = trim($_REQUEST['uid']);
        if(!isset($rfid_uid)||strlen($rfid_uid)<8 || empty($rfid_uid)){
            //echo json_encode(array("msg_type"=>"error","msg"=>"RFID Code not Received"));
            echo "2";
            exit;
        }
        $sql = "select count(*)as tot from tag where rfid_uid='$rfid_uid'";
        $data = $this->getData($sql);
        if(count($data)>0 && $data[0]['tot']>0){
            //echo json_encode(array("msg_type"=>"error","msg"=>"This RFID Card is already Exists or Registered!"));
            echo "0";
            exit;
        }else{
            echo "1";
            //echo json_encode(array("msg_type"=>"success","msg"=>"This is new RFID Card"));
            exit;
        }
    }

    public function getNormal_in_useApi(){
        $rfid_uid = trim($_REQUEST['uid']);
        $loc_id = trim($_REQUEST['loc_id']);
        $sql = "select count(*)as tot from tag where rfid_uid='$rfid_uid'";

        $data = $this->getData($sql);
        if(count($data)>0 && $data[0]['tot']>0){
            $sql = "insert into reg_tag set loc_id = '$loc_id',rfid_uid='$rfid_uid'";
            $flag = $this->conn->query($sql);
            if($flag){
                echo "Welcome!";
                die;
            }else{
                echo "Sorry! Something unexpected happened!";
                die;    
            }

        }else{
            echo "invalid access";die;
        }
    }
    
} 
class Attendance{
    
}
