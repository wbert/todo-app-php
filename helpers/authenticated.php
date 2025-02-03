<?php

session_start();

// Check if token exists in session or cookie
if (isset($_SESSION['access_token'])) {
  $token = $_SESSION['access_token'];
} elseif (isset($_COOKIE['access_token'])) {
  $token = $_COOKIE['access_token'];
} else {
  // Redirect to login page if no token exists
  header("Location: ../index.php");
  exit;
}
