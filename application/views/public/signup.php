<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Printviu</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="keywords" content="corporate gifts, business gifts, personalized gifts, unique gifts, branded gifts, customized gifts, premium gifts, thoughtful gifts, memorable gifts, client gifts, employee gifts, business partner gifts, branded accessories, curated gifts, gift baskets, promotional gifts, luxury gifts, executive gifts, customized merchandise, custom swag">

  <?php include_once 'inc-css.php'; ?>
</head>


<body style="background-color: #ececff;">
  <?php include_once 'inc-header.php'; ?>
  <!-- Signup Form -->
  <div class="container">
    <div class="card bg-light border-0 shadow rounded">
      <div class="row">
        <div class="col-lg-4 col-md-4 text-light rounded" style="background: #0258c1; background: linear-gradient(147deg, #0052ff 0%, #035d88 100%); padding: 10vh 5vh;">
          <h1 class="text-light">Looks like you are new here!</h1>
          <p style="font-size: 18pt;">Sign up to get started</p>
        </div>
        <div class="col-lg-8 col-md-8" style="padding: 10vh 6vh;">
          <form class="row" method="post">
            <div class="col-md-6 mb-3">
              <label for="validationDefault01" class="form-label">Your Full Name</label>
              <input name="username" type="text" class="form-control <?= (form_error('username') != "") ? 'is-invalid' : ''; ?>" value="<?= set_value('username') ?>" id="validationDefault01" style="width: 100%;">
              <span class="text-danger my-2"><?= (form_error('username') != "") ? form_error('username') : ''; ?></span>
            </div>
            <div class="col-md-6 mb-3">
              <label for="validationDefault02" class="form-label">Phone</label>
              <input name="usermobile" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" class="form-control <?= (form_error('usermobile') != "") ? 'is-invalid' : ''; ?>" value="<?= set_value('usermobile') ?>" id="validationDefault02" style="width: 100%;">
              <span class="text-danger my-2"><?= (form_error('usermobile') != "") ? form_error('usermobile') : ''; ?></span>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationDefault03" class="form-label">Email</label>
              <input name="useremail" type="email" class="form-control <?= (form_error('useremail') != "") ? 'is-invalid' : ''; ?>" value="<?= set_value('useremail') ?>" id="validationDefault03" style="width: 100%;">
              <span class="text-danger my-2"><?= (form_error('useremail') != "") ? form_error('useremail') : ''; ?></span>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationDefault03" class="form-label">Address</label>
              <input name="userstreet1" type="text" class="form-control <?= (form_error('userstreet1') != "") ? 'is-invalid' : ''; ?>" value="<?= set_value('userstreet1') ?>" id="validationDefault03" style="width: 100%;">
              <span class="text-danger my-2"><?= (form_error('userstreet1') != "") ? form_error('userstreet1') : ''; ?></span>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationDefault03" class="form-label">Password</label>
              <input name="userpass" type="password" class="form-control <?= (form_error('userpass') != "") ? 'is-invalid' : ''; ?>" value="<?= set_value('userpass') ?>" id="validationDefault04" style="width: 100%;">
              <span class="text-danger my-2"><?= (form_error('userpass') != "") ? form_error('userpass') : ''; ?></span>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationDefault03" class="form-label">Confirm Password</label>
              <input name="confirm_password" type="password" class="form-control <?= (form_error('confirm_password') != "") ? 'is-invalid' : ''; ?>" value="<?= set_value('confirm_password') ?>" id="validationDefault04" style="width: 100%;">
              <span class="text-danger my-2"><?= (form_error('confirm_password') != "") ? form_error('confirm_password') : ''; ?></span>
            </div>
            <div class="col-12">
              <button class="btn bg-primary w-100" id="butn" name="butn" type="submit">Sign Up</button>
            </div>
          </form>
          <div class="row mt-3">
            <div class="col-12">
              <a href="#loginmodal" data-toggle="modal" class="btn btn-secondary w-100">Existing User? Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once 'inc-footer.php'; ?>
  <?php include_once 'inc-script.php'; ?>

</body>

</html>