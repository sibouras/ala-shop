<?php

class Cart
{
  public $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function insertIntoCart($userId, $itemId)
  {
    $query = "INSERT INTO cart(user_id, item_id) VALUES(?, ?)";
    $stmt = $this->db->prepare($query);
    if ($stmt->execute([$userId, $itemId])) {
      // reload page
      header("Location: $_SERVER[PHP_SELF]");
    }
  }
}
