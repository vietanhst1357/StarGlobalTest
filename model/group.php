<?php

class Group {
  private $conn;

  public $id;
  public $group_name;
  public $title;
  public $content;

  public function __construct($db) {
    $this->conn = $db;
  }
  
  public function read() {
    $query = "Select * from groups";

    $stmt = $this->conn->prepare($query);

    $stmt->execute();
    return $stmt;
  }

  public function show() {
    $query = "Select * from groups where id = ? limit 1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
      return  false;
    }

    $this->group_name = $row['group_name'];
    $this->title = $row['title'];
    $this->content = $row['content'];
  }

  public function create() {
    $query = "INSERT INTO groups SET group_name=:group_name, title=:title, content=:content";
    $stmt = $this->conn->prepare($query);

    $this->group_name = htmlspecialchars(strip_tags($this->group_name));
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->content = htmlspecialchars(strip_tags($this->content));

    $stmt->bindParam(":group_name", $this->group_name);
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":content", $this->content);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function update() {
    $query = "UPDATE groups SET group_name=:group_name, title=:title, content=:content where id=:id";
    $stmt = $this->conn->prepare($query);

    $this->group_name = htmlspecialchars(strip_tags($this->group_name));
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->content = htmlspecialchars(strip_tags($this->content));

    $stmt->bindParam(":group_name", $this->group_name);
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":content", $this->content);
    $stmt->bindParam(":id", $this->id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function delete() {
    $query = "DELETE FROM groups where id=:id";
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