<?php include "./config/config.php"; ?>
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
        
        <script src="js/jquery.min.js"></script>
        <script src="js/index.js"></script>
        <script src="js/cart.js"></script>
        <script>
            function loader(id){
                document.getElementById(id).style.display="none";
            }
            $('.owl-carousel').owlCarousel({
                loop:true,
                autoplay:true,
                margin:0,
                nav:true,
                items:1,
                smartSpeed:1000
            })
        </script>
        <title><?php echo COMPANY_NAME?></title>
    </head>
    <body onload="loader('body-loader')">
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
            <?php require_once('./utilities/header.php')?>

            <div class="container">
                <!-- Checkout Section Begin -->
                <section class="checkout spad">
                    <div class="container text-left">
                        <form action="#" class="checkout__form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5>Billing detail</h5>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>First Name <span>*</span></p>
                                                <input type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Last Name <span>*</span></p>
                                                <input type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            
                                            <div class="checkout__form__input">
                                                <p>Address <span>*</span></p>
                                                <input type="text" placeholder="Street Address" required>
                                                <input type="text" placeholder="Apartment. suite, unite ect ( optinal )">
                                            </div>
                                            <div class="checkout__form__input">
                                                <p>Town/City <span>*</span></p>
                                                <input type="text" required>
                                            </div>
                                            <div class="checkout__form__input">
                                                <p>State <span>*</span></p>
                                                <input type="text" required>
                                            </div>
                                            <div class="checkout__form__input">
                                                <p>Postcode/Zip <span>*</span></p>
                                                <input type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="checkout__form__input">
                                                <p>Country <span>*</span></p>
                                                <select name="country" id="country" required>
                                                    <option value="">Select</option>
                                                    <option value="India">India(+91)</option>
                                                </select>
                                                <!-- <input type="text" value="India(+91)" disabled required> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <div class="checkout__form__input">
                                                <p>Phone <span>*</span></p>
                                                <input type="text"required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout__form__input">
                                                <p>Oder notes</p>
                                                <input type="text"
                                                placeholder="Note about your order, e.g, special note for delivery (Optional)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                include "./backend/classes/Cart.php";
                                $obj = new Cart();                                  
                                $items = $obj->getCartItems();
                                
                                ?>
                                <div class="col-lg-6">
                                    <div class="checkout__order">
                                        <h5>Your order</h5>
                                        <div class="checkout__order__product">
                                            <table class="checkout-table w-100">
                                                <thead>
                                                    <tr>
                                                        <th class="table-qty">Image</th>
                                                        <th class="table-product">Product</th>
                                                        <th class="table-qty">Price</th>
                                                        <th class="table-qty">Qty.</th>
                                                        <th class="table-qty">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $subtotal = 0;
                                                    if($items){
                                                        foreach($items as $pid=>$qty){
                                                            $product = new Product();
                                                            $getProduct = $product->getProById($pid);
                                                            $item = $getProduct->fetch_assoc();
                                                            $amount = $item['price']*$qty;
                                                            $subtotal = $subtotal + $amount;

                                                    
                                                    ?>
                                                        <tr>
                                                            <td class="table-data">
                                                                <img src="images/product/<?php echo $item['image']?>" alt="">
                                                            </td>
                                                            <td class="table-data"><?php echo $item['name']?></td>
                                                            <td class="table-data"><?php echo $item['price']?></td>
                                                            <td class="table-data "><?php echo $qty?> </td>
                                                            <td class="table-data table-total">Rs. <?php echo $amount?></td>
                                                        </tr>
                                                    <?php
                                                        }
                                                    }
                                                    $gst=$subtotal*0.18;
                                                    $total = $subtotal + $gst;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="checkout__order__total">
                                            <ul>
                                                <li>Subtotal <span>Rs. <?php echo $subtotal?></span></li>
                                                <li>GST @ 18% <span>Rs. <?php echo $gst?></span></li>
                                                <li>Total <span>Rs. <?php echo $total?></span></li>
                                            </ul>
                                        </div>
                                        <div class="checkout__order__widget">
                                            <div class="payment_option">
                                                <input type="radio" id="paypal" name="payment_method" value="paypal">
                                                <label for="paypal">Paypal</label>
                                            </div>
                                            
                                            <div class="payment_option">
                                                <input type="radio" id="COD" name="payment_method" value="COD" disabled>
                                                <label for="COD">COD(Currently unavailable)</label>
                                            </div>
                                        </div>
                                        <button type="submit" onlick="order_payment"class="site-btn">Place oder</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                    <!-- Checkout Section End -->
            </div>
            <?php require_once('./utilities/footer.php')?>

        </div>
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