<?php
session_start();
if (isset($_SESSION['username'])) {
  // $noNavbar = 'no navbar in this page';
  $sidebar = "include sidebar in this page";
  $pageTitle = 'Reviews';
  include 'init.php';

  $stmt = $pdo->prepare(
    "SELECT reviews.*,
      items.name AS item,
      users.username AS username
    FROM reviews
      INNER JOIN items ON items.id = reviews.item_id
      INNER JOIN users ON users.userID = reviews.user_id;
    "
  );
  $stmt->execute();
  $rows = $stmt->fetchAll();
?>

  <!-- Delete Modal -->
  <div class="modal" tabindex="-1" id="deleteReviewModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content text-center">
        <div class="modal-header bg-danger text-white d-flex justify-content-center">
          <h5 class="modal-title">Are you sure?</h5>
        </div>
        <form action="includes/processReviews.php" method="post">
          <input type="hidden" name="deleteID" id="deleteID">
          <div class="modal-body">
            <i class="fas fa-times fa-3x text-danger"></i>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-outline-danger" data-mdb-dismiss="modal">
              No
            </button>
            <button type="submit" name="delete" class="btn btn-danger">Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">
      <!--Section: Sales Performance KPIs-->
      <section class="mb-4">
        <div class="card">
          <div class="card-header text-center py-3">
            <h4 class="mb-0 text-center">
              <strong>Manage Reviews</strong>
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
            <div class="table-responsive">
              <table id="datatableId" class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Item</th>
                    <th scope="col">Username</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($rows as $row) : ?>
                    <tr>
                      <th scope="row"><?= $row['id']; ?></th>
                      <td><?= $row['rating']; ?></td>
                      <td><?php echo ($row['comment']) ? $row['comment'] : 'No Comment'; ?></td>
                      <td><?= $row['item']; ?></td>
                      <td><?= $row['username'] ?></td>
                      <td><?= $row['date']; ?></td>
                      <td>
                        <button type="button" class="me-2 btn btn-danger btn-sm px-2 deleteReviewBtn" data-mdb-toggle="modal" data-mdb-target="#deleteReviewModal">
                          <i class="fas fa-trash-alt"></i>
                        </button>
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
  include "$tpl/footer.php";
} else {
  header('Location: index.php?unauthorized_user');
  exit();
}
