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

  // Image upload
  $img = $_FILES['image'];
  $imageName = $img['name'];
  $imageSize = $img['size'];
  $imageTmp = $img['tmp_name'];
  $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
  $arr = explode('.', $imageName);
  $imageStart = strtolower(reset($arr));
  $imageExtension = strtolower(end($arr));

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
  } else if (!preg_match('/^\d{1,7}(?:[.]\d{0,3})?$/', $price)) {
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
  } else if (empty($imageName)) {
    $focus = "#aimage";
    $msg = 'An image is required';
  } else if (!in_array($imageExtension, $allowedExtensions)) {
    $focus = "#aimage";
    $msg = "This extension is not allowed";
  } else if ($imageSize > 4194304) {
    $focus = "#aimage";
    $msg = "Image can't be larger than 4mb";
  } else {
    $msg = '';
    $image = $imageStart . '_' . rand(0, 10000) . '.' . $imageExtension;
    move_uploaded_file($imageTmp, "../../uploads/itemImages/$image");

    $stmt = $pdo->prepare("INSERT INTO items(name, description, price, country_made, status, category_id, add_date, image) VALUES (?,?,?,?,?,?,now(),?)");
    $stmt->execute([$name, $description, $price, $country, $status, $category, $image]);

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

  $img = $_FILES['image'];
  $imageName = $img['name'];
  $imageSize = $img['size'];
  $imageTmp = $img['tmp_name'];
  $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];

  // $_POST['update'] has the file path
  $oldImage = $_POST['update'];
  if (!empty($imageName)) {
    $arr = explode('.', $imageName);
    $imageStart = strtolower(reset($arr));
    $imageExtension = strtolower(end($arr));
  }

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
  } else if (!preg_match('/^\d{1,7}(?:[.]\d{0,3})?$/', $price)) {
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
  } else if (isset($imageExtension) && !in_array($imageExtension, $allowedExtensions)) {
    $focus = "#image";
    $msg = "This extension is not allowed";
  } else if ($imageSize > 4194304) {
    $focus = "#image";
    $msg = "Image can't be larger than 4mb";
  } else {
    $msg = '';
    if (empty($imageName)) {
      $stmt = $pdo->prepare("UPDATE items SET name = ?, description = ?, price = ?, country_made = ?, status = ?, category_id = ? WHERE id = ?");
      $stmt->execute([$name, $description, $price, $country, $status, $category, $id]);
    } else {
      $file = "../$oldImage";
      $default = "../../uploads/itemImages/default.png";
      if (file_exists($file) && $file != $default) {
        unlink($file);
      }
      $image = $imageStart . '_' . rand(0, 10000) . '.' . $imageExtension;
      move_uploaded_file($imageTmp, "../../uploads/itemImages/$image");

      $stmt = $pdo->prepare("UPDATE items SET name = ?, description = ?, price = ?, country_made = ?, status = ?, category_id = ?, image = ? WHERE id = ?");
      $stmt->execute([$name, $description, $price, $country, $status, $category, $image, $id]);
    }

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
    // Delete image from directory
    $stmt = $pdo->prepare("SELECT image FROM items WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetchColumn();
    $file = "../../uploads/itemImages/$image";
    $default = "../../uploads/itemImages/default.png";
    if (file_exists($file) && $file != $default) {
      unlink($file);
    }

    // Delete record
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