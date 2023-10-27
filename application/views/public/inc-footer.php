    <!-- Footer Start -->
    <div class="container-fluid bg-black text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-5 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">Discover our premium selection of corporate gifts designed to strengthen relationships and elevate your brand image. Personalized and unique items perfect for showing appreciation to clients, employees, and business partners.</p>
                <p class="mb-2"><i class="fas fa-map-marker-alt text-primary mr-3"></i>28-29, Fatehpur Beri, New Delhi, Delhi 110074</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@printviu.in</p>
                <p class="mb-0"><i class="fas fa-phone-alt text-primary mr-3"></i>011-35686322</p>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="<?= base_url() ?>"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <?php
                            foreach ($cat_list as $clist) { ?>
                                <a class="text-secondary mb-2" href="<?= base_url('products/' . $clist['cat_url']); ?>"><i class="fa fa-angle-right mr-2"></i><?= $clist['cat_name']; ?></a>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Explore</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="<?= base_url() ?>"><i class="fa fa-angle-right mr-2"></i>About Our Company</a>
                            <a class="text-secondary mb-2" href="<?= base_url('contact-us') ?>"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                            <a class="text-secondary mb-2" href="<?= base_url('shipping-and-delivery') ?>"><i class="fa fa-angle-right mr-2"></i>Shipping & delivery</a>
                            <a class="text-secondary mb-2" href="<?= base_url('refund-and-cancellation') ?>"><i class="fa fa-angle-right mr-2"></i>Refund & Cancellation</a>
                            <a class="text-secondary mb-2" href="<?= base_url('privacy-and-policy') ?>"><i class="fa fa-angle-right mr-2"></i>Privacy Policy</a>
                            <a class="text-secondary mb-2" href="<?= base_url('terms-and-condition') ?>"><i class="fa fa-angle-right mr-2"></i>Terms & Condition</a>
                        </div>
                    </div>

                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Subscribe to get latest deals and discount updates</p>
                        <form method="post" id="subscribesform">
                            <span class="text-warning sbstatus py-3"></span>
                            <div class="input-group">
                                <input type="text" class="form-control mb-2" name="subsemail" id="subsemail" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <input type="hidden" name="btntype" value="subscribe">
                                    <button type="submit" class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a target="_blank" class="btn btn-primary btn-square mr-2" href="https://wa.link/1c6yze"><i class="fab fa-whatsapp"></i></a>
                            <a target="_blank" class="btn btn-primary btn-square mr-2" href="https://www.facebook.com/print.viu.3"><i class="fab fa-facebook-f"></i></a>
                            <a target="_blank" class="btn btn-primary btn-square mr-2" href="https://pin.it/1lgukPj"><i class="fab fa-pinterest"></i></a>
                            <a target="_blank" class="btn btn-primary btn-square" href="https://www.instagram.com/printviu_corporategifts/"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="<?= base_url() ?>">Printviu</a>. All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="<?= base_url('assets/images/payments.png') ?>" alt="Printviu">
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Modal -->
    <div class="modal fade" id="loginmodal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content rounded">
                <div class="modal-body">
                    <button type="button" class="close loginclose" data-dismiss="modal">&times;</button>
                    <div class="login-wrap">
                        <h3 class="mb-4">Sign In</h3>
                        <div class="alert alert-danger print-error-msg" style="display:none"></div>
                        <form method="post" class="login-form" id="userform" autocomplete="off">
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center text-white"><span class="fa fa-user"></span></div>
                                <input type="text" class="form-control rounded-left" name="useremail" id="useremail" placeholder="Enter Email" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center text-white"><span class="fa fa-lock"></span></div>
                                <input type="password" class="form-control rounded-left" id="userpassword" name="userpassword" placeholder="Password" autocomplete="off">
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <!-- <div class="w-100">
                                    <label class="checkbox-wrap checkbox-primary mb-0">Save Password
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                                <div class="w-100 d-flex justify-content-center">
                                    <input type="hidden" name="btntype" value="login">
                                    <button type="submit" class="btn btn-primary submit">Login</button>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <div class="w-100 text-center">
                                    <p class="mb-1">Don't have an account? <a href="#">Sign Up</a></p>
                                    <p><a href="#forgetmodal" data-toggle="modal" class="forpass">Forgot Password</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Forget Password  Modal -->

    <div class="modal fade" id="forgetmodal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content rounded">
                <div class="modal-body">
                    <button type="button" class="close loginclose" data-dismiss="modal">&times;</button>
                    <div class="login-wrap">
                        <h3 class="mb-4">Forget Password</h3>
                        <span class="text-danger fgstatus py-3"></span>
                        <form method="post" class="login-form" id="forgetform">
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center text-white"><span class="fa fa-user"></span></div>
                                <input type="text" class="form-control rounded-left" name="fgemail" id="fgemail" placeholder="Register Email" autocomplete="off">
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <div class="w-100 d-flex justify-content-center">
                                    <input type="hidden" name="btntype" value="forgetpass">
                                    <button type="submit" class="btn btn-primary submit">Submit</button>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <div class="w-100 text-center">
                                    <p class="mb-1"> <a href="<?= base_url('signup') ?>">Sign Up</a></p>
                                    <p><a href="#loginmodal" data-toggle="modal" class="backlogin">Back to login</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>