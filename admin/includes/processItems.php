<?php
session_start();
include "../connect.php";
include "functions/functions.php";

if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
  header("Location: ../items.php?error=unauthorized_user");
}

// Insert items
if (isset($_POST['add'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $country = $_POST['country'];
  $status = $_POST['status'];
  $user = $_POST['user'];
  $category = $_POST['category'];

  $stmt = $pdo->prepare("INSERT INTO items(name, description, price, country_made, status, user_id, category_id, add_date) VALUES (?,?,?,?,?,?,?,now())");
  $stmt->execute([$name, $description, $price, $country, $status, $user, $category]);

  $_SESSION['message'] = "Successfully Inserted to the database";
  $_SESSION['msgType'] = "success";
  header('Location: ../items.php');
  exit();
}

// Update users
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $hiddenName = $_POST['hiddenName'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $country = $_POST['country'];
  $status = $_POST['status'];
  $user = $_POST['user'];
  $category = $_POST['category'];

  $stmt = $pdo->prepare("UPDATE items SET name = ?, description = ?, price = ?, country_made = ?, status = ?, user_id = ?, category_id = ? WHERE id = ?");
  $stmt->execute([$name, $description, $price, $country, $status, $user, $category, $id]);

  $_SESSION['message'] = "Item has been Updated successfully";
  $_SESSION['msgType'] = "warning";
  header('Location: ../items.php');
  exit();
}

// Delete categories
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
