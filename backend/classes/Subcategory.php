<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 
class Subcategory
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function subcatInsert($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            $msg = "<span class='error'>Category field must not be empty!</span>";
            return $msg;
        } else {
            $query = "INSERT INTO sub_categories(sub_categories) VALUES('$catName')";
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

    public function getAllSubcat()
    {
        $query = "SELECT * FROM sub_categories WHERE status=1 ORDER BY id ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSubcatById($id)
    {
        $query = "SELECT * FROM sub_categories WHERE id = '$id' AND status=1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSubcatByCatId($catid)
    {
        $query = "SELECT * FROM sub_categories WHERE categories_id = '$catid' AND status=1";
        $result = $this->db->select($query);
        return $result;
    }

    public function subcatUpdate($catName, $catid)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catid = mysqli_real_escape_string($this->db->link, $catid);
        if (empty($catName)) {
            $msg = "<span class='error'>Category field must not be empty!</span>";
            return $msg;
        } else {
            $query = "UPDATE sub_categories
        	SET
        	sub_categories = '$catName'
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
    public function delSubCatById($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM sub_categories WHERE id = '$id'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>Sub Category Deleted Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'Sub Category Not Deleted!</span>";
            return $msg;
        }
    }
}
