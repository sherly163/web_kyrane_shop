<?php

    session_start();
    
    // memanggil library FPDF
    require('fpdf/fpdf.php');

    require 'connection.php';
    
    
    $user= $_SESSION['user'];
    function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
       
      }
      $transaksi = mysqli_query($conn,"SELECT * FROM transaksi LEFT JOIN  customer ON transaksi.idcustomer = customer.ID_customer LEFT JOIN barang ON transaksi.idbarang = barang.ID_barang LEFT JOIN  alamat_customer ON transaksi.idalamat = alamat_customer.ID_alamat");
                                         
        
        // $transaksi = mysqli_query($conn,"SELECT * FROM tbl_transaksi");
        $totaltransaksi = mysqli_num_rows($transaksi);
        if($totaltransaksi <= 0){
            $totalterjual = 0;
        }else{
            $terjual = mysqli_query($conn,"SELECT SUM(qty) AS total_terjual FROM transaksi;");
            while($dt = mysqli_fetch_array($terjual)){
                $totalterjual = $dt['total_terjual'];
            }
        }
        
        $t=date_create();
        $date=date_create();
        date_timezone_set($date,timezone_open("Asia/Jakarta"));
        $waktu =  date_format($date,"l, H:i:s, d/m/Y");
     

        
        
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
$pdf->AliasNbPages();
// membuat halaman baru

$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 20);
// mencetak string
$pdf->Cell(0, 20, 'LAPORAN TRANSAKSI', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(45, 7, 'TOTAL TRANSAKSI', 0, 0, 'L');
$pdf->Cell(5, 7, ':', 0, 0, 'R');
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(40, 7, $totaltransaksi, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(45, 7, 'TOTAL TERJUAL', 0, 0, 'L');
$pdf->Cell(5, 7, ':', 0, 0, 'R');
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(40, 7, $totalterjual, 0, 1, 'L');


$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(45, 7, 'Waktu Cetak', 0, 0, 'L');
$pdf->Cell(5, 7, ':', 0, 0, 'R');
$pdf->Cell(40, 7, $waktu, 0, 1, 'L');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(8, 6, 'No', 1, 0,'C');
$pdf->Cell(36, 6, 'Waktu Transaksi', 1, 0,'C');
$pdf->Cell(50, 6, 'Nama Customer', 1, 0,'C');
$pdf->Cell(28, 6, 'Nomor HP', 1, 0,'C');
$pdf->Cell(90, 6, 'Nama Barang', 1, 0,'C');
$pdf->Cell(14, 6, 'Qty', 1, 0,'C');
$pdf->Cell(30, 6, 'Harga Barang', 1, 0,'C');
$pdf->Cell(25, 6, 'Status', 1, 1,'C');
$pdf->SetFont('Arial', '', 10);
$i = 1;
while ($row = mysqli_fetch_array($transaksi)) {
    $pdf->Cell(8, 6, $i, 1, 0,'C');
    $pdf->Cell(36, 6, $row['waktu'], 1, 0,'C');
    $pdf->Cell(50, 6, $row['nama_customer'], 1, 0);
    $pdf->Cell(28, 6, $row['no_hp'], 1, 0,'C');
   
    $pdf->Cell(90, 6, $row['nama_barang'], 1, 0,'L');
    $pdf->Cell(14, 6, $row['qty'], 1, 0,'C');
    $pdf->Cell(30, 6, rupiah($row['harga_barang']), 1, 0,'R');
    $pdf->Cell(25, 6, $row['status'], 1, 1,'C');
    $i++;
}

$pdf->Output();
