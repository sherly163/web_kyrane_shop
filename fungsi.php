<?php
    require 'connection.php';

    // Update Nama
    if(isset($_POST['editNama'])){
        $idcust = $_POST['idcustomer'];
        $namacust = $_POST['namacustomer'];

        $editNama = mysqli_query($conn, "UPDATE customer SET nama_customer = '$namacust' WHERE ID_customer = '$idcust'");
        if($editNama){
            header('location:setting.php');
        } else{
            echo 'gagal';
            header('location:setting.php');
        }
    }
    //Tambah Alamat
    if(isset($_POST['TambahAlamat'])){
        $idcust = $_POST['idcust'];
        $namaPenerima = $_POST['namaPenerima'];
        $NoHP = $_POST['NoHP'];
        $prov = $_POST['prov'];
        $kab = $_POST['kab'];
        $kec = $_POST['kec'];
        $detail = trim($_POST['detail']);

        $tambahalamat = mysqli_query($conn,"INSERT INTO alamat_customer (ID_customer,namaPenerima, NoHP, prov, kab, kec, detail_alamat) values('$idcust','$namaPenerima','$NoHP','$prov','$kab','$kec','$detail')"); 
        if($tambahalamat){
            header('location:setting2.php');
        } else{
            echo 'gagal';
            header('location:setting2.php');
        }
    };

    // Edit Alamat
    if(isset($_POST['EditAlamat'])){
        $idcust = $_POST['idcust'];
        $idalamat = $_POST['idalamat'];
        $namaPenerima = $_POST['namaPenerima'];
        $NoHP = $_POST['NoHP'];
        $prov = $_POST['prov'];
        $kab = $_POST['kab'];
        $kec = $_POST['kec'];
        $detail = trim($_POST['detail']);

        $editAlamat = mysqli_query($conn, "UPDATE alamat_customer SET namaPenerima = '$namaPenerima', NoHP ='$NoHP', prov = '$prov', kab='$kab', kec = '$kec', detail_alamat='$detail' WHERE ID_alamat = '$idalamat'");
        if($editAlamat){
            header('location:setting2.php');
        } else{
            echo 'gagal';
            header('location:setting2.php');
        }
    }

    //menghapus Alamat
    if(isset($_POST['HapusAlamat'])){
        $idalamat = $_POST['idalamat'];

        $hapus = mysqli_query($conn, "DELETE FROM alamat_customer WHERE ID_alamat='$idalamat'");

        if($hapus){
            header('location:setting.php');
        } else{
            echo 'gagal';
            header('location:setting.php');
        }
    };

    //Transaksi
    if(isset($_POST['bayar'])){
        
        $idcust = $_POST['idcustomer'];
        $idbarang =$_POST['idbarang'];
        $idalamat = $_POST['idalamat'];
        $qty = $_POST['qty'];
        $totalharga = $_POST['totalbayar'];
        $status = 'Diproses';

        $ambilstok = mysqli_query($conn,"SELECT * FROM barang WHERE ID_barang = '$idbarang'");
        while($dt = mysqli_fetch_array($ambilstok)){
            $stok = $dt['stok'];
        }
        
        if($stok > $qty){
            $sisa = $stok - $qty;
            $updatestok = mysqli_query($conn, "UPDATE barang SET stok = '$sisa' WHERE ID_barang = '$idbarang'");
            $tambahalamat = mysqli_query($conn,"INSERT INTO transaksi (idcustomer, idbarang, idalamat, qty, totalharga, status) values('$idcust','$idbarang','$idalamat','$qty','$totalharga','$status')"); 
            
            if($tambahalamat){
                
                header('location:bukti.php');
                echo "<div class='alert alert-success'>
                        <strong>Pemesanan Success!</strong>
                        </div>";
            } else{
                echo 'gagal';
                header('location:bukti.php');
            }
        }
        
    };

?>