<?php
include "../backend/config/config.php";
session_start();
$username = DB_USER;
$password = DB_PASS;
$server = DB_HOST;
$database =DB_NAME;

$conn = mysqli_connect($server, $username, $password, $database );
if(!$conn){
    die("Error :". mysqli_connect_error());
}
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/thedecorshop');
define('SITE_PATH','http://localhost/thedecorshop');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'/images/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'/images/product/');

define('PRODUCT_MULTIPLE_IMAGE_SERVER_PATH',SERVER_PATH.'/images/product_images/');
define('PRODUCT_MULTIPLE_IMAGE_SITE_PATH',SITE_PATH.'/images/product_images/');

define('BANNER_IMAGE_SERVER_PATH',SERVER_PATH.'/images/banner/');
define('BANNER_IMAGE_SITE_PATH',SITE_PATH.'/images/banner/');

?>
