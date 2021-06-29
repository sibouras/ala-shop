<?php

class Cart
{
  public $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function insertIntoCart()
  {
    if (empty($cart) && isset($_SESSION['userId'])) {
      $query = "INSERT INTO cart(user_id, item_id, date) VALUES(?, ?, now())";
      $stmt = $this->db->prepare($query);
      if ($stmt->execute([$_POST['user_id'], $_POST['item_id']])) {
        // reload page
        header("Location: $_SERVER[PHP_SELF]");
      }
    }
  }

  public function insertCartSession()
  {
    $cart = $_SESSION['cart'];
    if (!empty($cart) && isset($_SESSION['userId'])) {
      $query = "INSERT INTO cart(user_id, item_id, date) VALUES(?, + ?, now())";
      $stmt = $this->db->prepare($query);
      foreach ($cart as $item) {
        $stmt->execute([$_SESSION['userId'], $item]);
      }
      $_SESSION['cart'] = [];
      header("Location: $_SERVER[PHP_SELF]");
    }
  }
}
