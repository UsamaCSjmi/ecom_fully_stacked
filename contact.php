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
        <title>Contact - <?php echo COMPANY_NAME?></title>
    </head>
    <body onload="loader('body-loader')">
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
            <?php require_once('./utilities/header.php')?>

            <div class="container flexbox col center">
                <div class="site-heading-simple w-100 flexbox center">
                    <h1>Ask Us</h1>
                </div>
                <div class="container flexbox col center">
                    <div class="container flexbox col center">
                        <div class="ask-us-outer flexbox col center collapsible w-100">
                            <div id="ask-us-inner" class="ask-us-inner container form-open">
                                <form action="#" class="ask-us w-100 flexbox col start-even">
                                    <div class="flexbox input-row w-100">
                                        <div class="input-item flexbox col start-even">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" required>
                                        </div>
                                        <div class="input-item flexbox col start-even">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" required>
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
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once('./utilities/footer.php')?>

        </div>

        <?php require_once('./utilities/cart.php')?>
        <a href="https://wa.me/91<?php echo MOBILE?>" id="wa" class="whatsapp flexbox center">
            <img src="icons/whatsapp.svg" alt="whatsapp logo">
        </a>
        <script type="text/javascript">
            function loader(id){
                document.getElementById(id).style.display="none";
            }
        </script>
        <script src="js/jquery.min.js"></script>
        <script src="js/index.js"></script>
        <script src="js/cart.js"></script>
    </body>
</html>