
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
    $content =  $_POST['content'];
    $updated_on = date('Y-m-d h:i:s');
    $res= mysqli_query($conn,"UPDATE store_details SET content = '$content',updated_on='$updated_on' WHERE id = $id");
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
                            <div class="form-group">
                                <label for="content" class=" form-control-label">Content</label>
                                <textarea name="content" placeholder="Enter Content" class="form-control" rows=15 style="resize:none" required ><?php echo $content?></textarea>
                            </div>
                            
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
