<?php

include "./backend/classes/Subcategory.php";

$subCategory = new Subcategory();
$getSubcategory = $subCategory->getSubcatByCatId(21);
if($getSubcategory == ""){
    echo "nhi hai";
}
else{
    echo "hai";
}
?>