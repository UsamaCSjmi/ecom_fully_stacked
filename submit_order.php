<?php 
session_start();
include "./config/config.php";
?>

<?php
    if(isset($_POST['submit_order'])){
        include "./backend/classes/Order.php";
        $order = new Order();
        $payment_method = $_POST["payment_method"]; 
        if($payment_method=="instamojo"){

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
                    $amount = $item['price']*$qty*100/118;
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
            $user_id = Session::get("USER_ID");
            if(!$user_id)
            $user_id = 0;
            $order->updateOrderTotal($total,$order_id,$user_id);


            session_start();

            $ch = curl_init();
            
            // curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
            curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                        array("X-Api-Key:".X_API_KEY,
                              "X-Auth-Token:".X_AUTH_TOKEN));
            $payload = Array(
                'purpose' => 'Buy Product | The Designers Home',
                'amount' => $total,
                'phone' => $_POST["phone"],
                'buyer_name' => $_POST["fname"]." ".$_POST["lname"],
                'redirect_url' => SITE_PATH.'/redirect.php',
                'send_sms' => true,
                'allow_repeated_payments' => false
            );
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
            $response = curl_exec($ch);
            curl_close($ch); 
            $response = json_decode($response);
            $_SESSION['TID'] = $response->payment_request->id;
            $order->updateOrderPayReqID($_SESSION['TID'],$order_id);

            header('location:'.$response->payment_request->longurl);
            die();

        }
        elseif($payment_method=="COD"){
            
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
                    $amount = $item['price']*$qty*100/118;
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
            $user_id = Session::get("USER_ID");
            if(!$user_id)
            $user_id = 0;
            $order->updateOrderTotal($total,$order_id,$user_id);
            header("Location:success.php");
            die();
        }
        else{
            echo "Payment Method Not Available";
            die();
        }
    }
    else{
        echo "Invalid Request";
        die();
    }
?>

