<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
        <link rel="shortcut icon" href="./images/d_white.png" type="image/x-icon">
        <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
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
            <div class="container flexbox center">
                <div class=" container about-us flexbox col start-even">
                    <h1 class="page-head w-100 center">About Us</h1>
                    <h1 class="about-us-head w-100 center">Welcome to The decor Shop</h1>
                    <div class="about-us-content">
                        THE DECOR SHOP Is An Online Retailer Of Luxury, Modern And Elegant Home Décor And Lifestyle Products. Operating From Moradabad and Delhi.
                        <br>
                        THE DECOR SHOP Philosophy Is That It Is Possible To Feature Well-Designed, Fashion-Forward, High-Quality Products At Competitive Prices. The Four Cornerstones Are : <br><br>
                        <ul>
                            <li>
                                Design: Well-Designed, Fashion-Forward Products For The Mass Market
                            </li>
                            <li>
                                Quality: High-Quality Products Produced In A Quality-Controlled Environment
                            </li>
                            <li>
                                Value: Offering Well-Designed, Quality Products At Affordable Prices
                            </li>
                            <li>
                                Relationships: Listening To Our Buyers And Building Trusting Relationships With Them
                            </li>
                        </ul>
                        <br>
                        THE DECOR SHOP Factory Located In Moradabad and Delhi. The Owners Of Company Are __________________ And ___________. We Have Fully Dedicated Team Of Designers, Manufacturing Workers And Marketing. Who Are Working With Utmost Inspiration To Bring You Best Quality And Most Innovative Home Decor Products.
                        <br><br>
                        Our Categories Include Designer Lights, Designer Paintings, Tables, Wall Clocks, Planters, Candles, Small Décor Products. 
                    </div>
                </div>
            </div>
            <?php require_once('./utilities/footer.php')?>

        </div>
        <?php require_once('./utilities/overlay.php')?>
        
        <?php require_once('./utilities/cart.php')?>
        <a href="https://wa.me/918171475514" id="wa" class="whatsapp flexbox center">
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