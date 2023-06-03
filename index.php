<?php include "./config/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta type="robot" content = "noindex,nofollow">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
        <link rel="shortcut icon" href="./images/d_white.png" type="image/x-icon">
        <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="./css/loaders.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/responsive.css">
        
        <!-- <script src="js/jquery.min.js"></script>
        <script src="owlcarousel/owl.carousel.min.js"></script>
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
        </script> -->
        <title><?php echo COMPANY_NAME?></title>
    </head>
    <body onload="loader('body-loader')">
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
            <?php require_once('./utilities/header.php')?>
            <div class="site-banner-area w-100">
                <div class="banner-slideshow owl-carousel owl-theme">
                    <?php
                    require_once (SERVER_PATH.'/backend/classes/Banner.php');
                    $banners = new Banner();

                    $getBan = $banners->getAllBan();
                    if ($getBan) {
                        while ($banner = $getBan->fetch_assoc()) {
                            ?>
                            <div class="item">
                                <div class="banner w-100">
                                    <div class="banner-image flexbox center w-100">
                                        <img src="<?php echo BANNER_IMAGE_SITE_PATH?>/<?php echo $banner['image']?>" alt="banner">
                                    </div>
                                </div>
                            </div>                            
                            <?php
                        }
                    }
                    ?>

                    
                </div>
            </div>
            <div class="container flexbox col center">
                <div class="site-heading-simple w-100 flexbox center">
                    <h1>Shop by</h1>
                </div>
                <!-- categories grid -->
                <div class="categories site-grid grid-5 w-100">
                    <?php
                    $categories = new Category();

                    $getCategories = $categories->getAllCat();
                    if ($getCategories) {
                        while ($category = $getCategories->fetch_assoc()) {
                            $product=new Product();
                            $getProduct=$product->getProImgByCatId($category['id']);
                            $proimg = $getProduct->fetch_assoc();
                            ?>
                            <div class="item">
                                <a href="category.php?catId=<?php echo $category['id']?>">
                                <div class="single-category w-100 flexbox center">
                                    <img src="images/product/<?php echo $proimg['image']?>" alt="Category Image">
                                    <p class="category-name w-100"><?php echo $category['categories']?></p>
                                </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>

                <div class="site-heading-simple w-100 flexbox center">
                    <h1>New Arrivals</h1>
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
                                <div class="product-image-up flexbox center">
                                    <button onclick="productQuickView(<?php echo $product['id']?>)" class="quick-view">Quick View</button>
                                </div>
                                <p class="product-tag">Sale</p>
                            </div>
                            <div class="product-description flexbox col center w-100">
                                <a href="product.php?pid=<?php echo $product['id']?>">
                                    <p class="product-name"><?php echo $product['name']?></p>
                                    <p class="vendor-name"><?php echo COMPANY_NAME;?></p>
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
            <div class="pink-background information-bar w-100">
                <div class="price-n-delivery-info">
                    <span class="main-tagline">Prices including GST also enjoy free shipping</span><br>
                    <span class="sub-tagline">All over India</span>
                </div>
            </div>

            <div class="promo-section flexbox center w-100">
                <img src="images/img3.webp" alt="promo-image">
                <div class="promo-box">
                    <div class="promo-content flexbox col start-even">
                        <h4>IMPRESSIVE</h4>
                        <h2>HOME FURNISHING</h2>
                        <p class="promo-deal">Grab the Best Deal on Home Furnishing </p>
                        <a href="#"class="btn btn-secondary">Shop Now</a>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="about-us w-100 flexbox col start-even">
                    <h1 class="about-us-head">Welcome to <?php echo COMPANY_NAME?></h1>
                    <?php include "./utilities/about.php";?>
                </div>
            </div>
            <?php require_once('./utilities/footer.php')?>

        </div>
        <?php require_once('./utilities/overlay.php')?>
        
        <?php require_once('./utilities/cart.php')?>
        <a href="https://wa.me/91<?php echo MOBILE?>" id="wa" class="whatsapp flexbox center">
            <img src="icons/whatsapp.svg" alt="whatsapp logo">
        </a>
        <script src="js/jquery.min.js"></script>
        <script src="owlcarousel/owl.carousel.min.js"></script>
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
        <script src="js/index.js"></script>
        <script src="js/cart.js"></script>
    </body>
</html>