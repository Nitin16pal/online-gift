<?php

if (!$_SESSION['userid']) {
    header("location:login.php");
    echo "<script>window.location.href='login.php';</script>";
}

?>
 
<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">
                <a href="#"><img class="logo_icon img-responsive" src="assets/logofinal.png" alt="#" /></a>
            </div>
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">
                <div class="user_img"><img class="img-responsive" src="assets/logofinal.png" alt="#" /></div>
                <div class="user_info">
                    <h6>Welcome</h6>
                    <p><span class="online_animation"></span> Online</p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <h4>General</h4>
        <ul class="list-unstyled components">
            <li><a href="dashboard.php"><i class="fa fa-map purple_color2"></i> <span>Dashboard</span></a></li>
            <li>
                <a href="#query" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>Category</span></a>
                <ul class="collapse list-unstyled" id="query">
                    <li><a href="category.php"> <span>Manage Category</span></a></li>
                    <li><a href="sub-category.php"> <span>Manage Sub Category</span></a></li>
                </ul>
            </li>
            <li><a href="carts.php"><i class="fa fa-diamond purple_color"></i> <span>Manage Cart</span></a></li>
            <li><a href="products.php"><i class="fa fa-diamond purple_color"></i> <span>Manage Products</span></a></li>
            <li><a href="orders.php"><i class="fa fa-diamond purple_color"></i> <span>Manage Orders</span></a></li>
            <li><a href="coupon.php"><i class="fa fa-diamond purple_color"></i> <span>Manage Coupon</span></a></li>
            <li><a href="manage-user.php"><i class="fa fa-diamond purple_color"></i> <span>Manage User</span></a></li>
        </ul>
    </div>
</nav>
<!-- end sidebar -->
<!-- right content -->
<div id="content">
    <!-- topbar -->
    <div class="topbar">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="full">
                <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                <div class="right_topbar">
                    <div class="icon_info">
                        <ul>
                            <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                            <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                        </ul>
                        <ul class="user_profile_dd">
                            <li>
                                <a class="dropdown-toggle" data-toggle="dropdown"><span class="name_user">Welcome </span></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- end topbar -->