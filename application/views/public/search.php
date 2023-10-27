<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Best Printed T-shirt under 299</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Corporate Gifting Company in INDIA - Printviu" name="keywords">
    <meta content="Corporate Gifting Company in INDIA - Printviu" name="description">
    <?php include_once "inc-css.php";
    $uri1 = $this->uri->segment(2);
    $uri2 = $this->uri->segment(3);

    $uri1segment = (!empty($uri1)) ? $uri1 . '/' : '';
    $uri2segment = (!empty($uri2)) ? $uri2 . '/' : '';

    ?>
</head>

<body>
    <!-- Topbar Start -->
    <?php include 'inc-header.php'; ?>
    <!-- Shop Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-white pr-3">Products Page Title</span></h2>
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <?php
                    if (isset($plist[0])) {
                        foreach ($plist as $list) {
                            $prod_id = $list['prod_id'];
                            $glhomeimage = '';
                            $gatgall = $this->db->query("SELECT * FROM `product_gallery` WHERE `pg_home`='1' AND `pg_prod`='$prod_id' AND `pg_status`='1'");
                            foreach ($gatgall->result() as $glrow) {
                                $glhomeimage = $glrow->pg_name;
                            }
                    ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4 rounded">
                                    <div class="product-img rounded position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="https://www.printviu.in/upload/products/<?= $glhomeimage; ?>" style="object-fit: contain; width: 100%; height: 35vh; float: center;" alt="<?= $list['prod_name']; ?>">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square addtocart" data-product_id="<?= $list['prod_id'] ?>" data-userid="<?= $urids ?>" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square addtowishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="<?= base_url('product/' . $uri1segment . $uri2segment . $list['prod_url']); ?>"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-text text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="<?= base_url('product/' . $uri1segment . $uri2segment . $list['prod_url']); ?>"><?= mb_strimwidth($list['prod_name'], 0, 22, "..."); ?></a>
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

                    <?php }}?>

                    <?php
                    if (isset($cplist[0])) {
                        foreach ($cplist as $list) {
                            $prod_id = $list['prod_id'];
                            $glhomeimage = '';
                            $gatgall = $this->db->query("SELECT * FROM `product_gallery` WHERE `pg_home`='1' AND `pg_prod`='$prod_id' AND `pg_status`='1'");
                            foreach ($gatgall->result() as $glrow) {
                                $glhomeimage = $glrow->pg_name;
                            }
                    ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4 rounded">
                                    <div class="product-img rounded position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="https://www.printviu.in/upload/products/<?= $glhomeimage; ?>" style="object-fit: contain; width: 100%; height: 35vh; float: center;" alt="<?= $list['prod_name']; ?>">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square addtocart" data-product_id="<?= $list['prod_id'] ?>" data-userid="<?= $urids ?>" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square addtowishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="<?= base_url('product/' . $uri1segment . $uri2segment . $list['prod_url']); ?>"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-text text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="<?= base_url('product/' . $uri1segment . $uri2segment . $list['prod_url']); ?>"><?= mb_strimwidth($list['prod_name'], 0, 22, "..."); ?></a>
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

                    <?php }}?>

                    <?php
                    if (isset($scplist[0])) {
                        foreach ($scplist as $list) {
                            $prod_id = $list['prod_id'];
                            $glhomeimage = '';
                            $gatgall = $this->db->query("SELECT * FROM `product_gallery` WHERE `pg_home`='1' AND `pg_prod`='$prod_id' AND `pg_status`='1'");
                            foreach ($gatgall->result() as $glrow) {
                                $glhomeimage = $glrow->pg_name;
                            }
                    ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4 rounded">
                                    <div class="product-img rounded position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="https://www.printviu.in/upload/products/<?= $glhomeimage; ?>" style="object-fit: contain; width: 100%; height: 35vh; float: center;" alt="<?= $list['prod_name']; ?>">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square addtocart" data-product_id="<?= $list['prod_id'] ?>" data-userid="<?= $urids ?>" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square addtowishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="<?= base_url('product/' . $uri1segment . $uri2segment . $list['prod_url']); ?>"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-text text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="<?= base_url('product/' . $uri1segment . $uri2segment . $list['prod_url']); ?>"><?= mb_strimwidth($list['prod_name'], 0, 22, "..."); ?></a>
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

                    <?php }}

                    if (!isset($plist[0]) && !isset($cplist[0]) && !isset($scplist[0])) { echo "Data Not Found"; } ?>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <!-- Vendor End -->
    <?php include_once 'inc-footer.php'; ?>
    <?php include_once 'inc-script.php'; ?>


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