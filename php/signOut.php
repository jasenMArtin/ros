<?php
session_start(); // Start the session

// Destroy the session and clear session variables
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
include '../popUps/logOutPop.php';

?>
