<?php 
session_start();
    if(isset($_SESSION['name']))
    {
    unset($_SESSION['name']);       
    }
    if(isset($_SESSION['response']))
    {
    unset($_SESSION['response']);       
    }
    if(isset($_SESSION['role']))
    {
    unset($_SESSION['role']);       
    }

    if (isset($_COOKIE['admin'])) {
        
        setcookie("admin", "", time()-3600);
    }

    header("Location:index.php");
    exit;
?>