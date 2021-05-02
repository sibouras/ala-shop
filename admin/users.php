<?php
session_start();
if (isset($_SESSION['username'])) {
  $sidebar = "include sidebar in this page";
  $pageTitle = 'Users';
  include 'init.php';

  $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
  if ($do == 'manage') {
    // Manage Users page
    $query = '';
    if (isset($_GET['page']) && $_GET['page'] == 'pending') {
      $query = 'AND regStatus = 0';
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE groupID != 1 $query");
    $stmt->execute();
    $rows = $stmt->fetchAll();
?>
    <!-- Manage Users page -->
    <!--Main layout-->
    <main style="margin-top: 58px">
      <div class="container pt-4">
        <!--Section: Sales Performance KPIs-->
        <section class="mb-4">
          <div class="card">
            <div class="card-header text-center py-3">
              <h4 class="mb-0 text-center">
                <strong>Manage Users</strong>
              </h4>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <?php if (isset($_SESSION['message'])) : ?>
                  <div class="alert alert-dismissible fade show alert-<?= $_SESSION['msgType'] ?>" role="alert" data-mdb-color="warning">
                    <strong><?= $_SESSION['message']; ?></strong>
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php endif;
                unset($_SESSION['message']); ?>
              </div>
            </div>
            <div class="card-body">
              <a href='users.php?do=add' class="btn btn-primary mb-4"><i class="fa fa-plus me-2"></i> Add New User</a>
              <div class="table-responsive">
                <table id="datatableId" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Username</th>
                      <th scope="col">Email</th>
                      <th scope="col">Full Name</th>
                      <th scope="col">Register Date</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($rows as $row) : ?>
                      <tr>
                        <th scope="row"><?= $row['userID']; ?></th>
                        <td><?= $row['userName']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['fullName']; ?></td>
                        <td><?= $row['date']; ?></td>
                        <td>
                          <a href="users.php?do=edit&userid=<?= $row['userID']; ?>" class="me-2 btn btn-sm px-2">
                            <i class="far fa-edit"></i>
                          </a>
                          <a href="includes/processUsers.php?delete=<?= $row['userID']; ?>" onclick="return confirm('Are you sure?')" class="me-2 btn btn-danger btn-sm px-2">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                          <?php if ($row['regStatus'] == 0) : ?>
                            <a href="includes/processUsers.php?activate=<?= $row['userID']; ?>" class="btn btn-info btn-sm px-2">
                              <i class="fas fa-check"></i>
                            </a>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
        <!--Section: Sales Performance KPIs-->

      </div>
    </main>

  <?php
  } else if ($do == 'edit' || $do == 'add') { ?>
    <!-- Edit page -->
    <?php

    include 'includes/processUsers.php';
    if (isset($_GET['errors'])) {
      $formErrors = unserialize($_GET['errors']);
    }

    if ($do == 'edit') {
      $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
      // Check if id exists in database
      $stmt = $pdo->prepare("SELECT * FROM users WHERE userID = ?");
      $stmt->execute([$userid]);
      $row = $stmt->fetch();
      $userid = $row['userID'];
      $username = $row['userName'];
      $fullname = $row['fullName'];
      $email = $row['email'];
      $password = $row['password'];
    }

    ?>
    <!--Main layout-->
    <main style="margin-top: 58px">
      <div class="container pt-4">
        <!--Section: Content-->
        <section class="mb-5">
          <div class="row d-flex justify-content-center mt-2">
            <div class="col-md-9 col-lg-8 col-xl-6">
              <div class="card px-3">
                <div class="card-body">
                  <?php if ($do == 'edit') : ?>
                    <h4 class="mb-5 text-center"><strong>Edit User</strong></h4>
                  <?php elseif ($do == 'add') : ?>
                    <h4 class="mb-5 text-center"><strong>Add New User</strong></h4>
                  <?php endif; ?>
                  <form action="includes/processUsers.php" method="post" autocomplete="off">
                    <!-- Hidden ID -->
                    <input type="hidden" name="userid" value="<?= $userid ?>">

                    <!-- Username input -->
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" name="username" value="<?= $username ?>" class="form-control" id="username" aria-describedby="emailHelp" required>
                      <div class="form-text text-danger"><?= $formErrors['username']; ?></div>
                    </div>

                    <!-- Fullname input -->
                    <div class="mb-3 ">
                      <label class="form-label" for="fullname">Full Name</label>
                      <input type="text" name="fullname" id="fullname" value="<?= $fullname ?>" class="form-control" required />
                      <div class="form-text text-danger"><?= $formErrors['fullname']; ?></div>
                    </div>

                    <!-- Email input -->
                    <div class="mb-3">
                      <label class="form-label" for="email">Email address</label>
                      <input type="email" name="email" id="email" value="<?= $email ?>" class="form-control" required />
                      <div class="form-text text-danger"><?= $formErrors['email']; ?></div>
                    </div>

                    <!-- Password input -->
                    <div class="mb-5">
                      <label class="form-label" for="password">Password</label>
                      <?php if ($do == 'edit') : ?>
                        <input type="hidden" name="oldpassword" value="<?= $password; ?>" />
                        <input type="password" name="newpassword" id="password" class="form-control" placeholder="Leave blank if you don't want to change" />
                      <?php elseif ($do == 'add') : ?>
                        <input type="password" name="password" id="password" class="form-control" required />
                        <div class="form-text text-danger"><?= $formErrors['password']; ?></div>
                      <?php endif; ?>
                    </div>

                    <!-- Submit button -->
                    <?php if ($do == 'edit') : ?>
                      <button type="submit" name="save" class="btn btn-primary btn-block mb-3">Save Profile Information</button>
                    <?php elseif ($do == 'add') : ?>
                      <button type="submit" name="add" class="btn btn-primary btn-block mb-3">Add User</button>
                    <?php endif; ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--Section: Content-->
      </div>
    </main>

<?php
  }
  include "$tpl/footer.php";
} else {
  header('Location: index.php?unauthorized_user');
  exit();
}
