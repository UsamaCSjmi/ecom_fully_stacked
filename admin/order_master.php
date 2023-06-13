<?php
require 'top.inc.php';
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Order Master </h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Payment Type </th>
                                    <th>Payment Status </th>
                                    <th>Transaction ID </th>
                                    <th>Order Status</th>
                                    <th>Order Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res=mysqli_query($conn,"select * from `order` ");
                                while($row=mysqli_fetch_assoc($res)){
                                ?>
                                <tr>
                                    <td>
                                        <a href="order_master_detail.php?id=<?php echo $row['order_id'];?>"><?php echo $row['order_id'];?></a>
                                        <br>
                                        <a href="<?php echo SITE_PATH?>/order_pdf.php?id=<?php echo $row['id'];?>">PDF</a>
                                    </td>
                                    <td><?php echo $row['added_on'];?></td>
                                    <td><?php echo $row['payment_type'];?></td>
                                    <td><?php echo $row['payment_status'];?></td>
                                    <td><?php echo $row['txnid'];?></td>
                                    <td><?php echo $row['order_status'];?></td>
                                    <td><?php echo $row['total_price'];?></td>
                                </tr>
                                <?php } ?>
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