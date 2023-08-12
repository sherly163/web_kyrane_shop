<?php
  session_start();
  require 'connection.php';
  require 'cek.php';
  require 'fungsi.php';
  $user = $_SESSION['user'];


  $datauser = mysqli_query($conn,"SELECT * FROM customer WHERE username = '{$user}'");
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
    <title>Setting</title>
</head>

<body style="background-color: #fff;">
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
      
      <div class="container">
      <h3 style="text-align:left; margin-top:40px; margin-bottom: -16px;"><b>Pengaturan</b></h3>
      <br><br>
      <div class="pagesetting" style="background-color:white; position:relative; border-radius:16px; box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.25);">
        <div class="textsetting">

        <a href="transaksi.php"><p>Riwayat Transaksi</p></a>
        
        <table>
        <?php 
  
          while($data=mysqli_fetch_array($datauser)){
            $idcustomer = $data['ID_customer'];
            $namacustomer = $data['nama_customer'];
            $username = $data['username'];
            $password = $data['password'];
            $nohp = substr($data['no_hp'],-2);
            
            $email = explode('@',$data['email']);
            $hitungnohp = strlen($data['no_hp'])-2;
            $semail = substr($data['email'],0,2);
            $hitungemail = strlen($email[0])-2;
        ?>
          <tr>
            <td style="height: 40px;">Username</td>
            <td style="width: 10px;">:</td>
            <td><b><?php echo $user;?></b></td>
          </tr>
          <tr>
            <td style="height: 50px;">Nama</td>
            <td>:</td>
            <td><b><?php echo $namacustomer;?></b></td>
            <td>
              <button type="button"  class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editNama">
                <i class="far fa-edit"></i>Edit</button>
            </td>
          </tr>
          <tr>
            <td style="height: 50px;">No handphone</td>
            <td>:</td>
            <td><b><?php for($i=0;$i<$hitungnohp;$i++){echo '*';} echo $nohp;?></b></td>
    
          </tr>
          <tr>
            <td style="height: 50px;">Email</td>
            <td>:</td>
            <td style="width: 300px;"><b><?php echo $semail; for($i=0;$i<$hitungemail;$i++){echo '*';} echo '@'.end($email);?></b></td>
            
          </tr>
          <tr>
            <td colspan="3">Ganti Password</td>
            
            <td>
              <a href="gantipassword.php"><button type="button"  class="btn btn-outline-primary">
                <i class="far fa-edit"></i>Edit</button></a>
            </td>
          </tr>
          <?php
          };
          ?>
        </table>
        </div>
      </div>

      <div class="pagesettingalamat" style="background-color:white; position:relative; border-radius:16px; box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.25);">
        <div class="textalamat">
          <button type="button" id="btnAlamat" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#TambahAlamat">Tambah Alamat  <i class="fa-solid fa-plus"></i></button>
          
          <?php
                $alamatuser = mysqli_query($conn,"Select * FROM alamat_customer WHERE ID_customer = '$idcustomer'");
                while($daftar = mysqli_fetch_array($alamatuser)){
                  $idalamat = $daftar['ID_alamat'];
                  $idcustomer = $daftar['ID_customer'];
                  $namaPenerima = $daftar['namaPenerima'];
                  $noHP = $daftar['NoHP'];
                  $prov = $daftar['prov'];
                  $kab = $daftar['kab'];
                  $kec = $daftar['kec'];
                  $detail_alamat = $daftar['detail_alamat'];
                
              ?>
            <div class="cardalamat">
              
                <table style=" width: 80%; margin: 20px auto; margin-left: 10px">
                  <tr>
                    <td>Nama Penerima</td>
                    <td>:</td>
                    <td><b><?php echo $namaPenerima;?></b></td>
                  </tr>
                  <tr>
                    <td>Nomor HP</td>
                    <td>:</td>
                    <td><b><?php echo $noHP;?></b></td>
                  </tr>
                  <tr>
                    <td colspan="3"><b>-----------------------------------------------------------------</b></td>
                  </tr>
                  <tr>
                    <td>Provinsi</td>
                    <td>:</td>
                    <td><b><?php echo $prov;?></b></td>
                  </tr>
                  <tr>
                    <td style="width: 200px;">Kabupaten</td>
                    <td style="width: 15px;">:</td>
                    <td><b><?php echo $kab;?></b></td>
                  </tr>
                  <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td><b><?php echo $kec;?></b></td>
                  </tr>
                  <tr>
                    <td>Detail</td>
                    <td>:</td>
                    <td><b><?php echo $detail_alamat;?></b></td>
                  </tr>
                </table>
                
                <div class="action" style="width: 20%;" style="display: flex; align-items: right;">
                  <table>
                    <tr>
                      <td>
                        <form method="post">
                          <input type="hidden" name="idalamat" value="<?=$idalamat;?>">
                          <button type="button"  class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editAlamat<?=$idalamat;?>">
                          <i class="far fa-edit"></i>Edit</button>
                        </form>
                      </td>
                      <td style="width: 20px;"></td>
                      <td>
                        <form method="post">
                          <input type="hidden" name="idalamat" value="<?=$idalamat;?>">
                          <button type="submit" name="HapusAlamat" class="btn btn-outline-danger" ><i class="fa-regular fa-trash"></i>delete</button>
                        </form>
                      </td>
                    </tr>
                  </table>
                </div>
            </div>
            <div class="foot" style="height: 30px;"></div>
             <!-- Modal Edit Alamat -->
            <div class="modal fade" id="editAlamat<?=$idalamat;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" style="background-color:#D9AC6B;">
                    <h5 class="modal-title" id="exampleModalLabel">Update Alamat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="post" >
                      <table style="width: 100%; padding:5px">
                        <tr>
                          <td>Nama Penerima</td>
                          <td><input type="text" name="namaPenerima" value="<?php echo $namaPenerima;?>" class="form-control" style="height: 35px; margin-top:10px;"></td>
                        </tr>
                        <tr>
                          <td>No Hp</td>
                          <td><input type="number" name="NoHP" value="<?php echo $noHP;?>" class="form-control" maxlength="14" style="height: 35px; margin-top:10px;"></td>
                        </tr>
                        <tr>
                          <td>Provinsi</td>
                          <td><input type="text" name="prov" value="<?php echo $prov;?>" class="form-control" style="height: 35px; margin-top:10px;"></td>
                        </tr>
                        <tr>
                          <td>Kabupaten</td>
                          <td><input type="text" name="kab" value="<?php echo $kab;?>" class="form-control" style="height: 35px; margin-top:10px;"></td>
                        </tr>
                        <tr>
                          <td>Kecamatan</td>
                          <td><input type="text" name="kec" value="<?php echo $kec;?>" class="form-control" style="height: 35px; margin-top:10px;"></td>
                        </tr>
                        <tr>
                          <td>Detail</td>
                          <td><textarea name="detail" value="<?php echo $detail_alamat;?>" id="detail" cols="30" rows="5" class="form-control" style="margin-top:10px;"><?php echo $detail_alamat;?></textarea></td>
                          
                        </tr>
                      </table>
                        <input type="hidden" name="idcust" value="<?=$idcustomer;?>">
                        <input type="hidden" name="idalamat" value="<?=$idalamat;?>">

                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="EditAlamat">Update</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php
              }
          ?>
        </div>

      </div>
      <div class="foot" style="height: 30px;"></div>
        

    </div>
    </div>
