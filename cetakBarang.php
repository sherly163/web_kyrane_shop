<?php

    session_start();
    
   
    // memanggil library FPDF
    require('fpdf/fpdf.php');
    require 'connection.php';
   
    $user = $_SESSION['user'];
    function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
       
      }
      $barang = mysqli_query($conn,"SELECT * FROM barang");

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
$pdf->Cell(0, 20, 'LAPORAN BARANG', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(40, 7, 'TOTAL BARANG', 0, 0, 'L');
$pdf->Cell(5, 7, ':', 0, 0, 'R');
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(170, 7, $totalbarang, 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(45, 7, 'TOTAL TRANSAKSI', 0, 0, 'L');
$pdf->Cell(5, 7, ':', 0, 0, 'R');
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(40, 7, $totaltransaksi, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(40, 10, 'TOTAL STOK', 0, 0, 'L');
$pdf->Cell(5, 10, ':', 0, 0, 'R');
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(170, 10, $totalstok, 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(45, 7, 'TOTAL TERJUAL', 0, 0, 'L');
$pdf->Cell(5, 7, ':', 0, 0, 'R');
$pdf->SetFont('Arial', 'B', 15);

$pdf->Cell(40, 7, $totalterjual, 0, 1, 'L');
$pdf->Cell(10, 4, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 7, 'Waktu Cetak', 0, 0, 'L');
$pdf->Cell(5, 7, ':', 0, 0, 'R');
$pdf->Cell(40, 7, $waktu, 0, 1, 'L');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 6, 'No', 1, 0,'C');
$pdf->Cell(90, 6, 'Nama Barang', 1, 0,'C');
$pdf->Cell(45, 6, 'Merek', 1, 0,'C');
$pdf->Cell(45, 6, 'Ukuran', 1, 0,'C');
$pdf->Cell(34, 6, 'Stok', 1, 0,'C');
$pdf->Cell(40, 6, 'Harga', 1, 1,'C');
$pdf->SetFont('Arial', '', 10);
$i = 1;
while ($row = mysqli_fetch_array($barang)) {
    $pdf->Cell(10, 6, $i, 1, 0,'C');
    $pdf->Cell(90, 6, $row['nama_barang'], 1, 0);
    $pdf->Cell(45, 6, $row['merek'], 1, 0,'C');
    $pdf->Cell(45, 6, $row['ukuran'], 1, 0,'C');
    $pdf->Cell(34, 6, $row['stok'], 1, 0,'C');
    $pdf->Cell(40, 6, rupiah($row['harga_barang']), 1, 1,'R');
    $i++;
}

$pdf->Output();
