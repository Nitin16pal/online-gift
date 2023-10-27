<?php

include_once "../config.php";
include_once 'functions.php';
// error_reporting(0);
date_default_timezone_set('Asia/Calcutta');

$date = date("Y-m-d H:i:s"); // time in India


// Add project categories

if (isset($_POST["addcategory"]) == "active") {

    $catId = get_safe_value($link, $_POST["cat_id"]);

    $meta_title = get_safe_value($link, $_POST["meta_title"]);
    $meta_keywords = get_safe_value($link, $_POST["meta_keywords"]);
    $meta_desc = get_safe_value($link, $_POST["meta_desc"]);
    $category = get_safe_value($link, $_POST["category"]);
    $ctcontent = get_safe_value($link, $_POST["ctcontent"]);

    $slugURL = clean($category);

    if (empty($category)) {
        echo $errors = "Please Enter Category";
        echo "<script>$('#category').focus(); $('#category').addClass('focus-red is-invalid'); </script>";
    } else {
        // check if category already exists

        $checkquery = mysqli_query($link, "SELECT `cat_name` FROM `category` WHERE `cat_name`='$category'");
        $check = mysqli_num_rows($checkquery);
        if (isset($catId) &&  (!empty($catId))) {
            $query = mysqli_query($link, "UPDATE `category` SET cat_name = '$category', cat_url='$slugURL', cat_title='$meta_title', cat_key='$meta_keywords', cat_desc='$meta_desc' WHERE cat_id = '$catId'");
        } else {
            if ($check > 0) {
                echo $errors = "This Category Already Exist";
                echo "<script>$('#category').focus(); $('#category').addClass('focus-red is-invalid'); </script>";
            } else {
                $query = mysqli_query($link, "INSERT INTO `category`(`cat_name`,`cat_url`,`cat_title`,`cat_key`,`cat_desc`,`cat_created`) VALUES('$category','$slugURL','$meta_title','$meta_keywords','$meta_desc','$date')");
            }
        }
        if ($query) {
            echo "<script>window.location.href = 'category.php'</script>";
        } else {
            echo '<script> alert("Oops! Problem occured.");</script>';
        }
    }
}

// Add Sub Category 

if (isset($_POST["subcategory"]) == "active") {

    $catId = get_safe_value($link, $_POST["subcatid"]);

    $meta_title = get_safe_value($link, $_POST["meta_title"]);
    $meta_key = get_safe_value($link, $_POST["meta_key"]);
    $meta_desc = get_safe_value($link, $_POST["meta_desc"]);
    $sub_name = get_safe_value($link, $_POST["sub_name"]);
    $category_id = get_safe_value($link, $_POST["category_id"]);
    $slugURL = clean($sub_name);

    if (empty($category_id)) {
        echo $errors = "Please Enter Category";
        echo "<script>$('#category_id').focus(); $('#category_id').addClass('focus-red is-invalid'); </script>";
    } else if (empty($sub_name)) {
        echo $errors = "Please Enter Sub Category";
        echo "<script>$('#sub_name').focus(); $('#sub_name').addClass('focus-red is-invalid'); </script>";
    } else {
        // check if category already exists

        $checkquery = mysqli_query($link, "SELECT `sub_cat_name` FROM `sub_category` WHERE `sub_cat_name`='$sub_name'");
        $check = mysqli_num_rows($checkquery);
        if (isset($catId) &&  (!empty($catId))) {
            $query = mysqli_query($link, "UPDATE `sub_category` SET sub_cat = '$category_id', sub_cat_name = '$sub_name',sub_cat_url='$slugURL', sub_cat_title='$meta_title', sub_cat_keyword='$meta_key', sub_cat_desc='$meta_desc' WHERE cat_id = '$catId'");
        } else {

            if ($check > 0) {
                echo $errors = "This Category Already Exist";
                echo "<script>$('#category').focus(); $('#category').addClass('focus-red is-invalid'); </script>";
            } else {
                $query = mysqli_query($link, "INSERT INTO `sub_category`(`sub_cat`, `sub_cat_name`, `sub_cat_url`, `sub_cat_title`, `sub_cat_keyword`, `sub_cat_desc`, `sub_cat_created`) VALUES ('$category_id','$sub_name','$slugURL','$meta_title','$meta_key','$meta_desc','$date')") or die('Query could not be run');
            }
        }
        if ($query) {
            echo "<script>window.location.href = 'sub-category.php?cat_id=$category_id'</script>";
        } else {
            echo '<script> alert("Oops! Problem occured.");</script>';
        }
    }
}

// Add Sub Category 

if (isset($_POST["getsubcat"]) == "active") {

    $catId = get_safe_value($link, $_POST["category_id"]);

    if (!empty($catId)) {
        $query = mysqli_query($link, "SELECT * FROM `sub_category` WHERE `sub_cat`='$catId'") or die('Query could not be run');
        $checkrow = mysqli_num_rows($query);
        if ($checkrow > 0) {
            while($catrow = mysqli_fetch_assoc($query)) {
                $subname = $catrow["sub_cat_name"];
                $subid = $catrow["sub_cat_id"];
?>
                <option value="<?= $subid ?>"><?= $subname ?></option>
<?php
            }
        } else {
            echo "<option value=''>Result not found</option>";
        }
    } else {
        echo "<option value=''>Result not found</option>";
    }
}
