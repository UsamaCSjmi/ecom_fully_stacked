
<?php
require 'top.inc.php';
$id='';
$type='';
$content='';
$msg="";

if(isset($_GET['id']) && $_GET['id']!=''){
    $id = get_safe_value($conn, $_GET['id']);
    $res= mysqli_query($conn,"select * from store_details where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $row=mysqli_fetch_assoc($res);
        $type=$row['type'];
        $content=$row['content'];
    }
    else{
        header('Location:product.php');
        die();
    }
}
if(isset($_POST['submit'])){
    $id = get_safe_value($conn, $_POST['type']);
    if($id == 10){
        $updated_on = date('Y-m-d h:i:s');
        if($_FILES['image']['name']!=''){

            $get_img="select content from store_details where id=10";
            $res=mysqli_query($conn,$get_img);
            $row=mysqli_fetch_assoc($res);
            unlink(SERVER_PATH."/images/shopnow/".$row['content']);
        


            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],SERVER_PATH.'/images/shopnow/'.$image);
            $update_sql="UPDATE store_details SET content = '$image',updated_on='$updated_on' WHERE id = 10";
        }
    }
    else{
        $content =  $_POST['content'];
        $updated_on = date('Y-m-d h:i:s');
        $update_sql = "UPDATE store_details SET content = '$content',updated_on='$updated_on' WHERE id = $id";
    }
    $res= mysqli_query($conn,$update_sql);
    if($res){
        $msg="Updated Successfully ";
    }
    else{
        $msg="Failed";
    }
}

?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header"><strong>Store Details</strong><small> Form</small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="type" class=" form-control-label">Type</label>
                                        <select class="form-control" name="type" id="type" required>
                                            <option>Select Type</option>
                                            <?php
                                            $res=mysqli_query($conn,"select id,type from store_details");
                                            while($row=mysqli_fetch_assoc($res)){
                                                if($row['id']==$id){
                                                    echo " <option selected value=".$row['id'].">".$row['type']."</option>";
                                                }
                                                else{
                                                    echo " <option value=".$row['id'].">".$row['type']."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <?php
                            if($id != 10){
                            ?>
                            <div class="form-group">
                                <label for="content" class=" form-control-label">Content</label>
                                <textarea name="content" placeholder="Enter Content" class="form-control" rows=15 style="resize:none" required ><?php echo $content?></textarea>
                            </div>
                            <?php
                            }else{
                            ?>
                            <div class="form-group">
                                <label for="image" class=" form-control-label">Image</label>
                                <input type="file" name = "image" accept="image/*"/>    
                            </div>
                            <?php
                            }
                            ?>
                            
                            <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount" >Submit</span>
                            </button>
                            <div class="feild_success"><?php echo $msg; ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./ckeditor/ckeditor.js"></script>
<script>
        CKEDITOR.replace( 'content', {
    toolbar: [
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        ]
        });
</script>
<?php
require 'footer.inc.php';?>
