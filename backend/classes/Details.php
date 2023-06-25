<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 
class Details
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function getContent($type){
        $type = mysqli_real_escape_string($this->db->link, ($this->fm->validation($type)));
        $query = "SELECT content,updated_on FROM store_details WHERE `type` = '$type'";
        $result = $this->db->select($query);
        return $result;
    }



  
}
