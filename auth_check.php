<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] !== true) {
    // Redirect to login page
    header("Location: login.html");
    exit();
}
?>