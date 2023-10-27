<?php require_once 'header.php';
require_once 'sidebar.php';

$prod_id = '';
if (isset($_GET['prod_id'])) {
    $prod_id = $_GET['prod_id'];
    $pdetails = mysqli_query($link, "SELECT * FROM `products` WHERE  `prod_id`='$prod_id'") or die("CATEGORY GET DETAILS QUERY NOT RUN");
    $rows = mysqli_fetch_array($pdetails);
}
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2><?= (!empty($prod_id)) ? 'Edit' : 'Add' ?> Product</h2>
                </div>
            </div>
        </div>

        <!-- row -->
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <a href="products.php" class="btn btn-primary btn-xs float-right">Back</a>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <form method="POST" id="productform" enctype="multipart/form-data">
                            <span class="status text-danger mb-0"></span>
                            <div class="form-row mb-3">
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Meta Title</label>
                                    <input type="text" name="prod_title" id="prod_title" value="<?= (!empty($rows['prod_title'])) ? $rows['prod_title'] : '' ?>" class="form-control" />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Meta Keyword</label>
                                    <input type="text" name="prod_key" id="prod_key" value="<?= (!empty($rows['prod_key'])) ? $rows['prod_key'] : '' ?>" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="label_field">Meta Description</label>
                                    <textarea name="prod_desc" id="prod_desc" class="form-control" rows="3"><?= (!empty($rows['prod_desc'])) ? $rows['prod_desc'] : '' ?></textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Category</label>
                                    <select name="category_id" id="category_id" class="form-control <?= (!empty($rows['sub_cat']))?$rows['sub_cat']:'' ?>">
                                        <option value="">Select category</option>
                                        <?php
                                        $datacat = mysqli_query($link, "SELECT * FROM `category` ORDER BY `cat_id` ASC");
                                        while ($rows_cat = mysqli_fetch_assoc($datacat)) {
                                        ?>
                                            <option value="<?= $rows_cat['cat_id'] ?>" <?= ($rows_cat['cat_id'] == $rows['prod_cat'] || $cat_id == $rows_cat['cat_id']) ? 'selected' : '' ?>><?= $rows_cat['cat_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Sub Category</label>
                                    <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="">Select sub category</option>
                                        <?php
                                        $catid=$rows['prod_cat'];
                                        $datacat = mysqli_query($link, "SELECT * FROM `sub_category` WHERE `sub_cat`='$catid' ORDER BY `sub_cat_id` ASC");
                                        while ($rowsb = mysqli_fetch_assoc($datacat)) {
                                        ?>
                                            <option value="<?= $rowsb['sub_cat_id'] ?>" <?= ($rowsb['sub_cat_id'] == $rows['prod_sub_cat']) ? 'selected' : '' ?>><?= $rowsb['sub_cat_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="label_field">Product Name</label>
                                    <input type="text" name="prod_name" id="prod_name" value="<?= (!empty($rows['prod_name'])) ? $rows['prod_name'] : '' ?>" class="form-control" />
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="label_field">Prodcut Actual Price</label>
                                    <input type="number" name="prod_total_price" id="prod_total_price" value="<?= (!empty($rows['prod_total_price'])) ? $rows['prod_total_price'] : '' ?>" class="form-control" />
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="label_field">Product Discounted price</label>
                                    <input type="number" name="prod_discounted_price" id="prod_discounted_price" value="<?= (!empty($rows['prod_discounted_price'])) ? $rows['prod_discounted_price'] : '' ?>" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="label_field">Content</label>
                                    <textarea name="prod_details" id="prod_details" class="form-control" rows="5"> <?= (!empty($rows['prod_details'])) ? $rows['prod_details'] : '' ?></textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Product Size</label>
                                    <input type="text" name="prod_size" id="prod_size" value="<?= (!empty($rows['prod_size'])) ? $rows['prod_size'] : '' ?>" class="form-control" />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Product Color </label>
                                    <input type="text" name="prod_color" id="prod_color" value="<?= (!empty($rows['prod_color'])) ? $rows['prod_color'] : '' ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group margin_0">
                                <input type="hidden" name="submitproduct" id="submitproduct" value="active">
                                <input type="hidden" name="prod_id" id="prod_id" value="<?= $prod_id ?>">
                                <button class="main_bt" type="submit">Submit</button>
                            </div>
                            <span id="result" class="text-danger mt-4 d-block"></span>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end dashboard inner -->
    </div>

    <?php require_once 'footer.php' ?>
    <script src="assets/ckeditor/ckeditor.js"></script>
    <script src="assets/ckeditor/config.js"></script>
    <script>
        CKEDITOR.replace('prod_details');
        $('#productform').on('submit', function(event) {
            event.preventDefault();
            var data = new FormData(this);

            $.ajax({
                url: "backend/product-queries.php",
                type: "POST",
                //data:  new FormData(this),
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
        $('#category_id').on('change', function(event) {
            event.preventDefault();
            var category_id = $(this).val();
            var getsubcat = 'active';

            if (category_id == '') {
                alert('Please select category');
            } else {
                $.ajax({
                    url: "backend/category_queries.php",
                    type: "POST",
                    //data:  new FormData(this),
                    data: {
                        category_id:category_id,
                        getsubcat:getsubcat,
                    },
                    // contentType: false,
                    // cache: false,
                    // processData: false,
                    // beforeSend: function() {
                    //     $(".status").html("Processing...");
                    // },
                    success: function(data) {
                        $("#sub_category").html(data);
                    }
                });
            }

        });
    </script>