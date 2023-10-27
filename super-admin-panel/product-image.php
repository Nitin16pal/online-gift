<?php require_once 'header.php';
require_once 'sidebar.php';

// Status update
if (isset($_GET['type']) && $_GET['type'] != '') {
    $prod_url = $_GET['prod_url'];
    $type = $_GET['type'];
    $pg_id = $_GET['pg_id'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $query = mysqli_query($link, "UPDATE `product_gallery` SET `pg_status`='$status' WHERE `pg_id`='$pg_id'") or die('Status Update Query Not Run');
        if ($query) {
            echo "<script>window.location.href='product-image.php?prod_url=$prod_url';</script>";
        }
    } else if ($type == 'trash') {
        $getimg = mysqli_query($link, "SELECT * FROM `product_gallery` WHERE `pg_id`='$pg_id'") or die('Delete Select Query Not Run');
        $glim = mysqli_fetch_array($getimg);
        if (!empty($glim['pg_name'])) {
            unlink('../upload/products/' . $glim['pg_name']);
        }
        $query = mysqli_query($link, "DELETE FROM `product_gallery` WHERE `pg_id`='$pg_id'") or die('Delete Query Not Run');
        if ($query) {
            echo "<script>window.location.href='product-image.php?prod_url=$prod_url';</script>";
        }
    }
}

$prod_id = '';
$prod_name = '';
if (isset($_GET['prod_url']) && !empty($_GET['prod_url'])) {
    $prod_url = $_GET['prod_url'];
    $projects = mysqli_query($link, "SELECT * FROM `products` WHERE  `prod_url`='$prod_url'") or die("gallery QUERY NOT RUN");
    $pro_rows = mysqli_fetch_array($projects);
    if (!empty($pro_rows) && !empty($pro_rows['prod_id'])) {
        $prod_id = $pro_rows['prod_id'];
        $prod_name = $pro_rows['prod_name'];
    } else {
        echo "<script>window.location.href='dashboard.php'</script>";
    }
} else {
    echo "<script>window.location.href='dashboard.php'</script>";
}

?>
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Product Gallery</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <a href="add-product-image.php?prod_url=<?= $prod_url ?>" class="btn btn-success btn-xs">Add Gallery</a>
                        <a href="products.php" class="btn btn-primary btn-xs float-right">Back</a>
                    </div>

                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table id="dataTable" class="table table-striped projects">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width: 2%">No</th>
                                                <th style="width: 60%">Product Name</th>
                                                <th style="width: 60%">Image</th>
                                                <th style="width: 60%">Title</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            // $data = mysqli_query($link, "SELECT * FROM `product_gallery` a INNER JOIN `category` b on a.common = b.common inner join TableC c on b.common = c.common ORDER BY `pg_id` DESC");
                                            $data = mysqli_query($link, "SELECT * FROM `product_gallery` WHERE `pg_prod`='$prod_id' ORDER BY `pg_id` DESC");
                                            $i = 1;
                                            if (mysqli_num_rows($data) > 0) {
                                                while ($rows = mysqli_fetch_assoc($data)) {
                                            ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $prod_name; ?></td>
                                                        <td>
                                                            <img src="../upload/products/<?= $rows['pg_name'] ?>" class="rounded-circle" style="object-fit:cover" alt="BMR" width="50" height="50">
                                                        </td>
                                                        <td><?= $rows['pg_title'] ?></td>
                                                        <td>
                                                            <ul class="list-inline d-flex justify-content-end">
                                                                <?php
                                                                if ($rows['pg_status'] == 1) {
                                                                ?>
                                                                    <li><a href="?type=status&operation=inactive&pg_id=<?= $rows['pg_id'] ?>&prod_url=<?= $prod_url ?>" class="btn btn-success btn-xs">Active</a></li>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <li><a href="?type=status&operation=active&pg_id=<?= $rows['pg_id'] ?>&prod_url=<?= $prod_url ?>" class="btn btn-warning btn-xs">Deactive</a></li>
                                                                <?php
                                                                }
                                                                ?>
                                                                <li><a href="edit-product-image.php?gall_id=<?= $rows['pg_id'] ?>&prod_url=<?= $prod_url ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a></li>
                                                                <li><a href="?type=trash&pg_id=<?= $rows['pg_id'] ?>&prod_url=<?= $prod_url ?>" onclick="return confirm ('Are you Sure you want to delete this row!')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></li>
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