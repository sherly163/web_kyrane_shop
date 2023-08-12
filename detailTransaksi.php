<?php
    session_start();
    require 'connection.php';
    require 'cekadmin.php';
    $user = $_SESSION['user'];
  
  
    $datauser = mysqli_query($conn,"SELECT * FROM admin WHERE username = $user");
  
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
    <title>Detail Transaksi</title>
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
    
      <!-- Akhir Header -->
      <?php

            //proses upload
            if(isset($_POST['cekdetail'])){
                $idtransaksi = $_POST['idtransaksi'];
                
            }

            $transaksi = mysqli_query($conn,"SELECT * FROM transaksi LEFT JOIN  customer ON transaksi.idcustomer = customer.ID_customer LEFT JOIN barang ON transaksi.idbarang = barang.ID_barang LEFT JOIN  alamat_customer ON transaksi.idalamat = alamat_customer.ID_alamat WHERE transaksi.idtransaksi = '$idtransaksi' ");
                                   
                        
                        $i = 1;
                            while($tr = mysqli_fetch_array($transaksi)){
                                $idtransaksi = $tr['idtransaksi'];
                                $waktu = $tr['waktu'];
                                $namauser = $tr['nama_customer'];
                                $nmbarang = $tr['nama_barang'];
                                $qty = $tr['qty'];
                                $namaPenerima = $tr['namaPenerima'];
                                $nohp = $tr['NoHP'];
                                $detailAlamat = $tr['detail_alamat'];
                                $prov = $tr['prov'];
                                $kab = $tr['kab'];
                                $kec = $tr['kec'];

                                $warnabarang = $tr['warna'];
                                $jenisbarang = $tr['jenis_barang'];
                                $ukuranbarang = $tr['ukuran'];
                                $merekbarang = $tr['merek'];
                                $totharga = $tr['harga_barang'];
                                $status = $tr['status'];
                                $fotobarang = $tr['produk_image'];
                            }
                        ?>
        
        <div class="container">
        <div class="detail" style="width:100%">
            <h2 align="center" style="margin-top:10px">Detail Transaksi</h2>
            <div class="isi" style="width: 80%; margin:0 auto; margin-top:40px">
            
                <table style="width: 85%; margin:0 auto;">
                    <tr>
                        <td colspan="3"><h5 align="center">Detail Transaksi</h5></td>
                    </tr>
                    <tr>
                        <td style="width: 25%;">Waktu Transaksi</td>
                        <td>:</td>
                        <td><b><?php echo $waktu;?></b></td>
                        <td>Quantity</td>
                        <td>:</td>
                        <td><b><?php echo $qty?></b></td>
                    </tr>
                     <tr>
                        <td>Harga Barang</td>
                        <td>:</td>
                        <td><b><?php echo rupiah($totharga);?></b></td>
                        <td>Status</td>
                        <td>:</td>
                        <td><b><?php echo $status?></b></td>
                    </tr>
        
                </table>
                
                <table style="width: 85%; margin:0 auto; margin-top:10px">
                    <tr>
                        <td colspan="3"><h5 align="center">Detail Pembeli</h5></td>
                    </tr>
                    <tr>
                        <td style="width: 25%;">Nama Customer</td>
                        <td>:</td>
                        <td><b><?php echo $namauser;?></b></td>
                    </tr>
                    <tr>
                        <td>Nama Penerima | No HP</td>
                        <td>:</td>
                        <td><b class="text-break">  <?php echo $namaPenerima;?>| <?php echo $nohp;?></b></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><b><?php echo $detailAlamat?>, Kec. <?php echo $kec?>, Kab.<?php echo $kab?>,<?php echo $prov?></b></td>
                    </tr>
                    <tr>
                        <td style="height: 20px;"></td>
                    </tr>
                 
                </table>

                        <div class="d-flex justify-content-center" style="margin-top: 30px; margin-bottom:10px">
                            <img src="img/<?php echo $fotobarang;?>" alt="" style="max-width:13vw;">
                        </div>
                    
                <table style="width: 85%; margin:0 auto;">
                       <tr>
                        <td colspan="3"><h5 align="center">Detail Barang</h5></td>
                    </tr>
                    <tr>
                        <td style="width: 25%;">Nama Barang</td>
                        <td>:</td>
                        <td><b><?php echo $nmbarang;?></b></td>
                    </tr>
                    <tr>
                        <td>Ukuran</td>
                        <td>:</td>
                        <td><b><?php echo $ukuranbarang;?></b></td>
                    </tr>
                    <tr> 
                    </tr>
                </table>
                
            
            <div class="space" style=" margin-top: 10px; width: 100%; min-height:1.5vh; background-color:#19335A">
            </div>
            <a href="daftarTransaksi.php" style="margin-top: 30px;"><button type="button" class="btn btn-warning"><i class="fa-solid fa-caret-left"></i>BACK</button></a>
            </div>
            <div class="foot" style="height: 30px;">
            </div>
    </div>
</body>
</html>