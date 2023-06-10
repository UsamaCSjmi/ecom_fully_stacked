<?php

if(isset($_POST['type'])){

    include './backend/classes/Product.php';
    include './backend/lib/Session.php';
    include './backend/classes/Customer.php';
    
    $fm = new Format();
    $db = new Database();
    $type=$fm->validation($_POST['type']);
    $type = mysqli_real_escape_string($db->link, $type);
    // echo $type;
    // die();
    if($type=="getProduct"){
        $id=$fm->validation($_POST['id']);
        $id = mysqli_real_escape_string($db->link, $id);
        $product=new Product();
        $getProduct = $product->getProById($id);
        if ($getProduct) {
            $products = $getProduct->fetch_assoc();
    
            header('Content-Type:application/json');
            echo json_encode($products); 
            // echo json_encode($getProduct); 

        }
    
    }
    
    elseif($type=="getProductImg"){
        $id=$fm->validation($_POST['id']);
        // $id=5;
        $pr=array();
        $id = mysqli_real_escape_string($db->link, $id);
        $product=new Product();
        $getProduct = $product->getProImagesId($id);
        if ($getProduct) {
            $i=0;
            while($products = $getProduct->fetch_assoc()){
                $pr[$i]=($products);
                $i++;
            }
    
            header('Content-Type:application/json');
            echo json_encode($pr);  
        }
    
    }

    elseif($type=="loginReq"){
        $user = new Customer();
        $msg=$user->customerLogin($_POST);
        echo $msg;
    }

    elseif($type=="regReq"){
        $user = new Customer();
        $msg=$user->customerRegistration($_POST);
        echo $msg;
    }

    elseif($type=="logoutReq"){
        Session::init();
        echo Session::destroy();
    }
    

}
else{
    echo "Permission Denied !";
}    

?>