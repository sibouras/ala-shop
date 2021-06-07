<?php
include('includes/templates/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['login_submit'])) {
    pre_r($_POST);
  }
}
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
          <h2>Login</h2>
          <form method="POST">
            <div class="group-input">
              <label for="username">Username or email address *</label>
              <input type="text" id="username" name="username">
            </div>
            <div class="group-input">
              <label for="password">Password *</label>
              <input type="text" id="password" name="password">
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
            <button type="submit" name="login_submit" class="site-btn login-btn">Sign In</button>
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