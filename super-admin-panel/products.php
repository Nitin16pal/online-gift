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
        $query = mysqli_query($link, "UPDATE `products` SET `prod_status`='$status' WHERE `prod_id`='$id'") or die('Status Update Query Not Run');
        if ($query) {
            echo "<script>window.location.href='products.php';</script>";
        }
    } else if ($type == 'trash') {
        $query = mysqli_query($link, "DELETE FROM `products` WHERE `prod_id`='$id'") or die('Delete Query Not Run');
        if ($query) {
            echo "<script>window.location.href='products.php';</script>";
        }
    }
}

?>
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Products</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <a href="add-product.php" class="btn btn-success btn-xs">Add Product</a>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table id="dataTable" class="table table-striped projects">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width: 2%">No</th>
                                                <th style="width: 60%">Category</th>
                                                <!-- <th style="width: 60%">Sub Category</th> -->
                                                <th style="width: 60%">Product Name</th>
                                                <th style="width: 20%">Product Actual Price</th>
                                                <th style="width: 20%">Product Disc. Price</th>
                                                <th style="width: 22%">Product Size</th>
                                                <th style="width: 22%">Product Color</th>
                                                <th style="width: 22%">Product Gallery</th>
                                                <th style="width: 22%">Added on</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data = mysqli_query($link, "SELECT pd.*, ca.cat_name FROM products pd INNER JOIN category AS ca ON ca.cat_id = pd.prod_cat  ORDER BY `prod_id` DESC");
                                            // $data = mysqli_query($link, "SELECT pd.*, ca.cat_name, sbc.sub_cat_name FROM products pd FULL OUTER JOIN category AS ca ON ca.cat_id = pd.prod_cat INNER JOIN sub_category sbc  ON sbc.sub_cat_id = pd.prod_sub_cat ORDER BY `prod_id` DESC");
                                            $i = 1;
                                            if (mysqli_num_rows($data) > 0) {
                                                while ($rows = mysqli_fetch_assoc($data)) {
                                            ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $rows['cat_name'] ?></td>
                                                        <!-- <td><?= $rows['sub_cat_name'] ?></td> -->
                                                        <td><?= $rows['prod_name'] ?></td>
                                                        <td><?= $rows['prod_total_price'] ?></td>
                                                        <td><?= $rows['prod_discounted_price'] ?></td>
                                                        <td><?= $rows['prod_size'] ?></td>
                                                        <td><?= $rows['prod_color'] ?></td>
                                                        <td><a href="product-image.php?prod_url=<?= $rows['prod_url'] ?>" class="btn btn-success btn-xs">GO</a></td>
                                                        <td><?= $rows['prod_created'] ?></td>
                                                        <td>
                                                            <ul class="list-inline d-flex justify-content-end">
                                                                <?php
                                                                if ($rows['prod_status'] == 1) {
                                                                ?>
                                                                    <li><a href="?type=status&operation=inactive&id=<?= $rows['prod_id'] ?>" class="btn btn-success btn-xs">Active</a></li>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <li><a href="?type=status&operation=active&id=<?= $rows['prod_id'] ?>" class="btn btn-warning btn-xs">Deactive</a></li>
                                                                <?php
                                                                }
                                                                ?>
                                                                <li><a href="add-product.php?prod_id=<?= $rows['prod_id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a></li>
                                                                <li><a href="?type=trash&id=<?= $rows['prod_id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></li>
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