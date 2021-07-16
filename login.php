<?php
$pageTitle = 'Login';
include('includes/templates/header.php');
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text">
          <a href="index.php"><i class="fa fa-home"></i> Home</a>
          <span>Login</span>
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
        <div class="login-form">
          <div id="message" class=""></div>
          <h2>Login</h2>
          <form id="login-form" method="POST">
            <div class="group-input">
              <label for="username">Username *</label>
              <input type="text" id="username" name="username" class="form-data">
              <div id="name-error" class="text-danger"></div>
            </div>
            <div class="group-input">
              <label for="password">Password *</label>
              <input type="password" id="password" name="password" class="form-data">
              <div id="password-error" class="text-danger"></div>
            </div>
            <div class="group-input gi-check">
              <div class="gi-more">
                <label for="save-pass">
                  Save Password
                  <input type="checkbox" id="save-pass">
                  <span class="checkmark"></span>
                </label>
                <a href="#" class="forget-pass">Forget your Password</a>
              </div>
            </div>
            <button type="submit" id="submit" name="login_submit" class="site-btn login-btn form-data" onclick="login();">Sign In</button>
          </form>
          <div class="switch-login">
            <a href="./register.php" class="or-login">Or Create An Account</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Register Form Section End -->

<?php
include('includes/templates/footer.php');
?>