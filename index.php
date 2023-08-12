<?php
  session_start();
  require 'connection.php';

  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
  }
?>

<!doctype html>
<html lang="en">
 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kyrane Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleval.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.5.2/css/bootstrap.min.css">
  </head>

  <body> 
    <nav class="navbar navbar-expand-lg" style="background-color: #C49045;">
    <div class="container-fluid " style="background-color: #C49045;">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="pre.php">Home</a>
        </li>
        </ul>
        </div>
    </div>

    <!-- <div class="btn-group"> 
        <a href="login.php">
            <button type="button" class="btn btn-primary">
            LOGIN
            </button>
        </a> 
     </div> -->
 
     <a aria-current="page" href="login.php"><button class="btn btn-dark" type="button" aria-expanded="false" style="margin-right: 24px;">Login</button></a>

     <!-- <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Login
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="loginadmin.php">Admin</a></li>
    <li><a class="dropdown-item" href="login.php">User</a></li>
  </ul>
</div> -->

    </nav>

    <div class="clearfix">
        <div class="banner">
            <h1>Kyrane Shop</h1>
            <br>
            <br>
            <p>Menyediakan Berbagai Macam Daster Dengan Harga Murah dan Kualitas yang Bagus. Dan Dapatkan Harga Terbaik!!!</p>
        </div>

        <div class="banner">
            <img src="img/logoo.jpg" alt="car" width="350px" align="right">
        </div>
    </div>

      <div class="container" style="margin-top: 40px; background-color:white; position:relative; border-radius:16px 16px 0px 0px; box-shadow: 0 1px 3px 1px grey; min-height: 65vh;">
      <br><h5 style="text-align:left; margin-left:40px;"><b>Katalog Produk</b></h5>
      <!-- Akhir Banner -->
      <div class="d-flex justify-content-start align-content-between flex-wrap" style=" margin: 0 auto;">
           <!-- Card Product -->
                 
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
            <div class="grid" style="--bs-columns: 4; --bs-gap: 5rem; margin-top: 30px; margin-left: 17px; margin-right: 17px; margin-bottom: 24px;">
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
                              
                              <div class="hargadanbeli" style="background-color:#DCDCDC; height:108px; min-width:95%; margin-left:24px">
                                <h1 class="text-danger" style="font-weight:800 ; padding-left:10px;padding-top:15px;"><?php echo rupiah($hargabarang)?>&nbsp;</h1>
                                <form action="login.php" method="post">
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
      ?>
        
      </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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