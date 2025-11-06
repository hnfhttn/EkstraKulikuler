<?php
// download.php
require('fpdf/fpdf.php');

// Ambil data (POST dari cetak.php)
$nama       = $_POST['namaLengkap'] ?? '';
$nisn       = $_POST['nisn'] ?? '';
$kelas      = $_POST['kelas'] ?? '';
$jurusan    = $_POST['jurusan'] ?? '';
$alamat     = $_POST['alamat'] ?? '';
$ekskul     = $_POST['ekstrakurikuler'] ?? '';

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

// Logo
$pdf->Image('logoskanilan.png', 10, 10, 25);
$pdf->Ln(25);

// Judul
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,8,'Bukti Pendaftaran Ekstrakurikuler',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,7,'SMK Negeri 9 Semarang',0,1,'C');

$pdf->Ln(6);

// Header biru
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(0,102,204);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0,9,'Data Pendaftaran Siswa',1,1,'C',true);

// Reset warna
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',12);

// Tabel isi (label kol 40-50 mm)
$labelW = 60;
$valW = 0; // sisanya

$pdf->Cell($labelW,12,'Nama Lengkap',1,0);
$pdf->Cell($valW,12,utf8_decode($nama),1,1);

$pdf->Cell($labelW,12,'NISN',1,0);
$pdf->Cell($valW,12,utf8_decode($nisn),1,1);

$pdf->Cell($labelW,12,'Kelas & Jurusan',1,0);
$pdf->Cell($valW,12,utf8_decode($kelas . ' ' . $jurusan),1,1);

$pdf->Cell($labelW,12,'Alamat',1,0);
$pdf->MultiCell(0,12,utf8_decode($alamat),1);

$pdf->Cell($labelW,12,'Ekstrakurikuler',1,0);
$pdf->Cell($valW,12,utf8_decode($ekskul),1,1);

// Tanda tangan area
$pdf->Ln(12);
$pdf->Cell(95,6,'Tanda Tangan Siswa,',0,0,'C');
$pdf->Cell(95,6,'Semarang, '.date('d F Y'),0,1,'C');

$pdf->Ln(20);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(95,6,utf8_decode($nama),0,0,'C');
$pdf->Cell(95,6,'(Orang Tua/Wali)',0,1,'C');

$pdf->Output('I','Bukti_Pendaftaran_'.$nama.'.pdf');
?>