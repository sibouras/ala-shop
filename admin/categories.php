<?php
session_start();
if (isset($_SESSION['username'])) {
  // $noNavbar = 'no navbar in this page';
  $sidebar = "include sidebar in this page";
  $pageTitle = 'dashboard';
  include 'init.php';
?>

  <main style="margin-top: 58px">
    <div class="container pt-4">
      <h3>Categories Page</h3>
    </div>
  </main>

<?php
  include "$tpl/footer.php";
} else {
  header('Location: index.php?unauthorized_user');
  exit();
}
