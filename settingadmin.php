<?php
    session_start();
    require 'connection.php';
    require 'cekadmin.php';
    $user = $_SESSION['user'];
  
    function rupiah($angka){
      
      $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
      return $hasil_rupiah;
     
    }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    <title>Setting Admin</title>
</head>
<body>
     <!-- Navigasi/header -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <div class="container-fluid" style="background-color: #D9AC6B; margin-top: -10px;">
          <a class="navbar-brand" href="indexadmin.php"><img src="img/logonav.jpg" class="logoinnav" style="height: 50px; margin-left: 32px;"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="row justify-content-md-center" style="width: 100%;">
              <div class="col" style="margin-top:20px">
                <ul class="navbar-nav me-auto mb-5 mb-lg-0 align-middle" >
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="indexadmin.php">Kyrane Shop</a>
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
                        <li><a class="dropdown-item" href="logout.php">Logout <i class="fa-sharp fa-solid fa-right-from-bracket"></i></a></li>
                      </ul>
                    </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
    
        <div class="container">
        <!-- Akhir header/nav -->
        <h2 style="text-align:left; margin-top:40px; margin-bottom: -16px;"><b>Setting</b></h2><br><br>
        <a aria-current="page" href="tambahAdmin.php"><button type="button" id="btnAdmin" class="btn btn-outline-warning" aria-expanded="false" style="margin-bottom: 16px;"><i class="fa-solid fa-plus"></i>Tambah Admin</button></a>         
        <div class="pagesettingadmin" style="background-color:white; position:relative; border-radius:16px; box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.25);">
            <div class="datauser" >
                <table class="tbl_dataadmin" style="margin-left: 10px;">
                    <?php 
                        $dataadmin = mysqli_query($conn,"SELECT * FROM admin WHERE username = '$user'");

                        while($ud = mysqli_fetch_array($dataadmin)){
                            $idadmin = $ud['Id_admin'];
                            $nameuser = $ud['username'];
                            $nama = $ud['nama_admin'];
                            $nohp = substr($ud['No_HP'],-2);
                            
                            $email = explode('@',$ud['email']);
                            $hitungnohp = strlen($ud['No_HP'])-2;
                            $semail = substr($ud['email'],0,2);
                            $hitungemail = strlen($email[0])-2;
    
                    ?>
                    <tr>
                        <td class="text-muted">Username</td>
                        <td style="width: 3vw; height:35px"></td>
                        <td class="fw-bold"><?php echo $nameuser;?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nama Lengkap</td>
                        <td style="width: 3vw; height:35px"></td>
                        <td class="fw-bold"><?php echo $nama;?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nomor Handphone</td>
                        <td style="width: 3vw; height:35px"></td>
                        <td class="fw-bold text-break"><?php for($i=0;$i<$hitungnohp;$i++){echo '*';} echo $nohp;?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td style="width: 3vw; height:35px"></td>
                        <td class="fw-bold text-break"><?php echo $semail; for($i=0;$i<$hitungemail;$i++){echo '*';} echo '@'.end($email);?></td>
                    </tr>
                    <?php 
                        };
                        ?>
                </table>
        </div>
    </div>
</body>
</html>