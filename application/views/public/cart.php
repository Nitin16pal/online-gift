<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cart</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords" content="<?= 'corporate gifts, business gifts, personalized gifts, unique gifts, branded gifts, customized gifts, premium gifts, thoughtful gifts, memorable gifts, client gifts, employee gifts, business partner gifts, branded accessories, curated gifts, gift baskets, promotional gifts, luxury gifts, executive gifts, customized merchandise, custom swag'; ?>">
    <?php include 'inc-css.php'; ?>

</head>

<body>
    <?php include 'inc-header.php'; ?>

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $subtotal = 0;
                        $shippingcharge = 40;
                        if (!empty($username)) {
                            foreach ($usercarts as $clist) {
                                $prod_id = $clist['pd_id'];
                                $glhomeimage = '';
                                $subtotal = $subtotal + $clist['pd_total'];
                                $gatgall = $this->db->query("SELECT * FROM `product_gallery` WHERE `pg_home`='1' AND `pg_prod`='$prod_id' AND `pg_status`='1'");
                                foreach ($gatgall->result() as $glrow) {
                                    $glhomeimage = $glrow->pg_name;
                                }
                        ?>
                                <tr id="trclass<?= $clist['crt_id']; ?>">
                                    <td class="float-left"><img src="https://www.printviu.in/upload/products/<?= $glhomeimage; ?>" alt="<?= $clist['pd_name']; ?>" style="width: 50px;"> <?= word_limiter($clist['pd_name'],3); ?></td>
                                    <td class="align-middle">₹ <?= $clist['pd_price']; ?></td>
                                    <td>
                                        <div class="col-md-8 row mx-auto">
                                            <button class="btn btn-link px-2 col-md-3 updatecart" data-cartid="<?= $clist['crt_id']; ?>" data-userids="<?= $urids ?>" data-prodids="<?= $prod_id ?>" data-prodprice="<?= $clist['pd_price'] ?>" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="prodqty<?= $clist['crt_id']; ?>" min="0" name="quantity" value="<?= $clist['pd_quantity'] ?>" type="number" class="form-control form-control-sm col-md-4" />

                                            <button class="btn btn-link px-2 col-md-3 updatecart" data-cartid="<?= $clist['crt_id']; ?>" data-userids="<?= $urids ?>" data-prodids="<?= $prod_id ?>" data-prodprice="<?= $clist['pd_price'] ?>" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="align-middle">₹ <?= $clist['pd_total']; ?></td>
                                    <td class="align-middle"><button data-cartid="<?= $clist['crt_id']; ?>" name="del" class="btn btn-sm btn-danger deletecart"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            $cart = $this->cart->contents();
                            foreach ($cart as $clist) {
                                $prod_id = $clist['id'];
                                $glhomeimage = '';
                                $subtotal = $this->cart->total();
                                $gatgall = $this->db->query("SELECT * FROM `product_gallery` WHERE `pg_home`='1' AND `pg_prod`='$prod_id' AND `pg_status`='1'");
                                foreach ($gatgall->result() as $glrow) {
                                    $glhomeimage = $glrow->pg_name;
                                }
                            ?>
                                <tr id="trclass<?= $clist['rowid']; ?>">
                                    <td class="float-left"><img src="https://www.printviu.in/upload/products/<?= $glhomeimage; ?>" alt="" style="width: 50px;"> <?= word_limiter($clist['name'],3); ?></td>
                                    <td class="align-middle">₹ <?= $clist['price']; ?></td>
                                    <td>
                                        <div class="col-md-8 row mx-auto">
                                            <button class="btn btn-link px-2 col-md-3 updatecart" data-cartid="<?= $clist['rowid']; ?>" data-userids="<?= (!empty($username)) ? $urids : '' ?>" data-prodids="<?= $prod_id ?>" data-prodprice="<?= number_format($clist['price']) ?>" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="prodqty<?= $clist['rowid']; ?>" min="0" name="quantity" value="<?= $clist['qty'] ?>" type="number" class="form-control form-control-sm col-md-4" />

                                            <button class="btn btn-link px-2 col-md-3 updatecart" data-cartid="<?= $clist['rowid']; ?>" data-userids="<?= (!empty($username)) ? $urids : '' ?>" data-prodids="<?= $prod_id ?>" data-prodprice="<?= number_format($clist['price']) ?>" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="align-middle">₹ <?= number_format($clist['price'] * $clist['qty']); ?></td>
                                    <td class="align-middle"><button data-cartid="<?= $clist['rowid']; ?>" name="del" class="btn btn-sm btn-danger deletecart"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>

                        <?php }
                        } ?>
                        <tr>
                            <td colspan="5" class="<?= (!empty($subtotal)) ? 'd-none' : '' ?> text-warning"> <?= (empty($subtotal)) ? 'Your cart is empty' : '' ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4 couponvalue" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary updatecoupon">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-white pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="cartsubtotal">₹ <?= number_format($subtotal) ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium" id="cartship">₹ <?= $shippingcharge = ($subtotal < 500) ? $shippingcharge : 0; ?></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <?php
                            $grandtotal = ($subtotal < 500) ? $subtotal + $shippingcharge : $subtotal;
                            $this->session->set_userdata('subtotal', $subtotal);
                            $this->session->set_userdata('grandtotal', $grandtotal);
                            $this->session->set_userdata('shipcarg', $shippingcharge);

                            ?>
                            <h5 id="cartgrandtotal">₹ <?= ($subtotal < 1) ? 0 : $grandtotal  ?></h5>
                        </div>
                        <a href="<?= (empty($username)) ? '#loginmodal' : base_url('checkout'); ?>" <?= (empty($username)) ? 'data-toggle="modal"' : '' ?>><button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include 'inc-footer.php'; ?>
    <?php include 'inc-script.php'; ?>

    <script>
        $('.deletecart').on('click', function(event) {
            event.preventDefault();
            var cartid = $(this).data('cartid');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('deletecart') ?>" + "/" + cartid,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // alert(data.status);
                            console.log(data);
                            if (data.status == 'success') {
                                Swal.fire({
                                    text: 'Product has been deleted.',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then((result) => {
                                    $("#trclass" + cartid).toggle();
                                    $("#cartsubtotal").html(data.subtotal);
                                    $("#cartship").html(data.shippingcarg);
                                    $("#cartgrandtotal").html(data.grandtotal);
                                    $('.headcart').load("<?= base_url('countcarts'); ?>");
                                    // location.reload();
                                })
                            }
                        }
                    });

                }
            })
        });

        $('.updatecart').on('click', function(event) {
            event.preventDefault();
            var cartid = $(this).data('cartid');
            var prodprice = $(this).data('prodprice');
            var prodqty = $('#prodqty' + cartid).val();
            $.ajax({
                url: "<?= base_url('updatecart') ?>" + "/" + cartid + "/" + prodqty + "/" + prodprice,
                type: "GET",
                success: function(data) {
                    Swal.fire({
                        text: 'Product update successfully.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        // if (result.isConfirmed) {
                        location.reload();
                        // }
                    })
                }
            });
        });

        $('.updatecoupon').on('click', function(event) {
            event.preventDefault();
            var couponvalue = $('.couponvalue').val();
            if (couponvalue == '') {
                Swal.fire({
                    text: 'Please Enter Coupon Code',
                    icon: 'warning',
                    showConfirmButton: false,
                    timer: 2000
                })
            } else {
                $.ajax({
                    url: "<?= base_url('applycoupon') ?>" + "/" + couponvalue,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 'success') {
                            // $("#cartsubtotal").html(Number(data.subtotal).toFixed(2));
                            $("#cartsubtotal").html(data.subtotal);
                            $("#cartship").html(data.shippingcarg);
                            $("#cartgrandtotal").html(data.grandtotal);
                            Swal.fire({
                                text: data.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 5000
                            })
                        } else {
                            Swal.fire({
                                text: data.message,
                                icon: 'warning',
                                showConfirmButton: false,
                                timer: 5000
                            })
                        }

                    }
                });
            }
        });
    </script>



</body>

</html>