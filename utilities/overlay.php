<div id="overlay" class="overlay close-overlay flexbox center">
    <div id="window" class="product-description-window flexbox ">
        <button class="close-window" onclick="closeWindow()">X</button>
        <div class="window-inner flexbox start-even text-left w-100">
            <div class="sub-images-container flexbox">
                <div id="product-sub-images" class="product-sub-images flexbox col">
                    <img id="sub-1" class="active-image" onclick="changeImage('sub-1')" src="" alt="">
                </div>
            </div>
            <div class="product-main-image">
                <img id="main-image"class="main-image-active "src="" alt="">
            </div>
            <div class="window-product-description">
                <div class="product-description flexbox col w-100">
                    <p class="vendor-name">The decor shop</p>
                    <p id="p-name" class="product-name"></p>
                    <div class="product-prices flexbox w-100">
                        <p id="old-price" class="old-price"></p>
                        <p id="new-price"class="new-price"></p>
                        <p id="saving"class="product-savings"></p>
                    </div>
                    <p class="offers">PRICE INCLUDING TAX & FREE SHIPPING ALL OVER INDIA...! CASH ON DELIVERY AVAILABLE...! </p>
                    <hr>
                    <p class="qty-label">quantity</p>
                    <div class="quantity-bar flexbox">
                        <span onclick="decreaseQty('qty-product')"class="update-qty-btn">-</span>
                        <input id="qty-product"class="quantity-input"type="text" value="1">
                        <span onclick="increasQty('qty-product')"class="update-qty-btn">+</span>
                    </div>
                    <div class="product-buttons w-100">
                        <button id="add-to-cart-btn" class="btn btn-primary">Add To Cart</button>
                        <button id="buy-now-btn" class="btn btn-secondary hover-shine">Buy It Now</button>
                    </div>
                    <p id="short-desc"class="product-short-description"></p>
                    <p id="long-desc"class="product-long-description"></p>
                    <p id="size" class="detail"></p>
                    <p id="material" class="detail "></p>
                    <p id="finish" class="detail "></p>
                    <p class="detail warranty">ONE YEAR WARRANTY ON MOVEMENT MACHINE</p>
                    <p class="ready-time">As We Make Fresh Piece-Dispatch Within 3 TO 5 Days...!</p>
                    <div class="ask-us-outer flexbox col center collapsible w-100">
                        <button onclick="collapseForm()" class="collapse-form-btn btn w-100">
                            Ask a question
                            <div class="up-down-btn">
                                <img id="arrowBtn" src="icons/arrow.svg" alt="">
                            </div>
                        </button>
                        <div id="ask-us-inner" class="ask-us-inner container">
                            <form action="#" class="ask-us w-100 flexbox col start-even">
                                <div class="flexbox input-row w-100">
                                    <div class="input-item flexbox col start-even">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" >
                                    </div>
                                    <div class="input-item flexbox col start-even">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" >
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
    </div>
</div>