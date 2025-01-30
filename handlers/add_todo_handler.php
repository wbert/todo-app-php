<?php

include "../database/database.php";

try {

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = 0;

    $stmt = $conn->prepare("INSERT INTO todo (title, description, status) VALUES (?, ?, ?)");

    $stmt->bind_param("ssi", $title, $description, $status);

    if ($stmt->execute()) {
      header("Location: ../index.php");
      exit;
    } else {
      echo "operation failed";
    }
  }
} catch (\Exception $e) {
  echo "Error: " . $e;
}
