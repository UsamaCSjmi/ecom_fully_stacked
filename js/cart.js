
function hideCart(){
    document.getElementById("cart").classList.remove("cart-view");
    cartArea= document.getElementById('cart-items');
    cartArea.innerHTML='';
}

function showCart(){
    const cart=document.getElementById("cart");
    cart.classList.add("cart-view");
    getCart();
}

function getCart(){
    $.ajax({
        url:'./backend/middleware/manageCart.php',
        type:'post',
        data:'type=getCartItems',
        success:function(result){
            if(result){
                displayCartItems(result);
            }
            else{
                document.getElementById('cart-items').innerHTML='<div class="empty-cart">Your cart is empty</div>';
            }
        },
        error: function (request, error) {
            console.log(error);
        }
    });
}

function displayCartItems(result){
    cartArea= document.getElementById('cart-items');
    cartArea.innerHTML='';
    totalPrice = 0;
    document.getElementById('cart-total').innerText="Rs. 0.00";
    for(pid in result){
        const qty = result[pid];

        $.ajax({
            url:'handleAJAX.php',
            type:'post',
            data:'type=getProduct&id='+pid,
            success:function(result){
                if(result){
                    id = result['id'];
                    price = result['price'];
                    imageName = result['image'];
                    name = result['name'];
                    totalPrice = totalPrice + (price*qty);

                    product = document.createElement('div');
                    product.classList.add('cart-item');
                    product.classList.add('flexbox');
                    product.classList.add('w-100');
                    
                        productImage = document.createElement('div');
                        productImage.classList.add('cart-product-image');

                            imageLink = document.createElement('a');
                            imageLink.href="product.php?pid="+id;
                                
                                image = document.createElement('img');
                                image.src = "images/product/"+imageName;

                            imageLink.appendChild(image);
                        productImage.appendChild(imageLink);
                    
                    product.appendChild(productImage);

                        productDescription = document.createElement('div');
                        productDescription.classList.add('cart-product-description');
                        productDescription.classList.add('flexbox');
                        productDescription.classList.add('col');
                        productDescription.classList.add('start');
                        productDescription.classList.add('w-100');
                        
                            imageLink = document.createElement('a');
                            imageLink.href="product.php?pid="+id;
                        
                                productName = document.createElement('p');
                                productName.classList.add('product-name');
                                productName.classList.add('w-100');
                                productName.innerText = name;
                            
                            imageLink.appendChild(productName);
                                
                        productDescription.appendChild(imageLink);

                            productInfo = document.createElement('div');
                            productInfo.classList.add('cart-product-info');
                            productInfo.classList.add('w-100');
                            productInfo.classList.add('flexbox');

                                productQuantity = document.createElement('div');
                                productQuantity.classList.add('quantity-bar');
                                productQuantity.classList.add('flexbox');

                                    decrease = document.createElement('span');
                                    decrease.setAttribute("onclick","decreaseQty('qty-"+id+"')");
                                    decrease.classList.add("update-qty-btn");
                                    decrease.innerText = "-";

                                productQuantity.appendChild(decrease);
                                    
                                    quantity = document.createElement('input');
                                    quantity.id = "qty-"+id;
                                    quantity.classList.add("quantity-input");
                                    quantity.setAttribute("type","text");
                                    quantity.setAttribute("value",qty);

                                productQuantity.appendChild(quantity);

                                    increase = document.createElement('span');
                                    increase.setAttribute("onclick","increasQty('qty-"+id+"')");
                                    increase.classList.add("update-qty-btn");
                                    increase.innerText = "+";

                                productQuantity.appendChild(increase);
                                
                            productInfo.appendChild(productQuantity);

                            productPrice = document.createElement('p');
                            productPrice.classList.add("new-price");
                            productPrice.innerText = "Rs. "+price;

                            productInfo.appendChild(productPrice);

                            removeBtn = document.createElement('button');
                            removeBtn.classList.add('remove-btn');
                            removeBtn.setAttribute("onclick", "manage_cart("+id+",'remove')");

                                delIcon = document.createElement('img');
                                delIcon.src = "icons/delete.svg";
                                delIcon.setAttribute("alt","Remove");
                                removeBtn.appendChild(delIcon);
                            
                            productInfo.appendChild(removeBtn);

                        productDescription.appendChild(productInfo);

                    product.appendChild(productDescription);
                    cartArea.appendChild(product);     

                    total = document.getElementById('cart-total');
                    total.innerText = "Rs. "+totalPrice;
                }
            }
        });
    }
}

