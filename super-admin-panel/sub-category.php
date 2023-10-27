<?php require_once 'header.php';
require_once 'sidebar.php';

// Status update
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
    $id = $_GET['id'];
    $cat_id = $_GET['cat_id'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $query = mysqli_query($link, "UPDATE `sub_category` SET `sub_cat_status`='$status' WHERE `sub_cat_id`='$id'") or die('Status Update Query Not Run');
        if ($query) {
            echo "<script>window.location.href='sub-category.php?cat_id=$cat_id';</script>";
        }
    } else if ($type == 'trash') {
        $query = mysqli_query($link, "DELETE FROM `sub_category` WHERE `sub_cat_id`='$id'") or die('Delete Query Not Run');
        if ($query) {
            echo "<script>window.location.href='sub-category.php?cat_id=$cat_id';</script>";
        }
    }
}
$cat_id = '';
if (isset($_GET['cat_id']) && $_GET['cat_id'] != '') {
    $cat_id = $_GET['cat_id'];
    $data = mysqli_query($link, "SELECT * FROM `sub_category`  WHERE `sub_cat`='$cat_id' ORDER BY `sub_cat_id` DESC");
}

?>
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Cities</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <a href="add-sub-category.php?cat_id=<?= $cat_id ?>" class="btn btn-success btn-xs">Add Sub Category</a>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table id="subct" class="table table-striped projects">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Cities</th>
                                                <th>Sub City Name</th>
                                                <th>Url</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            if (mysqli_num_rows($data) > 0) {
                                                while ($rows = mysqli_fetch_assoc($data)) {
                                                    $cat_id = $rows['sub_cat'];
                                                    $ctdata = mysqli_query($link, "SELECT * FROM `category` WHERE `cat_id`='$cat_id'");
                                                    $rowct = mysqli_fetch_array($ctdata);
                                            ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $rowct['cat_name'] ?></td>
                                                        <td><?= $rows['sub_cat_name'] ?></td>
                                                        <td><?= $rows['sub_cat_url'] ?></td>
                                                        <td>
                                                            <ul class="list-inline d-flex justify-content-end">
                                                                <?php
                                                                if ($rows['sub_cat_status'] == 1) {
                                                                ?>
                                                                    <li><a href="?type=status&operation=inactive&cat_id=<?= $cat_id ?>&id=<?= $rows['sub_cat_id'] ?>" class="btn btn-success btn-xs">Active</a></li>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <li><a href="?type=status&operation=active&cat_id=<?= $cat_id ?>&id=<?= $rows['sub_cat_id'] ?>" class="btn btn-warning btn-xs">Deactive</a></li>
                                                                <?php
                                                                }
                                                                ?>
                                                                <li><a href="add-sub-cities.php?sub_cat_id=<?= $rows['sub_cat_id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a></li>
                                                                <li><a href="?type=trash&cat_id=<?= $cat_id ?>&id=<?= $rows['sub_cat_id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this')"><i class="fa fa-trash"></i></a></li>
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