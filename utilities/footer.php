<div class="footer w-100 flexbox col center">
                <footer class="footer-grid w-100">
                    <div class="footer-grid-item footer-main-menu flexbox col start">
                        <p class="footer-heading">main menu</p>
                        <div class="footer-navigation">
                            <ul class="flexbox col start">
                            <?php
                                
                                if ($getCat2) {
                                    
                                    while ($resultCat2 = $getCat2->fetch_assoc()) {
                                    ?>
                                    <li>
                                        <a href="category.php?catId=<?php echo $resultCat2['id']?>">
                                            <?php echo $resultCat2['categories']?>
                                        </a>
                                    </li>
                                    <?php
                                    }
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-grid-item footer-briefs flexbox col start">
                        <p class="footer-heading">briefs</p>
                        <div class="footer-navigation">
                            <ul class="flexbox col start">
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="#">Reach Us</a></li>
                                <li><a href="#">Journals</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-grid-item footer-policies flexbox col start">
                        <p class="footer-heading">poliocies</p>
                        <div class="footer-navigation">
                            <ul class="flexbox col start">
                                <li><a href="#">Return, Refund, Cancellation & Exchange Policy </a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms Of Service</a></li>
                                <li><a href="#">Shipping Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-grid-item footer-subscription flexbox col start">
                        <p class="footer-heading">gET in touch</p>
                        <div class="footer-navigation">
                            <ul class="flexbox col start contact-list">
                                <li>The Decor Shop</li>
                                <li>H-No. 5, Asalat Ganj, Choti Mandi, Moradabad U.P. - India</li>
                                <li>Contact : +91-8171475514</li>
                                <li>Email : info@startechworld.com</li>
                                <li class="flexbox start w-100">
                                    <a class="flexbox center" href="https://www.instagram.com/" target="_blank">
                                        <img class="icon icon1" src="icons/instagram.svg" alt="india">
                                    </a>
                                    <a class="flexbox center" href="https://www.instagram.com/" target="_blank">
                                        <img class="icon icon2" src="icons/facebook-f.svg" alt="india">
                                    </a>
                                    <a class="flexbox center"href="https://www.instagram.com/" target="_blank">
                                        <img class="icon icon3" src="icons/twitter.svg" alt="india">
                                    </a>
                                    <a class="flexbox center"href="https://www.instagram.com/" target="_blank">
                                        <img class="icon icon4" src="icons/pinterest-p.svg" alt="india">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </footer>
                <a href="">
                    <div class="logo">
                        <img class="logo-image"src="./images/d_white.png" alt="logo">
                        <p class="logo-head">DECOR</p>
                        <p class="logo-para">SHOP</p>
                    </div>
                </a>
                <div class="sponsership w-100 flexbox center">
                    <p class="company">&copy; The Decor Shop 2023</p>
                    <p class="company">&nbsp;|&nbsp; Powered By : &nbsp;</p>
                    <a href="https://startechworld.com/" target="_blank">StarTech World</a>
                </div>
            </div>