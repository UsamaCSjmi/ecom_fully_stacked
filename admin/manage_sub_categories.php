<?php
require 'top.inc.php';
$categories='';
$msg='';
$sub_categories='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $id = get_safe_value($conn, $_GET['id']);
    $res= mysqli_query($conn,"select * from sub_categories where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $row=mysqli_fetch_assoc($res);
        $sub_categories=$row['sub_categories'];
        $categories=$row['categories_id'];
    }
    else{
        header('Location:sub_categories.php');
        die();
    }
}
if(isset($_POST['submit'])){
    $categories = get_safe_value($conn, $_POST['categories_id']);
    $sub_categories = get_safe_value($conn, $_POST['sub_categories']);

    $res= mysqli_query($conn,"select * from sub_categories where sub_categories='$sub_categories' and categories_id='$categories'");
    $check=mysqli_num_rows($res);

    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }
            else{
                $msg="Sub-Category already exist";
            }
        } 
        else{
            $msg="Sub-Category already exist";
        }
    }
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            mysqli_query($conn,"update sub_categories set categories_id='$categories', sub_categories='$sub_categories' where id='$id'");
        }
        else{
            mysqli_query($conn,"insert into sub_categories (categories_id,sub_categories,status) values('$categories','$sub_categories','1')");
        }
        header('Location:sub_categories.php');
        die();
    }
    
}

?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header"><strong>Sub Categories</strong><small> Form</small></div>
                    <form method="post" action="">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Categories</label>
                                <select class="form-control"  name="categories_id" id="" required>
                                    <option>Select Category</option>
                                    <?php
                                    $res=mysqli_query($conn,"select * from categories ");
                                    while($row=mysqli_fetch_assoc($res)){
                                        if($row['id']==$categories){
                                            echo "<option value='".$row['id']."' selected>".$row['categories']."</option>";
                                        }
                                        else{
                                            echo "<option value='".$row['id']."'>".$row['categories']."</option>";
                                        }
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_categories" class=" form-control-label">Sub Category</label>
                                <input type="text" name="sub_categories" placeholder="Enter Sub Category" class="form-control" required value="<?php echo $sub_categories?>">
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
<?php require 'footer.inc.php';?>