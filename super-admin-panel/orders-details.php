<?php
require_once 'header.php';
require_once 'sidebar.php';
$orderid = '';
$urid = '';
if (isset($_GET['orderid']) && $_GET['orderid'] != '') {
    $orderid = $_GET['orderid'];
    $poData = mysqli_query($link, "SELECT * FROM `products_order` WHERE `po_product_order`='$orderid' ORDER BY `po_created` DESC");
    $Rdata = mysqli_query($link, "SELECT * FROM `orders` INNER JOIN `user_registration` ON `orders`.`od_user_id`=`user_registration`.`ur_id` WHERE `od_id` = '$orderid' ORDER BY `od_created` DESC");
    $Rrows = mysqli_fetch_array($Rdata);
}
// Status update
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
    $id = $_GET['id'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $query = mysqli_query($link, "UPDATE `products_order` SET `po_status`='$status' WHERE `po_id`='$id'") or die('Status Update Query Not Run');
        if ($query) {
            echo "<script>window.location.href='order-details.php';</script>";
        }
    } else if ($type == 'trash') {
        $query = mysqli_query($link, "DELETE FROM `products_order` WHERE `po_id`='$id'") or die('Delete Query Not Run');
        if ($query) {
            echo "<script>window.location.href='order-details.php';</script>";
        }
    }
}

