<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../lib/Session.php');
include_once($filepath.'/../helpers/Format.php');



class Customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public static function checkLogin(){
        if(isset($_SESSION['USER_LOGIN']))
            return true;
        else
            return false;
    }

    public function customerRegistration($data)
    {
        $name    	= $this->fm->validation($data['name']);
        $email   	= $this->fm->validation($data['email']);
        $pass  		= $this->fm->validation($data['pass']);
        
        $name 		= mysqli_real_escape_string($this->db->link, $name);
        $email 		= mysqli_real_escape_string($this->db->link, $email);
        $pass 		= mysqli_real_escape_string($this->db->link, md5($pass));



        if ($name == "" || $email == "" || $pass == "") {
            $msg = "Empty Feilds";
            return $msg;
        }
        $mailquery = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $mailchk = $this->db->select($mailquery);
        if ($mailchk != false) {
            $msg = "email exists";
            return $msg;
        } else {
            $query = "INSERT INTO users(name, email, password) VALUES('$name', '$email', '$pass')";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "Success";
                return $msg;
            } else {
                $msg = "Failed";
                return $msg;
            }
        }
    }

    public function customerLogin($data)
    {
        $email 	= $this->fm->validation($data['email']);
        $pass  	= $this->fm->validation($data['password']);

        $email 	= mysqli_real_escape_string($this->db->link, $email);
        $pass 	= mysqli_real_escape_string($this->db->link, md5($pass));

        if (empty($email) || empty($pass)) {
            $msg = "empty feilds";
            return $msg;
        }
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::init();
            Session::set("USER_LOGIN", true);
            Session::set("USER_ID", $value['id']);
            Session::set("USER_NAME", $value['name']);
            $msg="success";
            return $msg;
        } else {
            $msg = "incorrect";
            return $msg;
        }
    }


    public function getCustomerData($id)
    {
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

}
