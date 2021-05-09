<?php
session_start();
if (isset($_SESSION['username'])) {
  // $noNavbar = 'no navbar in this page';
  $sidebar = "include sidebar in this page";
  $pageTitle = 'Categories';
  include 'init.php';

  $stmt = $pdo->prepare("SELECT * FROM categories");
  $stmt->execute();
  $rows = $stmt->fetchAll();

?>
  <!-- Add new category modal -->
  <div class="modal" tabindex="-1" id="addNewCategoryModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Category</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="add-category-form" action="includes/processCategories.php" method="post" autocomplete="off">
          <div class="modal-body">
            <!-- Name input -->
            <div class="mb-3">
              <label for="aname" class="form-label">Name</label>
              <input type="text" name="name" class="form-control" id="aname" required>
            </div>

            <!-- Description input -->
            <div class="mb-3">
              <label class="form-label" for="adescription">Description</label>
              <textarea type="text" name="description" id="adescription" class="form-control" /></textarea>
            </div>

            <!-- Ordering input -->
            <div class="mb-3">
              <label class="form-label" for="aordering">Ordering</label>
              <input type="text" name="ordering" id="aordering" class="form-control" />
            </div>

            <!-- Visibility input -->
            <div class="mb-3">
              <label class="form-label label-width">Visible:</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input avisibility" type="radio" name="visibility" value="0" id="avis-yes" checked />
                <label class="form-check-label" for="avis-yes">Yes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input avisibility" type="radio" name="visibility" value="1" id="avis-no" />
                <label class="form-check-label" for="avis-no">No</label>
              </div>
            </div>

            <!-- Comments input -->
            <div class="mb-3">
              <label class="form-label label-width">Allow Comments:</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input acomments" type="radio" name="comments" value="0" id="acom-yes" checked />
                <label class="form-check-label" for="acom-yes">Yes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input acomments" type="radio" name="comments" value="1" id="acom-no" />
                <label class="form-check-label" for="acom-no">No</label>
              </div>
            </div>

            <!-- Ads input -->
            <div class="mb-3">
              <label class="form-label label-width">Allow Ads:</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input aads" type="radio" name="ads" value="0" id="aads-yes" checked />
                <label class="form-check-label" for="aads-yes">Yes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input aads" type="radio" name="ads" value="1" id="aads-no" />
                <label class="form-check-label" for="aads-no">No</label>
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
            <button type="submit" name="add" id="add" class="btn btn-primary">Add Category</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit category modal -->
  <div class="modal" tabindex="-1" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Category</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="edit-category-form" action="includes/processCategories.php" method="post" autocomplete="off">
          <div class="modal-body">
            <input type="hidden" id="id" name="id">
            <input type="hidden" name="hiddenName" id="hiddenName">
            <!-- Name input -->
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <!-- Description input -->
            <div class="mb-3">
              <label class="form-label" for="description">Description</label>
              <textarea type="text" name="description" id="description" class="form-control" /></textarea>
            </div>

            <!-- Ordering input -->
            <div class="mb-3">
              <label class="form-label" for="ordering">Ordering</label>
              <input type="text" name="ordering" id="ordering" class="form-control" />
            </div>

            <!-- Visibility input -->
            <div class="mb-3">
              <label class="form-label label-width">Visible:</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input visibility" type="radio" name="visibility" value="0" id="vis-yes" />
                <label class="form-check-label" for="vis-yes">Yes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input visibility" type="radio" name="visibility" value="1" id="vis-no" />
                <label class="form-check-label" for="vis-no">No</label>
              </div>
            </div>

            <!-- Comments input -->
            <div class="mb-3">
              <label class="form-label label-width">Allow Comments:</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input comments" type="radio" name="comments" value="0" id="com-yes" />
                <label class="form-check-label" for="com-yes">Yes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input comments" type="radio" name="comments" value="1" id="com-no" />
                <label class="form-check-label" for="com-no">No</label>
              </div>
            </div>

            <!-- Ads input -->
            <div class="mb-3">
              <label class="form-label label-width">Allow Ads:</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input ads" type="radio" name="ads" value="0" id="ads-yes" />
                <label class="form-check-label" for="ads-yes">Yes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input ads" type="radio" name="ads" value="1" id="ads-no" />
                <label class="form-check-label" for="ads-no">No</label>
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
  <div class="modal" tabindex="-1" id="deleteModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content text-center">
        <div class="modal-header bg-danger text-white d-flex justify-content-center">
          <h5 class="modal-title">Are you sure?</h5>
        </div>
        <form action="includes/processCategories.php" method="post">
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
      <section class="mb-3">
        <div class="card">
          <div class="card-header text-center py-3">
            <h4 class="mb-0 text-center">
              <strong>Manage Categories</strong>
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
            <button type="button" class="btn btn-primary mb-4" data-mdb-toggle="modal" data-mdb-target="#addNewCategoryModal"><i class="fa fa-plus me-2"></i> Add new Category</button>
            <div class="table-responsive">
              <table id="datatableId" class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th scope="col">Ordering</th>
                    <th scope="col" style="display: none;">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Options</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($rows as $row) : ?>
                    <tr>
                      <th scope="row"><?= $row['ordering']; ?></th>
                      <td style="display: none;"><?= $row['id']; ?></td>
                      <td><?= $row['name']; ?></td>
                      <td><?php echo ($row['description']) ? $row['description'] : 'No description'; ?></td>
                      <td>
                        <?php if ($row['visibility'] == '1') : ?>
                          <span class="badge rounded-pill bg-secondary">Hidden</span>
                        <?php endif; ?>
                        <?php if ($row['allowComments'] == '1') : ?>
                          <span class="badge rounded-pill bg-success">No Comments</span>
                        <?php endif; ?>
                        <?php if ($row['allowAds'] == '1') : ?>
                          <span class="badge rounded-pill bg-info">No Ads</span>
                        <?php endif; ?>
                        <?php if ($row['visibility'] == '0' && $row['allowComments'] == '0' && $row['allowAds'] == '0') : ?>
                          <span class="badge rounded-pill bg-dark">Everything is Allowed</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <button type="button" class="me-2 btn btn-sm px-2 editBtn">
                          <i class="far fa-edit"></i>
                        </button>
                        <button type="button" class="me-2 btn btn-danger btn-sm px-2 deleteBtn" data-mdb-toggle="modal" data-mdb-target="#deleteModal">
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