?>
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Manage Order Details</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header"><i class="fa fa-shopping-cart"></i> Order Details</div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 1%;"><button class="btn btn-danger btn-sm"><i class="fa fa-calendar fa-fw"></i></button></td>
                                    <td><?= date("F j, Y", strtotime($Rrows['od_created'])) ?></td>
                                </tr>
                                <tr>
                                    <td><button class="btn btn-danger btn-sm"><i class="fa fa-credit-card fa-fw"></i></button></td>
                                    <td>Cash On Delivery</td>
                                </tr>
                                <tr>
                                    <td><button class="btn btn-danger btn-sm"><i class="fa fa-print fa-fw"></i></button></td>
                                    <td><a href="http://localhost/xyz-nonveg1/invoice/191598522540" target="_blank">Download Invoice</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header"><i class="fa fa-user"></i> Customer Details</div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 1%;"><button class="btn btn-danger btn-sm"><i class="fa fa-user fa-fw"></i></button></td>
                                    <td> <a href="javascript:;"><?= $Rrows['ur_name'] ?></a> </td>
                                </tr>
                                <tr>
                                    <td><button class="btn btn-danger btn-sm"><i class="fa fa-envelope fa-fw"></i></button></td>
                                    <td><a href="mailto:<?= $Rrows['ur_email'] ?>"><?= $Rrows['ur_email'] ?></a></td>
                                </tr>
                                <tr>
                                    <td><button class="btn btn-danger btn-sm"><i class="fa fa-phone fa-fw"></i></button></td>
                                    <td><?= $Rrows['ur_mobile'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-default mb-4">
            <div class="card-header"><i class="fa fa-info-circle"></i> Order(<strong class="text-primary"><?= $Rrows['od_hs_id'] ?></strong>)</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50%;" class="text-left">Payment Address</th>
                                <th style="width: 50%;" class="text-left">Shipping Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left align-top">
                                    <div class="col p-2">
                                        <?= $Rrows['ur_address'] ?><br />
                                        <?= (!empty($Rrows['ur_address2'])) ? $Rrows['ur_address2'] . '<br />' : '' ?>
                                        <?= $Rrows['ur_city'] ?><br />
                                        <?= $Rrows['ur_state'] ?><br />
                                        <?= $Rrows['ur_addr_type'] ?><br />
                                        <?= $Rrows['ur_country'] ?> </div>
                                </td>
                                <td class="text-left align-top">
                                    <div class="col p-2">
                                        <?= $Rrows['ur_address'] ?><br />
                                        <?= (!empty($Rrows['ur_address2'])) ? $Rrows['ur_address2'] . '<br />' : '' ?>
                                        <?= $Rrows['ur_city'] ?><br />
                                        <?= $Rrows['ur_state'] ?><br />
                                        <?= $Rrows['ur_addr_type'] ?><br />
                                        <?= $Rrows['ur_country'] ?> </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-left">Product</th>
                                <th class="text-left">SKU</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-right">Unit Price</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fdate = date('Y-m-d');
                            $i = 1;
                            $pcount = mysqli_num_rows($poData);
                            while ($rows = mysqli_fetch_assoc($poData)) {
                                $prodid = $rows['po_prd_id'];
                                $Odata = mysqli_query($link, "SELECT * FROM `products` WHERE `prod_id` = '$prodid'");
                                $orows = mysqli_fetch_array($Odata);
                            ?>
                                <tr>
                                    <td class="text-left">
                                        <p class="text-danger"><strong><?= $orows['prod_name'] ?></strong> </p>
                                        <small> - Delivery Date: <?= date("F j, Y", strtotime($rows['po_created'])) ?></small>
                                    </td>
                                    <td class="text-left"><?= $orows['prod_code'] ?></td>
                                    <td class="text-right"><?= $rows['po_prd_quantity'] ?></td>
                                    <td class="text-right"><i class="fa fa-inr"></i> <?= $rows['po_prd_price'] ?></td>
                                    <td class="text-right"><i class="fa fa-inr"></i> <?= $rows['po_prd_total'] ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4" class="text-right">Sub-Total</td>
                                <td class="text-right"><i class="fa fa-inr"></i> <?= $Rrows['od_sub_total'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">Shipping Charge</td>
                                <td class="text-right"><i class="fa fa-inr"></i> <?= $Rrows['od_ship_charge'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">Coupon Discount</td>
                                <!-- <td class="text-right"><i class="fa fa-inr"></i> </td> -->
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">Tax</td>
                                <td class="text-right"><i class="fa fa-inr"></i> <?= $Rrows['od_tax'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">Total</td>
                                <td class="text-right"><i class="fa fa-inr"></i> <?= $Rrows['od_total_price'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-header"><i class="far fa-comment-o"></i> Order History</div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="50">Sr No.</th>
                                <th>Date Added</th>
                                <th>Comment</th>
                                <th width="90">Status</th>

                            </tr>
                        </thead>
                        <tbody id="load-table">
                            <?php
                            $hdata = mysqli_query($link, "SELECT * FROM `order_history` WHERE `oh_order_id` = '$orderid'");
                            $a = 1;
                            while ($hrows = mysqli_fetch_assoc($hdata)) { ?>
                                <tr>
                                    <td><?= $a++; ?></td>
                                    <td><?= $hrows['oh_date_added']; ?></td>
                                    <td><?= $hrows['oh_order_comment']; ?></td>
                                    <td><?= $hrows['oh_order_status']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <fieldset>
                    <legend>Add Order History</legend>
                    <form class="form-horizontal" method="POST" id="orderhistory">
                        <span class="status text-danger py-3"></span>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 control-label" for="input_order_status">Order Status</label>
                                <div class="col-sm-9">
                                    <select  id="input_order_status" name="input_order_status" class="form-control">
                                        <option value="Canceled">Canceled</option>
                                        <option value="Placed" selected>Placed</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label" for="input_order_msg">Message</label>
                                <div class="col-sm-9">
                                    <textarea  rows="8" id="input_order_msg" name="input_order_msg" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <input type="hidden" name="addorderhistory" value="active">
                            <input type="hidden" name="orderid" value="<?= (!empty($orderid)) ? $orderid : '' ?>">
                            <button type="submit" id="button_history" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add History</button>
                        </div>
                    </form>
                </fieldset>

            </div>
        </div>
    </div>
</div>
<!-- end dashboard inner -->
</div>

<?php require_once 'footer.php' ?>
<script>
    $('#orderhistory').on('submit', function(event) {
        $("#load-table").html('');

        event.preventDefault();
        var data = new FormData(this);
        // var data = $(this).serialize();
        $.ajax({
            url: "backend/orders-history.php",
            type: "POST",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $(".status").html("Processing...");
            },
            success: function(data) {
                console.log(data);
                if (data.error == false) {
                    $(".status").html(data.errtype);
                } else {
                    var s=1;
                    $('#orderhistory')[0].reset();
                    $.each(data, function(key, value) {
                        $(".status").html('');
                        $("#load-table").append("<tr>" +
                            "<td>" + s++ + "</td>" +
                            "<td>" + value.oh_date_added + "</td>" +
                            "<td>" + value.oh_order_comment + "</td>" +
                            "<td>" + value.oh_order_status + "</td>");
                    })

                }
            }
        });
    });
</script>