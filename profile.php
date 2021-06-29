<?php
session_start();
if (isset($_SESSION['userId'])) :
  include('includes/templates/header.php');
?>

  <!-- Breadcrumb Section Begin -->
  <div class="breacrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-text">
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
            <span>Profile</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb Form Section Begin -->

  <!-- Profile Section Begin -->
  <div id="profile-page" class="spad">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div id="message"></div>
        </div>
      </div>
      <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
          <div class="card h-100">
            <div class="card-body">
              <div class="account-settings">
                <div class="user-profile">
                  <div class="user-avatar">
                    <img id="oldImage" src="uploads/profileImages/<?= $userData['image']; ?>" alt="uploads/profileImages/<?= $userData['image']; ?>">
                  </div>
                  <h5 class="user-name"><?= $userData['userName']; ?></h5>
                  <h6 class="user-email"><?= $userData['email']; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
          <div class="card h-100">
            <form method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row gutters">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Personal Details</h6>
                  </div>
                  <!-- hidden id -->
                  <input type="hidden" name="userid" class="form-data" value="<?= $userData['userID']; ?>">

                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control form-data" name="username" id="username" placeholder="Enter Username" value="<?= $userData['userName']; ?>">
                      <div id="name-error" class="text-danger"></div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="fullName">Full Name</label>
                      <input type="text" class="form-control form-data" name="fullname" id="fullName" placeholder="Enter full name" value="<?= $userData['fullName']; ?>">
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control form-data" name="email" id="email" placeholder="Enter email ID" value="<?= $userData['email']; ?>">
                      <div id="email-error" class="text-danger"></div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" class="form-control" name="image" id="image">
                      <div id="image-error" class="text-danger"></div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <input type="hidden" name="oldpassword" class="form-data" value="<?= $userData['password']; ?>" />
                      <label for="password">New Password</label>
                      <input type="password" class="form-control form-data" name="password" id="password" placeholder="Leave empty if you don't want to change">
                      <div id="password-error" class="text-danger"></div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="password-con">Confirm Password</label>
                      <input type="password" class="form-control form-data" name="password-con" id="password-con" placeholder="Confirm New Password">
                      <div id="password-con-error" class="text-danger"></div>
                    </div>
                  </div>
                </div>
                <div class="row gutters">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">Address</h6>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="Street">Street</label>
                      <input type="name" class="form-control" id="Street" placeholder="Enter Street">
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="ciTy">City</label>
                      <input type="name" class="form-control" id="ciTy" placeholder="Enter City">
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="sTate">State</label>
                      <input type="text" class="form-control" id="sTate" placeholder="Enter State">
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <label for="zIp">Zip Code</label>
                      <input type="text" class="form-control" id="zIp" placeholder="Zip Code">
                    </div>
                  </div>
                </div>
                <div class="row gutters mt-3">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right">
                      <button type="submit" id="submit" name="profile_submit" class="btn btn-primary form-data" onclick="updateProfile();">Update</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Profile Section End -->

  <?php include('includes/templates/footer.php'); ?>
<?php else : header('Location: index.php'); ?>
<?php endif; ?>