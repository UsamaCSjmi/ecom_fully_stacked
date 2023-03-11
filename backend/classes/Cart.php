<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../lib/Session.php');
include_once($filepath.'/../helpers/Format.php');

 ?>
<?php 


class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
        Session::init();
    }

    public function addProduct($pid,$qty){
        $pid = mysqli_real_escape_string($this->db->link, $pid);
        $qty = mysqli_real_escape_string($this->db->link, $qty);
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array($pid => $qty);
        }
        else{
            if(array_key_exists($pid,$_SESSION['cart'])){
                $_SESSION['cart'][$pid]=$qty;
            }
            else{
                $new_items = array($pid => $qty);
                $_SESSION['cart'] = $_SESSION['cart']+$new_items;
            }
            
        }
    }

    public function updateProduct($pid,$qty){
        $pid = mysqli_real_escape_string($this->db->link, $pid);
        $qty = mysqli_real_escape_string($this->db->link, $qty);
        if(array_key_exists($pid,$_SESSION['cart'])){
            $_SESSION['cart'][$pid]=$qty;
        }
    }

    public function removeProduct($pid){
        $pid = mysqli_real_escape_string($this->db->link, $pid);
        if(isset($_SESSION['cart'][$pid])){
            unset($_SESSION['cart'][$pid]);
        }
    }

    public function getCartItems(){
        if(!isset($_SESSION['cart'])){
            return 0;
        }
        $items=$_SESSION['cart'];
        return ($items);
    }

    public function emptyProduct(){
        unset($_SESSION['cart']);
    }

    public function totalProduct(){
        if(isset($_SESSION['cart'])){
            return count($_SESSION['cart']);
        }
        else{
            return 0;
        }
    }

}
