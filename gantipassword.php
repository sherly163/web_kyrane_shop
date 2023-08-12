<?php
  session_start();
  require 'connection.php';
  require 'cek.php';
  require 'fungsi.php';
  $user = $_SESSION['user'];


  $datauser = mysqli_query($conn,"SELECT * FROM customer WHERE username = '{$user}'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      .error {color: #FF0000;}
    </style>
    <!-- Font Awesome -->
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome/css/brands.css" rel="stylesheet">
    <link href="fontawesome/css/solid.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleval.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
</head>

<body style="background-color: #f5f5f5;">
     <!-- Navigasi/header -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <div class="container-fluid" style="background-color: #D9AC6B; margin-top: -10px;">
          <a class="navbar-brand" href="indexus.php"><img src="img/logonav.jpg" class="logoinnav" style="height: 50px; margin-left: 32px;"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="row justify-content-md-center" style="width: 100%;">
              <div class="col" style="margin-top:20px">
                <ul class="navbar-nav me-auto mb-5 mb-lg-0 align-middle" >
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="indexus.php">Kyrane Shop</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                  </li>
                  
                </ul>
              </div>
              <div class="col col-lg-2 " style="float:right; margin-top:6px; text-align:right;">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="Dropdown2"  data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user" style="text-align: center; margin: 20px;" ></i><?php echo $user;?>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="setting.php">Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Logout <i class="fa-sharp fa-solid fa-right-from-bracket"></i></a></li>
                      </ul>
                    </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <!-- Akhir Header -->
      

        <?php
        $PesanErr = "";
        if(isset($_POST['btngantipassword'])){
            $passlama = md5($_POST['passwordlama']);
            $passbaru = md5($_POST['passbaru']);
            $passbaruulang = md5($_POST['passbaruulang']);
            
            $cekpas = mysqli_query($conn,"SELECT * FROM customer WHERE username = '$user' AND password = '$passlama'");
            $cekhit = mysqli_num_rows($cekpas);
            
            if($cekhit>0){
                if(($passbaru == $passbaruulang) && !empty($_POST['passbaru'])){
                    $updatePass = mysqli_query($conn,"UPDATE customer SET password = '$passbaru' WHERE username = '$user'");
                    if($updatePass){
                        
                        header('location:setting.php');
                        echo "<script>alert('PASSWORD BERHASIL DIGANTI');</script>";
                    }else{
                        header('location:gantipass.php');
                    }
                }else{
                    $PesanErr = "* Password Not Match!!!";
                };
            }else{
                if(empty($_POST['passwordlama'])){
                    $PesanErr = "* Input Empty!!!";
                }else{
                    $PesanErr = "* Password Invalid!!!";
                };
                
            };
        }
        ?>

        <div class="container">
        <div class="pagegantipass" style="margin: 0 auto; max-width:95%">
            <div class="forform" style="min-width: 450px; max-width:60%; margin:0 auto;">
                <form action="" method="post">
                    <div>
                        <h3 class="fw-bolder" style="text-align:left; margin-top:40px; margin-bottom: -16px;">GANTI PASSWORD</h3><br><br>
                    </div>
                    <span class="error" style="position: absolute; margin-top:-25px;"><?php echo $PesanErr;  ?></span>
                    <div class="mb-3">
                        <label for="passwordlama" class="form-label">Password Lama</label>
                        <input type="password" name="passwordlama" class="form-control" id="passwordlama" placeholder="Masukkan Password Lama..." require>
                        <input class="form-check-input" type="checkbox" onclick="myFunction()" style="size: 20px; margin-top:10px" > <label for="passwordlama" style="margin-top: 5px;">Show Password</label>
                    </div>
                    <div class="mb-3">
                        <label for="passwordlama" class="form-label">Password Baru</label>
                        <input type="password" name="passbaru" class="form-control" id="passbaru" placeholder="Masukkan Password Baru..." require>
                        <input class="form-check-input" type="checkbox" onclick="barupass()" style="size: 20px; margin-top:10px" > <label for="passwordlama" style="margin-top: 5px;">Show Password</label>
                    </div>
                    <!-- Untuk Validasi Inputan Password -->
                    <div id="message">
                        <table width="100%">
                            <tr>
                                <td><p id="letter" class="invalid">  A <b>lowercase</b> letter </p></td>
                                <td style="width:20px ;"> </td>
                                <td><p id="capital" class="invalid">  A <b>capital (uppercase)</b> letter</p></td>
                                <td style="width:20px ;"> </td>
                                <td><p id="number" class="invalid">  A <b>number</b></p></td>
                                <td style="width:20px ;"> </td>
                                <td><p id="length" class="invalid">  Minimum <b>8 characters</b></p></td>
                            </tr>
                        </table>
                    </div>
                        <br>
                    <div class="mb-3">
                        <label for="passwordlama" class="form-label">Ulangi Password Baru</label>
                        <input type="password" name="passbaruulang" class="form-control" id="passbaruulang" placeholder="Masukkan Ulang Password Baru..." require>
                        <input class="form-check-input" type="checkbox" onclick="ulangpass()" style="size: 20px; margin-top:10px" > <label for="passwordlama" style="margin-top: 5px;">Show Password</label>
                    </div>
                    
                    <div class="row">
                        <div class="col-8">
                            
                        </div>
                        <div class="col-2">
                            <input type="reset" class="btn btn-outline-secondary" style="height: 45px" name="Reset" value="Reset">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-outline-primary" name="btngantipassword"><i class="fa-solid fa-paper-plane" style="height: 25px;"></i> Ganti</button>
                        </div>
                    </div>
                    <div class="mb-3" style="justify-content: left; width:100%">
                       
                    </div>
                </form>
                <a href="setting.php"><button type="button" class="btn btn-warning"><i class="fa-solid fa-caret-left"></i>BACK</button></a>
            </div>
            
        </div>
    </div>
    <script>
    function myFunction() {
    var x = document.getElementById("passwordlama");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function barupass() {
        var baru = document.getElementById("passbaru");
        if (baru.type === "password") {
            baru.type = "text";
        } else {
            baru.type = "password";
        }
    }
        
    function ulangpass() {
        var ulang = document.getElementById("passbaruulang");
        if (ulang.type === "password") {
            ulang.type = "text";
        } else {
            ulang.type = "password";
        }
    }
</script>
</body>

<footer class="text-center text-white" style="background-color:#D9AC6B;">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Whatsapp -->
      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #29A71A;"
        href="https://wa.me/6289633190966" 
        role="button"
        ><i class="fab fa-whatsapp"></i
      ></a>
      <!-- Instagram -->
      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #ac2bac;"
        href="https://instagram.com/kyrane_shop?igshid=MzRlODBiNWFlZA"
        role="button"
        ><i class="fab fa-instagram"></i
      ></a>
      <!-- Facebook -->
      <a
        class="btn text-white btn-floating m-1"
        style="background-color: #3b5998;"
        href="https://www.facebook.com/kyraneshop?mibextid=ZbWKwL"
        role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: #C49045;">
    © 2023 Copyright:Kyrane Shop
  </div>
  <!-- Copyright -->
</footer>

<!-- Untuk Validasi Inputan Password -->
<script>
        var myInput = document.getElementById("passbaru");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }
        
        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        // Validate numbers
        var numbers = /[0-9]/g;
        if(myInput.value.match(numbers)) {  
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }
        
        // Validate length
        if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
        }
        </script>
</html>