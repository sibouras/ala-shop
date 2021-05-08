<?php
session_start();
include "../connect.php";
include "functions/functions.php";

if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
  header("Location: ../categories.php?error=unauthorized_user");
  exit();
}

// Insert categories
if (isset($_POST['add'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $ordering = $_POST['ordering'];
  $visibility = $_POST['visibility'];
  $comments = $_POST['comments'];
  $ads = $_POST['ads'];

  $msg = '';
  $focus = '';

  if (empty($name)) {
    $focus = '#aname';
    $msg = "Name can't be empty!";
  } else if (strlen($name) < 2) {
    $focus = '#aname';
    $msg = "Name can't be less than 2 characters";
  } else if (checkItem("name", "categories", $name)) {
    $focus = '#aname';
    $msg = "Name already exists";
  } else if (empty($ordering)) {
    $focus = "#aordering";
    $msg = "Ordering can't be empty";
  } else if (!preg_match('/^[1-9][0-9]{0,10}$/', $ordering)) {
    $focus = "#aordering";
    $msg = "Enter a valid number between 1 and 10 digits long";
  } else {
    $msg = '';
    $stmt = $pdo->prepare("INSERT INTO categories(name, description, ordering, visibility, allowComments, allowAds) VALUES (?,?,?,?,?,?)");
    $stmt->execute([$name, $description, $ordering, $visibility, $comments, $ads]);

    $_SESSION['message'] = "Successfully Inserted to the database";
    $_SESSION['msgType'] = "success";
  }

  if (!empty($msg)) {
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
    $msg
    <button type='button' class='btn-close' data-mdb-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
}

// Update categories
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $hiddenName = $_POST['hiddenName'];
  $description = $_POST['description'];
  $ordering = $_POST['ordering'];
  $visibility = $_POST['visibility'];
  $comments = $_POST['comments'];
  $ads = $_POST['ads'];

  $msg = '';
  $focus = '';

  if (empty($name)) {
    $focus = '#name';
    $msg = "Name can't be empty!";
  } else if (strlen($name) < 2) {
    $focus = '#name';
    $msg = "Name can't be less than 2 characters";
  } else if ($name != $hiddenName && checkItem("name", "categories", $name)) {
    $focus = '#name';
    $msg = "Name already exists";
  } else if (empty($ordering)) {
    $focus = "#ordering";
    $msg = "Ordering can't be empty";
  } else if (!preg_match('/^[1-9][0-9]{0,10}$/', $ordering)) {
    $focus = "#ordering";
    $msg = "Enter a valid number between 1 and 10 digits long";
  } else {
    $stmt = $pdo->prepare("UPDATE categories SET name = ?, description = ?, ordering = ?, visibility = ?, allowComments = ?, allowAds = ? WHERE id = ?");
    $stmt->execute([$name, $description, $ordering, $visibility, $comments, $ads, $id]);

    $_SESSION['message'] = "Category has been Updated successfully";
    $_SESSION['msgType'] = "warning";
  }
  if (!empty($msg)) {
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
    $msg
    <button type='button' class='btn-close' data-mdb-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
}

// Delete categories
if (isset($_POST['delete'])) {
  $id = $_POST['deleteID'];

  // Check if id exists in database
  if (checkItem("id", "categories", $id)) {
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->execute([$id]);

    $_SESSION['message'] = "Category has been deleted successfully";
    $_SESSION['msgType'] = "danger";
    header('Location: ../categories.php');
    exit();
  } else {
    echo "This id does not exist";
  }
}
?>

<script>
  var msg = "<?= $msg; ?>";
  var focus = "<?= $focus; ?>";
  if (focus != '') {
    $(focus).focus();
  }

  if (msg == '') {
    // $('#name, #email, #password').val("");
    // $('#exampleModal').modal('hide');
    // window.location.reload();
    window.location.href = 'categories.php';
  }
</script>