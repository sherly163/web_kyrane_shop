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
          margin-bottom: 30px;
          min-height: 400px;
        
      }

    </style>
</head>

<body style="background-color: #f5f5f5;">
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
                        <li><a class="dropdown-item" href="setting.php">Setting</a></li>
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
      <h3 style="text-align:center;">Ongkir</h3>
      <br><br>
    </div>

   
    
    <div class="forform" style="min-width: 450px; max-width:60%; margin:0 auto;">
    <head>
  <script src="jquery-3.6.0.min.js"></script>
</head>
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

    <form action="pembayaran.php" method="post">
    <div id="tampil_ongkir" > </div>
    
     <a class="btn btn-primary" href="pembayaran.php" role="button">Next</a>
                  </form>

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
    </div>
  </body>
  </html>


