<?php 
session_start();
include "./config/config.php"; 
require('./backend/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
?>

<?php
    if(isset($_POST['submit_order'])){
        include "./backend/classes/Order.php";
        // $user_id = 0;
        // $user_id = Session::get("USER_ID");
        $order = new Order();
        $payment_method = $_POST["payment_method"]; 
        if($payment_method=="razorpay"){

            $order_id = $order->generateOrder($_POST);
            $_SESSION['order_id']=$order_id;

            // -----------------Getting Order products details-------------------- 
            include "./backend/classes/Cart.php";
            include "./backend/classes/Product.php";
            $obj = new Cart();                                  
            $items = $obj->getCartItems();
            $subtotal = 0;
            if($items){
                foreach($items as $pid=>$qty){
                    $product = new Product();
                    $getProduct = $product->getProById($pid);
                    $item = $getProduct->fetch_assoc();
                    $amount = $item['price']*$qty;
                    $subtotal = $subtotal + $amount;
                    $order_details = array("product_id"=>$pid,"qty"=>$qty,"price"=>$item['price'],"order_id"=>$order_id);

                    $insert_status = $order->insertOrderDetails($order_details);
                    if($insert_status === false){
                        echo "failed";
                        return;
                        die();
                    }
                }
            }
            $gst=$subtotal*0.18;
            $total = $subtotal + $gst;
            // $order->updateOrderTotal($total,$order_id);

            $orderData = [
                // 'receipt'         => $order_id,
                'amount'          => $total*100, // Total rupees in paise
                'currency'        => 'INR'
            ];

            
            //Generating RZP order for later on varification
            $api = new Api(API_KEY,SECRET_KEY);
            $razorpayOrder = $api->order->create($orderData);
            $_SESSION['razorpayOrder'] = $razorpayOrder['id'];

            echo $razorpayOrder['id'];
        }
        else{
            echo "Payment Method Not Available";
            die();
        }
    }
    else if(isset($_POST['handler_details'])&&isset($_POST['razorpay_payment_id'])&&isset($_POST['razorpay_order_id'])&&isset($_POST['razorpay_signature'])){
        $razorpay_payment_id = $_POST['razorpay_payment_id'];
        $razorpay_order_id = $_POST['razorpay_order_id'];
        $razorpay_signature = $_POST['razorpay_signature'];

        $_SESSION['razorpay_payment_id']=$razorpay_payment_id;

        $api = new Api(API_KEY, SECRET_KEY);
        $result = $api->utility->verifyPaymentSignature(array('razorpay_order_id' => $_SESSION['razorpayOrder'],'razorpay_payment_id' => $razorpay_payment_id, 'razorpay_signature' => $razorpay_signature));

        if($result==""){
            include "./backend/classes/Order.php";
            $obj = new Order();
            $order_id = $_SESSION['order_id'];
            echo $obj->updateOrder($order_id,"Success",$razorpay_payment_id);
        }
        else{
            echo "error";
        }
    }
    else{
        echo "Invalid Request";
        die();
    }
?>

