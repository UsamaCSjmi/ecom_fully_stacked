<?php
require 'top.inc.php';
$msg='';
if(isset($_POST['submit'])){
    $old_password = get_safe_value($conn, $_POST['old_password']);
    $new_password = get_safe_value($conn, $_POST['new_password']);
    $cnf_password = get_safe_value($conn, $_POST['cnf_password']);
    $res= mysqli_query($conn,"select * from admin_users where password='$old_password'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if($new_password === $cnf_password){
            $res= mysqli_query($conn,"UPDATE admin_users SET password='$new_password' where username='admin'");
            if($res){
                echo "
                <script>
                alert('Password Updated Successfully');
                window.location.href = 'categories.php';
                </script>
                ";
            }
        }
        else{
            $msg="Passwords Mismatched";
        }
    }
    else{
        $msg = "Invalid Old Password";
    }
}
?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header"><strong>Change Password</strong><small> Form</small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="old_password" class=" form-control-label">Old Password</label>
                                        <input type="password" name="old_password" placeholder="Enter Old Password" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="new_password" class=" form-control-label">New Password</label>
                                        <input type="password" name="new_password" placeholder="Enter New Password" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="cnf_password" class=" form-control-label">Confirm New Password</label>
                                        <input type="password" name="cnf_password" placeholder="Retype your password" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount" >Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
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
</>
<?php
require 'footer.inc.php';?>
<script>
<?php if(isset($_GET['id'])){ ?>
        get_sub_cat('<?php echo $sub_categories_id?>');
<?php } ?>
</script>