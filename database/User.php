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
    } else if (strlen($password) < 3) {
      $formErrors['password'] = "Password can't be less than 3 characters!";
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
      $formErrors['focus'] = 'username';
    } else if (strlen($username) < 3) {
      $formErrors['username'] = "Username can't be less than 3 characters!";
      $formErrors['focus'] = 'username';
    }

    if (!array_filter($formErrors)) {
      $data = [
        'username' => $username,
        'email' => $email,
        'password' => hash('sha1', $password)
      ];

      $query = "INSERT INTO users(userName, email, password, date) VALUES (:username, :email, :password, now())";
      $stmt = $this->db->prepare($query);
      $stmt->execute($data);
      $formErrors['success'] = "<div class='alert alert-success text-center'>Data saved, You can login now!</div>";
    }

    // send data to javascript in json format
    echo json_encode($formErrors);
  }

  public function login($post)
  {
    $username = $post['username'];
    $password = $post['password'];

    $formErrors = [
      'username' => '',
      'password' => '',
      'focus' => ''
    ];

    if (empty($password)) {
      $formErrors['password'] = "A Password is required!";
      $formErrors['focus'] = 'password';
    } else if (strlen($password) < 3) {
      $formErrors['password'] = "Password can't be less than 3 characters!";
      $formErrors['focus'] = 'password';
    }
    if (empty($username)) {
      $formErrors['username'] = 'A Username is required!';
      $formErrors['focus'] = 'username';
    } else if (strlen($username) < 3) {
      $formErrors['username'] = "Username can't be less than 3 characters!";
      $formErrors['focus'] = 'username';
    }

    if (!array_filter($formErrors)) {
      $data = [
        'username' => $username,
        'password' => hash('sha1', $password)
      ];
      $query = "SELECT * FROM users WHERE username = :username AND password = :password";
      $stmt = $this->db->prepare($query);
      $stmt->execute($data);
      if ($stmt->rowCount()) {
        $row = $stmt->fetch();
        $formErrors['success'] = "<div class='alert alert-success text-center'>Data saved, You can login now!</div>";

        session_start();
        $_SESSION['userId'] = $row['userID'];
        if ($row['groupID'] == 1) {
          $_SESSION['groupId'] = $row['groupID'];
        }
      } else {
        $formErrors['wrongCredentials'] = "<div class='alert alert-danger text-center'>Wrong Username or Password!</div>";
      }
    }

    // send data to javascript in json format
    echo json_encode($formErrors);
  }

  public function checkLogin()
  {
    if (isset($_SESSION['userId'])) {
      $query = "SELECT * FROM users WHERE userID = :id";
      $stmt = $this->db->prepare($query);
      $stmt->execute(['id' => $_SESSION['userId']]);
      if ($stmt->rowCount()) {
        return $stmt->fetch();
      }
    }
  }
}
