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
        exit();
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
      exit();
    }
  }

  // Count number of items 
  public function countItems($item = 'id', $table = 'cart')
  {
    $stmt = $this->db->prepare("SELECT COUNT($item) FROM $table WHERE user_id = $_SESSION[userId]");
    $stmt->execute();
    return $stmt->fetchColumn();
  }
}
