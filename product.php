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
        
        <title>The Decor Shop</title>
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
                        <p class="vendor-name">The decor shop</p>
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
                            <button onclick="addToCart()"class="btn btn-primary">Add To Cart</button>
                            <button onclick="buyNow()"class="btn btn-secondary hover-shine">Buy It Now</button>
                        </div>
                        <p id="short-desc"class="product-short-description"></p>
                        <p id="long-desc"class="product-long-description"></p>
                        <p id="size" class="detail"></p>
                        <p id="material" class="detail "></p>
                        <p id="finish" class="detail "></p>
                        <p class="detail warranty">ONE YEAR WARRANTY ON MOVEMENT MACHINE</p>
                        <p class="ready-time">As We Make Fresh Piece-Dispatch Within 3 TO 5 Days...!</p>
                        <!-- <div class="ask-us-outer flexbox col center collapsible w-100">
                            <button onclick="collapseForm()" class="collapse-form-btn btn w-100">
                                Ask a question
                                <div class="up-down-btn">
                                    <img id="arrowBtn" src="icons/arrow.svg" alt="">
                                </div>
                            </button>
                            <div id="ask-us-inner" class="ask-us-inner container">
                                <form action="#" class="ask-us w-100 flexbox col start-even">
                                    <div class="flexbox input-row w-100">
                                        <div class="input-item flexbox col start-even">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" >
                                        </div>
                                        <div class="input-item flexbox col start-even">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" >
                                        </div>
                                    </div>
                                    <div class="input-item flexbox col start-even">
                                        <label for="mobile">Phone number</label>
                                        <input type="text" id="mobile">
                                    </div>
                                    <div class="input-item flexbox col start-even">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="" rows="5"></textarea>
                                    </div>
                                    <div class="input-item w-100">
                                        <input type="submit" class="btn btn-secondary hover-shine" value="Send">    
                                    </div>
                                </form>
                            </div>
                        </div> -->
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
        <div id="cart" class="shopping-cart-overlay w-100">
            <div class="cart-area flexbox col start-even">
                <div class="cart-head flexbox start-even w-100">
                    <h2>cart</h2>
                    <div class="close cartIcon" onclick="hideCart()">
                        <img src="icons/close.svg" alt="close">
                    </div>
                </div>
                <div class="cart-items flexbox col start w-100">
                    <div class="cart-item flexbox w-100">
                        <div class="cart-product-image">
                            <a href="product.html">
                                <img src="images/img7.webp" alt="">
                            </a>
                        </div>
                        <div class="cart-product-description flexbox col start w-100">
                            <a href="product.html">
                                <p class="product-name w-100">ANTIQUE BLACK GOLDEN CAMBER TRINKET WALL CLOCK</p>
                            </a>
                            <div class="cart-product-info w-100 flexbox ">
                                <div class="quantity-bar flexbox">
                                    <span onclick="decreaseQty('qty-1')"class="update-qty-btn">-</span>
                                    <input id="qty-1"class="quantity-input"type="text" value="1">
                                    <span onclick="increasQty('qty-1')"class="update-qty-btn">+</span>
                                </div>
                                <p class="new-price">Rs. 1200.00</p>
                            </div>
                        </div>

                    </div>
                    <div class="cart-item flexbox w-100">
                        <div class="cart-product-image">
                            <a href="product.html">
                                <img src="images/img8.webp" alt="">
                            </a>
                        </div>
                        <div class="cart-product-description flexbox col start w-100">
                            <a href="product.html">
                                <p class="product-name w-100">ANTIQUE BLACK GOLDEN CAMBER TRINKET WALL CLOCK</p>
                            </a>
                            <div class="cart-product-info w-100 flexbox ">
                                <div class="quantity-bar flexbox">
                                    <span onclick="decreaseQty('qty-2')"class="update-qty-btn">-</span>
                                    <input id="qty-2"class="quantity-input"type="text" value="1">
                                    <span onclick="increasQty('qty-2')"class="update-qty-btn">+</span>
                                </div>
                                <p class="new-price">Rs. 1200.00</p>
                            </div>
                        </div>

                    </div>
                    <div class="cart-item flexbox w-100">
                        <div class="cart-product-image">
                            <a href="product.html">
                                <img src="images/img9.webp" alt="">
                            </a>
                        </div>
                        <div class="cart-product-description flexbox col start w-100">
                            <a href="product.html">
                                <p class="product-name w-100">ANTIQUE BLACK GOLDEN CAMBER TRINKET WALL CLOCK</p>
                            </a>
                            <div class="cart-product-info w-100 flexbox ">
                                <div class="quantity-bar flexbox">
                                    <span onclick="decreaseQty('qty-3')"class="update-qty-btn">-</span>
                                    <input id="qty-3"class="quantity-input"type="text" value="1">
                                    <span onclick="increasQty('qty-3')"class="update-qty-btn">+</span>
                                </div>
                                <p class="new-price">Rs. 1200.00</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="cart-footer w-100 flexbox col">
                    <div class="cart-subtotal flexbox w-100 start-even">
                        <p class="footer-heading" style="font-size: 13px;">subtotal</p>
                        <p class="footer-heading" style="font-size: 13px;">Rs. 12,700.00</p>
                    </div>
                    <p class="cart-note">Shipping, taxes, and discounts codes calculated at checkout. Orders will be processed in INR. </p>
                    <a class="btn btn-secondary hover-shine"href="checkout.html">check out</a>
                </div>
            </div>
        </div>
        <script>
            function loader(id){
                document.getElementById(id).style.display="none";
            }

        </script>

        <script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script>
            <?php
                if(isset($_GET['pid'])){
                    echo 'productQuickView('.$_GET["pid"].')';
                }
            ?>
        </script>
    </body>
</html>