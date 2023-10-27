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
        $query = mysqli_query($link, "UPDATE `user_registration` SET `ur_status`='$status' WHERE `ur_id`='$id'") or die('Status Update Query Not Run');
        if ($query) {
            echo "<script>window.location.href='manage-user.php';</script>";
        }
    } else if ($type == 'trash') {
        $query = mysqli_query($link, "DELETE FROM `user_registration` WHERE `ur_id`='$id'") or die('Delete Query Not Run');
        if ($query) {
            echo "<script>window.location.href='manage-user.php';</script>";
        }
    }
}

?>
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Managee User</h2>
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
                                                <th style="width: 60%">Name</th>
                                                <th style="width: 60%">Email</th>
                                                <th style="width: 60%">Mobille</th>
                                                <th style="width: 60%">Address</th>
                                                <th style="width: 60%">Address 2</th>
                                                <th style="width: 60%">City</th>
                                                <th style="width: 60%">State</th>
                                                <th style="width: 60%">Pin Code</th>
                                                <th style="width: 60%">Address Type</th>
                                                <th style="width: 60%">Alernate Address</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data = mysqli_query($link, "SELECT * FROM `user_registration` ORDER BY `ur_id` DESC");
                                            $i = 1;
                                            if (mysqli_num_rows($data) > 0) {
                                                while ($rows = mysqli_fetch_assoc($data)) {
                                            ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $rows['ur_name'] ?></td>
                                                        <td><?= $rows['ur_email'] ?></td>
                                                        <td><?= $rows['ur_mobile'] ?></td>
                                                        <td><?= $rows['ur_address'] ?></td>
                                                        <td><?= $rows['ur_address2'] ?></td>
                                                        <td><?= $rows['ur_city'] ?></td>
                                                        <td><?= $rows['ur_state'] ?></td>
                                                        <td><?= $rows['ur_pin'] ?></td>
                                                        <td><?= $rows['ur_addr_type'] ?></td>
                                                        <td><a href="alernate-address.php?ur_id=<?= $rows['ur_id'] ?>" class="btn btn-success btn-xs">GO</a></td>
                                                        <td>
                                                            <ul class="list-inline d-flex justify-content-end">
                                                                <?php
                                                                if ($rows['ur_status'] == 1) {
                                                                ?>
                                                                    <li><a href="?type=status&operation=inactive&id=<?= $rows['ur_id'] ?>" class="btn btn-success btn-xs">Active</a></li>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <li><a href="?type=status&operation=active&id=<?= $rows['ur_id'] ?>" class="btn btn-warning btn-xs">Deactive</a></li>
                                                                <?php
                                                                }
                                                                ?>
                                                                <li><a href="?type=trash&id=<?= $rows['ur_id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></li>
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