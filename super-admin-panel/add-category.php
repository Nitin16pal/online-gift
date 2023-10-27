<?php require_once 'header.php';
require_once 'sidebar.php';

$id = '';
if (isset($_GET['cat_id'])) {
    $id = $_GET['cat_id'];
    $pdetails = mysqli_query($link, "SELECT * FROM `category` WHERE  `cat_id`='$id'") or die("CATEGORY GET DETAILS QUERY NOT RUN");
    $rows = mysqli_fetch_array($pdetails);
}
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2><?= (!empty($id)) ? 'Edit' : 'Add' ?> Category</h2>
                </div>
            </div>
        </div>

        <!-- row -->
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <a href="category.php" class="btn btn-primary btn-xs float-right">Back</a>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <form method="POST" id="categoryform" enctype="multipart/form-data">
                            <span class="status text-danger mb-0"></span>
                            <div class="form-row mb-3">
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title" value="<?= (!empty($rows['cat_title'])) ? $rows['cat_title'] : '' ?>" class="form-control" />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="label_field">Meta Keyword</label>
                                    <input type="text" name="meta_keywords" id="meta_keywords" value="<?= (!empty($rows['cat_key'])) ? $rows['cat_key'] : '' ?>" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="label_field">Meta Description</label>
                                    <textarea name="meta_desc" id="meta_desc" class="form-control" rows="3"><?= (!empty($rows['cat_desc'])) ? $rows['cat_desc'] : '' ?></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="label_field">Category</label>
                                    <input type="text" name="category" id="category" value="<?= (!empty($rows['cat_name'])) ? $rows['cat_name'] : '' ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group margin_0">
                                <input type="hidden" name="addcategory" id="addcategory" value="active">
                                <input type="hidden" name="cat_id" id="cat_id" value="<?= $id ?>">
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
        $('#categoryform').on('submit', function(event) {
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