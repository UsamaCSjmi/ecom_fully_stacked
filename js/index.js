

if(window.screen.width<770){
    var menu = document.getElementById("side-nav");
    menu.classList.add("hideNav");
    menu.classList.add("sideNav");
    var listItems = document.getElementsByClassName("hasNav");
    // console.log(listItems.length())
    for(var i=0;i<listItems.length;i++){
        listItems[i].setAttribute("id","li-"+i);
        var span = document.createElement("span");
        span.innerHTML='<div class="up-down-btn"><img class="arrowBtn" src="icons/arrow.svg" alt=""></div>';
        span.setAttribute("onclick","toggleSubNav("+i+")");
        listItems[i].appendChild(span);
        var subNav=listItems[i].getElementsByClassName("subNavigation");
        subNav[0].classList.add("mobile-sub-menu");
        subNav[0].classList.remove("subNavigation");
    }
}
total_cart_items();

function showSearch(){
    document.getElementById("searchPanel").style.visibility="visible";
}
function closeSearch(){
    document.getElementById("searchPanel").style.visibility="hidden";
}
function closeWindow(){
    document.getElementById('overlay').classList.add("close-overlay");
    document.getElementById('overlay').classList.remove("open");
    var subImages=document.getElementById('product-sub-images');
    var allSubImages=subImages.getElementsByTagName('img');
    for(var i =allSubImages.length-1; i>=0;i--){
        if(allSubImages[i].id!="sub-1"){
            allSubImages[i].parentNode.removeChild(allSubImages[i]);
        }
    }
    document.getElementById('qty-product').value=1;
}
function productQuickView(id){
    var overlay = document.getElementById('overlay');
    var count=2;
    $.ajax({
        url:'handleAJAX.php',
        type:'post',
        data:'type=getProduct&id='+id,
        success:function(result){
            if(result){
                // console.log(result);
                document.getElementById('p-name').innerText=result['name'];
                document.getElementById('old-price').innerText="Rs. "+result['mrp'];
                document.getElementById('new-price').innerText="Rs. "+result['price'];
                document.getElementById('saving').innerText="Save "+Math.round((result['mrp']-result['price'])*100/result['mrp'])+" %";
                document.getElementById('short-desc').innerText=result['short_desc'];
                document.getElementById('long-desc').innerText=result['description'];
                document.getElementById('size').innerText="Size : "+result['size'];
                document.getElementById('material').innerText="Material : "+result['material'];
                document.getElementById('finish').innerText="Finish : "+result['finish'];
                document.getElementById('main-image').src="images/product/"+result['image'];
                document.getElementById('sub-1').src="images/product/"+result['image'];
                document.getElementById('making-time').innerText="As We Make Fresh Piece-Dispatch Within "+result['making_time']+"...!";
                document.getElementById('add-to-cart-btn').setAttribute("onclick","manage_cart("+id+",'add')");
                document.getElementById('buy-now-btn').setAttribute("onclick","buyNow("+id+")");
                
                $.ajax({
                    url:'handleAJAX.php',
                    type:'POST',
                    data:'type=getProductImg&id='+id,
                    success:function(images){
                        if(images){
                            var totalImages=images.length;
                            var subImages=document.getElementById('product-sub-images');
                            for(var i=0;i<totalImages;i++){
                                var img=document.createElement('img');
                                img.id="sub-"+count;
                                img.setAttribute("onclick","changeImage('sub-"+count+"')");
                                img.setAttribute("src","images/product/"+images[i]['product_images']);
                                subImages.appendChild(img);
                                count++;
                            }
                        }
                        // else{
                        //     alert("This product don't have more than one image")
                        // }
                    },
                    error: function (request, error) {
                        console.log("Error");
                    },
                });


            }
            else{
                console.log("falied Product")
            }
        }
    });
    document.getElementById('overlay').classList.remove("close-overlay");
    document.getElementById('overlay').classList.add("open");

}
function user_logout(){
    $.ajax({
        url:'handleAJAX.php',
        type:'post',
        data:'type=logoutReq',
        success:function(result){
            if(result){
                // console.log(result); 
                window.location.href=window.location.href;
            }
            else{
                console.log("Unable to login")
            }
        }
    });

}
function changeImage(id){
    var active=document.getElementsByClassName("active-image");
    active[0].classList.remove("active-image");
    var element=document.getElementById(id);
    element.classList.add("active-image");
    var src = element.getAttribute('src');
    document.getElementById("main-image").setAttribute('src',src);
    document.getElementById("main-image").style.animation="imageChange 1s";
}
function decreaseQty(id){
    var qty=document.getElementById(id).value;
    if(qty>1)
        qty--;
    document.getElementById(id).value=qty;
    if(id!='qty-product'){
        pid=id.slice(4);
        manage_cart(pid,'update');
    }
    
}
function increasQty(id){
    var qty=document.getElementById(id).value;
    qty++;
    document.getElementById(id).value=qty;
    if(id!='qty-product'){
        pid=id.slice(4);
        manage_cart(pid,'update');
    }
}
function collapseForm(){
    document.getElementById("arrowBtn").classList.toggle("arrowBtnUp");
    var doc=document.getElementById("ask-us-inner");
    doc.classList.toggle("form-open");
    document.getElementById("window").scrollTo({ left: 0, top: document.getElementById("window").scrollHeight, behavior: "smooth" });

}

