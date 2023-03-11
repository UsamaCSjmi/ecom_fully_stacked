<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 

class Product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function productInsert($data, $file)
    {
        $productName = $this->fm->validation($data['productName']);
        $catId       = $this->fm->validation($data['catId']);
        $brandId     = $this->fm->validation($data['brandId']);
        $body        = $this->fm->validation($data['body']);
        $price       = $this->fm->validation($data['price']);
        $type        = $this->fm->validation($data['type']);

        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $catId       = mysqli_real_escape_string($this->db->link, $catId);
        $brandId     = mysqli_real_escape_string($this->db->link, $brandId);
        $body        = mysqli_real_escape_string($this->db->link, $body);
        $price       = mysqli_real_escape_string($this->db->link, $price);
        $type        = mysqli_real_escape_string($this->db->link, $type);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if (empty($file_name)) {
            echo "<span class='error'>Please Select any Image !</span>";
        } elseif ($file_size >4048567) {
            echo "<span class='error'>Image Size should be less then 4MB! </span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        } elseif ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $msg = "<span class='error'>Fields must not be empty!</span>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type) VALUES('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type')";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success'>Product Inserted Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product Not Inserted.</span>";
                return $msg;
            }
        }
    }

    public function getAllProduct()
    {
        $query = "select * from product order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProById($proid)
    {
        $query = "select * from product where id=$proid";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProByCatId($catid)
    {
        $query = "select * from product where categories_id=$catid";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProBySubCatId($subcatid)
    {
        $query = "select * from product where sub_categories_id=$subcatid";
        $result = $this->db->select($query);
        return $result;
    }
    public function getProImagesId($proid)
    {
        $query = "select id,product_images from product_images where product_id=$proid";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProImgByCatId($cat)
    {
        $query = "SELECT image FROM product WHERE categories_id = '$cat' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProImgBySubCatId($subcat)
    {
        $query = "SELECT image FROM product WHERE sub_categories_id = '$subcat' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function productUpdate($data, $file, $proid)
    {
        $productName = $this->fm->validation($data['productName']);
        $catId       = $this->fm->validation($data['catId']);
        $brandId     = $this->fm->validation($data['brandId']);
        $body        = $this->fm->validation($data['body']);
        $price       = $this->fm->validation($data['price']);
        $type        = $this->fm->validation($data['type']);

        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $catId       = mysqli_real_escape_string($this->db->link, $catId);
        $brandId     = mysqli_real_escape_string($this->db->link, $brandId);
        $body        = mysqli_real_escape_string($this->db->link, $body);
        $price       = mysqli_real_escape_string($this->db->link, $price);
        $type        = mysqli_real_escape_string($this->db->link, $type);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $msg = "<span class='error'>Fields must not be empty!</span>";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size >4048567) {
                    echo "<span class='error'>Image Size should be less then 4MB! </span>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product
                                SET
                                productName ='$productName',
                                catId       ='$catId',
                                brandId     ='$brandId',
                                body        ='$body',
                                price       ='$price',
                                image       ='$uploaded_image',
                                type        ='$type'
                                WHERE productId = '$proid'
                                ";
                    $updated_row = $this->db->update($query);
                    if ($updated_row) {
                        $msg = "<span class='success'>Product Updated Successfully</span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Product Not Updated.</span>";
                        return $msg;
                    }
                }
            } else {
                $query = "UPDATE tbl_product
                                SET
                                productName ='$productName',
                                catId       ='$catId',
                                brandId     ='$brandId',
                                body        ='$body',
                                price       ='$price',                              
                                type        ='$type'
                                WHERE productId = '$proid'
                                ";
                $updated_row = $this->db->update($query);
                if ($updated_row) {
                    $msg = "<span class='success'>Product Updated Successfully</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Product Not Updated.</span>";
                    return $msg;
                }
            }
        }
    }
    public function delProById($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $getData = $this->db->select($query);
        if ($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $dellink = $delImg['image'];
                unlink($dellink);
            }
        }
        $delquery = "DELETE FROM tbl_product WHERE productId = '$id'";
        $deldata = $this->db->delete($delquery);
        if ($deldata) {
            $msg = "<span class='success'>Product Deleted Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Product Not Deleted!</span>";
            return $msg;
        }
    }
    


    public function getNewProducts($x)
    {
        $query = "SELECT * FROM product ORDER BY Id ASC LIMIT $x";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSingleProduct($proId)
    {
        $query = "SELECT p.*, c.catName, b.brandName
                    FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b
                    WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$proId'";
        
        $result = $this->db->select($query);
        return $result;
    }


    public function productByCat($catId)
    {
        $catId  = mysqli_real_escape_string($this->db->link, $catId);
        $query  = "SELECT * FROM tbl_product WHERE catId = '$catId'";
        $result = $this->db->select($query);
        return $result;
    }
}
