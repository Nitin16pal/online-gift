<?php require_once 'header.php';
require_once 'sidebar.php';

// Status update
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
    $id = $_GET['id'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $query = mysqli_query($link, "UPDATE `orders` SET `od_status`='$status' WHERE `od_id`='$id'") or die('Status Update Query Not Run');
        if ($query) {
            echo "<script>window.location.href='orders.php';</script>";
        }
    } else if ($type == 'trash') {
        $query = mysqli_query($link, "DELETE FROM `orders` WHERE `od_id`='$id'") or die('Delete Query Not Run');
        if ($query) {
            echo "<script>window.location.href='orders.php';</script>";
        }
    }
}

?>
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Manage Orders</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table id="dataTable" class="table table-striped projects">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Order Id</th>
                                                <th>Order Status</th>
                                                <th>Customer</th>
                                                <th>Total</th>
                                                <th>Payment Status</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Zip</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $fdate = date('Y-m-d');
                                            $i = 1;
                                            // $Rdata = mysqli_query($link, "SELECT * FROM `orders` WHERE `od_created` LIKE '%$fdate%' ORDER BY `od_created` DESC");
                                            $Rdata = mysqli_query($link, "SELECT * FROM `orders` INNER JOIN `user_registration` ON `orders`.`od_user_id`=`user_registration`.`ur_id`  ORDER BY `od_created` DESC") or die("Order Query not run");
                                            $Rcount = mysqli_num_rows($Rdata);
                                            while ($rows = mysqli_fetch_assoc($Rdata)) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><a href="orders-details.php?orderid=<?= $rows['od_id'] ?>&urid=<?= $rows['ur_id'] ?>" data-urodid="<?= $rows['od_id'] ?>"><?= $rows['od_hs_id'] ?></a></td>
                                                    <td class="text-info"><?= $rows['od_status'] ?></td>
                                                    <td><?= $rows['ur_name'] ?></td>
                                                    <td><i class="fa fa-inr"></i> <?= $rows['od_total_price'] ?></td>
                                                    <td class="text-success"><?= $rows['od_paystatus'] ?></td>
                                                    <td><?= $rows['od_address'] ?></td>
                                                    <td><?= $rows['od_city'] ?></td>
                                                    <td><?= $rows['od_state'] ?></td>
                                                    <td><?= $rows['od_zip_code'] ?></td>
                                                    <td><?= date("F j, Y", strtotime($rows['od_created'])) ?></td>
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