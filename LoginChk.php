<?php
    session_start();
    if((!isset($_SESSION['user']) && (!isset($_SESSION["access"]))))
    {
        header("location:login.php");
    }
?>