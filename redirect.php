<?php
    session_start();
    include "./backend/classes/Order.php";
    $obj = new Order();
    $order_id = $_SESSION['order_id'];
    $_SESSION['payment_id'] = $_GET['payment_id'];
    if($_SESSION['TID'] == $_GET['payment_request_id']){
        if($_GET['payment_status'] == "Credit"){
            echo $obj->updateOrder($order_id,"Success",$_GET['payment_id']);
            header('location:success.php');
        }
        else{
            echo $obj->updateOrder($order_id,"Failed",$_GET['payment_id']);
            header('location:failure.php');
        }
    }
    else{
        echo "Invalid Payment Request ID";
    }
    
?>