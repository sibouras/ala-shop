<?php

// include 'includes/functions/functions.php';
$formErrors = ['username' => '', 'fullname' => '', 'email' => '', 'password' => ''];
$userid = '';
$username = '';
$fullname = '';
$email = '';
$password = '';
$hashedPass = '';

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

  // Validate the form
  if (empty($username)) {
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
  if (array_filter($formErrors)) {
    header("Location: ../users.php?do=edit&userid=$userid&errors=" . serialize($formErrors));
    exit();
  } else {
    // update the database
    $stmt = $pdo->prepare("UPDATE users SET userName = ?, email = ?, fullName = ?, password = ? WHERE userID = ?");
    $stmt->execute([$username, $email, $fullname, $password, $userid]);

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
  if (array_filter($formErrors)) {
    header("Location: ../users.php?do=add&errors=" . serialize($formErrors));
    exit();
  } else {
    // insert to database
    $stmt = $pdo->prepare("INSERT INTO users(userName, password, email, fullName, regStatus, date) VALUES (?,?,?,?,1,now())");
    $stmt->execute([$username, $hashedPass, $email, $fullname]);

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
