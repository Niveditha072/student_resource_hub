<?php
session_start();
if (!isset($_SESSION['visited'])) {
    $_SESSION['visited'] = 1;
    echo "First visit!";
} else {
    $_SESSION['visited']++;
    echo "Visited " . $_SESSION['visited'] . " times.";
}
?>

