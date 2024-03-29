<?php
if (isset($_SESSION['userId'])) {
  $id =  $_SESSION['userId'];
  $stmt = $pdo->prepare("SELECT image FROM users WHERE userID = ?");
  $stmt->execute([$id]);
  $image = $stmt->fetchColumn();
  $file = "../uploads/profileImages/$image";
}
?>

<!-- Navbar -->
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Brand -->
    <a class="navbar-brand" href="../index.php">
      <img src="<?= $img ?>/ala-shop.png" width="84" alt="" loading="lazy" />
    </a>
    <!-- Search form -->
    <form class="d-none d-md-flex input-group w-auto my-auto">
      <input autocomplete="off" type="search" class="form-control rounded" placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
      <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
    </form>

    <!-- Right links -->
    <ul class="navbar-nav ms-auto d-flex flex-row">
      <!-- Notification dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-bell"></i>
          <span class="badge rounded-pill badge-notification bg-danger">1</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="#">Some news</a></li>
          <li><a class="dropdown-item" href="#">Another news</a></li>
          <li>
            <a class="dropdown-item" href="#">Something else here</a>
          </li>
        </ul>
      </li>

      <!-- Icon -->
      <li class="nav-item">
        <a class="nav-link me-3 me-lg-0" href="#">
          <i class="fas fa-fill-drip"></i>
        </a>
      </li>
      <!-- Icon -->
      <li class="nav-item me-3 me-lg-0">
        <a class="nav-link" href="https://github.com/sibouras/ala-shop" target="_blank">
          <i class="fab fa-github"></i>
        </a>
      </li>

      <!-- Icon dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <i class="united kingdom flag m-0"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li>
            <a class="dropdown-item" href="#"><i class="united kingdom flag"></i>English
              <i class="fa fa-check text-success ms-2"></i></a>
          </li>
          <li>
            <a class="dropdown-item" href="#"><i class="france flag"></i>Français</a>
          </li>
        </ul>
      </li>

      <!-- Avatar -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <img src="<?= $file; ?>" class="rounded-circle" height="22" alt="" loading="lazy" />
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="users.php?do=edit&userid=<?= $_SESSION['userId'] ?>">My profile</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->

<!--Main layout-->
<!-- <main style="margin-top: 58px">
  <div class="container pt-4">
  </div>
</main> -->