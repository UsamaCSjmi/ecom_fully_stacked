<?php
require 'top.inc.php';
$sql="select * from store_details";
$res=mysqli_query($conn,$sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Store Details </h4>
                    <h4 class="box-link"><a href="manage_store_details.php">Change Details</a> </h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th class="serial">#</th>
                                <th>Type</th>
                                <th>Content</th>
                                <th>Last Updated</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                while($row=mysqli_fetch_assoc($res)){?>
                                <tr>
                                    <td class="serial"><?php echo $i; ?></td>
                                    <td><?php echo $row['type']?></td>
                                    <td>
                                        <?php
                                            if($row['id'] != 10)
                                            {
                                                echo $row['content'];
                                            }
                                            else{
                                                echo "<img src='".SITE_PATH."/images/shopnow/".$row['content']."' style='max-width:300px' alt='shop now' />";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $row['updated_on']?></td>
                                    <td>
                                    <?php
                                    echo "<span class='badge badge-edit'><a href='manage_store_details.php?id=".$row['id']."' >Edit</a></span>";
                                    ?>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
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