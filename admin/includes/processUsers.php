<?php

// include 'includes/functions/functions.php';
$formErrors = ['username' => '', 'fullname' => '', 'email' => '', 'password' => '', 'image' => ''];
$userid = '';
$username = '';
$fullname = '';
$email = '';
$password = '';
$hashedPass = '';
$image = '';

if (isset($_POST['save']) || isset($_POST['add']) || isset($_GET['delete']) || isset($_GET['activate'])) {
  include "../connect.php";
  include "functions/functions.php";
}

// Update users
if (isset($_POST['save'])) {
  // get variables from form
  $userid = $_POST['userid'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $fullname = $_POST['fullname'];

  // Password Trick
  $password = empty($_POST['newpassword']) ? $password = $_POST['oldpassword'] : $password = sha1($_POST['newpassword']);

  // Image upload
  $img = $_FILES['image'];
  $imageName = $img['name'];
  $imageSize = $img['size'];
  $imageTmp = $img['tmp_name'];
  $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];

  $oldImage = $_POST['oldimage'];
  if (!empty($imageName)) {
    $arr = explode('.', $imageName);
    $imageStart = strtolower(reset($arr));
    $imageExtension = strtolower(end($arr));
  }

  // Validate the form
  $stmt = $pdo->prepare("SELECT userID FROM users WHERE userName = ? AND userID != ?");
  $stmt->execute([$username, $userid]);
  if ($stmt->rowCount()) {
    $formErrors['username'] = 'Username already exists!';
  } else if (empty($username)) {
    $formErrors['username'] = 'A Username is required!';
  } else if (strlen($username) < 3) {
    $formErrors['username'] = "Username can't be less than 3 characters";
  }
  if (empty($fullname)) {
    $formErrors['fullname'] = "A Full Name is required";
  } else if (!preg_match('/^[a-zA-Z\s]{5,}$/', $fullname)) {
    $formErrors['fullname'] = "Full Name must be letters and spaces only and >= 5";
  }
  if (empty($email)) {
    $formErrors['email'] = "An Email is required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $formErrors['email'] = "Email must be a valid email address";
  } else if (isset($imageExtension) && !in_array($imageExtension, $allowedExtensions)) {
    $formErrors['image'] = "This extension is not allowed";
  } else if ($imageSize > 4194304) {
    $formErrors['image'] = "Image can't be larger than 4mb";
  }
  if (array_filter($formErrors)) {
    header("Location: ../users.php?do=edit&userid=$userid&errors=" . serialize($formErrors));
    exit();
  } else {
    if (empty($imageName)) {
      // update the database
      $stmt = $pdo->prepare("UPDATE users SET userName = ?, email = ?, fullName = ?, password = ? WHERE userID = ?");
      $stmt->execute([$username, $email, $fullname, $password, $userid]);
    } else {
      $file = "../../uploads/profileImages/$oldImage";
      $default = "../../uploads/profileImages/default.png";
      if (file_exists($file) && $file != $default) {
        unlink($file);
      }
      $image = $imageStart . '_' . rand(0, 10000) . '.' . $imageExtension;
      move_uploaded_file($imageTmp, "../../uploads/profileImages/$image");

      // update the database
      $stmt = $pdo->prepare("UPDATE users SET userName = ?, email = ?, fullName = ?, password = ?, image = ? WHERE userID = ?");
      $stmt->execute([$username, $email, $fullname, $password, $image, $userid]);
    }

    session_start();
    $_SESSION['message'] = "Record has been Updated successfully";
    $_SESSION['msgType'] = "warning";
    header('Location: ../users.php');
    exit();
  }
}

// Insert users
if (isset($_POST['add'])) {
  // get variables from form
  $username = $_POST['username'];
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hashedPass = sha1($password);

  // Image upload
  $img = $_FILES['image'];
  $imageName = $img['name'];
  $imageSize = $img['size'];
  $imageTmp = $img['tmp_name'];
  $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
  $arr = explode('.', $imageName);
  $imageStart = strtolower(reset($arr));
  $imageExtension = strtolower(end($arr));

  // Validate the form
  if (checkItem("userName", "users", $username) == 1) {
    $formErrors['username'] = 'Sorry this user already exists';
  } else if (empty($username)) {
    $formErrors['username'] = 'A Username is required';
  } else if (strlen($username) < 3) {
    $formErrors['username'] = "Username can't be less than 3 characters";
  }
  if (empty($fullname)) {
    $formErrors['fullname'] = "A Full Name is required";
  } else if (!preg_match('/^[a-zA-Z\s]{5,}$/', $fullname)) {
    $formErrors['fullname'] = "Full Name must be letters and spaces only and >= 5";
  }
  if (empty($email)) {
    $formErrors['email'] = "An Email is required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $formErrors['email'] = "Email must be a valid email address";
  }
  if (empty($password)) {
    $formErrors['password'] = "A Password is required";
  }
  if (empty($imageName)) {
    $formErrors['image'] = 'An image is required';
  } else if (!in_array($imageExtension, $allowedExtensions)) {
    $formErrors['image'] = "This extension is not allowed";
  } else if ($imageSize > 4194304) {
    $formErrors['image'] = "Image can't be larger than 4mb";
  }
  if (array_filter($formErrors)) {
    header("Location: ../users.php?do=add&errors=" . serialize($formErrors));
    exit();
  } else {
    $image = $imageStart . '_' . rand(0, 10000) . '.' . $imageExtension;
    move_uploaded_file($imageTmp, "../../uploads/profileImages/$image");

    // insert to database
    $stmt = $pdo->prepare("INSERT INTO users(userName, password, email, fullName, regStatus, date, image) VALUES (?,?,?,?,1,now(),?)");
    $stmt->execute([$username, $hashedPass, $email, $fullname, $image]);

    session_start();
    $_SESSION['message'] = "Successfully Inserted to the database";
    $_SESSION['msgType'] = "success";
    header('Location: ../users.php');
    exit();
  }
}

// Delete users
if (isset($_GET['delete'])) {
  $userid = $_GET['delete'];
  // Check if id exists in database

  if (checkItem("userID", "users", $userid)) {
    // Delete image from directory
    $stmt = $pdo->prepare("SELECT image FROM users WHERE userID = ?");
    $stmt->execute([$userid]);
    $image = $stmt->fetchColumn();
    $file = "../../uploads/profileImages/$image";
    $default = "../../uploads/profileImages/default.png";
    if (file_exists($file) && $file != $default) {
      unlink($file);
    }

    // Delete record
    $stmt = $pdo->prepare("DELETE FROM users WHERE userID = ?");
    $stmt->execute([$userid]);

    session_start();
    $_SESSION['message'] = "Record has been deleted successfully";
    $_SESSION['msgType'] = "danger";
    header('Location: ../users.php');
    exit();
  } else {
    echo "This id does not exist";
  }
}

// activate users
if (isset($_GET['activate'])) {
  $userid = $_GET['activate'];
  // Check if id exists in database

  if (checkItem("userID", "users", $userid)) {
    $stmt = $pdo->prepare("UPDATE users SET regStatus = 1 WHERE userID = ?");
    $stmt->execute([$userid]);

    session_start();
    $_SESSION['message'] = "User has been Activated successfully";
    $_SESSION['msgType'] = "info";
    header('Location: ../users.php');
    exit();
  } else {
    echo "This id does not exist";
  }
}
