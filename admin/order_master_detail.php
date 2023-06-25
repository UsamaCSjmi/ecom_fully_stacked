<?php
require 'top.inc.php';
$order_id=get_safe_value($conn,$_GET['id']);

if(isset($_POST['update_order_status'])){
    $update_order_status=$_POST['update_order_status'];
    mysqli_query($conn,"update `order` set order_status='$update_order_status' where order_id='$order_id'");
}
$order=mysqli_fetch_assoc(mysqli_query($conn,"select * from `order` where order_id = '$order_id' "));
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Order Detail - <?php echo $order['order_id']; ?></h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th> Unit Price </th>
                                    <th> Qty </th>
                                    <th> Total Price </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $cart_subtotal=0;
                                $tax=0.18;
                                $res=mysqli_query($conn,"select order_detail.*, product.name, product.image from order_detail, product where order_detail.order_id = '$order_id' and order_detail.product_id=product.id");
                                while($row=mysqli_fetch_assoc($res)){
                                    $cart_subtotal=$cart_subtotal+($row['price']*$row['qty']*100/118);
                                ?>
                                <tr>
                                    <td><a href="product.php?id=<?php echo $row['product_id'];?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'];?>" alt="" /></a></td>
                                    <td class="product-name"><a href="product.php?id=<?php echo $row['product_id'];?>"><?php echo $row['name'];?></a></td>
                                    <td ><?php echo round($row['price']*100/118,2);?></td>
                                    <td ><?php echo $row['qty'];?></td>
                                    <td ><?php echo round($row['price']*$row['qty']*100/118,2);?></td>
                                </tr>
                                <?php
                                }
                                    $taxAmt=$tax*$cart_subtotal;
                                    $cart_total=$cart_subtotal+$taxAmt;
                                ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <td >Sub Total</td>
                                    <td ><?php echo round($cart_subtotal,2) ;?></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td >GST@18%</td>
                                    <td ><?php echo round($taxAmt,2) ;?></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td >Total</td>
                                    <td><?php echo round($cart_total,2) ;?></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>Street Address : </strong>
                                        <?php echo "   ".$order['street_address']."  <br/>
                                        <strong>Apartment : </strong>".$order['apartment']."  <br/>
                                        <strong>City : </strong>".$order['city']."  </br>
                                        <strong>Zip Code : </strong>".$order['zip_code']."  <br/>
                                        <strong>State : </strong>".$order['state'];?><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>Name : </strong>
                                        <?php echo $order['fname']." ".$order['lname']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>Phone : </strong>
                                        <?php echo "+".$order['country']."-".$order['phone']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>Order Notes : </strong>
                                        <?php echo $order['order_notes']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <strong>Order Status : </strong>
                                        <?php echo $order['order_status']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">
                                    <strong>Update Order Status : </strong>
                                        <form method="post">
                                            <select class="form-control" name="update_order_status" id="" required>
                                                <option>Select Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Processing">Processing</option>
                                                <option value="Dispatched">Dispatched</option>
                                                <option value="Shipped">Shipped</option>
                                                <option value="Cancelled">Cancelled</option>
                                                <?php
                                                // $res=mysqli_query($conn,"select * from order_status");
                                                // while($row=mysqli_fetch_assoc($res)){
                                                //     echo " <option value=".$row['id'].">".$row['name']."</option>";
                                                // }
                                                ?>
                                            </select>
                                            <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount" >Submit</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.inc.php';?>