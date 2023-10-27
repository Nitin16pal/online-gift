<?php

include_once "../config.php";
include_once 'functions.php';
// error_reporting(0);
date_default_timezone_set('Asia/Calcutta');

$date = date("Y-m-d H:i:s"); // time in India

// Add Products

if (isset($_POST["submitproduct"]) == "active") {

    $prod_id = get_safe_value($link, $_POST["prod_id"]);

    $prod_title = get_safe_value($link, $_POST["prod_title"]);
    $prod_key = get_safe_value($link, $_POST["prod_key"]);
    $prod_desc = get_safe_value($link, $_POST["prod_desc"]);
    $category_id = get_safe_value($link, $_POST["category_id"]);
    $sub_category = get_safe_value($link, $_POST["sub_category"]);

    $prod_name = get_safe_value($link, $_POST["prod_name"]);
    $prod_total_price = get_safe_value($link, $_POST["prod_total_price"]);
    $prod_discounted_price = get_safe_value($link, $_POST["prod_discounted_price"]);
    $prod_details = get_safe_value($link, $_POST["prod_details"]);
    $prod_size = get_safe_value($link, $_POST["prod_size"]);
    $prod_color = get_safe_value($link, $_POST["prod_color"]);
    $prod_code = generateRandomString();

    $slugURL = clean($prod_name);

    if (empty($category_id)) {
        echo $errors = "Please Select Category Id";
        echo "<script>$('#category_id').focus(); $('#category_id').addClass('focus-red is-invalid'); </script>";
    } else if (empty($prod_name)) {
        echo $errors = "Please Enter Product Name";
        echo "<script>$('#prod_name').focus(); $('#prod_name').addClass('focus-red is-invalid'); </script>";
    } else if (empty($prod_total_price)) {
        echo $errors = "Please Enter Product Actual Price";
        echo "<script>$('#prod_total_price').focus(); $('#prod_total_price').addClass('focus-red is-invalid'); </script>";
    } else if (empty($prod_discounted_price)) {
        echo $errors = "Please Enter Discounted Price";
        echo "<script>$('#prod_discounted_price').focus(); $('#prod_discounted_price').addClass('focus-red is-invalid'); </script>";
    } else if (empty($prod_details)) {
        echo $errors = "Please Enter Product Details";
        echo "<script>$('#prod_details').focus(); $('#prod_details').addClass('focus-red is-invalid'); </script>";
    } else if (empty($prod_color)) {
        echo $errors = "Please Enter Color";
        echo "<script>$('#prod_color').focus(); $('#prod_color').addClass('focus-red is-invalid'); </script>";
    } else {
        // check if category already exists

        $checkquery = mysqli_query($link, "SELECT `prod_name` FROM `products` WHERE `prod_name`='$prod_name' AND `prod_cat`='$category_id' AND `prod_sub_cat`='$sub_category'");
        $check = mysqli_num_rows($checkquery);

        if (isset($prod_id) &&  (!empty($prod_id))) {
            if ($check > 1) {
                echo $errors = "This Product  Already Exist";
                echo "<script>$('#prod_name').focus(); $('#prod_name').addClass('focus-red is-invalid'); </script>";
            } else {
                $query = mysqli_query($link, "UPDATE `products` SET `prod_title`='$prod_title',`prod_key`='$prod_key',`prod_desc`='$prod_desc',`prod_name`='$prod_name',`prod_code`='$prod_code',`prod_url`='$slugURL',`prod_total_price`='$prod_total_price',`prod_discounted_price`='$prod_discounted_price',`prod_details`='$prod_details',`prod_size`='$prod_size',`prod_color`='$prod_color',`prod_cat`='$category_id',`prod_sub_cat`='$sub_category' WHERE `prod_id` = '$prod_id'");
            }
        } else {
            if ($check > 0) {
                echo $errors = "This Product  Already Exist";
                echo "<script>$('#prod_name').focus(); $('#prod_name').addClass('focus-red is-invalid'); </script>";
            } else {
                $query = mysqli_query($link, "INSERT INTO `products`(`prod_title`, `prod_key`, `prod_desc`, `prod_name`, `prod_code`, `prod_url`, `prod_total_price`, `prod_discounted_price`, `prod_details`, `prod_size`, `prod_color`, `prod_cat`, `prod_sub_cat`,`prod_created`) VALUES('$prod_title','$prod_key','$prod_desc','$prod_name','$prod_code','$slugURL','$prod_total_price','$prod_discounted_price','$prod_details','$prod_size','$prod_color','$category_id','$sub_category','$date')");
            }
        }
        if ($query) {
            echo "<script>window.location.href = 'products.php'</script>";
        } else {
            echo '<script> alert("Oops! Problem occured.");</script>';
        }
    }
}

