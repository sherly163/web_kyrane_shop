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
    <title>Edit Barang</title>
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
        if(isset($_POST['editbarang'])){
            $idbarang = $_POST['idbarang'];
            
            $databarang = mysqli_query($conn,"SELECT * FROM barang WHERE ID_barang = '$idbarang'");
            $jmh = mysqli_num_rows($databarang);
            if($jmh > 0){
                while($dtbarang = mysqli_fetch_array($databarang)){
                    $idbarang = $dtbarang['ID_barang'];
                    $namabarang = $dtbarang['nama_barang'];
                    $hargabarang = $dtbarang['harga_barang'];
                    $merek = $dtbarang['merek'];
                    $stok = $dtbarang['stok'];
                    $ukuran = $dtbarang['ukuran'];
                    $deskripsi = $dtbarang['deskripsi'];
                    $fotobarang = $dtbarang['produk_image'];
                }
            }else{
                echo "kosong";
            };
        }

            //proses upload
            if(isset($_POST['update'])){
               
                $idBarang = $_POST['idbarang'];
                $namaBarang = $_POST['namaBarang'];
                $merek = $_POST['merek'];
                $harga = $_POST['harga'];
                $stok = $_POST['stok'];
                $ukuran = $_POST['ukuran'];
                $deskripsi = $_POST['deskripsi'];
                
                $tambahbarang = mysqli_query($conn, "UPDATE barang SET nama_barang ='$namaBarang' , harga_barang = '$harga' , merek = '$merek', stok ='$stok', ukuran ='$ukuran', deskripsi =  '$deskripsi' WHERE ID_barang = '$idBarang' ");
                if($tambahbarang){
                    header('location:indexadmin.php');
                }else{
                    echo 'gagal';
                    header('location:editbarang.php');
                }
            }
        
        ?>

        <div class="container">
        <div class="pagetambah" style="margin: 0 auto; max-width:95%">
            <div class="forform" style="min-width: 450px; max-width:60%; margin:0 auto;">
            <h3 style="text-align:left; margin-top:40px; margin-bottom: -16px;"><b>Edit Barang</b></h3><br><br>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Nama Barang</label>
                        <input type="text" name="namaBarang" value="<?php echo $namabarang;?>" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nama Barang..." require>
                    </div>
                     <div class="row">
                        <div class="col">
                        <label for="formGroupExampleInput" class="form-label">Harga</label>
                            <input type="number" name="harga" value="<?php echo $hargabarang;?>"class="form-control" placeholder="Masukkan Harga Barang..." aria-label="Masukkan Harga Barang..." require>
                        </div>
                        <div class="col">
                        <label for="formGroupExampleInput" class="form-label">Stok</label>
                            <input type="number" name="stok" value="<?php echo $stok;?>" class="form-control" placeholder="Masukkan Jumlah Stok..." aria-label="Masukkan Jumlah Stok..." require>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="formGroupExampleInput" class="form-label">Merek</label>
                            <input type="text" name="merek" value="<?php echo $merek;?>" class="form-control" placeholder="Masukkan Merek Barang..." aria-label="Masukkan Jenis Barang..." require>
                        </div>
                       <div class="col">
                        <label for="formGroupExampleInput" class="form-label">Ukuran</label>
                            <input type="text" name="ukuran" value="<?php echo $ukuran;?>" class="form-control" aria-label="Masukkan Harga Barang..." require>
                        </div>
                    </div>
                   
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Detail Barang</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" value="<?php echo $deskripsi;?>" placeholder="Masukkan Detail Barang...." requireds style="min-height: 150px;"><?php echo $deskripsi;?></textarea>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-8">
                            
                        </div>
                        <div class="col-2" style="width: 15%;">
                            <input type="hidden" name="idbarang" value="<?php echo $idbarang;?>">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-outline-primary" name="update" value="Update "><i class="fa-regular fa-paper-plane"></i> Update</button>
                        </div>
                    </div>
                    <div class="mb-3" style="justify-content: left; width:100%">
                       
                    </div>
                </form>
                <a href="indexadmin.php"><button type="button" class="btn btn-warning"><i class="fa-solid fa-caret-left"></i>BACK</button></a>
            </div>
            
        </div>
    </div>
</body>
</html>