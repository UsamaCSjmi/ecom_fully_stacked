<?php 
include "./config/config.php";
$order_id=$_GET['order_id'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
        <link rel="shortcut icon" href="./images/d_white.png" type="image/x-icon">
        <link rel="stylesheet" href="./css/loaders.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/responsive.css">
        <link rel="stylesheet" href="./css/style2.css">
        <title><?php echo COMPANY_NAME?></title>
    </head>
    <body onload="loader('body-loader')">
        <!-- <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div> -->
        <div class="site-wrapper flexbox col center w-100">
            <?php 
            require_once('./utilities/header.php');
            if(Customer::checkLogin()){
                $user_id = Session::get('USER_ID');
            }
            else{
                echo "
                    <script>
                        window.location.href = 'login.php?url=order_detail.php'
                    </script>
                ";
                die();
            }
            
            ?>
            <div class="container">

                <!-- Orders List Section Begin -->
                <section class="shop-cart checkout__form spad">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__order">
                                    <h5>Orders Details - <?php echo $order_id?></h5>
                                    <div class="checkout__order__product">
                                        <table class="checkout-table w-100">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Image</th>
                                                    <th>Product Name</th>
                                                    <th>Unit Price</th>
                                                    <th>Qty</th>
                                                    <th>Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                include_once('./backend/classes/Order.php');
                                                $obj = new Order();
                                                $order = $obj->getOrderByOrderId($order_id);
                                                $order = $order->fetch_assoc();
                                                $order_details = $obj->getOrdersDetailsByOrderId($order_id);
                                                $cart_subtotal=0;
                                                $tax=0.18;

                                                $i=1;
                                                if($order_details)
                                                while($row = $order_details->fetch_assoc()){
                                                    $cart_subtotal=$cart_subtotal+($row['price']*$row['qty']*100/118);
                                                ?>
                                                
                                                
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><a href="product.php?pid=<?php echo $row['product_id'];?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH."/".$row['image'];?>" alt="" style="margin-right: 10px;max-width: 45px;" /></a></td>
                                    <td class="product-name"><a href="product.php?pid=<?php echo $row['product_id'];?>"><?php echo $row['name'];?></a></td>
                                    <td ><?php echo round($row['price']*100/118,2);?></td>
                                    <td ><?php echo $row['qty'];?></td>
                                    <td ><?php echo round($row['price']*$row['qty']*100/118,2);?></td>
                                </tr>
                                <?php
                                 $i++;
                                }
                                    $taxAmt=$tax*$cart_subtotal;
                                    $cart_total=$cart_subtotal+$taxAmt;
                                ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <td >Sub Total</td>
                                    <td ><?php echo round($cart_subtotal,2) ;?></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td >GST@18%</td>
                                    <td ><?php echo round($taxAmt,2) ;?></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td >Total</td>
                                    <td><?php echo round($cart_total,2) ;?></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>Street Address : </strong> <?php echo $order['street_address'];?>
                                        <strong>Apartment : </strong><?php echo $order['apartment'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>City : </strong><?php echo $order['city'] ?> 
                                        <strong>Zip Code : </strong><?php echo$order['zip_code']?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>State : </strong><?php echo$order['state'];?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>Name : </strong>
                                        <?php echo $order['fname']." ".$order['lname']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>Phone : </strong>
                                        <?php echo "+".$order['country']."-".$order['phone']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>Order Notes : </strong>
                                        <?php echo $order['order_notes']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>Order Status : </strong>
                                        <?php echo $order['order_status']; ?>
                                    </td>
                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Orders List Section End -->

            </div>
            <?php require_once('./utilities/footer.php')?>
        </div>
        <?php require_once('./utilities/cart.php')?>
        <a href="https://wa.me/91<?php echo MOBILE?>" id="wa" class="whatsapp flexbox center">
            <img src="icons/whatsapp.svg" alt="whatsapp logo">
        </a>
        <script>
            function loader(id){
                document.getElementById(id).style.display="none";
            }
        </script>
        <script src="js/jquery.min.js"></script>
        <script src="js/index.js"></script>
        <script src="js/cart.js"></script>
    </body>
</html>