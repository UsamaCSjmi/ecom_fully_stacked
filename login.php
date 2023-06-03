<?php include "./config/config.php";
$url = "index.php";
if(isset($_GET['url'])){
    $url = $_GET['url'];
}
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
        
        <title><?php echo COMPANY_NAME?></title>
    </head>
    <body onload="loader('body-loader')">
        <div id="body-loader" class="loader">
            <div class="site-preloader"></div>
        </div>
        <div class="site-wrapper flexbox col center w-100">
        
            <?php require_once('./utilities/header.php')?>
        
            <div class="container flexbox center">
                <div class="form-container w-100 flexbox col center">
                    <div id="form-area"class="form-area flexbox center">
                        <div id="forgot-form " class="forgot-form form flexbox col center w-100">
                            <h1 class="">Reset Password</h1>
                            <form action="#" class="flexbox col w-100">
                                <div class="form-control flexbox w-100 col start">
                                    <label for="email">Email</label>
                                    <input name="email" type="email">
                                </div>
                                <div class="form-control flexbox w-100 col start">
                                    <button onclick="user_forgot()" class="btn btn-secondary w-100 hover-shine">Send OTP</button>
                                    <a href="javascript:void(0)" onclick="showForm('signup')" class="btn ">Create an account</a>
                                    <a href="javascript:void(0)" onclick="showForm('signin')" class="btn ">Sign In</a>
                                </div>
                            </form>
                        </div>
                        <div id="login-form" class="login-form form flexbox col center w-100">
                            <h1 class="">Login</h1>
                            <form class="flexbox col w-100">
                                <div class="form-control flexbox w-100 col start">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="email">
                                    <span id = "email-error" class = "error-msg"></span>
                                </div>
                                <div class="form-control flexbox w-100 col start">
                                    <label for="password">Password</label>
                                    <input id="password" name="password"type="password">
                                    <span id = "password-error" class = "error-msg"></span>
                                </div>
                                <div class="form-control flexbox w-100 col start">
                                    <button type="button" onclick="user_login()" class="btn btn-secondary w-100 hover-shine">Sign In</button>
                                    <span id = "login-error" class = "error-msg"></span>
                                    <span id = "login-success" class = "success-msg"></span>
                                    <a href="javascript:void(0)" onclick="showForm('signup')"class="btn ">Create an account</a>
                                    <a href="javascript:void(0)"onclick="showForm('forgot')" class="btn ">Forgot Password</a>
                                </div>
                            </form>
                        </div>
                        <div id="register-form " class="register-form form flexbox col center w-100">
                            <h1 class="">sign up</h1>
                            <form action="#" class="flexbox col w-100">
                                <div class="form-control flexbox w-100 col start">
                                    <label for="name">Name</label>
                                    <input name="name" type="text">
                                </div>
                                <div class="form-control flexbox w-100 col start">
                                    <label for="email">Email</label>
                                    <input name="email" type="email">
                                </div>
                                <div class="form-control flexbox w-100 col start">
                                    <label for="password">Password</label>
                                    <input name="password"type="password">
                                </div>
                                <div class="form-control flexbox w-100 col start">
                                <button onclick="user_register()" class="btn btn-secondary w-100 hover-shine">Sign Up</button>
                                    <a href="javascript:void(0)" onclick="showForm('signin')"class="btn">Already have an account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once('./utilities/footer.php')?>
            
            
        </div>
        
        <?php require_once('./utilities/cart.php')?>
        <script>
            function loader(id){
                document.getElementById(id).style.display="none";
            }
            function showForm(type){
                form=document.getElementById("form-area");
                if(type==='signin')
                    form.style.left="-100%";
                else if(type==="signup")
                    form.style.left="-200%";
                else if(type==="forgot")
                    form.style.left="0%";
            }
        </script>

        <script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script>
            const url = '<?php echo $url;?>';
            function user_login(){
                var loginform = document.getElementById('login-form');
                var errors = loginform.querySelectorAll('.error-msg');
                for (var i=0;i<errors.length;i++)
                    errors[i].innerText="";
                loginform.querySelector('#login-success').innerText="";
                var email = loginform.querySelector('#email').value;
                var password = loginform.querySelector('#password').value;
                if(email === ''){
                    loginform.querySelector('#email-error').innerText="Email cannot be empty";
                }
                else if(password == ''){
                    loginform.querySelector('#password-error').innerText="Password cannot be empty";
                }
                else{
                    $.ajax({
                        url:'handleAJAX.php',
                        type:'post',
                        data:'type=loginReq&email='+email+'&password='+password,
                        success:function(result){
                            if(result){
                                if(result=="success"){
                                    loginform.querySelector('#login-success').innerText="Successfully Logged In";
                                    window.location.href=url
                                }
                                else if(result == "incorrect"){
                                    loginform.querySelector('#login-error').innerText="Incorrect email or password";

                                }
                            }
                            else{
                                console.log("Unable to login")
                            }
                        }
                    });
                }
            }

        </script>
    </body>
</html>