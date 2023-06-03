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
        
        <title><?php echo COMPANY_NAME?></title>
    </head>
    <body onload="loader('body-loader')">
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
            <?php require_once('./utilities/header.php')?>
            <div class="container flexbox col center">
                
            <div class="window-inner flexbox start-even text-left w-100">
                <div class="sub-images-container flexbox">
                    <div id="product-sub-images" class="product-sub-images flexbox col">
                        <img id="sub-1" class="active-image" onclick="changeImage('sub-1')" src="" alt="">
                    </div>
                </div>
                <div class="product-main-image">
                    <img id="main-image"class="main-image-active "src="" alt="">
                </div>
                <div class="window-product-description">
                    <div class="product-description flexbox col w-100">
                        <p class="vendor-name"><?php echo COMPANY_NAME;?></p>
                        <p id="p-name" class="product-name"></p>
                        <div class="product-prices flexbox w-100">
                            <p id="old-price" class="old-price"></p>
                            <p id="new-price"class="new-price"></p>
                            <p id="saving"class="product-savings"></p>
                        </div>
                        <p class="offers">PRICE INCLUDING TAX & FREE SHIPPING ALL OVER INDIA...! CASH ON DELIVERY AVAILABLE...! </p>
                        <hr>
                        <p class="qty-label">quantity</p>
                        <div class="quantity-bar flexbox">
                            <span onclick="decreaseQty('qty-product')"class="update-qty-btn">-</span>
                            <input id="qty-product"class="quantity-input"type="text" value="1">
                            <span onclick="increasQty('qty-product')"class="update-qty-btn">+</span>
                        </div>
                        <div class="product-buttons w-100">
                            <button id="add-to-cart-btn" class="btn btn-primary">Add To Cart</button>
                            <button onclick="buyNow()"class="btn btn-secondary hover-shine">Buy It Now</button>
                        </div>
                        <p id="short-desc"class="product-short-description"></p>
                        <p id="long-desc"class="product-long-description"></p>
                        <p id="size" class="detail"></p>
                        <p id="material" class="detail "></p>
                        <p id="finish" class="detail "></p>
                        <p class="detail warranty">ONE YEAR WARRANTY ON MOVEMENT MACHINE</p>
                        <p class="ready-time">As We Make Fresh Piece-Dispatch Within 3 TO 5 Days...!</p>
                    </div>
                </div>
            </div>

            <div class="site-heading-simple w-100 flexbox center">
                <h1>You May also like</h1>
            </div>

                <!-- products grid -->
                <div class="categories site-grid grid-5 product-grid w-100">
                    <?php
                    
                    $products = new Product();
                    $getProducts = $products->getNewProducts(5);
                    if ($getProducts) {
                        while ($product = $getProducts->fetch_assoc()) {
                    ?>

                    <div class="item">
                        <div class=" single-product w-100 flexbox col center">
                            <div class="product-image-container">
                                <a href="product.php?pid=<?php echo $product['id']?>">
                                    <img src="images/product/<?php echo $product['image']?>" alt="Product Image">
                                </a>
                                <p class="product-tag">Sale</p>
                            </div>
                            <div class="product-description flexbox col center w-100">
                                <a href="product.php?pid=<?php echo $product['id']?>">
                                    <p class="product-name"><?php echo $product['name']?></p>
                                    <p class="vendor-name">The decor shop</p>
                                    <div class="product-prices flexbox center w-100">
                                        <p class="old-price">Rs. <?php echo $product['mrp']?></p>
                                        <p class="new-price">Rs. <?php echo $product['price']?></p>
                                    </div>
                                    <p class="product-savings">
                                        Save    <?php
                                                $discount=($product['mrp']-$product['price'])*100/$product['mrp'];
                                                $discount=round($discount);
                                                echo $discount;
                                                ?>
                                                %
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php
                        }
                    }
                    ?>
                </div>   
            </div>

            <?php require_once('./utilities/footer.php')?>
        </div>

        <?php require_once('./utilities/cart.php')?>
        <script>
            function loader(id){
                document.getElementById(id).style.display="none";
            }

        </script>

        <script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript" src="js/cart.js"></script>
        <script>
            <?php
                if(isset($_GET['pid'])){
                    echo 'productQuickView('.$_GET["pid"].')';
                }
            ?>
        </script>
    </body>
</html>