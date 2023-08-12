<?php
  session_start();
  require 'connection.php';
  require 'cek.php';
  require 'fungsi.php';
  $user = $_SESSION['user'];



  $userdata = mysqli_query($conn,"SELECT * FROM customer WHERE username = '{$user}'");
  while($data=mysqli_fetch_array($userdata)){
    $idcustomer = $data['ID_customer'];
    $namacustomer = $data['nama_customer'];}

 $barang = mysqli_query($conn,"SELECT * FROM barang");
  


  function rupiah($angka){
	
    $hasil_rupiah = "Rp" . number_format($angka,0,',','.');
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
    <title>Pembayaran</title>
    <style>
      .pagebayar{
          background-color: #ececec;
          border-radius: 5px;
          box-shadow: 0.5px 0.5px 5px #d4d4d4;
          margin-bottom: 30px;
          min-height: 400px;
        
      }

    </style>
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
                        <li><a class="dropdown-item" href="setting.php">Setting</a></li>
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
      <h3 style="text-align:center;">Pembayaran</h3>
      <br><br>
    </div>



    <?php
      // var_dump($_FILES);
      // die();
      if(isset($_POST['upload'])){
      //var_dump($_FILES);
      $namaGambar = $_FILES['file']['name'];
      $path = $_FILES['file']['tmp_name'];
      move_uploaded_file($path, 'img/'.$namaGambar);

      //$namaGambar = $_POST['$namaGambar'];

       $pembayaran = mysqli_query($conn, "INSERT INTO transfer (bukti_tf) VALUES ('$namaGambar')");
    if($pembayaran){
        header('location:indexus.php');
    }else{
        echo 'gagal';
        header('location:bukti.php');
    }

}
      ?>
    
    <div class="forform" style="min-width: 450px; max-width:60%; margin:0 auto;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" class="form-control" name="file" >
        </div>
        <div class="col-2">
                <button type="submit" class="btn btn-outline-primary" name="upload" value="Upload "><i class="fa-solid fa-upload"></i> Upload</button>
            </div>
      </form>
    </div>
  </body>
  </html>