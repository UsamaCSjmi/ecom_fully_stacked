<?php include "./config/config.php"; ?>

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
        <title><?php echo COMPANY_NAME?> - About</title>
    </head>
    <body onload="loader('body-loader')">
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
            <?php require_once(SERVER_PATH.'/utilities/header.php')?>
            <div class="container flexbox center">
                <div class=" container about-us w-100 flexbox col start-even">
                    <h1 class="page-head w-100 center">About Us</h1>
                   
                    <div class="about-content">
                        <?php 
                        require_once("./backend/classes/Details.php");
                        $det = new Details();
                        $res= $det->getContent('About');
                        $res = mysqli_fetch_assoc($res);
                        echo $res['content'];
                        ?>
                    </div>
                </div>
            </div>
            <?php require_once(SERVER_PATH.'/utilities/footer.php')?>
        </div>
        <?php require_once(SERVER_PATH.'/utilities/overlay.php')?>
        <?php require_once(SERVER_PATH.'/utilities/cart.php')?>
        <a href="https://wa.me/91<?php echo MOBILE?>" id="wa" class="whatsapp flexbox center">
            <img src="<?php echo SITE_PATH?>/icons/whatsapp.svg" alt="whatsapp logo">
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