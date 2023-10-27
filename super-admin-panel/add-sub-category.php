<?php require_once 'header.php';
require_once 'sidebar.php';

$id = '';
$cat_id = '';
if (isset($_GET['sub_cat_id'])) {
    $id = $_GET['sub_cat_id'];
    $pdetails = mysqli_query($link, "SELECT * FROM `sub_category` WHERE  `sub_cat_id`='$id'") or die("Sub Category GET DETAILS QUERY NOT RUN");
    $rows = mysqli_fetch_array($pdetails);
}
if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
}
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2><?= (!empty($id)) ? 'Edit' : 'Add' ?> Sub Cities</h2>
                </div>
            </div>
        </div>

        <!-- row -->
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <a href="sub-category.php?cat_id=<?= (!empty($rows['sub_cat']))?$rows['sub_cat']:$cat_id ?>" class="btn btn-primary btn-xs float-right">Back</a>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <form method="POST" id="citiesform" enctype="multipart/form-data">
                            <span class="status text-danger mb-0"></span>
                            <div class="form-row mb-3">
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title" value="<?= (!empty($rows['sub_cat_title'])) ? $rows['sub_cat_title'] : '' ?>" class="form-control" />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Meta Keywords</label>
                                    <input type="text" name="meta_key" id="meta_key" value="<?= (!empty($rows['sub_cat_keyword'])) ? $rows['sub_cat_keyword'] : '' ?>" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="label_field">Meta Description</label>
                                    <textarea name="meta_desc" id="meta_desc" class="form-control" rows="5"> <?= (!empty($rows['sub_cat_desc'])) ? $rows['sub_cat_desc'] : '' ?></textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select category</option>
                                        <?php
                                        $datact = mysqli_query($link, "SELECT * FROM `category` ORDER BY `cat_id` ASC");
                                        while ($rowsct = mysqli_fetch_assoc($datact)) {
                                        ?>
                                            <option value="<?= $rowsct['cat_id'] ?>" <?= ($rowsct['cat_id'] == $rows['sub_cat'] || $cat_id==$rowsct['cat_id']) ? 'selected' : '' ?>><?= $rowsct['cat_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Sub Category Name</label>
                                    <input type="text" name="sub_name" id="sub_name" value="<?= (!empty($rows['sub_cat_name'])) ? $rows['sub_cat_name'] : '' ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group margin_0">
                                <input type="hidden" name="subcategory" id="subcategory" value="active">
                                <input type="hidden" name="subcatid" id="subcatid" value="<?= $id ?>">
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
    <script>
        $('#citiesform').on('submit', function(event) {
            event.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "backend/category_queries.php",
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
    </script>
    <?php require_once 'footer.php' ?>