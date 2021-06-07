<?php

class User
{
  public $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function register($post)
  {
    $username = $post['username'];
    $email = $post['email'];
    $password = $post['password'];
    $passwordCon = $post['password-con'];

    $formErrors = [
      'username' => '',
      'email' => '',
      'password' => '',
      'passwordCon' => '',
      'focus' => ''
    ];

    if (empty($passwordCon)) {
      $formErrors['passwordCon'] = "Confirm Password is required!";
      $formErrors['focus'] = 'password-con';
    } else if ($passwordCon !== $password) {
      $formErrors['passwordCon'] = "Passwords do not match!";
      $formErrors['focus'] = 'password-con';
    }
    if (empty($password)) {
      $formErrors['password'] = "A Password is required!";
      $formErrors['focus'] = 'password';
    } else if (strlen($password) < 4) {
      $formErrors['password'] = "Password can't be less than 4 characters!";
      $formErrors['focus'] = 'password';
    }
    if (empty($email)) {
      $formErrors['email'] = "An Email is required!";
      $formErrors['focus'] = 'email';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $formErrors['email'] = "Email must be a valid email address!";
      $formErrors['focus'] = 'email';
    }
    if (checkItem('userName', 'users', $username)) {
      $formErrors['username'] = 'Sorry this user already exists';
      $formErrors['focus'] = 'username';
    } else if (empty($username)) {
      $formErrors['username'] = 'A Username is required!';
    } else if (strlen($username) < 3) {
      $formErrors['username'] = "Username can't be less than 3 characters!";
      $formErrors['focus'] = 'username';
    }

    if (!array_filter($formErrors)) {
      $data = [
        'username' => $username,
        'email' => $email,
        'password' => $password
      ];

      $query = "INSERT INTO users(userName, email, password, date) VALUES (:username, :email, :password, now())";
      $stmt = $this->db->prepare($query);
      $stmt->execute($data);
      $formErrors['success'] = "<div class='alert alert-success text-center'>Data saved, You can login now!</div>";
    }

    // send data to javascript in json format
    echo json_encode($formErrors);
  }
}
