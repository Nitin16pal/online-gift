<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contact Us</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Contact Us" name="keywords">
    <meta content="Contact Us" name="description">

    <?php
    include_once("inc-css.php");
    ?>
</head>

<body>
    <?php
    include_once("inc-header.php");
    ?>
    <?php
    $message = '';
    $mclr = 'success';
    if ($this->session->flashdata('conquery')) {
        $message = $this->session->flashdata('conquery');
        $mclr = 'success';
    } else if ($this->session->flashdata('conerror')) {
        $message = $this->session->flashdata('conerror');
        $mclr = 'danger';
    }
    ?>

    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <?php if (!empty($message)) { ?>
                        <div class="alert alert-<?= $mclr ?> alert-dismissible fade show" role="alert">
                        <?= $message ?>
                        </div>
                    <?php } ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control <?= (form_error('con_name') != "") ? 'is-invalid' : ''; ?>" id="con_name" name="con_name" placeholder="Your Name" value="<?= set_value('con_name') ?>" />
                            <span class="text-danger"> <?= (form_error('con_name') != "") ? form_error('con_name') : ''; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control <?= (form_error('con_email') != "") ? 'is-invalid' : ''; ?>" id="con_email" name="con_email" placeholder="Your Email" value="<?= set_value('con_email') ?>" />
                            <span class="text-danger"> <?= (form_error('con_email') != "") ? form_error('con_email') : ''; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control <?= (form_error('con_subject') != "") ? 'is-invalid' : ''; ?>" id="con_subject" name="con_subject" placeholder="Subject" value="<?= set_value('con_subject') ?>" />
                            <span class="text-danger"> <?= (form_error('con_subject') != "") ? form_error('con_subject') : ''; ?></span>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control <?= (form_error('con_message') != "") ? 'is-invalid' : ''; ?>" rows="8" id="con_message" name="con_message" placeholder="Message" value="<?= set_value('con_message') ?>"></textarea>
                            <span class="text-danger"> <?= (form_error('con_subject') != "") ? form_error('con_subject') : ''; ?></span>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3507.673043959003!2d77.1835308755155!3d28.459270875759852!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1f1cf47314bb%3A0x630d67026d89dfe9!2sPrintviu!5e0!3m2!1sen!2sin!4v1687857977269!5m2!1sen!2sin" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>28-29, Fatehpur Beri, New Delhi, Delhi 110074</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@printviu.in</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>011-35686322</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <?php
    include_once("inc-footer.php");
    include_once("inc-script.php");
    ?>
</body>

</html>