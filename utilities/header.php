
<?php 
include './backend/lib/Session.php';
Session::init();
include './backend/lib/Database.php';
include './backend/helpers/Format.php';

spl_autoload_register(function ($class) {
    include_once "./backend/classes/".$class.".php";
});
$db = new Database();
$fm = new Format();
$cmr = new Customer();

 ?>
<?php
include './backend/classes/Category.php';
include './backend/classes/Product.php';
include './backend/classes/Subcategory.php';

$cat = new Category();
$cat2 = new Category();
$getCat = $cat->getAllCat();
$getCat2 = $cat2->getAllCat();

?>

<div class="siteHeader w-100">
    <div class="w-100">
        <div class="topbar">
            <a href="/" class="announcements">
                <span>Made in India | Cash on delivery available |</span>
                <span>&nbsp Enjoy free shipping all over india</span>
            </a>
        </div>
        <div class="toolbar w-100">
            <div class="toolbar-list">
                <div class="toolbar-item">
                    <ul class="social-items">
                        <li>
                            <a class="flexbox center" href="https://www.instagram.com/" target="_blank">
                                <img class="icon icon1" src="icons/instagram.svg" alt="india">
                            </a>
                        </li>
                        <li>
                            <a class="flexbox center" href="https://www.instagram.com/" target="_blank">
                                <img class="icon icon2" src="icons/facebook-f.svg" alt="india">
                            </a>
                        </li>
                        <li>
                            <a class="flexbox center"href="https://www.instagram.com/" target="_blank">
                                <img class="icon icon3" src="icons/twitter.svg" alt="india">
                            </a>
                        </li>
                        <li>
                            <a class="flexbox center"href="https://www.instagram.com/" target="_blank">
                                <img class="icon icon4" src="icons/pinterest-p.svg" alt="india">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="toolbar-item">
                    <div class="currency flexbox center">
                        <div class="flag">
                            <img src="icons/flag.jpg" alt="india">
                        </div>
                        <div class="country">INR</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="w-100 flexbox center">
        <div class="container flexbox center col navHead">
            <nav class="w-100">
                <div class="w-100 flexbox equal topNav">
                    <div class="left-inner-head flexbox center">
                        <div onclick="showNav()"class="menu-button"> 
                            <div class="menubtn">
                                <hr class="line line1">
                                <hr class="line line2">
                                <hr class="line line3">
                            </div>
                        </div>
                        <?php
                            if($_SERVER['REQUEST_URI']!="/thedecorshop/checkout.php"){
                        ?>
                        <div onclick="showSearch()" class="search navbarIcon">
                            <img src="icons/search.svg" alt="search">
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="mid-inner-head flexbox center">
                        <a href="index.php">
                            <div class="logo">
                                <img class="logo-image"src="./images/d_white.png" alt="logo">
                                <p class="logo-head">DECOR</p>
                                <p class="logo-para">SHOP</p>
                            </div>
                        </a>
                    </div>
                    <div class="right-inner-head flexbox center">

                        <?php
                        if(Customer::checkLogin()){
                        ?>

                        <div class="user navbarIcon" onclick="user_logout()">
                            <img src="icons/logout.svg" alt="user">
                        </div>

                        <?php
                        }
                        else{
                        ?>

                        <div class="user navbarIcon">
                            <a href="login.php">
                                <img src="icons/user.svg" alt="user">
                            </a>
                        </div>
                        
                        <?php
                        }
                        ?>

                        <div onclick="showCart()" class="cart navbarIcon cartIcon">
                            <img src="icons/cart.svg" alt="cart">
                            <div id="total-cart-items" onload="total_cart_items()"></div>
                        </div>
                    </div>
                </div>

                    <?php
                    if($_SERVER['REQUEST_URI']!="/thedecorshop/checkout.php"){
                    ?>
                <ul id="side-nav" class="">
                    <li class="sideNavHead w-100 flexbox start-even">
                        <span class="navItem">
                            <a href="index.html">
                                <div class="logo">
                                    <img class="logo-image"src="./images/d_white.png" alt="logo">
                                </div>
                            </a>
                        </span>
                        <span class="navItem">
                            <div class="close navbarIcon" onclick="hideNav()">
                                <img src="icons/close.svg" alt="close">
                            </div>
                        </span>
                    </li>
                    <?php
                    if ($getCat) {

                        while ($resultCat = $getCat->fetch_assoc()) {
                            $subcat = new Subcategory();
                            $getSubcat = $subcat->getSubcatByCatId($resultCat['id']);
                            if(!$getSubcat){
                        ?>
                            <li class="navItem">
                                <a class="navLink" href="category.php?catId=<?php echo $resultCat['id']?>">
                                    <?php echo $resultCat['categories']?>
                                </a>
                            </li>  
                        <?php
                            }
                            else{
                                ?>

                                <li class="navItem hasNav">
                                    <a class="navLink" href="category.php?catId=<?php echo $resultCat['id']?>">
                                        <?php echo $resultCat['categories']?>
                                    </a>
                                    <ul id="" class="subNavigation  text-left">
                                        <?php
                                          while ($resultSubcat = $getSubcat->fetch_assoc()){
                                        ?>
                                        <li class="subNavItem">
                                            <a class="subNavLink" href="category.php?subcatId=<?php echo $resultSubcat['id']?>">
                                                <?php echo $resultSubcat['sub_categories']?>
                                            </a>
                                        </li>
                                        <?php
                                          }
                                        ?>
                                    </ul>
                                </li>

                                <?php
                            }
                        }
                    }
                    ?>
                    

                    <li class="navItem">
                        <a class="navLink" href="about.php">About Us</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink" href="contact.php">Contact Us</a>
                    </li>
                    
                </ul> 
                
        <?php }?>                    
            </nav>
        </div>
        
        <?php
        if($_SERVER['REQUEST_URI']!="/thedecorshop/checkout.php"){
        ?>

        <div id="searchPanel"class="siteSearchPanel flexbox center w-100">
            <div class="container">
                <div class="w-100 flexbox equal topNav">
                    <div class="left-inner-head flexbox center">
                        <div class="search navbarIcon">
                            <img src="icons/search.svg" alt="search">
                        </div>
                    </div>
                    <div class="mid-inner-head">
                        <div class="searchInput w-100">
                            <input type="text" placeholder="Search Here ...">
                        </div>
                    </div>
                    <div class="right-inner-head flexbox center">
                        <div class="close navbarIcon" onclick="closeSearch()">
                            <img src="icons/close.svg" alt="close">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>

    </header>
</div>