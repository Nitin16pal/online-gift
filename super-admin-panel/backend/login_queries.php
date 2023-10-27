<?php
include_once "../config.php";
include_once 'functions.php';
date_default_timezone_set('Asia/Calcutta');
$date = date("Y-m-d H:i:s"); // time in India
error_reporting(0);

if (isset($_POST['userlogin']) == 'starlogin') {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = md5(mysqli_real_escape_string($link, $_POST['password']));
    if (empty($username)) {
        echo 'Please Enter Username';
        echo "<script>$('#username').focus(); $('#username').addClass('focus-red');</script>";
    } else if (empty($password)) {
        echo 'Please Enter Password';
        echo "<script>$('#password').focus(); $('#password').addClass('focus-red');</script>";
    } else {
        $stmt = mysqli_query($link, "SELECT * FROM `admin_login` WHERE `userid`='$username' AND `password`='$password' AND `status`='1'  ");
        $rows = mysqli_fetch_array($stmt);
        $update = mysqli_query($link, "UPDATE `admin_login` SET last_login=NOW()");

        if ($stmt == true) {
            if ($update == true) {
                if (!empty($rows['userid']) and !empty($rows['password']) and !empty($rows['name'])) {
                    $_SESSION['userid'] = $rows['userid'];
                    $_SESSION['username'] = $rows['name'];
                    $_SESSION['useridno'] = $rows['id'];
                    echo "<script>window.location.href = 'dashboard.php';</script>";
                } else {
                    echo 'Invalid Username and Passwod';
                }
            } else {
                echo 'Not Updated';
            }
        } else {
            echo 'Error Creating Statement';
        }
    }
}
