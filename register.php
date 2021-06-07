<?php
include('includes/templates/header.php');

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   if (isset($_POST['register_submit'])) {
//     $user->signup($_POST);
//   }
// }
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text">
          <a href="#"><i class="fa fa-home"></i> Home</a>
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
        <div id="message"></div>
        <div class="register-form">
          <h2>Register</h2>
          <form id="register-form" method="POST">
            <div class="group-input">
              <label for="username">Username *</label>
              <input type="text" id="username" name="username" class="form-data">
            </div>
            <div class="group-input">
              <label for="email">Email *</label>
              <input type="email" id="email" name="email" class="form-data">
            </div>
            <div class="group-input">
              <label for="password">Password *</label>
              <input type="password" id="password" name="password" class="form-data">
            </div>
            <div class="group-input">
              <label for="con-password">Confirm Password *</label>
              <input type="password" id="con-password" name="con-password" class="form-data">
            </div>
            <button type="submit" id="submit" name="register_submit" class="site-btn register-btn form-data" onclick="saveData();">REGISTER</button>
          </form>
          <div class="switch-login">
            <a href="./login.php" class="or-login">Or Login</a>
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