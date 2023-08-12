<?php
  session_start();
  require 'connection.php';
  require 'cek.php';
  $user = $_SESSION['user'];


  $datauser = mysqli_query($conn,"SELECT * FROM customer WHERE username = '$user'");
  
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
    <title>Kyrane Shop</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleval.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
      
</head>

<body style="background-color: #f5f5f5;">
       <!-- Navigasi/header -->
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" style="background-color: #D9AC6B; margin-top: -10px; margin-bottom: -6px;">
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
              <div class="col col-lg-6 align-middle">
              <?php
                $nmbarang = "";
                if(isset($_GET['caribarang'])){
                  $nmbarang = $_GET['namabarang'];
                }
              ?>
                <form class="d-flex" method="GET">
                  <input class="form-control me-2" name="namabarang" type="search" placeholder="Search" value="<?php echo isset($_GET['namabarang']) ? $_GET['namabarang'] : ''; ?>" aria-label="Search" style="height: 40px; margin: 20px;">
                  <button class="btn btn-outline-dark" type="submit" name="caribarang" style="height: 40px; text-align: center; margin-left: 4px; margin-top: 20px;">Search</button>
                </form> 
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

      <!-- Awal Banner -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style=" margin-bottom: 20px">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/crs.png" class="d-block w-100" alt="#" style="height:400px;">
            </div>
            <div class="carousel-item active">
              <img src="img/crs2.png" class="d-block w-100" alt="#" style="height:400px;">
            </div>
          </div>
        </div>

      <div class="container" style="margin-top: -100px; background-color:white; position:relative; border-radius:16px 16px 0px 0px; box-shadow: 0 3px 5px grey;">
      <br><h5 style="text-align:left; margin-left:40px;"><b>Katalog Produk</b></h5>
      <!-- Akhir Banner -->
      <div class="d-flex justify-content-start align-content-between flex-wrap" style=" margin: 0 auto; ">
        <!-- Card Product -->
      <?php
      
      if(isset($_GET['caribarang'])){
        $nmbarang = $_GET['namabarang'];
        $result = mysqli_query($conn, "SELECT * FROM barang WHERE (nama_barang LIKE '%$nmbarang%') OR  (jenis_barang LIKE '%$nmbarang%')
        OR  (merek LIKE '%$nmbarang%')");
        
          while($barang = mysqli_fetch_array($result)){
            $idbarang = $barang['ID_barang'];
            $namabarang = $barang['nama_barang'];
            $hargabarang = $barang['harga_barang'];
            //$jenisbarang = $barang['jenis_barang'];
            $merek = $barang['merek'];
            //$warna = $barang['warna'];
            $ukuran = $barang['ukuran'];
            //$garansi = $barang['garansi'];
            $stok = $barang['stok'];
            $deskripsi = $barang['deskripsi'];
            // $fotobarang = $barang['produk_image'];
            // $foto2 = $barang['foto2'];
            // $foto3 = $barang['foto3'];
            $gambar = mysqli_query($conn,"SELECT * FROM gambar where ID_barang = $idbarang");
            $fotobarang = array();
            while($dtgambar = mysqli_fetch_array($gambar)){
              // $fotobarang = $dtgambar['produk_image'];
              array_push($fotobarang, $dtgambar['produk_image']);
            }

            ?>
            <div class="grid" style="--bs-columns: 4; --bs-gap: 5rem; margin-top: 15px; margin-left: 9px; margin-right: 9px;">
            <div class="grid" style="--bs-columns: 4; --bs-gap: 5rem; margin-top: 15px; margin-left: 9px; margin-right: 9px;">
              <div class="card" style="width: 18rem; min-height:550px; border-radius:16px;">
              <div class="carousel-inner" style="border-radius:16px 16px 0px 0px;">
                  <?php
                    $gambar = mysqli_query($conn, "SELECT * FROM gambar WHERE ID_barang = $idbarang");
                    $fotobarang = array();
  
                    while ($dtgambar = mysqli_fetch_array($gambar)) {
                    array_push($fotobarang, $dtgambar['produk_image']);
                    }
  
                    foreach ($fotobarang as $index => $image) {
                      $activeClass = ($index == 0) ? 'active' : '';
                        echo '<div class="carousel-item ' . $activeClass . '">';
                        echo '<img src="img/' . $image . '" class="d-block w-100" alt="..." style="height: 300px; width: 300px;">';
                        echo '</div>';  
                    }
                    ?>
                </div>

                <!-- <img src="img/<?php echo $fotobarang;?>" class="card-img-top" alt="..."> -->
                <div class="card-body">
                  <h5 class="card-title"><?php echo $namabarang;?></h5>
                  <div class="card-text">
                      <table>
                          <tr>
                            <td>Stok</td>
                            <td>:</td>
                            <td>
                              <?php
                                if($stok == 0){
                              ?>
                                <b style="color:red;"><?php echo $stok;?></b>
                              <?php 
                                }
                                else{
                                  echo $stok;
                                }
                                ?>
                              </td>
                          </tr>
                      </table>
                  </div>
                  <br>
                  <p> <b class="text-danger"><?php echo rupiah($hargabarang)?></b></p>
                  <!-- Button trigger modal Detail-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#detail<?=$idbarang;?>" style="right:6px; position:absolute; bottom:10px; background-color: #D9AC6B;">
                      Detail
                    </button>
                    
                </div>
              </div>
            </div>
            <div class="modal fade" id="detail<?=$idbarang;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #D9AC6B;">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">
                    <div class="keterangan" style="text-align: center; width:90%; margin: 0 auto;">
                      <div class="fotodetail" style="margin-bottom:20px ; margin-top:10px ;" >
                        <table class="foto_nama_harga">
                          <tr>
                            <td>
                              <div id="carouseldetail" class="carousel slide" data-bs-ride="carousel" style=" height:300px; width:300px; margin:0 auto;">
                              <div class="carousel-inner" style="border-radius:8px;">
                                <?php
                                  $gambar = mysqli_query($conn, "SELECT * FROM gambar WHERE ID_barang = $idbarang");
                                  $fotobarang = array();
  
                                  while ($dtgambar = mysqli_fetch_array($gambar)) {
                                    array_push($fotobarang, $dtgambar['produk_image']);
                                  }
  
                                  foreach ($fotobarang as $index => $image) {
                                      $activeClass = ($index == 0) ? 'active' : '';
                                      echo '<div class="carousel-item ' . $activeClass . '">';
                                      echo '<img src="img/' . $image . '" class="d-block w-100" alt="..." style="height: 300px; width: 300px;">';
                                      echo '</div>';  
                                  }
                                ?>
                              </div>
                              </div>
                            </td>

                            <td style="width:10px;">
                                <!-- Jeda -->
                            </td>

                              <!-- NAMA Harga -->
                            <td style="text-align:left; width:98%;">
                              <h3 style="margin-left:24px"><?php echo $namabarang;?></h3>
                              <br>
                              <div class="hargadanbeli" style="background-color:#fff; height:108px; min-width:95%; margin-left:24px">
                                <h1 class="text-danger" style="font-weight:800 ; padding-left:10px;padding-top:15px; margin-bottom:16px"><?php echo rupiah($hargabarang)?>&nbsp;</h1>
                                <form action="pembayaran.php" method="post">
                                  <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                                  <div class="input-group mb-3">
                                  <input type="text" class="form-control" name="banyak" placeholder="inputkan jumlah" aria-label="Example text with button addon" aria-describedby="button-addon1" style="width:250px; height:35px" required>

                                  <button type="submit" name="beli" class="btnbeli"  style="width:250px; height:35px ;position: relative; margin-right:30px; float: right;">Beli Sekarang</button>
                                </form>
                              </div>                           
                            </td>
                          </tr>
                        </table>

                        <!-- Detail Product -->
                        <table class="nameproduk" style="width: 100%; margin:0 auto; margin-top:15px">
                          <tr>
                            <td colspan="3" style="background-color:#D9AC6B; border-radius:0px 0px 24px 0px; text-align:left; padding: 10px"><b>Spesifikasi</b></td>
                          </tr>
                        </table>
                        <br>

                        <table class="spek" style="width: 97%; margin:0 auto; text-align:left; padding: 10px;">
                          <tr>
                            <td style="color:gray; width:300px;">Merek</td>
                            <td><?php echo $merek;?></td>
                          </tr>
                          <tr>
                            <td style="color:gray; width:300px;">Ukuran</td>
                            <td><?php echo $ukuran;?></td>
                          </tr>
                          <tr>
                            <td style="color:gray; width:300px;">Stock</td>
                            <td><?php
                                if($stok == 0){
                              ?>
                                <b style="color:red;"><?php echo $stok;?></b>
                              <?php 
                                }
                                else{
                                  echo $stok;
                                }
                                ?></td>
                          </tr>
                        </table>

                        <table class="nameproduk" style="width: 100%; margin:0 auto; margin-top:15px">
                          <tr>
                            <td colspan="3" style="background-color:#D9AC6B; border-radius:0px 0px 24px 0px; text-align:left; padding: 10px"><b>Deskripsi Produk</b></td>
                          </tr>
                        </table>

                        <div class="deskripsi" style="width: 97%; margin:0 auto; text-align:left; padding: 10px;">
                          <p align="justify"><?php echo $deskripsi;?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            </div>
          <?php
        };
      }
    else{
      ?>


          
      <?php
      // Query tampil barang
        $listbarang = mysqli_query($conn,"SELECT * FROM barang");
        
        while($barang = mysqli_fetch_array($listbarang)){
          $idbarang = $barang['ID_barang'];
          $namabarang = $barang['nama_barang'];
          $hargabarang = $barang['harga_barang'];
          //$jenisbarang = $barang['jenis_barang'];
          $merek = $barang['merek'];
          //$warna = $barang['warna'];
          $ukuran = $barang['ukuran'];
          //$garansi = $barang['garansi'];
          $stok = $barang['stok'];
          $deskripsi = $barang['deskripsi'];
          // $fotobarang = $barang['produk_image'];
          // $foto2 = $barang['foto2'];
          // $foto3 = $barang['foto3'];
          $gambar = mysqli_query($conn,"SELECT * FROM gambar where ID_barang = $idbarang");
          $fotobarang = array();
          while($dtgambar = mysqli_fetch_array($gambar)){
            // $fotobarang = $dtgambar['produk_image'];
            array_push($fotobarang, $dtgambar['produk_image']);
          }

          ?>
            <div class="grid" style="--bs-columns: 4; --bs-gap: 5rem; margin-top: 30px; margin-left: 17px; margin-right: 17px;">
              <div class="card" style="width: 18rem; min-height:550px; border-radius:16px;">
              <div id="carouseldetail" class="carousel slide" data-bs-ride="carousel" style=" height:300px; width:18rem; margin:0 auto;">
                <div class="carousel-inner" style="border-radius:16px 16px 0px 0px;">
                  <?php
                    $gambar = mysqli_query($conn, "SELECT * FROM gambar WHERE ID_barang = $idbarang");
                    $fotobarang = array();
  
                    while ($dtgambar = mysqli_fetch_array($gambar)) {
                    array_push($fotobarang, $dtgambar['produk_image']);
                    }
  
                    foreach ($fotobarang as $index => $image) {
                      $activeClass = ($index == 0) ? 'active' : '';
                        echo '<div class="carousel-item ' . $activeClass . '">';
                        echo '<img src="img/' . $image . '" class="d-block w-100" alt="..." style="height: 300px; width: 300px;">';
                        echo '</div>';  
                    }
                    ?>
                </div>
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $namabarang;?></h5>
                  <div class="card-text">
                      <table>
                          <tr>
                            <td>Stok</td>
                            <td>:</td>
                            <td>
                              <?php
                                if($stok == 0){
                              ?>
                                <b style="color:red;"><?php echo $stok;?></b>
                              <?php 
                                }
                                else{
                                  echo $stok;
                                }
                                ?>
                              </td>
                          </tr>
                      </table>
                  </div>
                  <br>
                  <p> <b class="text-danger"><?php echo rupiah($hargabarang)?></b></p>
                  <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#detail<?=$idbarang;?>" style="right:6px; position:absolute; bottom:10px; background-color: #D9AC6B;">
                      Detail
                    </button>
                    
                </div>
              </div>
            </div>
            <div class="modal fade" id="detail<?=$idbarang;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #D9AC6B;">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">
                    <div class="keterangan" style="text-align: center; width:90%; margin: 0 auto;">
                      <div class="fotodetail" style="margin-bottom:20px ; margin-top:10px ;" >
                        <table class="foto_nama_harga">
                          <tr>
                            <td>
                              <div id="carouseldetail" class="carousel slide" data-bs-ride="carousel" style=" height:300px; width:300px; margin:0 auto;">
                              <div class="carousel-inner" style="border-radius:8px;">
                                <?php
                                  $gambar = mysqli_query($conn, "SELECT * FROM gambar WHERE ID_barang = $idbarang");
                                  $fotobarang = array();
  
                                  while ($dtgambar = mysqli_fetch_array($gambar)) {
                                    array_push($fotobarang, $dtgambar['produk_image']);
                                  }
  
                                  foreach ($fotobarang as $index => $image) {
                                      $activeClass = ($index == 0) ? 'active' : '';
                                      echo '<div class="carousel-item ' . $activeClass . '">';
                                      echo '<img src="img/' . $image . '" class="d-block w-100" alt="..." style="height: 300px; width: 300px;">';
                                      echo '</div>';  
                                  }
                                ?>
                              </div>
                              </div>
                            </td>

                            <td style="width:10px;">
                                <!-- Jeda -->
                            </td>

                              <!-- NAMA Harga -->
                            <td style="text-align:left; width:98%;">
                              <h3 style="margin-left:24px"><?php echo $namabarang;?></h3>
                              
                              <div class="hargadanbeli" style="background-color:#fff; height:108px; min-width:95%; margin-left:24px">
                                <h1 class="text-danger" style="font-weight:800 ; padding-left:10px; padding-top:15px; margin-bottom:16px"><?php echo rupiah($hargabarang)?>&nbsp;</h1>
                                <form action="pembayaran.php" method="post">
                                  <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                                  <div class="input-group mb-3">
                                  <input type="text" class="form-control" name="banyak" placeholder="inputkan jumlah" aria-label="Example text with button addon" aria-describedby="button-addon1" style="width:250px; height:35px" required>

                                  <button type="submit" name="beli" class="btnbeli"  style="width:250px; height:35px ;position: relative; margin-right:30px; float: right;">Beli Sekarang</button>
                                </form>
                              </div>                           
                            </td>
                          </tr>
                        </table>

                        <!-- Detail Product -->
                        <table class="nameproduk" style="width: 100%; margin:0 auto; margin-top:15px">
                          <tr>
                            <td colspan="3" style="background-color:#D9AC6B; border-radius:0px 0px 24px 0px; text-align:left; padding: 10px"><b>Spesifikasi</b></td>
                          </tr>
                        </table>
                        <br>

                        <table class="spek" style="width: 97%; margin:0 auto; text-align:left; padding: 10px;">
                          <tr>
                            <td style="color:gray; width:300px;">Merek</td>
                            <td><?php echo $merek;?></td>
                          </tr>
                          <tr>
                            <td style="color:gray; width:300px;">Ukuran</td>
                            <td><?php echo $ukuran;?></td>
                          </tr>
                          <tr>
                            <td style="color:gray; width:300px;">Stock</td>
                            <td><?php
                                if($stok == 0){
                              ?>
                                <b style="color:red;"><?php echo $stok;?></b>
                              <?php 
                                }
                                else{
                                  echo $stok;
                                }
                                ?></td>
                          </tr>
                        </table>

                        <table class="nameproduk" style="width: 100%; margin:0 auto; margin-top:15px">
                          <tr>
                            <td colspan="3" style="background-color:#D9AC6B; border-radius:0px 0px 24px 0px; text-align:left; padding: 10px"><b>Deskripsi Produk</b></td>
                          </tr>
                        </table>

                        <div class="deskripsi" style="width: 97%; margin:0 auto; text-align:left; padding: 10px;">
                          <p align="justify"><?php echo $deskripsi;?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          <?php
        };
      }
      ?>
        
      </div>

    </div>
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

</html>