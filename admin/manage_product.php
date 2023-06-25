
<?php
require 'top.inc.php';
$msg='';
$categories_id='';
$sub_categories_id='';
$name='';
$mrp='';
$price='';
$making_time='';
$size='';
$material='';
$finish='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_desc='';
$meta_keyword='';
$MultipleImageArr=[];
$image_required='required';

if(isset($_GET['pi']) && $_GET['pi']>0){
    $pi=get_safe_value($conn,$_GET['pi']);
    $id=get_safe_value($conn,$_GET['id']);

    //Deleting image from folder
    $get_img="select product_images from product_images where id='$pi'";
    $res=mysqli_query($conn,$get_img);
    $row=mysqli_fetch_assoc($res);
    unlink(PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$row['product_images']);

    //Delete from database
    $delete_sql="delete from product_images where id='$pi'";
    mysqli_query($conn,$delete_sql);
    header('location:manage_product.php?id='.$id);
    die();
}

if(isset($_GET['id']) && $_GET['id']!=''){
    $image_required='';
    $id = get_safe_value($conn, $_GET['id']);
    $res= mysqli_query($conn,"select * from product where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $row=mysqli_fetch_assoc($res);
        $categories_id=$row['categories_id'];
        $sub_categories_id=$row['sub_categories_id'];
        $name=$row['name'];
        $mrp=$row['mrp'];
        $price=$row['price'];
        $making_time=$row['making_time'];
        $size=$row['size'];
        $material=$row['material'];
        $finish=$row['finish'];
        $short_desc=$row['short_desc'];
        $description=$row['description'];
        $meta_title=$row['meta_title'];
        $meta_desc=$row['meta_desc'];
        $meta_keyword=$row['meta_keyword'];
        $image=$row['image'];

        $resMultipleImage=mysqli_query($conn,"select id, product_images from product_images where product_id='$id'");
        if(mysqli_num_rows($resMultipleImage)>0){
            $j=0;
            while($rowMultipleImage=mysqli_fetch_assoc($resMultipleImage)){
                $MultipleImageArr[$j]['product_images']=$rowMultipleImage['product_images'];
                $MultipleImageArr[$j]['id']=$rowMultipleImage['id'];
                $j++;
            }
        }
    }
    else{
        header('Location:product.php');
        die();
    }
}
if(isset($_POST['submit'])){
    $categories_id = get_safe_value($conn, $_POST['categories_id']);
    $sub_categories_id = get_safe_value($conn, $_POST['sub_categories_id']);
    $name = get_safe_value($conn, $_POST['name']);
    $mrp = get_safe_value($conn, $_POST['mrp']);
    $price = get_safe_value($conn, $_POST['price']);
    $making_time = get_safe_value($conn, $_POST['making_time']);
    $size = get_safe_value($conn, $_POST['size']);
    $material = get_safe_value($conn, $_POST['material']);
    $finish = get_safe_value($conn, $_POST['finish']);
    // $image = get_safe_value($conn, $_POST['image']);
    $short_desc = get_safe_value($conn, $_POST['short_desc']);
    $description = get_safe_value($conn, $_POST['description']);
    $meta_title = get_safe_value($conn, $_POST['meta_title']);
    $meta_desc = get_safe_value($conn, $_POST['meta_desc']);
    $meta_keyword = get_safe_value($conn, $_POST['meta_keyword']);
    
    $res= mysqli_query($conn,"select * from product where name='$name'");
    $check=mysqli_num_rows($res);

    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }
            else{
                $msg="Product already exist";
            }
        } 
        else{
            $msg="Product already exist";
        }
    }

    if($_FILES['image']['type']!='' && ($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg')){
        $msg ="Please select only PNG/JPG/JPEG Formats";
    }

    if(isset($_FILES['product_images'])){
        foreach($_FILES['product_images']['type'] as $key=>$val){
            if($_FILES['product_images']['type'][$key]!='' && ($_FILES['product_images']['type'][$key]!='image/png' && $_FILES['product_images']['type'][$key]!='image/jpg' && $_FILES['product_images']['type'][$key]!='image/jpeg')){
                $msg ="Please select Extra images in only PNG/JPG/JPEG Formats";
            }
        }
    }


    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            if($_FILES['image']['name']!=''){
                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                $update_sql="update product set categories_id='$categories_id',sub_categories_id= NULLIF('$sub_categories_id',''),name='$name',mrp='$mrp',price='$price',making_time='$making_time',size='$size',material='$material',finish='$finish',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image' where id='$id'";
            }
            else{
                $update_sql="update product set categories_id='$categories_id',sub_categories_id= NULLIF('$sub_categories_id','') ,name='$name',mrp='$mrp',price='$price',making_time='$making_time',size='$size',material='$material',finish='$finish',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword'where id='$id'";
            }
            mysqli_query($conn,$update_sql);
        }
        else{
            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
            mysqli_query($conn,"insert into product (categories_id,sub_categories_id,name,mrp,price,making_time,size,material,finish,short_desc,description,meta_title,meta_desc,meta_keyword,status,image) values('$categories_id',NULLIF('$sub_categories_id',''),'$name','$mrp','$price','$making_time','$size','$material','$finish','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword','1','$image')");
            $id=mysqli_insert_id($conn);
        }
        // Product Multiple images start
        
        if(isset($_GET['id']) && $_GET['id']!=''){
            foreach($_FILES['product_images']['name'] as $key=>$val){
                if($_FILES['product_images']['name'][$key]!=''){
                    if(isset($_POST['product_images_id'][$key])){
                        $image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
                        move_uploaded_file($_FILES['product_images']['tmp_name'][$key],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
                        mysqli_query($conn,"update product_images set product_images='$image' where id='".$_POST['product_images_id'][$key]."'");
                    }
                    else{
                        $image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
                        move_uploaded_file($_FILES['product_images']['tmp_name'][$key],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
                        mysqli_query($conn,"insert into product_images (product_id,product_images) values('$id','$image')");
                    }
                }
            }
        }
        else{
            if(isset($_FILES['product_images']['name'])){
                foreach($_FILES['product_images']['name'] as $key=>$val){
                    $image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
                    move_uploaded_file($_FILES['product_images']['tmp_name'][$key],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
                    mysqli_query($conn,"insert into product_images (product_id,product_images) values('$id','$image')");
                }
            }
        }



        // Product Multiple images end
        header('Location:product.php');
        die();
    }
    
}

?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header"><strong>Product</strong><small> Form</small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="categories" class=" form-control-label">Categories</label>
                                        <select class="form-control" name="categories_id" id="categories_id" onchange="get_sub_cat('')" required>
                                            <option>Select Categories</option>
                                            <?php
                                            $res=mysqli_query($conn,"select id,categories from categories order by categories asc");
                                            while($row=mysqli_fetch_assoc($res)){
                                                if($row['id']==$categories_id){
                                                    echo " <option selected value=".$row['id'].">".$row['categories']."</option>";
                                                }
                                                else{
                                                    echo " <option value=".$row['id'].">".$row['categories']."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="categories" class=" form-control-label">Sub Categories</label>
                                        <select class="form-control" name="sub_categories_id" id="sub_categories_id">
                                            <option>Select Sub Categories</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Product Name</label>
                                <input type="text" name="name" placeholder="Enter Product name" class="form-control" required value="<?php echo $name?>">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="mrp" class=" form-control-label">MRP</label>
                                        <input type="text" name="mrp" placeholder="Enter Product MRP" class="form-control" required value="<?php echo $mrp?>">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="price" class=" form-control-label">Price</label>
                                        <input type="text" name="price" placeholder="Enter Product Price" class="form-control" required value="<?php echo $price?>">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="making_time" class=" form-control-label">Price</label>
                                        <input type="text" name="making_time" placeholder="Enter Making Time" class="form-control" required value="<?php echo $making_time?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="size" class=" form-control-label">Size</label>
                                        <input type="text" name="size" placeholder="Enter Size" class="form-control" required value="<?php echo $size?>">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="material" class=" form-control-label">Material</label>
                                        <input type="text" name="material" placeholder="Enter Material" class="form-control" required value="<?php echo $material?>">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="finish" class=" form-control-label">Finish</label>
                                        <input type="text" name="finish" placeholder="Enter Finish" class="form-control" required value="<?php echo $finish?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row" id="image_box">
                                    <div class="col-lg-6">
                                        <label for="image" class=" form-control-label">Image</label>
                                        <input type="file" name="image" class="form-control" <?php echo $image_required?> >
                                    </div>
                                    <?php 
                                        if($image!=''){
                                            echo '<div class="col-lg-3">
                                                    <a target="_blank" href="'.PRODUCT_IMAGE_SITE_PATH.$image.'">
                                                        <img src="'.PRODUCT_IMAGE_SITE_PATH.$image.'" alt="">
                                                    </a>
                                                  </div>';
                                        }
                                        ?>
                                    
                                    <div class="col-lg-2">
                                        <label for="add_image" class=" form-control-label"></label>
                                        <button type="button" id="" onclick="add_more_images()" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount" >Add Image</span>
                                        </button>
                                    </div>
                                    <?php 
                                if(isset($MultipleImageArr[0])){
                                    foreach($MultipleImageArr as $list){
                                        echo '
                                        <div class="col-lg-6" style="margin-top:20px" id="add_image_box_'.$list['id'].'">
                                        <label for="image" class=" form-control-label">Image</label>
                                        <input type="file" name="product_images[]"class="form-control">
                                           <a target="_blank" href="'.PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list['product_images'].'">
                                           <img width="150px" src="'.PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list['product_images'].'" alt="">
                                                </a>
                                            <a href="?id='.$id.'&pi='.$list['id'].'" style="color:#fff;">
                                            <button type="button" style="margin-top:5px" class="btn btn-lg btn-danger btn-block">
                                                <span id="payment-button-amount" >Remove</span>
                                                </button>
                                                </a>
                                                <input type="hidden" name="product_images_id[]" value="'.$list['id'].'">      
                                                </div>
                                                ';
                                            }
                                        }
                                        ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="short_desc" class=" form-control-label">Short Description</label>
                                <textarea name="short_desc" placeholder="Enter Product Short Description" class="form-control" required ><?php echo $short_desc?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description" class=" form-control-label">Description</label>
                                <textarea name="description" placeholder="Enter Product Description" class="form-control" required ><?php echo $description?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_title" class=" form-control-label">Meta Title</label>
                                <textarea name="meta_title" placeholder="Enter Product Meta Title" class="form-control" ><?php echo $meta_title?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_desc" class=" form-control-label">Meta Description</label>
                                <textarea name="meta_desc" placeholder="Enter Product Meta Description" class="form-control" ><?php echo $meta_desc?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword" class=" form-control-label">Meta Keyword</label>
                                <textarea name="meta_keyword" placeholder="Enter Product Meta Keyword" class="form-control" ><?php echo $meta_keyword?></textarea>
                            </div>
                            
                            
                            
                            <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount" >Submit</span>
                            </button>
                            <div class="feild_error"><?php echo $msg; ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function get_sub_cat(sub_categories_id){
        var categories_id=jQuery("#categories_id").val();
        jQuery.ajax({
            url:'get_sub_cat.php',
            type:'post',
            data:'categories_id='+categories_id+'&sub_categories_id='+sub_categories_id,
            success:function(result){
                jQuery('#sub_categories_id').html(result)
            }
        });
    }
    var total_image=1;
    function add_more_images(){
        total_image++;
        var html = '<div class="col-lg-6" style="margin-top:20px" id="add_image_box_'+total_image+'"><label for="image" class=" form-control-label">Image</label><input type="file" name="product_images[]"class="form-control" required><button type="button" style="margin-top:5px" class="btn btn-lg btn-danger btn-block" onclick=remove_image("'+total_image+'")><span id="payment-button-amount" >Remove</span></button></div>';
        jQuery('#image_box').append(html);
    }
    function remove_image(id){
        jQuery('#add_image_box_'+id).remove();
    }
</script>
<?php
require 'footer.inc.php';?>
<script>
<?php if(isset($_GET['id'])){ ?>
        get_sub_cat('<?php echo $sub_categories_id?>');
<?php } ?>
</script>