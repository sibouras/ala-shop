<?php
session_start();
if (isset($_SESSION['username'])) {
  header('Location: dashboard.php');
}

$noNavbar = 'no navbar in this page';
$pageTitle = 'login';

include 'init.php';

// session from main website
if (isset($_SESSION['groupId']) && $_SESSION['groupId'] == 1) {
  $stmt = $pdo->prepare("SELECT userID, username FROM users WHERE groupID = ?");
  $stmt->execute([$_SESSION['groupId']]);
  $row = $stmt->fetch();
  $_SESSION['userId'] = $row['userID'];
  $_SESSION['username'] = $row['username'];
  header('Location: dashboard.php');
  exit();
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashedPass = sha1($password);

  // Check if user exists in database
  $stmt = $pdo->prepare("SELECT userID ,username, password FROM users WHERE username = ? AND password = ? AND groupID = 1 LIMIT 1");
  $stmt->execute([$username, $hashedPass]);
  $count = $stmt->rowCount();
  if ($count > 0) {
    $row = $stmt->fetch();
    $_SESSION['username'] = $username;
    $_SESSION['userId'] = $row['userID'];
    header('Location: dashboard.php');
    exit();
  }
}
?>

<div class="container">
  <div class="row justify-content-center align-items-center" style="height:100vh; ">
    <div class="card shadow px-3" style="width: 22rem">
      <div class="card-body">
        <h5 class="card-title text-center">Admin Login</h5>
        <form class="row g-3" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
          <div class="col-12 mt-5">
            <!-- Name input -->
            <div class="form-outline ">
              <input type="text" name="username" id="username" class="form-control" />
              <label class="form-label" for="username">Username</label>
            </div>
          </div>
          <div class="col-12">
            <!-- Password input -->
            <div class="form-outline ">
              <input type="password" name="password" id="password" class="form-control" />
              <label class="form-label" for="password">Password</label>
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-primary mt-5">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
include "$tpl/footer.php";
?>