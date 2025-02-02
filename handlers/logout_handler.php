<?php

session_start();

// Remove the token from the session
unset($_SESSION['access_token']);

// Clear the cookie (expire it)
setcookie("access_token", "", time() - 3600, "/"); // Expire the cookie by setting the time in the past

session_destroy();

header("Location: ../index.php");
exit;
