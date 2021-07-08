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

  public function updateProfile()
  {
    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordCon = $_POST['password-con'];

    // Image upload
    if (isset($_FILES['image'])) {
      $img = $_FILES['image'];
      $imageName = $img['name'];
      $imageSize = $img['size'];
      $imageTmp = $img['tmp_name'];
      $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];

      if (!empty($imageName)) {
        $arr = explode('.', $imageName);
        $imageStart = strtolower(reset($arr));
        $imageExtension = strtolower(end($arr));
      }
    }


    $formErrors = [
      'username' => '',
      'email' => '',
      'password' => '',
      'passwordCon' => '',
      'image' => '',
      'focus' => ''
    ];

    if (empty($password)) {
      $password = $_POST['oldpassword'];
    } else if (strlen($password) < 3) {
      $formErrors['password'] = "Password can't be less than 3 characters!";
      $formErrors['focus'] = 'password';
    } else if ($passwordCon !== $password) {
      $formErrors['passwordCon'] = "Passwords do not match!";
      $formErrors['focus'] = 'password-con';
    } else {
      $password = hash('sha1', $_POST['password']);
    }
    if (isset($img)) {
      if (!in_array($imageExtension, $allowedExtensions)) {
        $formErrors['image'] = "This extension is not allowed";
        $formErrors['focus'] = 'image';
      } else if ($imageSize > 2097152) {
        $formErrors['image'] = "Image can't be larger than 2mb";
        $formErrors['focus'] = 'image';
      }
    }
    if (empty($email)) {
      $formErrors['email'] = "An Email is required!";
      $formErrors['focus'] = 'email';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $formErrors['email'] = "Email must be a valid email address!";
      $formErrors['focus'] = 'email';
    }
    $stmt = $this->db->prepare("SELECT userID FROM users WHERE userName = ? AND userID != ?");
    $stmt->execute([$username, $userid]);
    if ($stmt->rowCount()) {
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
        'userid' => $userid,
        'username' => $username,
        'fullname' => $fullname,
        'email' => $email,
        'password' => $password
      ];

      $imgQuery = "";
      if (isset($img)) {
        $oldImage = $_POST['oldImage'];
        $default = "uploads/profileImages/default.png";
        if (file_exists($oldImage) && $oldImage != $default) {
          unlink($oldImage);
        }
        $image = $imageStart . '_' . rand(0, 10000) . '.' . $imageExtension;
        $data['image'] = $image;
        move_uploaded_file($imageTmp, "uploads/profileImages/$image");

        $imgQuery = ", image = :image";
      }

      $query = "UPDATE users SET userName = :username, fullname = :fullname, email = :email, password = :password $imgQuery WHERE userID = :userid";
      $stmt = $this->db->prepare($query);
      $stmt->execute($data);
      $formErrors['success'] = "<div class='alert alert-success text-center'>Profile Updated Successfully!</div>";
    }
    echo json_encode($formErrors);
  }
}
