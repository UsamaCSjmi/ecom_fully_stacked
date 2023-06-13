<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 
class Contact
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function contactInsert($array)
    {
        $name = $this->fm->validation($array['name']);
        $name = mysqli_real_escape_string($this->db->link, $name);
        $email = $this->fm->validation($array['email']);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $phone = $this->fm->validation($array['phone']);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $msg = $this->fm->validation($array['msg']);
        $msg = mysqli_real_escape_string($this->db->link, $msg);
        $added_on = date('Y-m-d h:i:s');
        $query = "INSERT INTO contact_us(name,email,mobile,comment,added_on) VALUES('$name','$email','$phone','$msg','$added_on')";
        $insert = $this->db->insert($query);
        if ($insert) {
            return "success";
        } else {
            return "failed";
        }
    
    }

    public function getAllContact()
    {
        $query = "SELECT * FROM contact_us ORDER BY id ASC";
        $result = $this->db->select($query);
        return $result;
    }
}
