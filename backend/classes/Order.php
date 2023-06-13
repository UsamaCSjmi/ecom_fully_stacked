<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 
class Order
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function generateOrder($array)
    {

        $first_name = $array["fname"];
        $last_name = $array["lname"];
        $street_address=$array["street_address"];
        $apartment = $array["apartment"];
        $city = $array["city"];
        $state = $array["state"];
        $zip_code = $array["zip_code"];
        $country = $array["country"];
        $phone = $array["phone"];
        $order_notes = $array["order_notes"];
        $payment_method = $array["payment_method"];
        $total_price = $array["total"];
        $user_id = $array["user_id"];


        $first_name = mysqli_real_escape_string($this->db->link, ($this->fm->validation($first_name)));
        $last_name = mysqli_real_escape_string($this->db->link, ($this->fm->validation($last_name)));
        $street_address = mysqli_real_escape_string($this->db->link, ($this->fm->validation($street_address)));
        $apartment = mysqli_real_escape_string($this->db->link, ($this->fm->validation($apartment)));
        $city = mysqli_real_escape_string($this->db->link, ($this->fm->validation($city)));
        $state = mysqli_real_escape_string($this->db->link, ($this->fm->validation($state)));
        $zip_code = mysqli_real_escape_string($this->db->link, ($this->fm->validation($zip_code)));
        $country = mysqli_real_escape_string($this->db->link, ($this->fm->validation($country)));
        $phone = mysqli_real_escape_string($this->db->link, ($this->fm->validation($phone)));
        $order_notes = mysqli_real_escape_string($this->db->link, ($this->fm->validation($order_notes)));
        $payment_method = mysqli_real_escape_string($this->db->link, ($this->fm->validation($payment_method)));
        $total_price = mysqli_real_escape_string($this->db->link, ($this->fm->validation($total_price)));
        $user_id = mysqli_real_escape_string($this->db->link, ($this->fm->validation($user_id)));
        $payment_status = "Pending";
        $order_status = "Pending";
        $added_on = date('Y-m-d h:i:s');
        $order_id = "unknown";
        $txnid = "unknown";


        $query = "INSERT INTO `order` (fname,lname,street_address,apartment,city,state,zip_code,country,phone,order_notes,payment_status,order_status,total_price,user_id,added_on,order_id,payment_type,txnid) VALUES('$first_name','$last_name','$street_address','$apartment','$city','$state','$zip_code','$country','$phone','$order_notes','$payment_status','$order_status',$total_price,$user_id,'$added_on','$order_id','$payment_method','$txnid')";
        $catinsert = $this->db->insert($query);
        $order_id = mysqli_insert_id($this->db->link);
        if ($catinsert) {
            $new_order_id = "TDESH000".$order_id;
            $query = "UPDATE `order` SET order_id = '$new_order_id' WHERE id = $order_id";
            $updateOid = $this->db->update($query);
            if($updateOid){
                return $new_order_id;
            }
            else{
                return -1;
            }
        } else {
            return -1;
        }

    }

    public function insertOrderDetails($array)
    {

        $product_id = $array["product_id"];
        $qty = $array["qty"];
        $price = $array["price"];
        $order_id = $array["order_id"];

        $product_id = mysqli_real_escape_string($this->db->link, ($this->fm->validation($product_id)));
        $qty = mysqli_real_escape_string($this->db->link, ($this->fm->validation($qty)));
        $price = mysqli_real_escape_string($this->db->link, ($this->fm->validation($price)));
        $order_id = mysqli_real_escape_string($this->db->link, ($this->fm->validation($order_id)));
        
        $query = "INSERT INTO `order_detail` ( order_id , product_id , qty , price) VALUES('$order_id',$product_id,$qty,$price)";
        
        $catinsert = $this->db->insert($query);
        if ($catinsert) {
            return true;
        } else {
            return false;
        }
    }

    public function updateOrder($order_id,$payment_status,$txnid)
    {
        $payment_status = mysqli_real_escape_string($this->db->link, ($this->fm->validation($payment_status)));
        $order_id = mysqli_real_escape_string($this->db->link, ($this->fm->validation($order_id)));
        $txnid = mysqli_real_escape_string($this->db->link, ($this->fm->validation($txnid)));

        $query = "UPDATE `order` SET payment_status = '$payment_status' , txnid = '$txnid' WHERE order_id = '$order_id'";
        $insert = $this->db->update($query);
        if ($insert) {
            $msg = "successfully updated";
            return $msg;
        } else {
            $msg = "Not updated";
            return $msg;
        }
    }

    public function getOrdersByUserId($user_id){
        $user_id = mysqli_real_escape_string($this->db->link, ($this->fm->validation($user_id)));
        $query = "SELECT * FROM `order` WHERE user_id = $user_id";
        $result = $this->db->select($query);
        return $result;
    }
   
    public function getOrderByOrderId($order_id){
        $order_id = mysqli_real_escape_string($this->db->link, ($this->fm->validation($order_id)));
        $query = "SELECT * FROM `order` WHERE order_id = '$order_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getOrdersDetailsByOrderId($order_id){
        $order_id = mysqli_real_escape_string($this->db->link, ($this->fm->validation($order_id)));
        $query = "SELECT order_detail.*, product.name, product.image FROM order_detail, product WHERE order_id = '$order_id' AND order_detail.product_id = product.id";
        $result = $this->db->select($query);
        return $result;
    }



  
}
