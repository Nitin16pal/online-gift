<?php require_once 'header.php';
require_once 'sidebar.php';

// Status update
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
    $id = $_GET['id'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        if ($operation == 'active') {
            $status = 'Active';
        } else {
            $status = 'Inactive';
        }
        $query = mysqli_query($link, "UPDATE `coupon` SET `cp_status`='$status' WHERE `coupon_id`='$id'") or die('Status Update Query Not Run');
        if ($query) {
            echo "<script>window.location.href='coupon.php';</script>";
        }
    } else if ($type == 'trash') {
        $query = mysqli_query($link, "DELETE FROM `coupon` WHERE `coupon_id`='$id'") or die('Delete Query Not Run');
        if ($query) {
            echo "<script>window.location.href='coupon.php';</script>";
        }
    }
}

?>
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Manage Coupon</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <a href="add-coupon.php" class="btn btn-success btn-xs">Add Coupon</a>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table id="dataTable" class="table table-striped projects">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Coupon Name</th>
                                                <th>Coupon Code</th>
                                                <th>Coupon Type</th>
                                                <th>Coupon Discount</th>
                                                <th>Total Amount</th>
                                                <th>Product Id</th>
                                                <th>Category Id</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Max User</th>
                                                <th>Created</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $fdate = date('Y-m-d');
                                            $i = 1;
                                            $Rdata = mysqli_query($link, "SELECT * FROM `coupon`ORDER BY `cp_created` DESC");
                                            // $Rdata = mysqli_query($link, "SELECT * FROM `coupon` INNER JOIN `category` ON `coupon`.`od_user_id`=`category`.`cat_id` INNER JOIN `products` ON `coupon`.`cp_product_id`=`products`.`pod_id` ORDER BY `cp_created` DESC");
                                            $Rcount = mysqli_num_rows($Rdata);
                                            while ($rows = mysqli_fetch_assoc($Rdata)) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $rows['cp_coupon_name'] ?></td>
                                                    <td><?= $rows['cp_coupon_code'] ?></td>
                                                    <td><?= $rows['cp_type'] ?></td>
                                                    <td><?= $rows['cp_discount'] ?></td>
                                                    <td><?= $rows['cp_total_amount'] ?></td>
                                                    <td><?= $rows['cp_product_id'] ?></td>
                                                    <td><?= $rows['cp_category_id'] ?></td>
                                                    <td><?= date("F j, Y", strtotime($rows['cp_start_date'])) ?></td>
                                                    <td><?= date("F j, Y", strtotime($rows['cp_end_date'])) ?></td>
                                                    <td><?= $rows['cp_max_uses'] ?></td>
                                                    <td><?= date("F j, Y", strtotime($rows['cp_created'])) ?></td>
                                                    <td>
                                                        <ul class="list-inline d-flex justify-content-end">
                                                            <?php
                                                            if ($rows['cp_status'] == 'Active') {
                                                            ?>
                                                                <li><a href="?type=status&operation=inactive&id=<?= $rows['coupon_id'] ?>" class="btn btn-success btn-xs">Active</a></li>

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <li><a href="?type=status&operation=active&id=<?= $rows['coupon_id'] ?>" class="btn btn-warning btn-xs">Deactive</a></li>
                                                            <?php
                                                            }
                                                            ?>
                                                            <li><a href="add-coupon.php?coupon_id=<?= $rows['coupon_id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a></li>
                                                            <li><a href="?type=trash&id=<?= $rows['coupon_id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure! want to delete this?')"><i class="fa fa-trash"></i></a></li>
                                                        </ul>
                                                    </td>

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
            <!-- end row -->
        </div>
        <!-- end dashboard inner -->
    </div>

    <?php require_once 'footer.php' ?>