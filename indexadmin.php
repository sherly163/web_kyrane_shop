<?php
    session_start();
    require 'connection.php';
    require 'cekadmin.php';
    $user = $_SESSION['user'];
  
  
    $datauser = mysqli_query($conn,"SELECT * FROM admin WHERE username = '$user'");
  
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
    <title>Admin</title>
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
    
    <div class="container">
    <div class="keseluruhan">
            <div class="d-flex justify-content-center align-content-between flex-wrap" style="margin: 0 auto; width: 99%;">
            <?php 
                    $totalbarang = mysqli_num_rows($barang);
                    $totstok = mysqli_query($conn,"SELECT SUM(stok) AS total_stok FROM barang;");
                    while($data = mysqli_fetch_array($totstok)){
                        $totalstok = $data['total_stok'];
                    }
                    $transaksi = mysqli_query($conn,"SELECT * FROM transaksi");
                    $totaltransaksi = mysqli_num_rows($transaksi);
                    if($totaltransaksi <= 0){
                        $totalterjual = 0;
                    }else{
                        $terjual = mysqli_query($conn,"SELECT SUM(qty) AS total_terjual FROM transaksi;");
                        while($dt = mysqli_fetch_array($terjual)){
                            $totalterjual = $dt['total_terjual'];
                        }
                    }
                    
                    
                ?>
                <div class="card" style="width: 12rem; margin-right:1%; margin-left:1%; margin-top:15px;">
                    <div class="card-body">
                        <h1 align="center" class=""><?php echo $totalbarang ;?></h1>
                        
                    </div>
                    <div class="card-footer bg-transparent border-success" style="text-align: center;">JUMLAH BARANG</div>
                </div>
                <div class="card" style="width: 12rem; margin-right:1%; margin-left:1%; margin-top:15px;">
                    <div class="card-body">
                        <h1 align="center"><?php echo $totalstok ;?></h1>
                        
                    </div>
                    <div class="card-footer bg-transparent border-success" style="text-align: center;">TOTAL STOK</div>
                </div>
                <div class="card" style="width: 12rem; margin-right:1%; margin-left:1%; margin-top:15px;">
                    <div class="card-body">
                        <h1 align="center"><?php echo $totalterjual ;?></h1>
                        
                    </div>
                    <div class="card-footer bg-transparent border-success" style="text-align: center;">TOTAL TERJUAL</div>
                </div>
                <div class="card" style="width: 12rem; margin-right:1%; margin-left:1%; margin-top:15px;">
                    <div class="card-body">
                        <h1 align="center"><?php echo $totaltransaksi ;?></h1>
                        
                    </div>
                    <div class="card-footer bg-transparent border-success" style="text-align: center;">TOTAL TRANSAKSI</div>
                </div>
            
            </div>
        </div>
        <!-- Akhir Rekap -->

        <div class="list">
            <div style="width: 100%; height:2px; background-color:#19335A; margin-top:40px"></div>
            <div class="ttabble" style="width: 95%; margin: 0 auto; margin-top:10px">
            <div class="row">
                        <div class="col">
                            <a href="tambahbarang.php"><button type="button" class="btn btn-outline-warning" style="min-width: 100px;"><i class="fa-solid fa-plus"></i> Tambah Barang</button></a>
                        </div>
                        <div class="col" style=" display:flex; justify-content: end;">
                        <a href="daftartransaksi.php"><button type="button" class="btn btn-outline-warning" style="min-width: 100px; margin-right:10px;"><i class="fa-regular fa-clipboard"></i> Daftar Transaksi</button></a>
                            <a href="cetakBarang.php"><button type="button" class="btn btn-outline-warning" style="min-width: 100px;"><i class="fa-regular fa-print"></i> Cetak Laporan</button></a>
                        </div>
                    </div>
            
            <?php
                
                if(isset($_GET['caribarang'])){
                    $nmbarang = $_GET['namabarang'];
                }
            ?>
            
            <form method="get">
                <div class="input-group mb-3" style="min-width: 350px; max-width: 60%; margin-top:30px;">
                    <input type="text" name="namabarang" class="form-control" placeholder="Search Barang" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-dark" style="border-radius:0px 16px 16px 0px;" type="submit" name="caribarang" id="button-addon2" value="<?php echo $nmbarang; ?>">Search</button>&nbsp;
                    
                    <a href="indexadmin.php"><button type="button" class="btn" href="indexadmin.php" style="height: 50px; width:50px;"><i class="fa-solid fa-x"></i></button></a>
                </div>
            </form>
            
            <?php
                if(isset($_GET['caribarang'])){
                    $nmbarang = $_GET['namabarang'];
                    ?>
                    <span><p class="fw-light">Hasil Pencarian : <b><?php echo $nmbarang; ?></b></p></span>
                    
            <?php
                }
            ?>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr style="text-align: center;">
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sdata = 1;
                        if(isset($_GET['caribarang'])){
                            $nmbarang = $_GET['namabarang'];
                            $barang = mysqli_query($conn, "SELECT * FROM barang WHERE (nama_barang LIKE '%$nmbarang%') OR  (ukuran LIKE '%$nmbarang%')
                                                    OR  (merek LIKE '%$nmbarang%')");
                            $sdata = mysqli_num_rows($barang);
                        }else{
                            $barang = mysqli_query($conn,"SELECT * FROM barang");
                            
                        };
                        if($sdata <= 0){
                        ?>
                            <h3 align="center">BARANG TIDAK ADA</h3>
                        <?php
                        }else{
                        $i = 1;
                            while($dtbarang = mysqli_fetch_array($barang)){
                                $idbarang = $dtbarang['ID_barang'];
                                $namabarang = $dtbarang['nama_barang'];
                                $hargabarang = $dtbarang['harga_barang'];
                                $ukuran = $dtbarang['ukuran'];
                                $merek = $dtbarang['merek'];
                                $warna = $dtbarang['warna'];
                                $stok = $dtbarang['stok'];
                                $deskripsi = $dtbarang['deskripsi'];
                                // $fotobarang = $dtbarang['produk_image'];
                                $gambar = mysqli_query($conn,"SELECT * FROM gambar where ID_barang = $idbarang");
                                $fotobarang = array();
                                while($dtgambar = mysqli_fetch_array($gambar)){
                                    // $fotobarang = $dtgambar['produk_image'];
                                    array_push($fotobarang, $dtgambar['produk_image']);
                                }
                            
                        ?>
                        <tr style="text-align: center;">
                            <th scope="row" style="justify-self: center;"><?php echo $i;?></th>
                            <?php
                                echo "<td>";
                                foreach ($fotobarang as $value) {
                                    echo "<img src='img/".$value."' style='height: 60px; w'>";
                                }
                                echo "</td>";
                            ?>
                            <!-- <td><img src="img/<?php echo $fotobarang;?>" style="height: 60px; w"></td> -->
                            <td style="text-align: left ;"><?php echo $namabarang ;?></td>
                            <td style="text-align: left;"><?php echo $ukuran ;?></td>
                            <td><?php echo $merek ;?></td>
                            <td><?php echo $stok ;?></td>
                            <td class="justify-content-right align-content-between flex-wrap" style="width:35vh">
                                
                                <div class="row">
                                    <div class="col">
                                        <form action="detailbarang.php" method="post">
                                            <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                                            <button type="submit" name="cekdetail" class="btn btn-outline-success"><i class="fa-solid fa-info" ></i> Detail</button>
                                        </form>
                                    </div>
                                    <div class="col">
                                        <form action="editbarang.php" method="post">
                                            <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                                            <button type="submit" name="editbarang" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i>Edit</button>
                                        </form>  
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapus<?=$idbarang;?>"><i class="fa-regular fa-trash"></i></i>Hapus</button>
                                    </div>
                                </div>

                                
                               
                                
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="hapus<?=$idbarang;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda Yakin Ingin Menghapus <b><?php echo $namabarang; ?></b> ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                <form action="" method="post">
                                    <input type="hidden" name="idbarang" value="<?php echo $idbarang;?>">
                                    <button type="submit" class="btn btn-danger" name="hapusbarang">YA</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>

                       
                        <?php $i++;
                            };
                        };?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</body>
</html>
<?php
// untuk hapus barang
if(isset($_POST['hapusbarang'])){
    $idbarang = $_POST['idbarang'];

    $hpusbarng = mysqli_query($conn,"DELETE barang, gambar FROM barang LEFT JOIN gambar ON barang.ID_barang = gambar.ID_barang WHERE barang.ID_barang = '$idbarang'");
    if($hpusbarng){
      echo "<script>document.location='indexadmin.php';</script>";
    }
}
?>