</body>

  <!-- Modal Tambah Alamat -->
  <div class="modal fade" id="TambahAlamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#D9AC6B;">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" >
            <table style="width: 100%; padding:5px">
            <tr>
                <td>Nama Penerima</td>
                <td><input type="text" name="namaPenerima" class="form-control" style="height: 35px; margin-top:10px;"></td>
              </tr>
              <tr>
                <td>No Hp</td>
                <td><input type="number" name="NoHP" class="form-control" maxlength="14" style="height: 35px; margin-top:10px;"></td>
              </tr>
              <tr>
                <td>Provinsi</td>
                <td><input type="text" name="prov" class="form-control" style="height: 35px; margin-top:10px;"></td>
              </tr>
              <tr>
                <td>Kabupaten</td>
                <td><input type="text" name="kab" class="form-control" style="height: 35px; margin-top:10px;"></td>
              </tr>
              <tr>
                <td>Kecamatan</td>
                <td><input type="text" name="kec" class="form-control" style="height: 35px; margin-top:10px;"></td>
              </tr>
              <tr>
                <td>Detail</td>
                <td><textarea name="detail" id="detail" cols="30" rows="5" class="form-control" style="margin-top:10px;"></textarea></td>
                
              </tr>
            </table>
              <input type="hidden" name="idcust" value="<?=$idcustomer;?>">

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="TambahAlamat">Tambah</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</html>

<!-- Modal -->
<div class="modal fade" id="editNama" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #D9AC6B;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Nama</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <input type="text" name="namacustomer" value="<?php echo $namacustomer ;?>">
      </div>
      <div class="modal-footer">
              <input type="hidden" name="idcustomer" value="<?php echo $idcustomer;?>">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="editNama">Update</button>
      </div>
        </form>
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