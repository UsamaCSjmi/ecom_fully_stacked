<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 
class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            $msg = "<span class='error'>Category field must not be empty!</span>";
            return $msg;
        } else {
            $query = "INSERT INTO categories(categories) VALUES('$catName')";
            $catinsert = $this->db->insert($query);
            if ($catinsert) {
                $msg = "<span class='success'>Category Inserted Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category Not Inserted.</span>";
                return $msg;
            }
        }
    }

    public function getAllCat()
    {
        $query = "SELECT * FROM categories WHERE status=1 ORDER BY id ASC";
        $result = $this->db->select($query);
        return $result;
    }


    public function getCatById($catid)
    {
        $query = "SELECT * FROM categories WHERE id = '$catid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function catUpdate($catName, $catid)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catid = mysqli_real_escape_string($this->db->link, $catid);
        if (empty($catName)) {
            $msg = "<span class='error'>Category field must not be empty!</span>";
            return $msg;
        } else {
            $query = "UPDATE categories
        	SET
        	categories = '$catName'
        	WHERE id = '$catid'";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $msg = "<span class='success'>Category Updated Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category Not Updated.</span>";
                return $msg;
            }
        }
    }
    public function delCatById($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM categories WHERE id = '$id'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>Category Deleted Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Category Not Deleted!</span>";
            return $msg;
        }
    }
}
