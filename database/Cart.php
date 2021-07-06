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
      $query = "INSERT INTO cart(user_id, item_id) VALUES(?, ?)";
      $stmt = $this->db->prepare($query);
      if ($stmt->execute([$_POST['user_id'], $_POST['item_id']])) {
        // reload page
        header("Location: $_SERVER[PHP_SELF]");
        exit();
      }
    }
  }

  public function getData($query)
  {
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function insertCartSession()
  {
    $cart = $_SESSION['cart'];
    if (!empty($cart) && isset($_SESSION['userId'])) {
      $query = "INSERT INTO cart(user_id, item_id, date) VALUES(?, + ?, now())";
      $stmt = $this->db->prepare($query);
      $cartIds = $this->getCartIds($this->getData("SELECT * FROM cart WHERE user_id=$_SESSION[userId]"));
      foreach ($cart as $itemId) {
        if (!in_array($itemId, $cartIds)) {
          $stmt->execute([$_SESSION['userId'], $itemId]);
        }
      }
      $_SESSION['cart'] = [];
      header("Location: $_SERVER[PHP_SELF]");
      exit();
    }
  }

  public function countItems($item = 'id', $table = 'cart')
  {
    $stmt = $this->db->prepare("SELECT COUNT($item) FROM $table WHERE user_id = $_SESSION[userId]");
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function deleteCart($table = 'cart')
  {
    $stmt = $this->db->prepare("DELETE FROM $table WHERE item_id=$_POST[itemId] AND user_id=$_SESSION[userId]");
    if ($stmt->execute()) {
      header("Location: $_SERVER[PHP_SELF]");
      exit();
    }
  }

  public function deleteCartFromSession()
  {
    foreach ($_SESSION['cart'] as $key => $item) {
      if ($item == $_POST['itemId']) {
        unset($_SESSION['cart'][$key]);
      }
    }
    header("Location: $_SERVER[PHP_SELF]");
    exit();
  }

  public function getTotal($price, $quantity)
  {
    $total = (float) $price * $quantity;
    return number_format($total, 2);
  }

  public function getSum($arr)
  {
    if (isset($arr)) {
      $sum = 0;
      foreach ($arr as $item) {
        $item = (float) filter_var($item, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $sum += $item;
      }
      return number_format($sum, 2);
    }
  }

  public function getCartIds($cartArray = [])
  {
    if ($cartArray != []) {
      $cartIds = array_map(function ($value) {
        return $value['item_id'];
      }, $cartArray);
      return $cartIds;
    }
    return [];
  }

  public function update()
  {
    $output = array('error' => false);
    $id = $_POST['itemId'];
    $qty = $_POST['qty'];

    session_start();
    if (isset($_SESSION['userId'])) {
      try {
        $stmt = $this->db->prepare("UPDATE cart SET quantity=:quantity WHERE item_id=:id");
        $stmt->execute(['quantity' => $qty, 'id' => $id]);
        $output['message'] = 'Updated';
      } catch (PDOException $e) {
        $output['message'] = $e->getMessage();
      }
    }

    echo json_encode($output);
  }
}
