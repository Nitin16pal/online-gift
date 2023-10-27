<?php

include_once "../config.php";
include_once 'functions.php';
// error_reporting(0);
date_default_timezone_set('Asia/Calcutta');
$date = date("Y-m-d H:i:s"); // time in India

// Update Order History

if (isset($_POST["addorderhistory"]) == "active") {


    $orderid = get_safe_value($link, $_POST["orderid"]);
    $input_order_status = get_safe_value($link, $_POST["input_order_status"]);
    $input_order_msg = get_safe_value($link, $_POST["input_order_msg"]);

    if (empty($input_order_status)) {
        // echo $errors = "Please Select Order Status";
        echo json_encode(array('error'=>false,'errtype'=>'Please Select Order Status'));
    } else if (empty($orderid)) {
        // echo $errors = "You are worng order";
        echo json_encode(array('error'=>false,'errtype'=>'You are worng order'));
    } else {
        $query = mysqli_query($link, "INSERT INTO `order_history`(`oh_order_id`, `oh_order_status`, `oh_order_comment`, `oh_date_added`) VALUES ('$orderid','$input_order_status','$input_order_msg','$date')");
        $orderstatus=mysqli_query($link,"UPDATE `orders` SET `od_status`='$input_order_status' WHERE `od_id`='$orderid'");

        if ($query) {
            $hdata = mysqli_query($link, "SELECT * FROM `order_history` WHERE `oh_order_id` = '$orderid'");
            $output=mysqli_fetch_all($hdata,MYSQLI_ASSOC);
            echo json_encode($output);
        } else {
            echo json_encode(array('error'=>false,'errtype'=>"Somthing Went Wrong"));
        }
    }
}

// Add Coupan

if (isset($_POST["coupanadd"]) == "active") {


    $coupname = get_safe_value($link, $_POST["coupname"]);
    $coupcode = get_safe_value($link, $_POST["coupcode"]);
    $coupdisctype = get_safe_value($link, $_POST["coupdisctype"]);
    $coupdiscount = get_safe_value($link, $_POST["coupdiscount"]);
    $couptotalamt = get_safe_value($link, $_POST["couptotalamt"]);
    // $productsid = get_safe_value($link, $_POST["productsid"]);
    // $categoryselect = get_safe_value($link, $_POST["categoryselect"]);

    $coupstrtdate = get_safe_value($link, $_POST["coupstrtdate"]);
    $coupenddate = get_safe_value($link, $_POST["coupenddate"]);
    $coupmaxuses = get_safe_value($link, $_POST["coupmaxuses"]);
    

    if (empty($coupname)) {
        echo $errors = "Please Enter Coupan Name";
        echo "<script>$('#coupname').focus(); $('#coupname').addClass('focus-red is-invalid'); </script>";
    } else if (empty($coupcode)) {
        echo $errors = "Please Enter Coupan Code ";
        echo "<script>$('#coupcode').focus(); $('#coupcode').addClass('focus-red is-invalid'); </script>";
    } else if (empty($coupdisctype)) {
        echo $errors = "Please Select Discount Type ";
        echo "<script>$('#coupdisctype').focus(); $('#coupdisctype').addClass('focus-red is-invalid'); </script>";
    } else if (empty($coupdiscount)) {
        echo $errors = "Please Enter Discount";
        echo "<script>$('#coupdiscount').focus(); $('#coupdiscount').addClass('focus-red is-invalid'); </script>";
    } else if (empty($couptotalamt)) {
        echo $errors = "Please Enter Total Amount";
        echo "<script>$('#couptotalamt').focus(); $('#couptotalamt').addClass('focus-red is-invalid'); </script>";
    } else if (empty($_POST["productsid"])) {
        echo $errors = "Please Select Product Id ";
        echo "<script>$('#productsid').focus(); $('#productsid').addClass('focus-red is-invalid'); </script>";
    } else if (empty($_POST["categoryselect"])) {
        echo $errors = "Pleae Select Category";
        echo "<script>$('#categoryselect').focus(); $('#categoryselect').addClass('focus-red is-invalid'); </script>";
    } else if (empty($coupstrtdate)) {
        echo $errors = "Please Select Coupan Start Date";
        echo "<script>$('#coupstrtdate').focus(); $('#coupstrtdate').addClass('focus-red is-invalid'); </script>";
    } else if (empty($coupenddate)) {
        echo $errors = "Please Select Coupan End Date";
        echo "<script>$('#coupenddate').focus(); $('#coupenddate').addClass('focus-red is-invalid'); </script>";
    } else if (empty($coupmaxuses)) {
        echo $errors = "Please Enter Max User ";
        echo "<script>$('#coupmaxuses').focus(); $('#coupmaxuses').addClass('focus-red is-invalid'); </script>";
    } else {
    $productsid=implode(",",$_POST["productsid"]);
        $categoryselect=implode(",",$_POST["categoryselect"]);
        $query = mysqli_query($link, "INSERT INTO `coupon`(`cp_coupon_name`, `cp_coupon_code`, `cp_type`, `cp_discount`, `cp_total_amount`, `cp_product_id`, `cp_category_id`, `cp_start_date`, `cp_end_date`, `cp_max_uses`, `cp_created`) VALUES ('$coupname','$coupcode','$coupdisctype','$coupdiscount','$couptotalamt','$productsid','$categoryselect','$coupstrtdate','$coupenddate','$coupmaxuses','$date')");
        echo "test";

        if ($query) {
            echo "<script>window.location.href='coupon.php'; </script>";
        } else {
            echo "Something went wrong";
        }
    }
}