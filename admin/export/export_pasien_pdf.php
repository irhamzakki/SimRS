<?php
include_once("../../library/koneksi.php");
require_once "../../library/fpdf/fpdf.php";



$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,7,'DATA PASIEN KLINIK',0,1,'C');
$pdf->Ln(3);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No',1,0,'C');
$pdf->Cell(30,6,'No Pasien',1,0,'C');
$pdf->Cell(40,6,'Nama',1,0,'C');
$pdf->Cell(30,6,'JK',1,0,'C');
$pdf->Cell(50,6,'Alamat',1,0,'C');
$pdf->Cell(30,6,'No. Telp',1,1,'C');

$pdf->SetFont('Arial','',10);
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY no_pasien ASC");
while ($data = mysqli_fetch_array($query)) {
    $pdf->Cell(10,6,$no++,1,0,'C');
    $pdf->Cell(30,6,$data['no_pasien'],1,0);
    $pdf->Cell(40,6,$data['nm_pasien'],1,0);
    $pdf->Cell(30,6,$data['j_kel'],1,0);
    $pdf->Cell(50,6,$data['alamat'],1,0);
    $pdf->Cell(30,6,$data['no_tlp'],1,1);
}

$pdf->Output();
?>
