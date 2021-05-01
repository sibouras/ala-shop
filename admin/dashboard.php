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
      <!--Section: Minimal statistics cards-->
      <section>
        <div class="row">
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-success"><?php echo checkItem('regStatus', 'users', '0'); ?></h3>
                    <p class="mb-0">Pending Users</p>
                  </div>
                  <div class="align-self-center">
                    <a href="users.php?do=manage&page=pending">
                      <i class="far fa-user text-success fa-3x"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div class="align-self-center">
                    <i class="fas fa-shopping-cart text-info fa-3x"></i>
                  </div>
                  <div class="text-end">
                    <h3>278</h3>
                    <p class="mb-0">New Items</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div class="align-self-center">
                    <i class="far fa-comment-alt text-warning fa-3x"></i>
                  </div>
                  <div class="text-end">
                    <h3>156</h3>
                    <p class="mb-0">New Comments</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div class="align-self-center">
                    <i class="fas fa-map-marker-alt text-danger fa-3x"></i>
                  </div>
                  <div class="text-end">
                    <h3>423</h3>
                    <p class="mb-0">Total Visits</p>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </section>
      <!--Section: Minimal statistics cards-->

      <!--Section: Statistics with subtitles-->
      <section>
        <div class="row">
          <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fas fa-shopping-cart text-info fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Total Items</h4>
                      <p class="mb-0">Monthly Items</p>
                    </div>
                  </div>
                  <div class="align-self-center">
                    <h2 class="h1 mb-0">18,000</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Total Comments</h4>
                      <p class="mb-0">Monthly Comments</p>
                    </div>
                  </div>
                  <div class="align-self-center">
                    <h2 class="h1 mb-0">84,695</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <a href="users.php">
                        <i class="far fa-user text-success fa-3x me-4"></i>
                      </a>
                    </div>
                    <div>
                      <h4>Total Users</h4>
                      <p class="mb-0">Monthly Users</p>
                    </div>
                  </div>

                  <div class="align-self-center">
                    <h2 class="h1 mb-0"><?= countItems("userID", "users"); ?></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <h2 class="h1 mb-0 me-4">$36,000.00</h2>
                    </div>
                    <div>
                      <h4>Total Cost</h4>
                      <p class="mb-0">Monthly Cost</p>
                    </div>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-wallet text-success fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
              <div class="card-header">
                <i class="fa fa-users text-success me-1"></i>
                Latest Users
              </div>
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  A list item
                  <span class="badge bg-primary rounded-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  A second list item
                  <span class="badge bg-primary rounded-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  A third list item
                  <span class="badge bg-primary rounded-pill">1</span>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
              <div class="card-header">
                <i class="fas fa-shopping-cart fa-fw me-1 text-info"></i>
                Latest Items
              </div>
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  A list item
                  <span class="badge bg-primary rounded-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  A second list item
                  <span class="badge bg-primary rounded-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  A third list item
                  <span class="badge bg-primary rounded-pill">1</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <!--Section: Statistics with subtitles-->
    </div>
  </main>

<?php
  include "$tpl/footer.php";
} else {
  header('Location: index.php?unauthorized_user');
  exit();
}
