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
                    <h1>Refund Policy</h1>
                </div>
                <h3 class="policy-heading-small">Return, Refund, Cancellation & Exchange Policy</h3>
                <p class="policy-text">
                    Simplicity, transparency, and security are the hallmarks of your online shopping experience at <?php echo WEBSITE?>.
                </p>
                <p class="policy-text">
                    We go the distance to ensure that every transaction on our website is seamless. We take great care in delivering our products and adhere to the highest quality standards. As a policy, we do not entertain returns on products delivered in perfect, undamaged condition. Please refer to our Return Policy for your understanding.
                </p>

                <p class="policy-text">
                    If your goods are damaged or one of any above conditions, we would be happy to give you the following alternatives:
                    <ul>
                        <li>Replacement with the right product</li>
                        <li>Exchange the product for an alternative of your choice of equal value</li>
                        <li>Refund of the full amount paid by you.</li>
                    </ul>
                </p>

                <p class="policy-text">
                    A product is only eligible for return under the following conditions:
                    <ol>
                        <li>
                            A wrong product has been dispatched in the event that a product does not match the item selected during order confirmation.
                        </li>
                        <li>
                            If you identify a manufacturing defect on the received product.
                        </li>
                        <li>
                            If the product is received in a damaged condition. Note: Please do not accept any package if it is tampered with or damaged upon delivery.
                        </li>
                        <li>
                            To ensure that we are able to process your returns accurately and promptly, please read through the return process, along with the guidelines that need to be followed.
                        </li>
                    </ol>
                </p>
                <h4>
                    RETURN PROCESS:
                </h4>

                <p class="policy-text">
                    Please raise a Return Request within 48 hours of delivery by calling our Customer Service at  <?php echo MOBILE?>    (Monday - Saturday 11 AM to 7 PM) or mail us at <?php echo EMAIL?>. 
                </p>

                <p class="policy-text">
                    You will be asked to mail a good-quality picture of the received product clearly depicting the issue (in case of damage/defect/incorrect product) along with your order details to  <?php echo EMAIL?>. (You can mail the picture in the first step, for a faster process). Our Quality Assurance team will check the details in reference to its eligibility for return.
                </p>
                <p class="policy-text">
                    We will get back to you with your Return Request Status within 2-3 days of receiving your request mail with pictures. Once your return request has been accepted, we will arrange a reverse pick-up for the product in question. It usually takes 2-3 working days to organize a pickup and 5-7 days for delivery at our war Cancellation
                    Most of our items are make to orders at a factory, if the item is already made, then the order cannot be canceled. To check the status-making process or cancel the order please call us at our customer care number <?php echo "+91 - ".MOBILE ?> or mail us at  <?php echo EMAIL ?> We are unable to cancel the order once it has been maderehouse.
                </p>

                <p class="policy-text">
                    Once the merchandise is back at our warehouse, the refund process will get initiated within 3 to 5 working days of receiving it. The refund will be processed in your same bank Account. In the case of COD, you need to share bank account details in a return request email. Read further for important details.
                </p>
                <h4>
                    Custom Product Order
                </h4>

                <p class="policy-text">
                    Custom products are the products that are created at your request, apart from other available products on the website. On such product orders, COD won't be applicable. Such orders are non-refundable, non-cancelable & non-exchangeable. They can only be replaced in case of an incorrect product or a damaged product received.
                </p>
                <h4>
                    Points to Remember:
                </h4>
                <p class="policy-text">
                    The product must be returned with the original packaging, including the tags, barcodes, accessories, manuals, warranty cards, shipping labels (pasted on the packet), invoice, etc.
                </p>
                <p class="policy-text">
                    The product should be unused and in its original condition.
                </p>
                <p class="policy-text">
                <?php echo COMPANY_NAME?> reserves the right to do a thorough quality check of the product before issuing a refund. Given the nature of our products, we reserve the sole discretion to provide the resolution to any situation as we deem fit. Each return or exchange request is handled on a case-to-case basis and we request you to get in touch with our team for prompt resolution.
                </p>
                <h4>
                    Disclaimer: All policies are subject to change without prior notice. In case of any conflict Terms & Conditions Policy would prevail.
                </h4>
                <p class="policy-text">
                    For any assistance contact our Customer Service at <?php echo MOBILE?>  (Monday-Saturday 11 AM to 7 PM) or <?php echo EMAIL?> to initiate the return process. 
                </p>
                <h4>
                    Order Cancellation
                </h4>
                <p class="policy-text">
                    Most of our items are make to orders at a factory, if the item is already made, then the order cannot be canceled. To check the status-making process or cancel the order please call us at our customer care number <?php echo "+91 - ".MOBILE ?> or mail us at  <?php echo EMAIL ?> We are unable to cancel the order once it has been made.
                </p>            
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