<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords" content="corporate gifts, business gifts, personalized gifts, unique gifts, branded gifts, customized gifts, premium gifts, thoughtful gifts, memorable gifts, client gifts, employee gifts, business partner gifts, branded accessories, curated gifts, gift baskets, promotional gifts, luxury gifts, executive gifts, customized merchandise, custom swag">

    <?php include_once "inc-css.php"; ?>

</head>

<body>
    <?php include 'inc-header.php'; ?>


    <?php
    foreach ($prductsdetails as $list) {
        $prod_id = $list['prod_id'];
        $glhomeimage = '';
        $gatgall = $this->db->query("SELECT * FROM `product_gallery` WHERE `pg_home`='1' AND `pg_prod`='$prod_id' AND `pg_status`='1'");
        // print_r($this->db->last_query());
        // exit;
        foreach ($gatgall->result() as $glrow) {
            $glhomeimage = $glrow->pg_name;
        }
    ?>

        <!-- Shop Detail Start -->
        <div class="container-fluid bg-secondary py-5">
            <div class="row px-xl-5">
                <div class="col-lg-5 mb-30 productDetail-img">
                    <div class="inner h-100 bg-white rounded">
                        <img src="https://www.printviu.in/upload/products/<?= $glhomeimage; ?>" class="w-100 h-100" style="object-fit: contain;">
                    </div>
                </div>
                <div class="col-lg-7 h-auto mb-30 productDetail">
                    <div class="h-100 bg-light p-30 rounded">
                        <h3><?= $list['prod_name']; ?></h3>
                        <div class="d-flex mb-3">
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(99 Reviews)</small>
                        </div>
                        <span><del>₹<?= $list['prod_total_price']; ?></del>
                            <h3 class="font-weight-semi-bold mb-4">₹<?= $list['prod_discounted_price']; ?>
                                <span class="text-primary"> -
                                    <?php
                                    $cal = $list['prod_total_price'] - $list['prod_discounted_price'];
                                    $percent = ($cal / $list['prod_total_price']) * 100;
                                    echo  number_format($percent, 2, '.', ''); ?>%
                                </span>
                            </h3>
                        </span>
                        <p class="mb-4"><?= $list['prod_details']; ?></p>
                        <div class="d-flex mb-3">
                            <strong class="text-dark mr-3">Size:</strong>
                            <p><?= $list['prod_size']; ?></p>
                        </div>
                        <div class="d-flex mb-4">
                            <strong class="text-dark mr-3">Colors:</strong>
                            <p><?= $list['prod_color']; ?></p>
                        </div>
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <button class="btn btn-outline-dark px-3">Shop Now</button>
                            </div>
                            <button class="btn btn-primary px-3 addtocart" data-product_id="<?= $list['prod_id'] ?>" data-userid="<?= $urids ?>"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                        </div>
                        <div class="d-flex pt-2">
                            <strong class="text-dark mr-2">Share on:</strong>
                            <div class="d-inline-flex">
                                <a class="text-dark px-2" href="https://www.facebook.com/">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="text-dark px-2" href="https://twitter.com/">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="text-dark px-2" href="https://in.linkedin.com/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="text-dark px-2" href="https://in.pinterest.com/">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Detail End -->

    <?php } ?>
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-white pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">

            <div class="col">

                <div class="owl-carousel related-carousel">
                    <?php
                    foreach ($sprod as $slist) {
                        $prod_id = $slist['prod_id'];
                        $prod_sub_cat = $slist['prod_sub_cat'];
                        $prod_cat = $slist['prod_cat'];
                        $glhomeimage = '';
                        $gatgall = $this->db->query("SELECT * FROM `product_gallery` WHERE `pg_home`='1' AND `pg_prod`='$prod_id' AND `pg_status`='1'");
                        foreach ($gatgall->result() as $glrow) {
                            $glhomeimage = $glrow->pg_name;
                        }

                        $rpdcatname='';
                        $rsbpdcatname='';
                        if (!empty($prod_cat)) {
                        $catrow = $this->db->query("SELECT * FROM `category` WHERE `cat_status`='1' AND `cat_id`='$prod_cat'")->result_array();
                        $rpdcatname = $catrow[0]['cat_url'];
                        }
                        if (!empty($prod_sub_cat)) {
                            $sbcatrow = $this->db->query("SELECT * FROM `sub_category` WHERE `sub_cat_status`='1' AND `sub_cat_id`='$prod_sub_cat'")->result_array();
                            $rsbpdcatname = $sbcatrow[0]['sub_cat_url'].'/';
                        }

                    ?>
                        <!-- conde -->
                        <div class="product-item bg-light rounded">
                            <div class="product-img rounded position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="https://www.printviu.in/upload/products/<?= $glhomeimage; ?>" alt="" style="object-fit: contain; width: 100%; height: 35vh; float: center;">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square addtocart" data-product_id="<?= $list['prod_id'] ?>" data-userid="<?= $urids ?>" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="<?= base_url('product/'.$rpdcatname . '/' . $rsbpdcatname.$slist['prod_url']); ?>"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-text text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="<?= base_url('product/'.$rpdcatname . '/' . $rsbpdcatname.$slist['prod_url']); ?>">
                                    <?= $name = mb_strimwidth($slist['prod_name'], 0, 22, "..."); ?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>₹ <?= number_format($slist['prod_discounted_price']); ?></h5>
                                    <h6 class="text-muted ml-2"><del>₹ <?= number_format($slist['prod_total_price']); ?></del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- ende code -->
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


    <!-- Footer Start -->
    <?php include 'inc-footer.php'; ?>
    <?php include 'inc-script.php'; ?>
    <!-- Footer End -->

    <script>
        $('.addtocart').on('click', function(event) {
            event.preventDefault();
            var prodId = $(this).data('product_id');
            var userId = $(this).data('userid');
            $.ajax({
                url: "<?= base_url('addcart') ?>" + "/" + prodId + "/" + userId,
                type: "GET",
                success: function(data) {
                    Swal.fire({
                        text: 'Product has been added in your cart.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                    }).then((result) => {
                        $('.headcart').load("<?= base_url('countcarts'); ?>");
                    })
                }
            });

        });
    </script>
</body>

</html>