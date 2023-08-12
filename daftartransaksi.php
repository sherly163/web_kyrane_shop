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
    <title>Daftar Transaksi</title>
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
        <!-- Akhir footer/nav -->

        <!-- Akhir Rekap -->

        <div class="container">
        <div class="list">
        <h2 style="text-align:left; margin-left:24px; margin-top:40px; margin-bottom: -16px;"><b>Transaksi</b></h2><br><br>
            <div class="ttabble" style="width: 95%; margin: 0 auto; margin-top:10px">
            <div class="row">
                        <div class="col-5">
                        </div>
                        <div class="col-5">
                        </div>
                        <div class="col-2" style=" display:flex; justify-content: end;">
                            <a href="cetakTransaksi.php"><button type="button" class="btn btn-outline-warning" style="min-width: 100px;"><i class="fa-regular fa-print"></i> Cetak Transaksi</button></a>
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
                        if(isset($_POST['btnStatus'])){
                            $idtransaksi = $_POST['idtransaksi'];
                            $status = $_POST['status'];

                            $updatestatus = mysqli_query($conn, "UPDATE transaksi SET status = '$status' WHERE idtransaksi = '$idtransaksi'");
                        }

                        $sdata = 1;
                        
                        $transaksi = mysqli_query($conn,"SELECT * FROM transaksi LEFT JOIN  customer ON transaksi.idcustomer = customer.ID_customer LEFT JOIN barang ON transaksi.idbarang = barang.ID_barang LEFT JOIN  alamat_customer ON transaksi.idalamat = alamat_customer.ID_alamat");
                        
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
                            <td><?php echo $status ;?> <i data-bs-toggle="modal" data-bs-target="#editStatus<?=$idtransaksi;?>" class="fa-solid fa-pen" style="cursor:pointer;"></i></td>
                            <td style="text-align: right;">
                                <form action="detailTransaksi.php" method="post">
                                    <input type="hidden" name="idtransaksi" value="<?=$idtransaksi;?>">
                                    <button type="submit" name="cekdetail" class="btn btn-outline-warning"><i class="fa-solid fa-info" ></i> Detail</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal Edit Transaksi-->
                            <div class="modal fade" id="editStatus<?=$idtransaksi;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="daftartransaksi.php" method="post">
                                        <select class="form-select" name="status">
                                            <option value="<?php echo $status;?>"><?php echo $status;?></option>
                                            <option value="">-----------</option>
                                            <option value="Diproses">Diproses</option>
                                            <option value="Dibayar">Dibayar</option>
                                            <option value="Dikemas">Dikemas</option>
                                            <option value="Dikirim">Dikirim</option>
                                            <option value="Selesai">Selesai</option>
                                            <option value="Dibatalkan">Dibatalkan</option>
                                        </select>
                                        <input type="hidden" name="idtransaksi" value="<?=$idtransaksi;?>">
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="btnStatus" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>

    
                        <?php $i++;
                            };
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</body>
</html>