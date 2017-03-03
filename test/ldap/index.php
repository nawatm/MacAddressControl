<?php
    session_start();

    if((!isset($_SESSION['user']) && (!isset($_SESSION["access"]))))
    {
        header("location:login.php");
    }
?>
<html>
<head><title>Test</title>     
</head>
<body>
    <h1>This My Index Page...</h1>
   
    <a href="logout.php">Logout</a>
</body>
</html>