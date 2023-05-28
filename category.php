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
        
        <title>Categories - <?php echo COMPANY_NAME?></title>
    </head>
    <body onload="loader('body-loader')">
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
            <?php require_once(SITE_PATH.'/utilities/header.php')?>
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
                            <a href="<?php echo SITE_PATH?>/category.php?subcatId=<?php echo $subcat['id']?>">
                            <div class="single-category w-100 flexbox center">
                                <img src="<?php echo SITE_PATH?>/images/product/<?php echo $proimg['image']?>" alt="Category Image">
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
                                <a href="<?php echo SITE_PATH?>/product.php?pid=<?php echo $product['id']?>">
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH?>/<?php echo $product['image']?>" alt="Product Image">
                                </a>
                                <div class="product-image-up flexbox center">
                                    <button onclick="productQuickView(<?php echo $product['id']?>)" class="quick-view">Quick View</button>
                                </div>
                                <p class="product-tag">Sale</p>
                            </div>
                            <div class="product-description flexbox col center w-100">
                                <a href="<?php echo SITE_PATH?>/product.php?pid=<?php echo $product['id']?>">
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
        <?php require_once('./utilities/cart.php')?>
        <script>
            function loader(id){
                document.getElementById(id).style.display="none";
            }
        </script>

        <script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
    </body>
</html>