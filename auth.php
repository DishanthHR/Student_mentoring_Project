<?php
 
require "../config/database.php";
 
session_start(); 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{  
        $username = mysqli_real_escape_string($link, trim($_POST['username']));
        $password = mysqli_real_escape_string($link, trim($_POST['password']));

       
        if ($username == "admin" && $password == "admin") 
        {
            $_SESSION["admin"] = "admin";
            $_SESSION["adminname"] = "admin";
            $_SESSION["adminusername"] = "admin";
            echo "<script> location.replace('dashboard.php') </script>";
        } 
        else 
        {
            $_SESSION["fail"] = "yes";
            echo "<script> location.replace('index.php') </script>";
        } 
 
    mysqli_close($link);
}
else 
{
    echo "<script> location.replace('index.php') </script>";
}
