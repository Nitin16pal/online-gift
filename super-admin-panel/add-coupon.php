<?php require_once 'header.php';
require_once 'sidebar.php';

$coupon_id = '';
if (isset($_GET['coupon_id'])) {
    $coupon_id = $_GET['coupon_id'];
    $coup = mysqli_query($link, "SELECT * FROM `coupon` WHERE  `coupon_id`='$coupon_id'") or die("CATEGORY GET DETAILS QUERY NOT RUN");
    $rows = mysqli_fetch_array($coup);
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap-select.min.css" />
<script src="assets/js/bootstrap-select.min.js"></script>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2><?= (!empty($prod_id)) ? 'Edit' : 'Create' ?> Coupon</h2>
                </div>
            </div>
        </div>

        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 mb-4">
                    <a href="coupon.php" class="btn btn-secondary btn-icon-split shadow">
                        <span class="icon text-white-50">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                        <span class="text">Back</span>
                    </a>
                </div>
            </div>
            <div class="card shadow mb-4 addProTable">
                <div class="card-body">
                    <div class="table-responsive"><!--admin/Nonveg/Addnonvegrecord-->
                        <span class="status text-danger py-3"></span>
                        <form enctype="multipart/form-data" method="post" id="addcoupan" accept-charset="utf-8">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="">Coupon Name*</label>
                                            <input type="text" name="coupname" value="<?= (!empty($rows['cp_coupon_name'])) ? $rows['cp_coupon_name'] : '' ?>" class="form-control" id="coupname">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="">Code*</label>
                                            <input type="text" name="coupcode" value="<?= (!empty($rows['cp_coupon_code'])) ? $rows['cp_coupon_code'] : '' ?>" class="form-control" id="coupcode">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group">
                                            <label for="">Discount on*</label>
                                            <select name="coupdisctype" class="form-control" id="coupdisctype">
                                                <option value="Products" <?= (!empty($rows['cp_type']) && $rows['cp_type'] == 'Products') ? 'selected' : '' ?>>Products</option>
                                                <option value="Category" <?= (!empty($rows['cp_type']) && $rows['cp_type'] == 'Category') ? 'selected' : '' ?>>Category</option>
                                                <option value="No of User" <?= (!empty($rows['cp_type']) && $rows['cp_type'] == 'No of User') ? 'selected' : '' ?>>No of User</option>
                                                <option value="Min Purchase" <?= (!empty($rows['cp_type']) && $rows['cp_type'] == 'Min Purchase') ? 'selected' : '' ?>>Min Purchase</option>
                                                <option value="Date" <?= (!empty($rows['cp_type']) && $rows['cp_type'] == 'Date') ? 'selected' : '' ?>>Date</option>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group">
                                            <label for="">Discount*</label>
                                            <input type="number" name="coupdiscount" value="<?= (!empty($rows['cp_discount'])) ? $rows['cp_discount'] : '' ?>" class="form-control" id="coupdiscount">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="">Total Amount*</label>
                                            <input type="number" name="couptotalamt" value="<?= (!empty($rows['cp_total_amount'])) ? $rows['cp_total_amount'] : '' ?>" class="form-control" id="couptotalamt">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <tr>

                                    <td class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Products*</label>
                                            <select class="selectpicker form-control" multiple name="productsid[]" id="productsid" multiple data-max-options="7">
                                                <?php
                                                $data = mysqli_query($link, "SELECT pd.*, ca.cat_name FROM products pd INNER JOIN category AS ca ON ca.cat_id = pd.prod_cat  ORDER BY `prod_id` DESC");
                                                if (mysqli_num_rows($data) > 0) {
                                                    while ($rowp = mysqli_fetch_assoc($data)) {
                                                ?>
                                                        <option value="<?= $rowp['prod_id'] ?>" <?= (!empty($rows['cp_product_id']) && $rows['cp_product_id'] == $rowp['prod_id']) ? 'selected' : '' ?>><?= $rowp['prod_name'] ?></option>
                                                <?php }
                                                } else {
                                                    echo "<option value=''>Not Found</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select multiple data-live-search="true" class="selectpicker form-control" id="categoryselect" name="categoryselect[]">
                                                <?php
                                                $data = mysqli_query($link, "SELECT * FROM `category` ORDER BY `cat_id` DESC");
                                                if (mysqli_num_rows($data) > 0) {
                                                    while ($rowsc = mysqli_fetch_assoc($data)) {
                                                ?>
                                                        <option value="<?= $rowsc['cat_id'] ?>"><?= $rowsc['cat_name'] ?></option>
                                                <?php }
                                                } else {
                                                    echo "<option value=''>Not Found</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="">Date Start*</label>
                                            <input type="date" name="coupstrtdate" value="<?= (!empty($rows['cp_start_date'])) ? $rows['cp_start_date'] : '' ?>" class="form-control" id="coupstrtdate">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="">Date End*</label>
                                            <input type="date" name="coupenddate" value="<?= (!empty($rows['cp_end_date'])) ? $rows['cp_end_date'] : '' ?>" class="form-control" id="coupenddate">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="">Type*</label>
                                            <select name="coupdisctype" class="form-control" id="coupdisctype">
                                                <option value="Percentage" <?= (!empty($rows['cp_type']) && $rows['cp_type'] == 'Percentage') ? 'selected' : '' ?>>Percentage</option>
                                                <option value="Fixed Amount" <?= (!empty($rows['cp_type']) && $rows['cp_type'] == 'Fixed Amount') ? 'selected' : '' ?>>Fixed Amount</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="">Uses per Customer*</label>
                                            <input type="text" name="coupmaxuses" value="<?= (!empty($rows['cp_max_uses'])) ? $rows['cp_max_uses'] : '' ?>" class="form-control" id="coupmaxuses">
                                        </div>
                                    </td>
                                </tr>
                                <tr style="border-top:1px solid #ccc;">
                                    <td colspan="3">
                                        <input type="hidden" name="coupanadd" value="active">
                                        <button type="submit" name="submit" class="btn btn-success" id="addBtn" style="width:220px;">Submit</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end dashboard inner -->
</div>

<?php require_once 'footer.php' ?>
<script>
    $('#addcoupan').on('submit', function(event) {
        event.preventDefault();
        var data = new FormData(this);

        $.ajax({
            url: "backend/orders-history.php",
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $(".status").html("Processing...");
            },
            success: function(data) {
                $(".status").html(data);
            }
        });
    });
</script>