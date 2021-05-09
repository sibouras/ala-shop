<?php
session_start();
include "../connect.php";
include "functions/functions.php";

if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
  header("Location: ../items.php?error=unauthorized_user");
  exit();
}

// Insert items
if (isset($_POST['add'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $country = $_POST['country'];
  $status = $_POST['status'];
  $category = $_POST['category'];

  $msg = '';
  $focus = '';

  if (empty($name)) {
    $focus = "#aname";
    $msg = "Name can't be empty!";
  } else if (strlen($name) < 2) {
    $focus = "#aname";
    $msg = "Name can't be less than 2 characters!";
  } else if (empty($price)) {
    $focus = "#aprice";
    $msg = "Price can't be empty!";
  } else if (!preg_match('/[\$€]\s?(\d+[\.\s,\dk]+)|(\d+[\.\s,\dk]+)[\$€]/', $price)) {
    $focus = "#aprice";
    $msg = "Enter a valid price!";
  } else if (empty($country)) {
    $focus = "#acountry";
    $msg = "Country can't be empty!";
  } else if (!preg_match('/^[a-zA-Z]{2,}$/', $country)) {
    $focus = "#acountry";
    $msg = "Enter a valid country!";
  } else if (empty($status)) {
    $focus = "#astatus";
    $msg = "Choose status!";
  } else if (empty($category)) {
    $focus = "#acategory";
    $msg = "Choose category!";
  } else {
    $msg = '';
    $stmt = $pdo->prepare("INSERT INTO items(name, description, price, country_made, status, category_id, add_date) VALUES (?,?,?,?,?,?,now())");
    $stmt->execute([$name, $description, $price, $country, $status, $category]);

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

// Update items
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $country = $_POST['country'];
  $status = $_POST['status'];
  $category = $_POST['category'];

  $msg = '';
  $focus = '';

  if (empty($name)) {
    $focus = "#name";
    $msg = "Name can't be empty!";
  } else if (strlen($name) < 2) {
    $focus = "#name";
    $msg = "Name can't be less than 2 characters!";
  } else if (empty($price)) {
    $focus = "#price";
    $msg = "Price can't be empty!!";
  } else if (!preg_match('/[\$€]\s?(\d+[\.\s,\dk]+)|(\d+[\.\s,\dk]+)[\$€]/', $price)) {
    $focus = "#price";
    $msg = "Enter a valid price!";
  } else if (empty($country)) {
    $focus = "#country";
    $msg = "Country can't be empty!";
  } else if (!preg_match('/^[a-zA-Z]{2,}$/', $country)) {
    $focus = "#country";
    $msg = "Enter a valid country!";
  } else if (empty($status)) {
    $focus = "#status";
    $msg = "Choose status!";
  } else if (empty($category)) {
    $focus = "#category";
    $msg = "Choose category!";
  } else {
    $msg = '';
    $stmt = $pdo->prepare("UPDATE items SET name = ?, description = ?, price = ?, country_made = ?, status = ?, category_id = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $country, $status, $category, $id]);

    $_SESSION['message'] = "Item has been Updated successfully";
    $_SESSION['msgType'] = "warning";
  }
  if (!empty($msg)) {
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
    $msg
    <button type='button' class='btn-close' data-mdb-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
}

// Delete items
if (isset($_POST['delete'])) {
  $id = $_POST['deleteID'];

  // Check if id exists in database
  if (checkItem("id", "items", $id)) {
    $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
    $stmt->execute([$id]);

    $_SESSION['message'] = "Item has been deleted successfully";
    $_SESSION['msgType'] = "danger";
    header('Location: ../items.php');
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
    window.location.href = 'items.php';
  }
</script>