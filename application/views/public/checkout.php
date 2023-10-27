<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Checkout</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Printviu" name="keywords">
    <meta content="Printviu" name="description">
    <link rel="stylesheet" href="check.scss">
    <?php include 'inc-css.php'; ?>

</head>

<body>
    <?php include 'inc-header.php'; ?>



    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <span class="text-danger py-3 check-error"></span>
                    <form id="usercheckout" method="POST">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Your Name</label>
                                <input class="form-control" id="user_name" name="user_name" type="text" value="<?= (!empty($userd['0']->ur_name)) ? $userd['0']->ur_name : ''; ?>">
                                <span class="text-danger nameerror"></span>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" id="user_mail" name="user_mail" type="mail" value="<?= (!empty($userd['0']->ur_email)) ? $userd['0']->ur_email : ''; ?>">
                                <span class="text-danger emailerror"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" id="user_number" name="user_number" type="number" value="<?= (!empty($userd['0']->ur_mobile)) ? $userd['0']->ur_mobile : ''; ?>">
                                <span class="text-danger mobileerror"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 1</label>
                                <input class="form-control" id="add1" name="add1" type="text" placeholder="123 Street" value="<?= (!empty($userd['0']->ur_address)) ? $userd['0']->ur_address : ''; ?>" required>
                                <span class="text-danger add1error"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 2</label>
                                <input class="form-control" id="add2" name="add2" type="text" placeholder="123 Street (optional)" value="<?= (!empty($userd['0']->ur_address2)) ? $userd['0']->ur_address2 : ''; ?>" required>
                                <span class="text-danger add2error"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" id="city" name="city" type="text" placeholder="Noida" value="<?= (!empty($userd['0']->ur_city)) ? $userd['0']->ur_city : ''; ?>" required>
                                <span class="text-danger cityerror"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" id="state" name="state" type="text" placeholder="Uttar Pradesh" value="<?= (!empty($userd['0']->ur_state)) ? $userd['0']->ur_state : ''; ?>" required>
                                <span class="text-danger stateerror"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" id="zip" name="zip" type="number" placeholder="123456" value="<?= (!empty($userd['0']->ur_pin)) ? $userd['0']->ur_pin : ''; ?>" required>
                                <span class="text-danger ziperror"></span>

                            </div>
                            <div class="col-md-6 form-group">
                                <div class="form-check form-check-inline pe-auto">
                                    <input class="form-check-input" type="radio" name="addrtype" id="homeid" value="Home">
                                    <label class="form-check-label" for="homeid">Home</label>
                                </div>
                                <div class="form-check form-check-inline pe-auto">
                                    <input class="form-check-input" type="radio" name="addrtype" id="officetime" value="Office">
                                    <label class="form-check-label" for="officetime">Office</label>
                                </div><br>
                                <span class="text-danger timeerror"></span>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>

                        <div class="d-flex justify-content-between">
                            <p><?= "Product Name"; ?></p>
                            <p>₹ <?= $grandtotal = $this->session->userdata('grandtotal'); ?></p>
                        </div>
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6> <?= $subtotal =  $this->session->userdata('subtotal'); ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">₹<?= $shipcarg =  $this->session->userdata('shipcarg'); ?></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="amount">₹<?= $grtotal = $this->session->userdata('grandtotal'); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30 row">
                        <button id="rzp-button1" onclick="pay()" class="btn btn-block btn-primary font-weight-bold py-3 col-sm-6">Place Order</button>
                        <button onclick="paylater()" class="btn btn-block btn-primary font-weight-bold py-3 col-sm-6">Pay Later</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->


    <!-- Footer Start -->
    <?php include 'inc-footer.php'; ?>
    <?php include 'inc-script.php'; ?>


    <!-- payment -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script type="text/javascript">
        function pay() {
            var cxname = $('#user_name').val();
            var cxmail = $('#user_mail').val();
            var cxnum = $('#user_number').val();
            var add1 = $('#add1').val();
            var add2 = $('#add2').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var zip = $('#zip').val();
            var homeid = $('#homeid').val();
            var amt = parseInt(<?= $grtotal ?>);

            validation = true;

            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]){2,4}$/;

            if (cxname == "" || cxname == null) {
                validation = false;
                $('.nameerror').text('Please Enter Name');
                $('#user_name').addClass('is-invalid');
            } else if ((/^[A-Za-z ]$/.test(cxname))) {
                validation = false;
                $('.nameerror').text('Please Enter Valid Name');
                $('#user_name').addClass('is-invalid');
            } else {
                validation = true;
                $('.nameerror').text('');
                $('#user_name').removeClass('is-invalid').addClass('is-valid');
            }

            if (cxmail == "" || cxmail == null) {
                validation = false;
                $('.emailerror').text('Please Enter Email');
                $('#user_mail').addClass('is-invalid');
            } else if (!filter.test(cxmail)) {
                validation = false;
                $('.emailerror').text('Please Enter Valid Email');
                $('#user_mail').addClass('is-invalid');
            } else {
                validation = true;
                $('.emailerror').text('');
                $('#user_mail').removeClass('is-invalid').addClass('is-valid');
            }

            if (cxnum == "" || cxnum == null) {
                validation = false;
                $('.mobileerror').text('Please Enter Mobile');
                $('#user_number').addClass('is-invalid');
            } else if (!(/^[1-9]{1}[0-9]{9}$/.test(cxnum))) {
                validation = false;
                $('.mobileerror').text('Please Enter Valid Mobile');
                $('#user_number').addClass('is-invalid');
            } else {
                validation = true;
                $('.mobileerror').text('');
                $('#user_number').removeClass('is-invalid').addClass('is-valid');
            }

            if (add1 == "" || add1 == null) {
                validation = false;
                $('.add1error').text('Please Enter Address');
                $('#add1').addClass('is-invalid');
            } else {
                validation = true;
                $('.add1error').text('');
                $('#add1').removeClass('is-invalid').addClass('is-valid');
            }

            if (city == "" || city == null) {
                validation = false;
                $('.cityerror').text('Please Enter City Name');
                $('#city').addClass('is-invalid');
            } else {
                validation = true;
                $('.cityerror').text('');
                $('#city').removeClass('is-invalid').addClass('is-valid');
            }

            if (state == "" || state == null) {
                validation = false;
                $('.stateerror').text('Please Enter State Name');
                $('#state').addClass('is-invalid');
            } else {
                validation = true;
                $('.stateerror').text('');
                $('#state').removeClass('is-invalid').addClass('is-valid');
            }

            if (zip == "" || zip == null) {
                validation = false;
                $('.ziperror').text('Please Enter Zip Code');
                $('#zip').addClass('is-invalid');
            } else {
                validation = true;
                $('.ziperror').text('');
                $('#zip').removeClass('is-invalid').addClass('is-valid');
            }
            if ($('input[name="addrtype"]:checked').length == 0) {
                validation = false;
                $('.timeerror').text('Please Select Delivery TIme');
                $('#homeid').addClass('is-invalid');
                $('#officetime').addClass('is-invalid');
            } else {
                validation = true;
                $('.timeerror').text('');
                $('#homeid').removeClass('is-invalid');
                $('#officetime').removeClass('is-invalid');
            }
            var payment_status = "success";
            if (validation == true) {
                var checkdata = $("#usercheckout").serialize();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('user-address') ?>",
                    dataType: "json",
                    data: checkdata,
                    beforeSend: function() {
                        $(".status").html("Please wait...");
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $(".check-error").css('display', 'none');

                            if (data.success == 'success') {
                                var arr = {
                                    paystatus: data.success,
                                    pay_ur_id: data.up_user_id,
                                    pay_type: data.payment_type,
                                    pay_id: data.payment_id,
                                    pay_odr_id: data.pay_order_id,
                                    grandtotal: <?= $grandtotal ?>,
                                    subtotal: <?= $subtotal ?>,
                                    shipcarg: <?= $shipcarg ?>,
                                    grtotal: <?= $grtotal ?>,
                                };

                                var options = {
                                    "key": "rzp_test_cAT1PmCU69ljBw", // Enter the Key ID generated from the Dashboard
                                    "amount": amt * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                                    "currency": "INR",
                                    "name": "Printviu",
                                    "description": "Test Transaction",
                                    "image": "https://www.printviu.in/logofinal.png",
                                    // "order_id": oid, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                                    "handler": function(response) {
                                        console.warn(response);

                                        if (response) {
                                            $.ajax({
                                                type: 'POST',
                                                url: "<?= base_url('place-orders') ?>",
                                                dataType: 'json',
                                                // data: JSON.stringify(arr),
                                                data: arr,
                                                // contentType: 'application/json; charset=utf-8',
                                                success: function(data) {
                                                    if ($.isEmptyObject(data.error)) {
                                                        if (data.success == 'success') {
                                                            // location.href="<?= base_url() ?>";
                                                            $('.headcart').load("<?= base_url('countcarts'); ?>");
                                                            alert('Your order Place SuccessfUlly');
                                                        }
                                                    } else {
                                                        $(".check-error").css('display', 'block');
                                                        $(".check-error").html(data.error);
                                                    }
                                                }
                                            });
                                        } else {
                                            alert("BED Requests");
                                            alert(response.razorpay_payment_id);
                                            alert(response.razorpay_order_id);
                                        }
                                    },

                                };
                                var rzp1 = new Razorpay(options);
                                rzp1.on('payment.failed', function(response) {
                                    // alert(response.error.code);
                                    // alert(response.error.description);
                                    // alert(response.error.source);
                                    // alert(response.error.step);
                                    // alert(response.error.reason);
                                    // alert(response.error.metadata.order_id);
                                    // alert(response.error.metadata.payment_id)
                                    // alert("paymentid");
                                    // console. warn(response);
                                });
                                // document.getElementById('rzp-button1').onclick = function(e){
                                rzp1.open();
                                // e.preventDefault();
                                // }
                                alert(amt);

                            }
                        } else {
                            $(".check-error").css('display', 'block');
                            $(".check-error").html(data.error);
                        }
                    }
                });



                // } else {
                //     alert('Something went wrong');}
            }

        }

        //  Paylater

        function paylater() {
            var cxname = $('#user_name').val();
            var cxmail = $('#user_mail').val();
            var cxnum = $('#user_number').val();
            var add1 = $('#add1').val();
            var add2 = $('#add2').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var zip = $('#zip').val();
            var homeid = $('#homeid').val();
            var amt = parseInt(<?= $grtotal ?>);

            validation = true;

            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]){2,4}$/;

            if (cxname == "" || cxname == null) {
                validation = false;
                $('.nameerror').text('Please Enter Name');
                $('#user_name').addClass('is-invalid');
            } else if ((/^[A-Za-z ]$/.test(cxname))) {
                validation = false;
                $('.nameerror').text('Please Enter Valid Name');
                $('#user_name').addClass('is-invalid');
            } else {
                validation = true;
                $('.nameerror').text('');
                $('#user_name').removeClass('is-invalid').addClass('is-valid');
            }

            if (cxmail == "" || cxmail == null) {
                validation = false;
                $('.emailerror').text('Please Enter Email');
                $('#user_mail').addClass('is-invalid');
            } else if (!filter.test(cxmail)) {
                validation = false;
                $('.emailerror').text('Please Enter Valid Email');
                $('#user_mail').addClass('is-invalid');
            } else {
                validation = true;
                $('.emailerror').text('');
                $('#user_mail').removeClass('is-invalid').addClass('is-valid');
            }

            if (cxnum == "" || cxnum == null) {
                validation = false;
                $('.mobileerror').text('Please Enter Mobile');
                $('#user_number').addClass('is-invalid');
            } else if (!(/^[1-9]{1}[0-9]{9}$/.test(cxnum))) {
                validation = false;
                $('.mobileerror').text('Please Enter Valid Mobile');
                $('#user_number').addClass('is-invalid');
            } else {
                validation = true;
                $('.mobileerror').text('');
                $('#user_number').removeClass('is-invalid').addClass('is-valid');
            }

            if (add1 == "" || add1 == null) {
                validation = false;
                $('.add1error').text('Please Enter Address');
                $('#add1').addClass('is-invalid');
            } else {
                validation = true;
                $('.add1error').text('');
                $('#add1').removeClass('is-invalid').addClass('is-valid');
            }

            if (city == "" || city == null) {
                validation = false;
                $('.cityerror').text('Please Enter City Name');
                $('#city').addClass('is-invalid');
            } else {
                validation = true;
                $('.cityerror').text('');
                $('#city').removeClass('is-invalid').addClass('is-valid');
            }

            if (state == "" || state == null) {
                validation = false;
                $('.stateerror').text('Please Enter State Name');
                $('#state').addClass('is-invalid');
            } else {
                validation = true;
                $('.stateerror').text('');
                $('#state').removeClass('is-invalid').addClass('is-valid');
            }

            if (zip == "" || zip == null) {
                validation = false;
                $('.ziperror').text('Please Enter Zip Code');
                $('#zip').addClass('is-invalid');
            } else {
                validation = true;
                $('.ziperror').text('');
                $('#zip').removeClass('is-invalid').addClass('is-valid');
            }
            if ($('input[name="addrtype"]:checked').length == 0) {
                validation = false;
                $('.timeerror').text('Please Select Delivery TIme');
                $('#homeid').addClass('is-invalid');
                $('#officetime').addClass('is-invalid');
            } else {
                validation = true;
                $('.timeerror').text('');
                $('#homeid').removeClass('is-invalid');
                $('#officetime').removeClass('is-invalid');
            }
            var payment_type = "cash on deliviry";
            if (validation == true) {
                var checkdata = $("#usercheckout").serialize();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('user-address') ?>",
                    dataType: "json",
                    data: checkdata,
                    beforeSend: function() {
                        $(".status").html("Please wait...");
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $(".check-error").css('display', 'none');

                            if (data.success == 'success') {
                                var arr = {
                                    paystatus: 'Pending',
                                    pay_ur_id: data.up_user_id,
                                    pay_type: 'Cash On Deliviry',
                                    pay_id: data.payment_id,
                                    pay_odr_id: data.pay_order_id,
                                    grandtotal: <?= $grandtotal ?>,
                                    subtotal: <?= $subtotal ?>,
                                    shipcarg: <?= $shipcarg ?>,
                                    grtotal: <?= $grtotal ?>,
                                };

                                $.ajax({
                                    type: 'POST',
                                    url: "<?= base_url('place-orders') ?>",
                                    dataType: 'json',
                                    // data: JSON.stringify(arr),
                                    data: arr,
                                    // contentType: 'application/json; charset=utf-8',
                                    success: function(data) {
                                        if ($.isEmptyObject(data.error)) {
                                            if (data.success == 'success') {
                                                $('.headcart').load("<?= base_url('countcarts'); ?>");
                                                Swal.fire({
                                                    text: 'Your order placed successfully.',
                                                    icon: 'success',
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                }).then((result) => {
                                                    // if (result.isConfirmed) {
                                                    location.href="<?= base_url() ?>";
                                                    // }
                                                })
                                            }
                                        } else {
                                            $(".check-error").css('display', 'block');
                                            $(".check-error").html(data.error);
                                        }
                                    }
                                });

                            }
                        } else {
                            $(".check-error").css('display', 'block');
                            $(".check-error").html(data.error);
                        }
                    }
                });
            }

        }
    </script>

</body>

</html>