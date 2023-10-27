<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Unique Corporate Gifts: Stand Out from the Competition with Printviu</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://www.Printviu.in">
    <meta property="og:title" content="Corporate Gifting Company in INDIA - Printviu">
    <meta property="og:image" content="ORG IMAGE.jpg.webp">
    <meta property="og:description" content="Make a Lasting Impression with Our Unique and Personalized Corporate Gifts: Elevate Your Brand with Our Premium Selection">
    <meta property="og:discription" content="Make a Lasting Impression with Our Unique and Personalized Corporate Gifts: Elevate Your Brand with Our Premium Selection.">
    <meta name="title" content="Corporate Gifting Company in INDIA - Printviu">
    <meta name="description" content="Unleash the power of corporate gifting with our premium, personalized selection of unique gifts. Elevate your brand image and strengthen relationships with clients, employees, and business partners. Browse our collection today!">
    <meta name="keywords" content="corporate gifts, business gifts, personalized gifts, unique gifts, branded gifts, customized gifts, premium gifts, thoughtful gifts, memorable gifts, client gifts, employee gifts, business partner gifts, branded accessories, curated gifts, gift baskets, promotional gifts, luxury gifts, executive gifts, customized merchandise, custom swag">

    <?php include_once "inc-css.php"; ?>
</head>

