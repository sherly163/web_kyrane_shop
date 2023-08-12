<?php
    $host = "83.136.216.132";
    $username ="u1576591_mpti";
    $password = "XVi{Impllv.n";
    $dbname = "u1576591_mpti";
    $conn = new mysqli($host,$username,$password,$dbname);

    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }
    
?>