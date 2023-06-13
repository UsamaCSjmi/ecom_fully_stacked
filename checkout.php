<?php include "./config/config.php" ?>

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
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
            <?php 
            require_once('./utilities/header.php');
            if(Customer::checkLogin()){
                $user_id = Session::get('USER_ID');
            }
            else{
                echo "
                    <script>
                        window.location.href = 'login.php?url=checkout.php'
                    </script>
                ";
                die();
            }
            
            ?>
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
                                                <input type="text" id="fname" name="fname"required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Last Name <span></span></p>
                                                <input type="text" id="lname" name="lname">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            
                                            <div class="checkout__form__input">
                                                <p>Address <span>*</span></p>
                                                <input type="text" id="street_address" name="street_address" placeholder="Street Address" required>
                                                <input type="text" id="apartment" name="apartment" placeholder="Apartment. suite, unite ect ( optinal )">
                                            </div>
                                            <div class="checkout__form__input">
                                                <p>Town/City <span>*</span></p>
                                                <input type="text" id="city" name="city" required>
                                            </div>
                                            <div class="checkout__form__input">
                                                <p>State <span>*</span></p>
                                                <input type="text" id="state" name="state" required>
                                            </div>
                                            <div class="checkout__form__input">
                                                <p>Postcode/Zip <span>*</span></p>
                                                <input type="text" id="zip_code" name="zip_code" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="checkout__form__input">
                                                <p>Country <span>*</span></p>
                                                <select name="country" id="country" required>
                                                    <option value="">Select</option>
                                                    <option value="+91">India(+91)</option>
                                                </select>
                                                <!-- <input type="text" value="India(+91)" disabled required> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <div class="checkout__form__input">
                                                <p>Phone <span>*</span></p>
                                                <input type="text" id="phone" name="phone"required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout__form__input">
                                                <p>Oder notes</p>
                                                <input type="text" id="order_notes" name="order_notes"
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
                                                <input type="radio" id="razorpay" name="payment_method" value="razorpay" checked>
                                                <label for="razorpay">RazorPay</label>
                                            </div>
                                            
                                            <div class="payment_option">
                                                <input type="radio" id="COD" name="payment_method" value="COD" disabled>
                                                <label for="COD">COD(Currently unavailable)</label>
                                            </div>
                                        </div>
                                        <button type="button" id="submit_button" name="submit_order" onclick="order_submit()" class="site-btn" style="cursor:pointer" > Place oder </button>
                                        <span id = "ord-error" class = "error-msg"></span>
                                        <span id = "ord-success" class = "success-msg"></span>        
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
        <script>
            function order_submit(){
                document.getElementById('ord-error').innerText="";
                const fname = $('#fname').val();
                const lname = $('#lname').val();
                const street_address = $('#street_address').val();
                const apartment = $('#apartment').val();
                const city = $('#city').val();
                const zip_code = $('#zip_code').val();
                const country = $('#country').val();
                const state = $('#state').val();
                const phone = $('#phone').val();
                const order_notes = $('#order_notes').val();
                const payment_method =$('input[name="payment_method"]:checked').val();;
                const total = <?php echo $total; ?>;
                const user_id = <?php echo $user_id; ?>;
                if(fname == "" || street_address == "" || city == "" || state == "" || zip_code == "" || country == "" || phone == ""){
                    document.getElementById('ord-error').innerText="Please Fill required fields!";
                }
                else{

                    $.ajax({
                        type: 'post',
                        url:'submit_order.php',
                        data:"submit_order=true&fname="+fname+"&lname="+lname+"&street_address="+street_address+"&apartment="+apartment+"&city="+city+"&zip_code="+zip_code+"&country="+country+"&state="+state+"&phone="+phone+"&order_notes="+order_notes+"&total="+total+"&user_id="+user_id+'&payment_method='+payment_method,
                        success:function(result){
                            var options = {
                                "key": "<?php echo API_KEY?>", 
                                "amount": "<?php echo $total*100?>",
                                "currency": "INR",
                                "name": "<?php echo COMPANY_NAME?>",
                                "description": "Test Transaction",
                                "image": "<?php echo COMPANY_LOGO_URL?>",
                                "order_id": result.trim(), 
                                "handler": function (response){
                                    razorpay_payment_id = response.razorpay_payment_id;
                                    razorpay_order_id = response.razorpay_order_id;
                                    razorpay_signature = response.razorpay_signature;
                                    $.ajax({
                                        type: 'post',
                                        url:'submit_order.php',
                                        data:"handler_details=true&razorpay_payment_id="+razorpay_payment_id+"&razorpay_order_id="+razorpay_order_id+"&razorpay_signature="+razorpay_signature,
                                        success:function(result){
                                            console.log(result)
                                            if(result!="error"){
                                                window.location.href = "success.php";
                                            }
                                            else{
                                                window.location.href = "failure.php";
                                            }
                                        }
    
                                    });
                                },
                                "prefill": {
                                    "name": fname+" "+lname,
                                    "contact": phone
                                },
                                "theme": {
                                    "color": "#3399cc"
                                }
                            };
                            var rzp1 = new Razorpay(options);
                            rzp1.on('payment.failed', function (response){
                                    alert(response.error.code);
                                    alert(response.error.description);
                                    alert(response.error.source);
                                    alert(response.error.step);
                                    alert(response.error.reason);
                                    alert(response.error.metadata.order_id);
                                    alert(response.error.metadata.payment_id);
                                    console.log(response.error);
                                    window.location.href = "failure.php";
                                });
                                rzp1.open();
                            },
                            error:function(response){
                                console.log(response)
                                alert(response);
                                window.location.href = "failure.php";
                        }
                    });
                    
                }

            }
        </script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    </body>
</html>