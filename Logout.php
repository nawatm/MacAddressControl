<?php
    session_start();
    unset ( $_SESSION['user'] );
    unset ( $_SESSION['access'] );
    session_destroy();
    header("Location: Login.php");
    exit(0);
?>
<h2>Logout</h2>