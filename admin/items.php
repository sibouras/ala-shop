<?php
session_start();
if (isset($_SESSION['username'])) {
  // $noNavbar = 'no navbar in this page';
  $sidebar = "include sidebar in this page";
  $pageTitle = 'Items';
  include 'init.php';

  $stmt = $pdo->prepare(
    "SELECT items.*,
      categories.name AS category_name
    FROM items
      INNER JOIN categories ON categories.id = items.category_id;
    "
  );
  $stmt->execute();
  $rows = $stmt->fetchAll();

  $categories_stmt = $pdo->prepare("SELECT id, name FROM categories");
  $categories_stmt->execute();
  $categories = $categories_stmt->fetchAll();
?>

  <!-- Add new item modal -->
  <div class="modal" tabindex="-1" id="addNewItemModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Item</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="add-item-form" action="includes/processItems.php" method="post" autocomplete="off">
          <div class="modal-body">
            <!-- Name input -->
            <div class="row mb-3">
              <label for="aname" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10 ps-4">
                <input type="text" name="name" class="form-control" id="aname" required>
              </div>
            </div>

            <!-- Description input -->
            <div class="row mb-3">
              <label for="adescription" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10 ps-4">
                <textarea type="text" name="description" class="form-control" id="adescription"></textarea>
              </div>
            </div>

            <!-- Price input -->
            <div class="row mb-3">
              <label for="aprice" class="col-sm-2 col-form-label">Price</label>
              <div class="col-sm-10 ps-4">
                <input type="text" name="price" class="form-control" id="aprice" required>
              </div>
            </div>

            <!-- Country input -->
            <div class="row mb-3">
              <label for="acountry" class="col-sm-2 col-form-label">Country</label>
              <div class="col-sm-10 ps-4">
                <input type="text" name="country" class="form-control" id="acountry" required>
              </div>
            </div>

            <!-- Status input -->
            <div class="row mb-3">
              <label for="astatus" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10 ps-4">
                <select name="status" class="form-select" id="astatus" required>
                  <option value="">Choose Status</option>
                  <option value="1">New</option>
                  <option value="2">Like New</option>
                  <option value="3">Used</option>
                  <option value="4">Old</option>
                </select>
              </div>
            </div>

            <!-- Category input -->
            <div class="row mb-3">
              <label for="acategory" class="col-sm-2 col-form-label">Category</label>
              <div class="col-sm-10 ps-4">
                <select name="category" class="form-select" id="acategory" required>
                  <option value="">Choose Category</option>
                  <?php
                  foreach ($categories as $category) {
                    echo "<option value='$category[id]'>$category[name]</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <!-- error message -->
          <div class="d-flex justify-content-center">
            <div id="amsg" class="col-md-11"></div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
              Close
            </button>
            <!-- Submit button -->
            <button type="submit" name="add" id="add" class="btn btn-primary">Add Item</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit new item modal -->
  <div class="modal" tabindex="-1" id="editItemModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit New Item</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="edit-item-form" action="includes/processItems.php" method="post" autocomplete="off">
          <div class="modal-body">
            <input type="hidden" id="id" name="id">
            <!-- Name input -->
            <div class="row mb-3">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10 ps-4">
                <input type="text" name="name" class="form-control" id="name" required>
              </div>
            </div>

            <!-- Description input -->
            <div class="row mb-3">
              <label for="description" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10 ps-4">
                <textarea type="text" name="description" class="form-control" id="description"></textarea>
              </div>
            </div>

            <!-- Price input -->
            <div class="row mb-3">
              <label for="price" class="col-sm-2 col-form-label">Price</label>
              <div class="col-sm-10 ps-4">
                <input type="text" name="price" class="form-control" id="price" required>
              </div>
            </div>

            <!-- Country input -->
            <div class="row mb-3">
              <label for="country" class="col-sm-2 col-form-label">Country</label>
              <div class="col-sm-10 ps-4">
                <input type="text" name="country" class="form-control" id="country" required>
              </div>
            </div>

            <!-- Status input -->
            <div class="row mb-3">
              <label for="status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10 ps-4">
                <div id="select-status">
                  <select name="status" class="form-select" id="status" required>
                    <option value="">Choose Status</option>
                    <option value="1">New</option>
                    <option value="2">Like New</option>
                    <option value="3">Used</option>
                    <option value="4">Old</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Category input -->
            <div class="row mb-3">
              <label for="category" class="col-sm-2 col-form-label">Category</label>
              <div class="col-sm-10 ps-4">
                <div id="select-category">
                  <select name="category" class="form-select" id="category" required>
                    <option value="">Choose Category</option>
                    <?php
                    foreach ($categories as $category) {
                      echo "<option value='$category[id]'>$category[name]</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- error message -->
          <div class="d-flex justify-content-center">
            <div id="msg" class="col-md-11"></div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
              Close
            </button>
            <!-- Submit button -->
            <button type="submit" name="update" id="update" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal" tabindex="-1" id="deleteItemModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content text-center">
        <div class="modal-header bg-danger text-white d-flex justify-content-center">
          <h5 class="modal-title">Are you sure?</h5>
        </div>
        <form action="includes/processItems.php" method="post">
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
              <strong>Manage Items</strong>
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
            <button type="button" class="btn btn-primary mb-4" data-mdb-toggle="modal" data-mdb-target="#addNewItemModal"><i class="fa fa-plus me-2"></i> Add new Item</button>
            <div class="table-responsive">
              <table id="datatableId" class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Country</th>
                    <th scope="col">Add Date</th>
                    <th scope="col" style="display: none;">Status</th>
                    <th scope="col" style="display: none;">Category ID</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($rows as $row) : ?>
                    <tr>
                      <th scope="row"><?= $row['id']; ?></th>
                      <td><?= $row['name']; ?></td>
                      <td><?php echo ($row['description']) ? $row['description'] : 'No description'; ?></td>
                      <td><?= $row['price']; ?></td>
                      <td><?= $row['country_made'] ?></td>
                      <td><?= $row['add_date']; ?></td>
                      <td style="display:none"><?= $row['status']; ?></td>
                      <td style="display: none;"><?= $row['category_id']; ?></td>
                      <td><?= $row['category_name']; ?></td>
                      <td>
                        <button type=" button" class="me-2 btn btn-sm px-2 editItemBtn">
                          <i class="far fa-edit"></i>
                        </button>
                        <button type="button" class="me-2 btn btn-danger btn-sm px-2 deleteItemBtn" data-mdb-toggle="modal" data-mdb-target="#deleteItemModal">
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
