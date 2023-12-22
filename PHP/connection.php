<?php
    $hostname = 'localhost';
    $email = "root";
    $password = "";  
    $name = "signupforms";

    if(!$conn = mysqli_connect($hostname, $email, $password, $name))
    {
        die("Failed to connect, please try again later");
    }
?> 