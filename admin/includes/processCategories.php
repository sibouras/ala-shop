<?php
session_start();
include "../connect.php";
include "functions/functions.php";

if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
  header("Location: ../categories.php?error=unauthorized_user");
}

// Insert categories
if (isset($_POST['add'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $ordering = $_POST['ordering'];
  $visibility = $_POST['visibility'];
  $comments = $_POST['comments'];
  $ads = $_POST['ads'];

  // Check if category exists in db
  if (checkItem("name", "categories", $name)) {
    $_SESSION['message'] = "Name already exists";
    $_SESSION['msgType'] = "danger";
    header('Location: ../categories.php');
    exit();
  } else {
    $stmt = $pdo->prepare("INSERT INTO categories(name, description, ordering, visibility, allowComments, allowAds) VALUES (?,?,?,?,?,?)");
    $stmt->execute([$name, $description, $ordering, $visibility, $comments, $ads]);

    $_SESSION['message'] = "Successfully Inserted to the database";
    $_SESSION['msgType'] = "success";
    header('Location: ../categories.php');
    exit();
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

  // Check if category exists in db
  if ($name != $hiddenName && checkItem("name", "categories", $name)) {
    $_SESSION['message'] = "Name already exists";
    $_SESSION['msgType'] = "danger";
    header('Location: ../categories.php');
    exit();
  } else {
    $stmt = $pdo->prepare("UPDATE categories SET name = ?, description = ?, ordering = ?, visibility = ?, allowComments = ?, allowAds = ? WHERE id = ?");
    $stmt->execute([$name, $description, $ordering, $visibility, $comments, $ads, $id]);

    $_SESSION['message'] = "Category has been Updated successfully";
    $_SESSION['msgType'] = "warning";
    header('Location: ../categories.php');
    exit();
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
