<?php

session_start();

if (isset($_SESSION['access_token']) || isset($_COOKIE['access_token'])) {
  // Redirect authenticated users to the homepage or dashboard
  header("Location: views/home.php");
  exit;
}
