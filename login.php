<?php 
 require 'connection.php';
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      .error {color: #FF0000;}
    </style>
    <script src="https://kit.fontawesome.com/445f94dbc0.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    <title>Login</title>
</head>

<body style="width: 100%; height:800px;">
    <?php
    
// define variables and set to empty values
$usernameErr = $passwordErr = $userpassErr  = "";
$username = $password  = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {
    $username = test_input($_POST["username"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-z0-9 ]*$/",$username)) {
      $usernameErr = "don't use spaces and kapital caracter";
    }
  }
  
  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["password"]);
    // check if e-mail address is well-formed
    
  }
   }
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //cek data di data base
    $cekdatabase = mysqli_query($conn,"SELECT * FROM customer WHERE username ='$username' and password = '$password' ");
    //cek jumlah data yang sama
    $hitung = mysqli_num_rows ($cekdatabase);
   
    if ($hitung >0) {
        session_start();
        $_SESSION['log'] = 'True';
        $_SESSION['lvl'] = 'User';
        $_SESSION['user'] = $username;
    
        header('location:indexus.php');
        } else{
          $userpassErr="*Username Or Password Wrong!!" ;
        };
};

    if(!isset($_SESSION['log'])){
        
    }else{
        header('location:indexus.php');
    };
?>

    <div class="pagelogin">
    <img src="img/logoo.jpg" class="logoinlogin">
        <div class="rightpage">
            
            <div class="formlog">
            <h1>LOGIN</h1>
                <br><br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="formlogin">
                        <p id="namef"><b>Username</b> <span class="error">* <?php echo $usernameErr;  ?></span></p>
                        <input type="text" name="username" id="flogin" placeholder="Username" value="<?php echo $username?>" require>
                        <br><br>
                        <p id="namef"><b> Password </b><span class="error">* <?php echo $passwordErr;  ?></span></p>
                        <input type="password" name="password" id="flogin" placeholder="Password" require>
                        <br>
                        <span class="error"> <?php echo $userpassErr;  ?></span>
                        
                        <br><br>
                    </div>
                    <button type="submit" id="btnlogin" name="login">LOGIN</button>
                </form>
                <br>
                
                <br>
                <p>Don't have an account? <a href="singup.php">Create Account</a></p>
                <br>
                <!-- <p><a href="loginadmin.php"> Login as Admin </a></p> -->
            </div>
        </div>
    </div>
</body>
</html>