// Add Products Gallery

if (isset($_POST['prod_image']) == "active") {
    $prod_id =  mysqli_real_escape_string($link, $_POST['prod_id']);
    $prod_url =  mysqli_real_escape_string($link, $_POST['prod_url']);
    $file = $_FILES["gallery"]["name"];
    $sucess = '';
    $sql = '';
    foreach ($_FILES["gallery"]["tmp_name"] as $key => $tmp_name) {
        $titles =  mysqli_real_escape_string($link, $_POST['titles'][$key]);

        if (empty($file)) {
            echo $error = 'Please Select Image';
            echo "<script>$('#gallery').focus(); $('#gallery').addClass('focus-red');</script>";
        } else {

            $extension = array("jpeg", "jpg", "png", "gif", "webp");
            $file_name = $_FILES["gallery"]["name"][$key];
            $file_name = str_replace(" ", "_", $file_name);
            $file_tmp = $_FILES["gallery"]["tmp_name"][$key];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);

            if (in_array($ext, $extension)) {
                $filename = basename($file_name, $ext);
                $newFileName =  time() . $filename . $ext;
                $sucess = move_uploaded_file($file_tmp = $_FILES["gallery"]["tmp_name"][$key], "../../upload/products/" . $newFileName);
                if ($sucess) {
                    $sql = mysqli_query($link, "INSERT INTO `product_gallery`(`pg_prod`, `pg_name`, `pg_title`, `pg_created`) VALUES ('$prod_id','$newFileName','$titles','$date');");
                } else {
                    echo '<script> alert("Product Image Not uploded");</script>';
                }
            } else {
                echo "Invalid Extension";
            }
        }
    }
    if ($sucess) {
        echo "<script>window.location.href = 'product-image.php?prod_url=$prod_url'</script>";
    } else {
        echo '<script> alert("Sorry Oops Problem is occured");</script>';
    }
}

// Edit Product Image Gallery

if (isset($_POST['ed_prod_image']) == "active") {
    $pg_id =  mysqli_real_escape_string($link, $_POST['pg_id']);
    $prod_url =  mysqli_real_escape_string($link, $_POST['prod_url']);

    $sql = mysqli_query($link, "SELECT * FROM `product_gallery` WHERE `pg_id`='$pg_id'");
    $pgrow = mysqli_fetch_array($sql);
    if (!empty($pgrow['pg_name'])) {
        unlink('../../upload/products/' . $pgrow['pg_name']);
    }

    $sucess = '';
    $sql = '';
    $titles =  mysqli_real_escape_string($link, $_POST['titles']);
    if (empty($_FILES["gallery"]["name"])) {
        $sql = mysqli_query($link, "UPDATE `product_gallery` SET `pg_title`='$titles' WHERE `pg_id`='$pg_id'");
    } else {
        $extension = array("jpeg", "jpg", "png", "gif", "webp");
        $file_name = $_FILES["gallery"]["name"];
        $file_name = str_replace(" ", "_", $file_name);
        $file_tmp = $_FILES["gallery"]["tmp_name"];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        if (in_array($ext, $extension)) {
            $filename = basename($file_name, $ext);
            $newFileName =  time() . $filename . $ext;
            $sucess = move_uploaded_file($file_tmp, "../../upload/products/" . $newFileName);
            if ($sucess) {
                $sql = mysqli_query($link, "UPDATE `product_gallery` SET `pg_title`='$titles', `pg_name`='$newFileName' WHERE `pg_id`='$pg_id'");
            } else {
                echo '<script> alert("Product Image Not uploded");</script>';
            }
        } else {
            echo "Invalid Extension";
        }
    }
    if ($sucess) {
        echo "<script>window.location.href = 'product-image.php?prod_url=$prod_url'</script>";
    } else {
        echo '<script> alert("Sorry Oops Problem is occured");</script>';
    }
}
