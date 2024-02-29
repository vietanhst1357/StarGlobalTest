<?php

class Product {
  private $conn;

  public $id;
  public $group_id;
  public $product_name;

  public function __construct($db) {
    $this->conn = $db;
  }
  
  public function read() {
    $query = "Select * from products";

    $stmt = $this->conn->prepare($query);

    $stmt->execute();
    return $stmt;
  }

  public function show() {
    $query = "Select * from products where id = ? limit 1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
      return  false;
    }

    $this->group_id = $row['group_id'];
    $this->product_name = $row['product_name'];
  }

  public function create() {
    $query = "INSERT INTO products SET group_id=:group_id, product_name=:product_name";
    $stmt = $this->conn->prepare($query);

    $this->group_id = htmlspecialchars(strip_tags($this->group_id));
    $this->product_name = htmlspecialchars(strip_tags($this->product_name));

    $stmt->bindParam(":group_id", $this->group_id);
    $stmt->bindParam(":product_name", $this->product_name);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function update() {
    $query = "UPDATE products SET group_id=:group_id, product_name=:product_name where id=:id";
    $stmt = $this->conn->prepare($query);

    $this->group_id = htmlspecialchars(strip_tags($this->group_id));
    $this->product_name = htmlspecialchars(strip_tags($this->product_name));

    $stmt->bindParam(":group_id", $this->group_id);
    $stmt->bindParam(":product_name", $this->product_name);
    $stmt->bindParam(":id", $this->id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function delete() {
    $query = "DELETE FROM products where id=:id";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":id", $this->id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

}


?>