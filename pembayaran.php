<?php
  session_start();
  require 'connection.php';
  require 'cek.php';
  require 'fungsi.php';
  $user = $_SESSION['user'];



  $userdata = mysqli_query($conn,"SELECT * FROM customer WHERE username = '{$user}'");
  while($data=mysqli_fetch_array($userdata)){
    $idcustomer = $data['ID_customer'];
    $namacustomer = $data['nama_customer'];}


  function rupiah($angka){
  
    $hasil_rupiah = "Rp" . number_format($angka,0,',','.');
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

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleval.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <style>
      .pagebayar{
          background-color: #ececec;
          border-radius: 5px;
          box-shadow: 0.5px 0.5px 5px #d4d4d4;
          min-height: 400px;
        
      }

    </style>
    <script src="jquery-3.6.0.min.js"></script>
</head>

<body style="background-color: #FFF;">
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
      <div class="container">
      <h3 style="text-align:left; margin-top:40px; margin-bottom: -16px;"><b>Pembayaran</b></h3>
      <br><br>
      
      <div class="d-flex justify-content-start align-content-between flex-wrap">
      <div class="pagepembayaran" style="width: 53%; height:300px; background-color:white; position:relative; border-radius:16px; box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.25);">
        <h5><i class="fa-solid fa-location-dot" style="padding: 24px;"></i><strong>Alamat Pengiriman</strong></h5>
        <div class="textpembayaran">
          <br>
            <table style="margin: 0 auto; width:95%;">
            <?php
                $alamatuser = mysqli_query($conn,"Select * FROM alamat_customer WHERE ID_customer = $idcustomer");
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
          
              <tr>
                <td style="width: 300px;"><b><?php echo $namaPenerima;?></b></td>
                <td rowspan="3" style="width:800px"><?php echo $detail_alamat.' Kec.'.$kec.' Kab.'.$kab.','.$prov;?></td>
              </tr>
              <tr>
              <td><b><?php echo $noHP;?></b></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <?php };?>
            </table>
        </div>
        
      </div>

      <div class="pageproduk" style="width: 45%; height:300px; margin-left:24px; background-color:white; position:relative; border-radius:16px; box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.25);">
        <h5><b><i class="fa-regular fa-cart-shopping" style="padding: 24px;"></i> Produk dibeli</b></h5>
        <div class="textpembayaran">
          <br>
            <table style="margin: 0 auto; width:95%;">
              <tr align="center" style="height: 10px; color: grey;">
                <td>Nama produk</td>
                <td></td>
                <td>harga</td>
                <td>Jumlah</td>
                <td align="left">SubTotal</td>
              </tr>
              <?php
              if(isset($_POST['beli'])){
                $idbrg = $_POST['idbarang'];
                $banyak = $_POST['banyak'];
              }
              $databarang = mysqli_query($conn,"SELECT * FROM barang WHERE ID_barang = $idbrg");
              while($barang = mysqli_fetch_array($databarang)){
                $idbarang = $barang['ID_barang'];
                $namabarang = $barang['nama_barang'];
                $hargabarang = $barang['harga_barang'];
                $jenisbarang = $barang['jenis_barang'];
                $ukuran = $barang['ukuran'];
                $stok = $barang['stok'];
                $deskripsi = $barang['deskripsi'];
                $fotobarang = $barang['produk_image'];
              }
              
              ?>
              <?php $qty = $banyak;?>
              <tr>
                <form action="" method="post">
                <td style="width: 50%;" align="center"><?php echo $namabarang;?></td>
                <td style="width: 15%;" align="center"><?php echo $jenisbarang;?></td>
                <td style="width: 10%" align="center" id="harga"><?php echo rupiah($hargabarang);?></td>
                <td style="width: 10%" align="center"> <?php echo $qty;?> </td>
                <td style="width: 15%;" id="subtot"><?php $subtot = $qty * $hargabarang; echo rupiah($subtot);?></td>
              </tr>
              <tr style="height: 20px;">
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
              <tr style="height: 10px;">
                <td></td>
                <td></td>
                
                <td colspan="3"></td>
              </tr>
              <tr style="height: 30px;">
                <td></td>
                <td></td>
                <td><b style="color: #ee4d2d;">Total</b></td>
                <td></td>
                <td><b style="color: #ee4d2d;"><?php $tot = $subtot; echo rupiah($tot);?></b></td>
              </tr>
              
            </table>
        </div>
      </div>
      </div>

            <div class="pagebayar" style="height:600px; background-color:white; position:relative; border-radius:16px; box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.25); margin-bottom: 30px;">
        <h5><b><i class="fa-regular fa-money-bill" style="padding: 24px;"></i> Ongkos Kirim</b></h5>
        <div class="textpembayaran" style="width: 95%; margin: 0 auto;">
          <br>
          <table>
            <?php 
    //Get Data Provinsi
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
        "key:f82deb47b25782635b3820e48f90dbf6"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
