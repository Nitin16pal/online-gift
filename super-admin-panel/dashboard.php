<?php require_once 'header.php';
require_once 'sidebar.php'; 

$qruser=mysqli_query($link,"SELECT * FROM `user_registration` WHERE `ur_status`='1'");
$urcount=mysqli_num_rows($qruser);
$qrcart=mysqli_query($link,"SELECT * FROM `carts` WHERE `pd_status`='1'");
$crcount=mysqli_num_rows($qrcart);
$qrorder=mysqli_query($link,"SELECT * FROM `orders`");
$orcount=mysqli_num_rows($qrorder);
// $qrwlistr=mysqli_query($link,"SELECT * FROM `wishlist` WHERE `wl_status`='1'");
// $count=mysqli_num_rows($qrwlistr);
$qrprod=mysqli_query($link,"SELECT * FROM `products` WHERE `prod_status`='1'");
$prodcount=mysqli_num_rows($qrprod);


?>
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <h3 class="text-info text-capitalize">Order Info</h3>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <a href="products.php">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-bitbucket purple_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no"><?= $prodcount ?></p>
                                                <p class="head_couter">Total products</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="manage-user.php">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-users red_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                            <p class="total_no"><?= $urcount ?></p>
                                                <p class="head_couter">Total User</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="carts.php">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-shopping-cart orange_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                            <p class="total_no"><?= $crcount ?></p>
                                                <p class="head_couter">Total Cart</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="orders.php">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-heart-o green_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                            <p class="total_no"><?= $orcount ?></p>
                                                <p class="head_couter">Total Order</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <h3 class="text-info text-capitalize">Recent orders</h3>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table id="subct" class="table table-striped projects">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Order Id</th>
                                                <th>Status</th>
                                                <th>Customer</th>
                                                <th>Payment Status</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $fdate = date('Y-m-d');
                                            $i=1;
                                            // $Rdata = mysqli_query($link, "SELECT * FROM `orders` WHERE `od_created` LIKE '%$fdate%' ORDER BY `od_created` DESC");
                                            $Rdata = mysqli_query($link, "SELECT * FROM `orders` INNER JOIN `user_registration` ON `orders`.`od_user_id`=`user_registration`.`ur_id` WHERE `od_created` LIKE '%$fdate%' ORDER BY `od_created` DESC");
                                            $Rcount = mysqli_num_rows($Rdata);
                                            while ($rows = mysqli_fetch_assoc($Rdata)) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $rows['od_hs_id'] ?></td>
                                                    <td><?= $rows['od_staus'] ?><span class="badge badge-success p-2">paid</span></td>
                                                    <td><?= $rows['ur_name'] ?></td>
                                                    <td><?= $rows['od_paystatus'] ?></td>
                                                    <td><?= date("F j, Y",strtotime($rows['od_created'])) ?></td>
                                                    <td><i class="fa fa-inr"></i> <?= $rows['od_total_price'] ?></td>
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

        <!--  -->

    </div>
    <?php require_once 'footer.php' ?>