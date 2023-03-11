<?php

include '../classes/Product.php';
include '../lib/Session.php';
include '../classes/Customer.php';
include "../classes/Cart.php";

$type=$_POST['type'];

$obj=new Cart();

if($type=='getCartItems'){
    $items = $obj->getCartItems();
    header('Content-Type:application/json');
    echo json_encode($items);
}
if($type=='add'){
    $obj->addProduct($_POST['pid'],$_POST['qty']);
}
if($type=='remove'){
    $obj->removeProduct($_POST['pid']);
}
if($type=='update'){
    $obj->updateProduct($_POST['pid'],$_POST['qty']);
}
if($type=='getTotal'){
    $total = $obj->totalProduct();
    echo $total;
}


?>