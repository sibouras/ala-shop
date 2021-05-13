<?php
session_start();
include "../connect.php";
include "functions/functions.php";

if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
  header("Location: ../reviews.php?error=unauthorized_user");
  exit();
}

// Delete reviews
if (isset($_POST['delete'])) {
  $id = $_POST['deleteID'];

  // Check if id exists in database
  if (checkItem("id", "reviews", $id)) {
    $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->execute([$id]);

    $_SESSION['message'] = "Review has been deleted successfully";
    $_SESSION['msgType'] = "danger";
    header('Location: ../reviews.php');
    exit();
  } else {
    echo "This id does not exist";
  }
}