function hideNav(){
    document.getElementById("side-nav").classList.add("hideNav");
}

function showNav(){
    document.getElementById("side-nav").classList.remove("hideNav");
}

function toggleSubNav(id){
    var item = document.getElementById("li-"+id);
    var subNav=item.getElementsByClassName("mobile-sub-menu");
    subNav[0].classList.toggle("mobile-sub-nav");
}

// Cart Requests
function manage_cart(pid,type){
    if(type=='update'){
        var qty = jQuery("#qty-"+pid).val();
    }
    else{
        var qty = jQuery("#qty-product").val();
        if(!qty){
            qty=1;
        } 
    }
    if(qty<1){
        qty=1;
    }
    jQuery.ajax({
        url:'./backend/middleware/manageCart.php',
        type:'post',
        data:'pid='+pid+'&qty='+qty+'&type='+type,
        success:function(result){
            if(type=='update' || type=='remove'){
                    getCart();
            }
            total_cart_items();
        }
    });
}

function total_cart_items(){
    jQuery.ajax({ 
        url:'./backend/middleware/manageCart.php',
        type:'post',
        data:'type=getTotal',
        success:function(total){
            document.getElementById('total-cart-items').innerText = total;
            console.log("Success")
            if(total){
                console.log("Total not zero")
            }
            else{
                console.log("Zero");
            }
        },
        error:function(r,e){
            console.log("Error")
        }
    });
}

function buyNow(pid){
    var qty = jQuery("#qty-product").val();
    if(!qty){
        qty=1;
    } 
    if(qty<1){
        qty=1;
    }
    jQuery.ajax({
        url:'./backend/middleware/manageCart.php',
        type:'post',
        data:'pid='+pid+'&qty='+qty+'&type=buyNow',
        success:function(result){
            total_cart_items();
            window.location.href = "checkout.php";
        }
    });
}


function submit_contact(){
    var response = document.getElementById('reponse_msg');
    response.innerText = "";
    const email = $('#email').val();
    const name = $('#name').val();
    const phone = $('#mobile').val();
    const msg = $('#msg').val();
    if(email == "" || name == "" || phone == "" || msg == ""){
        response.innerText = "Fields cannot be empty";
        response.classList.remove("success-msg");
        response.classList.add("error-msg");
    }
    else{

        jQuery.ajax({
            url:'./backend/middleware/manageContact.php',
            type:'post',
            data:'email='+email+'&name='+name+'&phone='+phone+'&msg='+msg+'&type=contact',
            success:function(result){
                console.log(result)
                response.innerText = "Success";
                response.classList.remove("error-msg");
                response.classList.add("success-msg");
            }
        });

    }


}

function search(){
    keyword = document.getElementById('keyword').value;
    if(keyword != ''){
        window.location.href="category.php?keyword="+keyword;
    }
}