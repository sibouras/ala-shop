<?php

class User
{
  public $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function signup($post)
  {
    $data = [
      'username' => $post['username'],
      'email' => $post['email'],
      'password' => $post['password']
    ];
    $conPassword = $post['con-password'];

    $query = "INSERT INTO users(userName, email, password, date) VALUES (:username, :email, :password, now())";
    $stmt = $this->db->prepare($query);
    $stmt->execute($data);
    echo "<div class='alert alert-success text-center'>Data Saved</div>";
  }
}
