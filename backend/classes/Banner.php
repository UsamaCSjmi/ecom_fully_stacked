<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 
class Banner
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function banInsert($banImg)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $banImg);
        if (empty($banImg)) {
            $msg = "<span class='error'>Banner Image must not be empty!</span>";
            return $msg;
        } else {
            $query = "INSERT INTO banner(image,status) VALUES('$banImg',1)";
            $catinsert = $this->db->insert($query);
            if ($catinsert) {
                $msg = "<span class='success'>Banner Added Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Banner Not Added.</span>";
                return $msg;
            }
        }
    }

    public function getAllBan()
    {
        $query = "SELECT * FROM banner ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getBanById($banId)
    {
        $query = "SELECT * FROM banner WHERE id = '$banId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delBanById($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM banner WHERE id = '$id'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>Banner Deleted Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Banner Not Deleted!</span>";
            return $msg;
        }
    }
}
