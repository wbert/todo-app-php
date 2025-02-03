<?php

include '../database/database.php';
session_start();

try {
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = verify_user($username, $password);

    if ($user) {

      // Generate a unique token
      $token = bin2hex(random_bytes(32));

      // Store the token in the session
      $_SESSION['access_token'] = $token;

      // Optionally store token in a cookie
      // setcookie("access_token", $token, time() + (86400 * 7), "/", "", false, true); // Expires in 7 days

      header("Location: ../views/home.php");
      exit;
    } else {
      $_SESSION['errors'] = "Invalid username or password!";
      header("Location: ../index.php");
      exit;
    }
  }
} catch (\Exception $e) {
  echo "Error: " . $e->getMessage();
}

// Function to verify user credentials
function verify_user($username, $password)
{
  global $conn;

  $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
      return $row; // Return user info
    }
  }
  return false;
}
