<?php 
session_start();
include "./config/config.php"; 
require('./backend/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
?>

<?php
    if(isset($_POST['submit_order'])){
        include "./backend/classes/Order.php";
        $user_id = 0;
        $order = new Order();
        $payment_method = $_POST["payment_method"]; 
        if($payment_method=="razorpay"){

            $order_id = $order->generateOrder($_POST,$user_id);

            // -----------------Getting Order products details-------------------- 
            include "./backend/classes/Cart.php";
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
            $order->updateOrderTotal($total,$order_id);



            $orderData = [
                'receipt'         => $order_id,
                'amount'          => $total*100, // Total rupees in paise
                'currency'        => 'INR'
            ];

            
            //Generating RZP order for later on varification
            $api = new Api(API_KEY,SECRET_KEY);
            $razorpayOrder = $api->order->create($orderData);
            $_SESSION['order_id'] = $razorpayOrder['id'];
            echo $razorpayOrder;
        }
        else{
            echo "Payment Method Not Available";
            die();
        }
    }
    elseif(isset($_POST['handler_details'])){

        

    }
    else{
        echo "Invalid Request";
        die();
    }
?>


<script>

{
"razorpay_payment_id": "pay_29QQoUBi66xm2f",
"razorpay_order_id": "order_9A33XWu170gUtm",
"razorpay_signature": "9ef4dffbfd84f1318f6739a3ce19f9d85851857ae648f114332d8401e0949a3d"
}



generated_signature = hmac_sha256(order_id + "|" + razorpay_payment_id, secret);
if (generated_signature == razorpay_signature) {
payment is successful
}

</script>