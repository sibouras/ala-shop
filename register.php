<?php
$pageTitle = 'Register';
include('includes/templates/header.php');
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text">
          <a href="index.php"><i class="fa fa-home"></i> Home</a>
          <span>Register</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Form Section Begin -->

<!-- Register Section Begin -->
<div class="register-login-section spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="register-form">
          <h2>Register</h2>
          <form id="register-form" method="POST">
            <div class="group-input">
              <label for="username">Username *</label>
              <input type="text" id="username" name="username" class="form-data">
              <div id="name-error" class="text-danger"></div>
            </div>
            <div class="group-input">
              <label for="email">Email *</label>
              <input type="email" id="email" name="email" class="form-data">
              <div id="email-error" class="text-danger"></div>
            </div>
            <div class="group-input">
              <label for="password">Password *</label>
              <input type="password" id="password" name="password" class="form-data">
              <div id="password-error" class="text-danger"></div>
            </div>
            <div class="group-input">
              <label for="password-con">Confirm Password *</label>
              <input type="password" id="password-con" name="password-con" class="form-data">
              <div id="password-con-error" class="text-danger"></div>
            </div>
            <button type="submit" id="submit" name="register_submit" class="site-btn register-btn form-data" onclick="register();">REGISTER</button>
          </form>
          <div class="switch-login">
            <a id="switch-login" href="./login.php" class="or-login">Or Login</a>
          </div>
          <div id="message" class="pt-2"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Register Form Section End -->

<?php
include('includes/templates/footer.php');
?>