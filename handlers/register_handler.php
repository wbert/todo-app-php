<?php

include '../database/database.php';
session_start();

try {
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    // Check if username already exists
    if (username_exists($username)) {
      $_SESSION['errors'] = "Username already taken!";
      header("Location: ../register.php");
      exit;
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
      $_SESSION['errors'] = "Password Mismatch!";
      header("Location: ../register.php");
      exit;
    }


    // Create an account if username does not exist
    if (create_account($username, $password)) {
      header("Location: ../index.php");
      exit;
    } else {
      $_SESSION['errors'] = "Account creation failed!";
      header("Location: ../register.php");
      exit;
    }
  }
} catch (\Exception $e) {
  echo "Error: " . $e->getMessage();
}

function username_exists($username)
{
  global $conn;

  $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
  if (!$stmt) {
    return false;
  }

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  return $stmt->num_rows > 0;
}

function create_account($username, $password)
{
  global $conn;

  $hashed_password = password_hash($password, PASSWORD_BCRYPT);

  $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
  if (!$stmt) {
    return false;
  }

  $stmt->bind_param("ss", $username, $hashed_password);
  return $stmt->execute();
}
