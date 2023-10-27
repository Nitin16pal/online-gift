<!-- Topbar Start -->
<div class="container-fluid top-header">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="top-nav d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="<?= base_url('about-us') ?>">About</a>
                <a class="text-body mr-3" href="<?= base_url('contact-us') ?>">Contact</a>
                <a class="text-body mr-3" href="<?= base_url('help') ?>">Help</a>
                <a class="text-body mr-3" href="<?= base_url('faqs') ?>">FAQs</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right d-flex flex-wrap header-search-container">
            <div class="header-search">
                <form action="<?= base_url('products-search') ?>" method="POST">
                    <div class="input-group">
                        <input type="text" name="product_name" class="form-control" placeholder="Search for products">
                        <button class="input-group-text" name="search">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="d-inline-flex align-items-center">
                <div class="btn-group h-100">
                    <?php
                    $username = $this->session->userdata('enduser');
                    $uremails = $this->session->userdata('uremails');
                    $ur_mobile = $this->session->userdata('ur_mobile');
                    $urids = $this->session->userdata('urids');
                    if (!empty($username)) { ?>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"><?= (!empty($username)) ? $username : '' ?></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item text-dark btn" href="<?= base_url('order-history') ?>">My Orders</a>
                            <a class="dropdown-item text-dark btn" href="<?= base_url('usrlogout') ?>">Logout</a>
                        </div>
                    <?php } else { ?>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">My Account</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="text-dark dropdown-item btn" data-toggle="modal" href="#loginmodal">Sign in</a>
                            <a class="text-dark dropdown-item btn" href="<?= base_url('signup') ?>">Sign up</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a class="btn px-0" href="<?= base_url('favourite') ?>">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge text-primary border border-primary rounded-circle headfavourite" style="padding-bottom: 2px;">0</span>
                </a>
                <a href="<?= base_url('cart') ?>" class="btn px-0 ml-3">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge text-primary border border-primary rounded-circle headcart" style="padding-bottom: 2px;">0</span>
                </a>
            </div>
        </div>
    </div>
    <!-- <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logofinal.png') ?>" width="180"></a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="search.php" method="get">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <button class="input-group-text bg-transparent text-primary" name="search">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Customer Service</p>
            <h5 class="m-0"><a href="tel: 011-35686322" style="text-decoration: none;">011-35686322</a></h5>
        </div>
    </div> -->
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid bg-white border-bottom mb-30">
    <div class="row px-xl-5">
        <div class="logo col-lg-3 pl-0 d-none d-lg-block">
            <a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logofinal.png') ?>" class="w-100"></a>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg navbar-dark py-3 py-lg-0 px-0">
                <a href="<?= base_url() ?>" class="text-decoration-none d-block d-lg-none">
                    <img src="<?= base_url('assets/images/logofinal.png') ?>" width="180">
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <?php
                        foreach ($cat_list as $clist) {
                            $cat_id = $clist['cat_id'];
                            $subcat = $this->db->query("SELECT * FROM `sub_category` WHERE `sub_cat`='$cat_id' AND `sub_cat_status`='1'")->result_array();
                            if (isset($subcat['0'])) {
                        ?>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?= $clist['cat_name']; ?> <i class="fa fa-angle-down mt-1"></i></a>
                                    <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                        <?php foreach ($subcat as $slist) { ?>
                                            <a href="<?= base_url('products/' . $clist['cat_url'] . '/' . $slist['sub_cat_url']); ?>" class="dropdown-item"><?= $slist['sub_cat_name']; ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <a href="<?= base_url('products/' . $clist['cat_url']); ?>" class="nav-item nav-link"><?= $clist['cat_name']; ?></a>

                        <?php }
                        } ?>

                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="<?= base_url('favourite') ?>" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge text-primary border border-primary rounded-circle headfavourite" style="padding-bottom: 2px;">0</span>
                        </a>
                        <a href="<?= base_url('cart') ?>" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge text-primary border border-primary rounded-circle headcart" style="padding-bottom: 2px;">0</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->