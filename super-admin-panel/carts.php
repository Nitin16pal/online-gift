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
        $query = mysqli_query($link, "UPDATE `carts` SET `pd_status`='$status' WHERE `crt_id`='$id'") or die('Status Update Query Not Run');
        if ($query) {
            echo "<script>window.location.href='carts.php';</script>";
        }
    } else if ($type == 'trash') {
        $query = mysqli_query($link, "DELETE FROM `carts` WHERE `crt_id`='$id'") or die('Delete Query Not Run');
        if ($query) {
            echo "<script>window.location.href='carts.php';</script>";
        }
    }
}

?>
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Manage Cart</h2>
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
                                                <th style="width: 2%">No</th>
                                                <th style="width: 60%">User Name</th>
                                                <!-- <th style="width: 60%">Product Image</th> -->
                                                <th style="width: 60%">Product Name</th>
                                                <th style="width: 20%">Product Price</th>
                                                <th style="width: 20%">Product Quantity</th>
                                                <th style="width: 22%">Total Price</th>
                                                <th style="width: 22%">Updated Updated </th>
                                                <th style="width: 22%">Added Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data = mysqli_query($link, "SELECT ct.pd_id,ct.crt_id,ct.pd_status, ur.ur_name, ct.pd_price,ct.pd_quantity,ct.pd_name, ct.pd_total,ct.pd_modified,ct.pd_created FROM carts ct INNER JOIN user_registration AS ur ON ct.user_id = ur.ur_id INNER JOIN products as pd ON ct.pd_id = pd.prod_id ORDER BY `pd_created` DESC");
                                            // $data = mysqli_query($link, "SELECT pd.*, ca.cat_name, sbc.sub_cat_name FROM products pd FULL OUTER JOIN category AS ca ON ca.cat_id = pd.prod_cat INNER JOIN sub_category sbc  ON sbc.sub_cat_id = pd.prod_sub_cat ORDER BY `prod_id` DESC");
                                            $i = 1;
                                            if (mysqli_num_rows($data) > 0) {
                                                while ($rows = mysqli_fetch_assoc($data)) {
                                            ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $rows['ur_name'] ?></td>
                                                        <!-- <td><?= $rows['pd_image'] ?></td> -->
                                                        <td><?= $rows['pd_name'] ?></td>
                                                        <td><?= $rows['pd_price'] ?></td>
                                                        <td><?= $rows['pd_quantity'] ?></td>
                                                        <td><?= $rows['pd_total'] ?></td>
                                                        <td><?= date("F j, Y",strtotime($rows['pd_modified'])) ?></td>
                                                        <td><?= date("F j, Y",strtotime($rows['pd_created'])) ?></td>
                                                        <td>
                                                            <ul class="list-inline d-flex justify-content-end">
                                                                <?php
                                                                if ($rows['pd_status'] == 1) {
                                                                ?>
                                                                    <li><a href="?type=status&operation=inactive&id=<?= $rows['crt_id'] ?>" class="btn btn-success btn-xs">Active</a></li>

                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <li><a href="?type=status&operation=active&id=<?= $rows['crt_id'] ?>" class="btn btn-warning btn-xs">Deactive</a></li>
                                                                <?php
                                                                }
                                                                ?>
                                                                <li><a href="?type=trash&id=<?= $rows['crt_id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="5">Data not found</td>
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