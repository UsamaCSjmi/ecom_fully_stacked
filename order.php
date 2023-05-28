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
        <title><?php echo COMPANY_NAME?></title>
    </head>
    <body onload="loader('body-loader')">
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
            <?php require_once('./utilities/header.php')?>
            <div class="container">

                <!-- Orders List Section Begin -->
                <section class="shop-cart checkout__form spad">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__order">
                                    <h5>My Orders</h5>
                                    <div class="checkout__order__product">
                                        <table class="checkout-table w-100">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Order Id</th>
                                                    <th>Total</th>
                                                    <th>Payment Status</th>
                                                    <th>Order Status</th>
                                                    <th>View PDF</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>DECOR00001</td>
                                                    <td>Rs. 500</td>
                                                    <td>Success</td>
                                                    <td>Success</td>
                                                    <td><a href="/" download>Download</a></td>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>DECOR00001</td>
                                                    <td>Rs. 500</td>
                                                    <td>Success</td>
                                                    <td>Success</td>
                                                    <td><a href="/" download>Download</a></td>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>DECOR00001</td>
                                                    <td>Rs. 500</td>
                                                    <td>Success</td>
                                                    <td>Success</td>
                                                    <td><a href="/" download>Download</a></td>
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