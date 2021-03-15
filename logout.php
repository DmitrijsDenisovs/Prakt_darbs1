<?php
    session_start();
    session_destroy();
    setcookie("name", "", time() - 3600, "/");
    setcookie("email", "", time() - 3600, "/");
    header("Location: index.php"); 
?>
    