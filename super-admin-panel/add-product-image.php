<?php require_once 'header.php';
require_once 'sidebar.php';

$prod_url = '';
$prod_id = '';
if (isset($_GET['prod_url']) && !empty($_GET['prod_url'])) {
    $prod_url = $_GET['prod_url'];
    $projects = mysqli_query($link, "SELECT * FROM `products` WHERE  `prod_url`='$prod_url'") or die("GALLERY QUERY NOT RUN");
    $pro_rows = mysqli_fetch_array($projects);
    if (!empty($pro_rows) && !empty($pro_rows['prod_id'])) {
        $prod_id = $pro_rows['prod_id'];
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
                                <div class="clone_fields">
                                    <div class="col-md-6 form-group remove">
                                        <span><i class="fa fa-times red_color" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="form-row ">
                                        <div class="col-md-6 form-group">
                                            <label class="label_field">Amenities Alt</label>
                                            <input type="text" name="titles[]" id="titles" class="form-control" />
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="label_field">Amenities Icon</label>
                                            <input type="file" id="gallery" name="gallery[]" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span id="addmore" class="col-md-12 form-group">Add More</span>

                            <div class="form-group margin_0">
                                <input type="hidden" name="prod_image" value="active">
                                <input type="hidden" name="prod_id" value="<?= $prod_id ?>">
                                <input type="hidden" name="prod_url" value="<?= $prod_url ?>">
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
    <style>
        .clone_fields:first-child .remove {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#addmore').on('click', function() {
                var data = $(".clone_fields:eq(0)").clone(true).appendTo(".more_fields_container");
                data.find("input").val('');
                $('.remove').show();
            });
            $(document).on('click', '.remove', function() {
                var currentBox = $(this).parents(".clone_fields");
                if ($(".clone_fields").length > 1) {
                    currentBox.remove();
                } else {
                    alert("Sorry!! Can't remove first row!");
                }
                if ($(".clone_fields").length == 1) {
                    $('.remove').hide();
                }
            });
        });

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
    </script>
    <?php require_once 'footer.php' ?>