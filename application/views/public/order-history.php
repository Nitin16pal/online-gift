<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cart</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords" content="corporate gifts, business gifts, personalized gifts, unique gifts, branded gifts, customized gifts, premium gifts, thoughtful gifts, memorable gifts, client gifts, employee gifts, business partner gifts, branded accessories, curated gifts, gift baskets, promotional gifts, luxury gifts, executive gifts, customized merchandise, custom swag">
    <?php include 'inc-css.php'; ?>

</head>

<body>
    <?php include 'inc-header.php'; ?>

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Sub Total</th>
                            <th>Shiping Charge</th>
                            <th>Total Price</th>
                            <th>Order Status</th>
                            <th>Payment Type</th>
                            <th>Date</th>
                            <th>View Order</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $count = 1;
                        if (isset($odhist[0])) {
                            foreach ($odhist as $olist) {
                        ?>
                                <tr>
                                    <td class="process"> <?= $count++; ?></td>
                                    <td class="align-middle"><?= $olist['od_hs_id']; ?></td>
                                    <td class="align-middle">₹ <?= $olist['od_sub_total']; ?></td>
                                    <td class="align-middle">₹ <?= $olist['od_ship_charge']; ?></td>
                                    <td class="align-middle">₹ <?= $olist['od_total_price']; ?></td>
                                    <td class="align-middle font-weight-bold text-capitalize <?= (strtolower($olist['od_status']) == 'cancel') ? 'text-danger' : ((strtolower($olist['od_status']) == 'placed' ||strtolower($olist['od_status']) == 'delivered' ||strtolower($olist['od_status']) == 'shipped') ? 'text-success' : '') ?>"><?= $olist['od_status']; ?></td>
                                    <td class="align-middle"><?= $olist['od_paystatus']; ?></td>
                                    <td class="align-middle"><?= date("F j, Y", strtotime($olist['od_created'])); ?></td>
                                    <td>
                                        <ul class="list-inline d-flex justify-content-start">
                                            <li data-toggle="tooltip" data-placement="bottom" title="View Order"><a href="#vieworder" data-urodid="<?= $olist['od_id'] ?>" data-toggle="modal" class="btn btn-primary viedetails mx-1"><i class="fa fa-eye"></i></a></li>
                                            <li class="actionorder<?= $olist['od_id'] ?> <?= (strtolower($olist['od_status']) == 'pending' || strtolower($olist['od_status']) == 'processing' || strtolower($olist['od_status']) == 'pending') ? 'd-block' : 'd-none' ?>"><a href="javascript:void(0)" data-urodid="<?= $olist['od_id'] ?>" class="btn btn-danger mx-1 cancelorder" data-toggle="tooltip" data-placement="bottom" title="Cancel Order"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <?php include 'inc-footer.php'; ?>
    <?php include 'inc-script.php'; ?>

    <div class="modal fade" id="vieworder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-3 px-2">
                    <div class="main-content text-center">
                        <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><span class="icon-close2"></span></span>
                        </a>
                        <div class="col-md-12">
                            <div class="rounded">
                                <div class="table-responsive table-borderless">
                                    <table class="table">
                                        <thead class="odhistory">
                                            <tr>
                                                <th> #</th>
                                                <th>Product</th>
                                                <th>Product Name</th>
                                                <th>Product Price</th>
                                                <th>Product Quantity</th>
                                                <th>Product Total</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        $('.viedetails').click(function() {
            var orderid = $(this).data('urodid');
            if (orderid != '') {
                $.ajax({
                    url: "<?= base_url('order-details/') ?>" + orderid,
                    method: 'GET',
                    // beforeSend: function() {
                    //     $("#projectname").html("Processing...");
                    // },
                    success: function(data) {
                        $(".table-body").html(data);
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }
        })

        $('.cancelorder').click(function() {
            var orderid = $(this).data('urodid');
            if (orderid != '') {
                $.ajax({
                    url: "<?= base_url('order-cancel/') ?>" + orderid,
                    method: 'GET',
                    dataType: 'json',
                    // beforeSend: function() {
                    //     $("#projectname").html("Processing...");
                    // },
                    success: function(data) {
                        if (data.status == 'success') {

                            Swal.fire({
                                text: data.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                $('.actionorder' + orderid).toggle();
                                location.reload();

                            })
                        } else {
                            Swal.fire({
                                text: data.message,
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }

                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }
        })
    </script>


</body>

</html>