<?php require_once 'header.php';
require_once 'sidebar.php';

$prod_url = '';
$prod_id = '';
$gall_id = '';
if (isset($_GET['prod_url']) && !empty($_GET['prod_url']) && isset($_GET['gall_id']) && !empty($_GET['gall_id'])) {
    $prod_url = $_GET['prod_url'];
    $gall_id = $_GET['gall_id'];
    $data = mysqli_query($link, "SELECT * FROM `product_gallery` WHERE `pg_id`='$gall_id'") or die("GALLERY QUERY NOT RUN");
    $pg_row = mysqli_fetch_array($data);
    if (!empty($pg_row) && !empty($pg_row['pg_id'])) {
        $pg_id = $pg_row['pg_id'];
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
                    <h2>Add Product Gallery</h2>
                </div>
            </div>
        </div>

        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <a href="product-image.php?prod_url=<?= $_GET['prod_url'] ?>" class="btn btn-primary btn-xs float-right">Back</a>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <span class="status text-danger"></span>
                        <form method="POST" id="gallerImage" enctype="multipart/form-data">
                            <div class="more_fields_container">
                                <div class="form-row ">
                                    <div class="col-md-6 form-group">
                                        <label class="label_field">Gallery Title</label>
                                        <input type="text" name="titles" id="titles" class="form-control" value="<?= (!empty($pg_row['pg_title'])) ? $pg_row['pg_title'] : '' ?>" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="label_field">Gallery Image</label>
                                        <input type="file" id="gallery" name="gallery" class="form-control" />
                                        <img src="../upload/products/<?= $pg_row['pg_name'] ?>" class="<?= (!empty($pg_row['pg_name'])) ? '' : 'd-none' ?>" style="object-fit:cover" alt="Printviu" width="50" height="50">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group margin_0">
                                <input type="hidden" name="ed_prod_image" value="active">
                                <input type="hidden" name="pg_id" value="<?= $gall_id ?>">
                                <input type="hidden" name="prod_url" value="<?= $prod_url ?>">
                                <button class="main_bt" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end dashboard inner -->
    </div>
    <script>
        $(document).ready(function() {
            $('#gallerImage').on('submit', function(event) {
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
        });
    </script>
    <?php require_once 'footer.php' ?>