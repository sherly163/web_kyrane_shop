<?php
    session_start();
    require 'connection.php';
    require 'cek.php';
    $user = $_SESSION['user'];
  
  
    $datauser = mysqli_query($conn,"SELECT * FROM customer WHERE username = $user");
  
    function rupiah($angka){
      
      $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
      return $hasil_rupiah;
     
    }

    //Query untuk memanggil barang
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
    
    <?php


//proses upload
if(isset($_POST['upload'])){
    // $namaGambar = $_FILES['file']['name'];
    // $path = $_FILES['file']['tmp_name'];
    // move_uploaded_file($path, 'img/'.$namaGambar);

    // $namaGambar2 = $_FILES['foto2']['name'];
    // $path2 = $_FILES['foto2']['tmp_name'];
    // move_uploaded_file($path2, 'img/'.$namaGambar2);

    // $namaGambar3 = $_FILES['foto3']['name'];
    // $path3 = $_FILES['foto3']['tmp_name'];
    // move_uploaded_file($path3, 'img/'.$namaGambar3);

    $namaBarang = $_POST['namaBarang'];
    $merek = $_POST['merek'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    
    //Query update data
    $tambahbarang = mysqli_query($conn, "INSERT INTO barang (nama_barang, harga_barang, jenis_barang, merek,ukuran, warna, garansi, stok, deskripsi) VALUES ('$namaBarang','$harga','$jenis','$merek','$ukuran','$warna','$garansi','$stok','$deskripsi')");

    // var_dump($conn);
    // die();

    if($tambahbarang){
        $idBarang = mysqli_insert_id($conn);
        $countfiles = count($_FILES['file']['name']);
        // var_dump($idBarang);
        // die();


        for ($i=0; $i <$countfiles ; $i++) {
            $namaGambar = $_FILES['file']['name'][$i];
            $path = $_FILES['file']['tmp_name'][$i];
            move_uploaded_file($path, 'img/'.$namaGambar);

            $tambahgambar = mysqli_query($conn, "INSERT INTO gambar (produk_image,ID_barang) VALUES ('$namaGambar','$idBarang')");

            // var_dump($conn);
            // die();
        }
        header('location:indexadmin.php');
    }else{
        echo 'gagal';
        header('location:tambahbarang.php');
    }
}

?>

<div class="container">
<div class="pagetambah" style="margin: 0 auto; max-width:95%">
<div class="forform" style="min-width: 450px; max-width:60%; margin:0 auto;">
<h3 style="text-align:left; margin-top:40px; margin-bottom: -16px;"><b>Tambah Barang</b></h3><br><br>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Nama Barang</label>
            <input type="text" name="namaBarang" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nama Barang..." require>
        </div>
        <div class="row">
            <div class="col">
            <label for="formGroupExampleInput" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" placeholder="Masukkan Harga Barang..." aria-label="Masukkan Harga Barang..." require>
            </div>
            <div class="col">
            <label for="formGroupExampleInput" class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" placeholder="Masukkan Jumlah Stok..." aria-label="Masukkan Jumlah Stok..." require>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <label for="formGroupExampleInput" class="form-label">Merek</label>
                <input type="text" name="merek" class="form-control" placeholder="Masukkan Merek Barang..." aria-label="Masukkan Merek Barang..." require>
            </div>
            <div class="col">
            <label for="formGroupExampleInput" class="form-label">Ukuran</label>
                <input type="text" name="ukuran" class="form-control" placeholder="Masukkan Ukuran Stok..." aria-label="Masukkan Ukuran Stok..." require>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Detail Barang</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukkan Detail Barang...." requireds style="min-height: 150px;"></textarea>
            
        </div>
        <div class="mb-3">
            <input type="file" class="form-control" name="file[]" multiple>
        </div>
        <!-- <div class="mb-3">
            <input type="file" class="form-control" name="foto2">
        </div>
        <div class="mb-3">
            <input type="file" class="form-control" name="foto3">
        </div> -->
        <div class="row">
            <div class="col-8">
                
            </div>
            <div class="col-2">
                <input type="reset" class="btn btn-outline-secondary" style="height: 40px;" name="Reset" value="Reset">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-outline-primary" name="upload" value="Upload "><i class="fa-solid fa-upload"></i> Upload</button>
            </div>
        </div>
        <div class="mb-3" style="justify-content: left; width:100%">
           
        </div>
    </form>
    <a href="indexadmin.php"><button type="button" class="btn btn-warning" style="margin-bottom: 80px;"><i class="fa-solid fa-caret-left" ></i>BACK</button></a>
</div>

</div>
</div>
</body>
</html>