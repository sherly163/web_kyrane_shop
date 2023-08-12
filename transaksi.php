<?php
  session_start();
  require 'connection.php';
  require 'cek.php';
  require 'fungsi.php';
  $user = $_SESSION['user'];


  $datauser = mysqli_query($conn,"SELECT * FROM customer WHERE username = '{$user}'");
  
    while($ud = mysqli_fetch_array($datauser)){
        $idcust = $ud['ID_customer'];
    }
    function rupiah($angka){
  
        $hasil_rupiah = "Rp" . number_format($angka,0,',','.');
        return $hasil_rupiah;
       
      }
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
    <title>Daftar Transaksi</title>
</head>

<body style="background-color: #f5f5f5;">
       <!-- Navigasi/header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid" style="background-color: #D9AC6B; margin-top: -10px;">
          <a class="navbar-brand" href="indexus.php"><img src="img/logonav.jpg" class="logoinnav" style="height: 50px; margin-left:32px;"></a>
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
      <div class="container" style="min-height: 65vh">
      <div class="col-5" >
        <h2 style="text-align:left; margin-top:40px; margin-bottom: -16px;"><b>Transaksi</b></h2>
      </div><br>
      <div class="list">
            <div class="ttabble" style="width: 95%; margin: 0 auto; margin-top:10px; margin-bottom:24px;">
            <div class="row">
                        <div class="col-5">
                        </div>
                        <div class="col-2" style=" display:flex; justify-content: end;">
                           
                        </div>
                    </div>

                <table class="table table-bordered table-striped table-hover" style="margin-top: 30px;">
                    <thead>
                        <tr style="text-align: center;">
                            <th scope="col">No</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Pembeli</th>
                            <th scope="col">Nomor HP</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Qty</th>
                            
                            <th scope="col">Harga Barang</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sdata = 1;
                        
                        $transaksi = mysqli_query($conn,"SELECT * FROM transaksi LEFT JOIN  customer ON transaksi.idcustomer = customer.ID_customer LEFT JOIN barang ON transaksi.idbarang = barang.ID_barang LEFT JOIN  alamat_customer ON transaksi.idalamat = alamat_customer.ID_alamat WHERE customer.ID_customer = '$idcust'");
                            
                        $hitung = mysqli_num_rows($transaksi);
                        if($hitung>0){
                        $i = 1;
                            while($tr = mysqli_fetch_array($transaksi)){
                                $idtransaksi = $tr['idtransaksi'];
                                $waktu = $tr['waktu'];
                                $namacust = $tr['nama_customer'];
                                $nmbarang = $tr['nama_barang'];
                                $qty = $tr['qty'];
                                $namaPenerima = $tr['namaPenerima'];
                                $nohp = $tr['NoHP'];
                                $alamat = $tr['detail_alamat'];
                                $totharga = $tr['harga_barang'];
                                $status = $tr['status'];
                            
                        ?>
                        <tr style="text-align: center;">
                            <th scope="row" style="justify-self: center;"><?php echo $i;?></th>
                            <td><?php echo $waktu;?></td>
                            <td style="text-align: left ;"><?php echo $namacust ;?></td>
                            <td> <?php echo $nohp ;?></td>
                            <td style="text-align: left;"><?php echo $nmbarang ;?></td>
                            <td ><?php echo $qty ;?></td>
                            <td><?php echo rupiah($totharga) ;?></td>
                            <td><?php echo $status ;?></td>
                            <td style="text-align: right;">
                                <form action="detailTransaksiCust.php" method="post">
                                    <input type="hidden" name="idtransaksi" value="<?=$idtransaksi;?>">
                                    <button type="submit" name="cekdetail" class="btn btn-outline-warning"><i class="fa-solid fa-info" ></i> Detail</button>
                                </form>
                            </td>
                        </tr>

    
                        <?php $i++;
                            };}else{
                                ?>
                                <h3 align="center">TIDAK ADA RIWAYAT TRANSAKSI</h3>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    

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
</body>



</html>