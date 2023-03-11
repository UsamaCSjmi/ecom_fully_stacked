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
        
        <title>Categories - The Decor Shop</title>
    </head>
    <body onload="loader('body-loader')">
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
            <?php require_once('./utilities/header.php')?>
            <div class="container flexbox col center">

                <?php
                    
                    $fm = new Format();
                    $db = new Database();
                    
                    if(isset($_GET['catId'])){
                        $catId=$fm->validation($_GET['catId']);
                        $catId = mysqli_real_escape_string($db->link, $catId);

                        $category = new Category();
                        $getCategory = $category->getCatById($catId);
                        $cat = $getCategory->fetch_assoc();
                ?>

                <div class="site-heading-simple w-100 flexbox center">
                    <h1><?php echo $cat['categories']?> - includes</h1>
                </div>
                <!-- categories grid -->
                <div class="categories site-grid grid-5 w-100">
                    <?php
                        $subCategory = new Subcategory();
                        $getSubcategory = $subCategory->getSubcatByCatId($catId);

                        while ($subcat = $getSubcategory->fetch_assoc()) {
                            $product=new Product();
                            $getProduct=$product->getProImgBySubCatId($subcat['id']);
                            $proimg = $getProduct->fetch_assoc();

                    ?>
                        <div class="item">
                            <a href="category.php?subcatId=<?php echo $subcat['id']?>">
                            <div class="single-category w-100 flexbox center">
                                <img src="images/product/<?php echo $proimg['image']?>" alt="Category Image">
                                <p class="category-name w-100"><?php echo $subcat['sub_categories']?></p>
                            </div>
                            </a>
                        </div>

                    <?php

                        }
                    }
                    ?>    
                   

                </div>
                <?php

                    $products = new Product();
                    
                    if(isset($_GET['catId'])){
                        $siteHeading = $cat['categories'];
                        $getProducts = $products->getProByCatId($catId);
                    }
                    elseif(isset($_GET['subcatId'])){
                        $subcatId=$fm->validation($_GET['subcatId']);
                        $subcatId = mysqli_real_escape_string($db->link, $subcatId);
    
                        $subCategory = new Subcategory();
                        $getSubcategory = $subCategory->getSubcatById($subcatId);
                        $subcat = $getSubcategory->fetch_assoc();

                        $siteHeading = $subcat['sub_categories'];

                        $getProducts = $products->getProBySubCatId($subcatId);
                    }
                    else{
                        $siteHeading = "All Products";

                        $getProducts = $products->getAllProduct();
                    }
                ?>
                <div class="site-heading-simple w-100 flexbox center">
                    <h1><?php echo $siteHeading ?></h1>
                </div>
                <!-- products grid -->
                <div class="categories site-grid grid-4 w-100">
                    
                    <?php
                        
                        if ($getProducts) {
                            while ($product = $getProducts->fetch_assoc()) {
                    ?>

                    <div class="item">
                        <div class=" single-product w-100 flexbox col center">
                            <div class="product-image-container">
                                <a href="product.php?pid=<?php echo $product['id']?>">
                                    <img src="images/product/<?php echo $product['image']?>" alt="Product Image">
                                </a>
                                <div class="product-image-up flexbox center">
                                    <button onclick="productQuickView(<?php echo $product['id']?>)" class="quick-view">Quick View</button>
                                </div>
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
        <?php require_once('./utilities/overlay.php')?>
        
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
    </body>
</html>