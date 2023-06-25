<?php
include "./config/config.php";
?>
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
        <script src="js/index.js"></script>
        <script src="js/cart.js"></script>
        <title><?php echo COMPANY_NAME?></title>
    </head>
    <body onload="loader('body-loader')">
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
            <?php require_once('./utilities/header.php')?>
            <div class="container policy">
                <div class="policy-heading-big w-100">
                    <h1>Terms of Service</h1>
                </div>
                <h3 class="policy-heading-small">Terms of Service</h3>

                <?php 
                    require_once("./backend/classes/Details.php");
                    $det = new Details();
                    $res= $det->getContent('Terms of Service');
                    $res = mysqli_fetch_assoc($res);
                ?>
                <p class="policy-text">Last Updated : <?php echo $res['updated_on']?></p>
                <?php echo $res['content']?>
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
        <script src="js/index.js"></script>
        <script src="js/cart.js"></script>
    </body>
</html>