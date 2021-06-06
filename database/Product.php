<?php

// Use to fetch product data
class Product
{
  public $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  // fetch product data using getData method
  public function getData($query)
  {
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  // fetch last 10 day's records
  function getNewData($query, $interval)
  {
    $stmt = $this->db->prepare("$query WHERE add_date >= DATE_SUB(CURDATE(), INTERVAL $interval DAY) LIMIT 10");
    $stmt->execute();
    return $stmt->fetchAll();
  }
}