?>
    <label>Provinsi</label><br>
    <select name='provinsi' id='provinsi'>";
        <option>Pilih Provinsi</option>
        <?php
        $get = json_decode($response, true);
        for ($i=0; $i < count($get['rajaongkir']['results']); $i++):
        ?>
            <option  value="<?php echo $get['rajaongkir']['results'][$i]['province_id']; ?>"  ><?php echo $get['rajaongkir']['results'][$i]['province']; ?></option>
        <?php endfor; ?>
    </select><br>

    <label>Kabupaten</label><br>
    <select id="kabupaten" name="kabupaten" >
    <!-- Data kabupaten akan diload menggunakan AJAX -->
    </select> <br>

    <label>Kurir</label><br>
    <select class="form-control" id="kurir" name="kurir" >
        <option value="">Pilih Kurir</option>
        <option value="jne">JNE</option>
        <option value="tiki">TIKI</option>
        <option value="pos">POS INDONESIA</option>
    </select>

    
    <div id="tampil_ongkir" > </div>
 
    <script>
  $('#provinsi').change(function(){
 
        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
        var prov = $('#provinsi').val();
        var nama_provinsi = $(this).attr("nama_provinsi");
        $.ajax({
            type : 'GET',
            url : 'ambil-kabupaten.php',
            data :  'prov_id=' + prov,
                success: function (data) {

                //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                $("#kabupaten").html(data);
            }
        });
    });


    $('#kurir').change(function(){

        //Mengambil value dari option select provinsi asal, kabupaten, kurir kemudian parameternya dikirim menggunakan ajax
        var kab = $('#kabupaten').val();
        var kurir = $('#kurir').val();
   
        $.ajax({
            type : 'POST',
            url : 'tabel-ongkir.php',
            data :  {'kab_id' : kab, 'kurir' : kurir},
                success: function (data) {

                //jika data berhasil didapatkan, tampilkan ke dalam element div tampil_ongkir
                $("#tampil_ongkir").html(data);

 
            }
        });
    });

    </script>
          

          </table>
          <br><br>
          
      </div>
          
              </tr>
              
            </table>
        </div>
      <div class="pagebayar" style="height:450px; background-color:white; position:relative; border-radius:16px; box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.25);">
        <h5><b><i class="fa-regular fa-money-bill" style="padding: 24px;"></i> Pembayaran</b></h5>
        <div class="textpembayaran" style="width: 95%; margin: 0 auto;">
          <br>
          <table>
            <tr>
              <td>Pembayaran Via Transfer Bank:</td>
              <td style="width: 10px;"></td>
              <td></td>
            </tr>
            <tr>
              <td>Nama Bank</td>
              <td>: </td>
              <td style="width: 600px;"><b>Bank BCA</b></td>
              
            
            </tr>
            <tr>
              <td>Atas Nama</td>
              <td>: </td>
              <td><b> Kyrane</b></td>

  
            </tr>
            <tr>
              <td>Nomor Rekening</td>
              <td>: </td>
              <td><b>4441 1232 49</b></td>
             
              
            </tr>
            <tr style="height: 50px;">
              <td>Pembayaran Via ShopeePay:</td>
              <td></td>
              <td></td>
              
         
            </tr>
            <tr>
              <td>Atas Nama</td>
              <td>: </td>
              <td><b>Kyrane Shop</b></td>
            </tr>
            <tr>
              <td>Nomor HP</td>
              <td>: </td>
              <td><b>085155408879</b></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td><button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#qrshopee">QR Shopeepay</button></td>
            </tr>

          </table>
          <br><br>
          <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
            <input type="hidden" name="idcustomer" value="<?=$idcustomer;?>">
            <input type="hidden" name="idalamat" value="<?=$idalamat;?>">
            <input type="hidden" name="totalbayar" value="<?=$total;?>">
            <input type="hidden" name="qty" value="<?=$qty;?>">

            <a href="bukti.php"><button type="submit" name="bayar" class="btnbeli"  style="width:250px; height:35px ;position: relative; margin-right:30px; float: right;">bayar sekarang</button></a>
            </form>
        </div>
      </div>
      <div class="foot" style="height: 30px;"></div>
    </div>
    </div>
</body>


<!-- Modal QR -->
<div class="modal fade" id="qrshopee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">QRIS SHOPEEPAY</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="display:flex; justify-content: center; width:100%">
        <img src="img/qrshopeepay.jpg" style="max-width: 350px; margin:0 auto;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
</html>
<script>
function sum() {
      var txtFirstNumberValue = document.getElementById('qty').value;
      var txtSecondNumberValue = document.getElementById('harga').value;
      var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('subtot').value = result;
      }
}
</script>



