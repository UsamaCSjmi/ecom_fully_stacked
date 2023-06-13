<?php

include '../classes/Contact.php';

$type=$_POST['type'];

$obj=new Contact();

if($type=='contact'){
    $msg = $obj->contactInsert($_POST);
    echo $msg;
}


?>