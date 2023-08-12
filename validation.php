<?php
    
    $namaErr = $nohpErr = $emailErr = $usernameErr = $passErr = "";
    $nama = $nohp = $email = $username = $pass = "";
    if(isset($_POST['daftar'])){
        if ( $_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["nama"])) {
            $namaErr = "Name is required";
            } else {
            $nama = test_input($_POST["nama"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$nama)) {
                $namaErr = "Only letters and white space allowed"; 
            }
            }
            
        }
    }


    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    
?>