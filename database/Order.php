<?php

class Order
{
  public $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function placeOrder()
  {
    $data = [
      'userId' => $_SESSION['userId'],
      'total' => $_POST['total'],
      'first' => $_POST['first'],
      'last' => $_POST['last'],
      'country' => $_POST['country'],
      'address' => $_POST['address'],
      'zip' => $_POST['zip'],
      'city' => $_POST['city'],
      'email' => $_POST['email'],
      'phone' => $_POST['phone']
    ];

    $query = "INSERT INTO orders(user_id, total, first_name, last_name, country, address, zip, city, email, phone) VALUES (:userId, :total, :first, :last, :country, :address, :zip, :city, :email, :phone)";
    $stmt = $this->db->prepare($query);
    $stmt->execute($data);
  }
}