<body>
    <?php include 'inc-header.php'; ?>

    <div id="banner" class="px-xl-5 banner carousel carousel-fade slide" data-pause="false" data-ride="carousel">
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
                <picture>
                    <img src="<?= base_url('assets/images/carousel-1.jpg') ?>" class="h-100 w-100 rounded object-cover" alt="">
                </picture>
                <div class="bannerText rounded col-md-6">
                    <h2>Plan Every event with Perfect Gift.</h2>
                    <h6 class="h6">Best wholesale Customizable Corporate Gifts.</h6>
                    <a href="#" class="btn btn-danger">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="<?= base_url('assets/images/bulk.png') ?>" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save upto 20%</h6>
                        <h3 class="text-white mb-3">Call Now For Bulk Order</h3>
                        <a href="tel:011-35686322" class="btn btn-primary">Call Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="<?= base_url('assets/images/designprint.png') ?>" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Custom Print</h6>
                        <h3 class="text-white mb-3">Print Your Brand</h3>
                        <a target="_blank" href="<?= base_url('403forbidden.php') ?>" class="btn btn-primary">Create Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->
    <?php if (isset($feature_products['0'])) { ?>
        <div class="container-fluid pt-5 pb-3">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-white pr-3">Featured Products</span></h2>

            <div class="row px-xl-5">
                <?php
                foreach ($feature_products as $list) {
                    $prod_id = $list['prod_id'];
                    $prod_sub_cat = $list['prod_sub_cat'];
                    $prod_cat = $list['prod_cat'];
                    $glhomeimage = '';
                    $pdcatname = '';
                    $sbpdcatname = '';
                    if (!empty($prod_cat)) {
                        $catrow = $this->db->query("SELECT * FROM `category` WHERE `cat_status`='1' AND `cat_id`='$prod_cat'")->result_array();
                        $pdcatname = $catrow[0]['cat_url'];
                    }
                    if (!empty($prod_sub_cat)) {
                        $sbcatrow = $this->db->query("SELECT * FROM `sub_category` WHERE `sub_cat_status`='1' AND `sub_cat_id`='$prod_sub_cat'")->result_array();
                        $sbpdcatname = $sbcatrow[0]['sub_cat_url'] . '/';
                    }

                    $gatgall = $this->db->query("SELECT * FROM `product_gallery` WHERE `pg_home`='1' AND `pg_prod`='$prod_id' AND `pg_status`='1'");
                    // print_r($this->db->last_query());
                    // exit;
                    foreach ($gatgall->result() as $glrow) {
                        $glhomeimage = $glrow->pg_name;
                    }
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4 rounded">
                            <div class="product-img rounded position-relative overflow-hidden">
                                <img class="img-fluid w-100 rounded" src="https://www.printviu.in/upload/products/<?= $glhomeimage; ?>" style="object-fit: contain; width: 100%; height: 35vh; float: center;" alt="<?= $list['prod_name']; ?>">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square addtocart" data-product_id="<?= $list['prod_id'] ?>" data-userid="<?= $urids ?>" href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square addtowishlist" href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Add to Wishlist"><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="<?= base_url('product/' . $pdcatname . '/' . $sbpdcatname . $list['prod_url']); ?>" data-toggle="tooltip" data-placement="bottom" title="View Detail"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-text text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="<?= base_url('product/' . $pdcatname . '/' . $sbpdcatname . $list['prod_url']); ?>"><?= mb_strimwidth($list['prod_name'], 0, 22, "..."); ?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>₹ <?= number_format($list['prod_discounted_price']); ?></h5>
                                    <h6 class="text-muted ml-2"><del>₹ <?= number_format($list['prod_total_price']); ?></del></h6>
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
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else {
        echo "Products Not Found";
    } ?>

    <!-- Offer Start -->
    <div class="pt-5 pb-3">
        <img src="<?= base_url('assets/banner/banner1.jpeg') ?>" style="width: 100%;">
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <?php if (isset($recent_products['0'])) { ?>

        <div class="container-fluid pt-5 pb-3">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-white pr-3">Recent Products</span></h2>

            <div class="row px-xl-5">
                <?php
                foreach ($recent_products as $rlist) {
                    $prod_id = $rlist['prod_id'];
                    $prod_sub_cat = $rlist['prod_sub_cat'];
                    $prod_cat = $rlist['prod_cat'];
                    $recent_image = '';
                    $recgall = $this->db->query("SELECT * FROM `product_gallery` WHERE `pg_home`='1' AND `pg_prod`='$prod_id' AND `pg_status`='1'");
                    $rpdcatname = '';
                    $rsbpdcatname = '';
                    if (!empty($prod_cat)) {
                        $catrow = $this->db->query("SELECT * FROM `category` WHERE `cat_status`='1' AND `cat_id`='$prod_cat'")->result_array();
                        $rpdcatname = $catrow[0]['cat_url'];
                    }
                    if (!empty($prod_sub_cat)) {
                        $sbcatrow = $this->db->query("SELECT * FROM `sub_category` WHERE `sub_cat_status`='1' AND `sub_cat_id`='$prod_sub_cat'")->result_array();
                        $rsbpdcatname = $sbcatrow[0]['sub_cat_url'] . '/';
                    }

                    foreach ($recgall->result() as $rglrow) {
                        $recent_image = $rglrow->pg_name;
                    }
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4 rounded">
                            <div class="product-img rounded position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="https://www.printviu.in/upload/products/<?= $recent_image; ?>" style="object-fit: contain; width: 100%; height: 35vh; float: center;" alt="<?= $rlist['prod_name']; ?>">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square addtocart" data-product_id="<?= $list['prod_id'] ?>" data-userid="<?= $urids ?>" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square addtowishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="<?= base_url('product/' . $rpdcatname . '/' . $rsbpdcatname . $rlist['prod_url']); ?>"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-text text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="<?= base_url('product/' . $rpdcatname . '/' . $rsbpdcatname . $rlist['prod_url']); ?>"><?= mb_strimwidth($rlist['prod_name'], 0, 22, "..."); ?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>₹ <?= number_format($rlist['prod_discounted_price']); ?></h5>
                                    <h6 class="text-muted ml-2"><del>₹ <?= number_format($rlist['prod_total_price']); ?></del></h6>
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
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Products End -->
    <?php } else {
        echo "Products Not Found";
    } ?>

    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/aeroplay.jpeg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/gedu_logofianl.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/railtel-final.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/army.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/rfl_final.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/logo 1.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/spectra_care.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/ar.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/ufood.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/wholesum.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/railwire.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/max.jpg') ?>" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?= base_url('assets/client/RC BENTEX.jpg.webp') ?>" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->

    <?php include_once 'inc-footer.php'; ?>
    <?php include_once 'inc-script.php'; ?>
    <style>

    </style>

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