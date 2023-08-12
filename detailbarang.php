<?php
    session_start();
    require 'connection.php';
    require 'cekadmin.php';
    $user = $_SESSION['user'];
  
  
    $datauser = mysqli_query($conn,"SELECT * FROM customer WHERE username = $user");
  
    function rupiah($angka){
      
      $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
      return $hasil_rupiah;
     
    }

    $barang = mysqli_query($conn,"SELECT * FROM barang");
  
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
    <title>Detail Barang</title>
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
                        <li><a class="dropdown-item" href="settingadmin.php">Profil</a></li>
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
    </div>

    <?php

//proses upload
if(isset($_POST['cekdetail'])){
    $idbarang = $_POST['idbarang'];
    $detailbarang = mysqli_query($conn, "SELECT * FROM barang WHERE ID_barang = '$idbarang'");
}

while($dtbarang = mysqli_fetch_array($detailbarang)){
        $idbarang = $dtbarang['ID_barang'];
        $namabarang = $dtbarang['nama_barang'];
        $hargabarang = $dtbarang['harga_barang'];
        $merek = $dtbarang['merek'];
        $stok = $dtbarang['stok'];
        $ukuran = $dtbarang['ukuran'];
        $deskripsi = $dtbarang['deskripsi'];
        $fotobarang = $dtbarang['produk_image'];
}

?>
<div class="container">
<div class="detail" style="width:100%">
<h2 align="center" style="margin-top:10px">Detail Barang</h2>
<div class="isi" style="width: 80%; margin:0 auto; margin-top:40px">

    <table style="width: 85%; margin: auto;">
        <tr>
            <td rowspan="9"><img src="img/<?php echo $fotobarang;?>" alt="" style="max-width:25vw; margin-right: 24px;"></td>
            <td colspan="3"><h3 align="center"><?php echo $namabarang; ?></h3></td>
            
        </tr>
        <tr>
            <td>Merek</td>
            <td>:</td>
            <td><?php echo $merek;?></td>
        </tr>
        <tr>
            <td>Ukuran</td>
            <td>:</td>
            <td><?php echo $ukuran;?></td>
        </tr>
        <tr>
            <td>Stok</td>
            <td>:</td>
            <td><?php echo $stok;?></td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>:</td>
            <td><b><?php echo rupiah($hargabarang)?></b></td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="4"><h4 align="center">DESKRIPSI</h4></td>
        </tr>
        <tr>
            <td colspan="4" style="text-align: justify;"><?php echo $deskripsi ?></td>
        </tr>
    </table>
    

<div class="space" style=" margin-top: 10px; width: 100%; min-height:1.5vh; background-color:#19335A; margin-bottom:10px;">
</div>
<a href="indexadmin.php" style="margin-top: 50px;"><button type="button" class="btn btn-warning"><i class="fa-solid fa-caret-left"></i>BACK</button></a>
</div>
<div class="foot" style="height: 30px;">
</div>



    



</div>
</body>
</html>