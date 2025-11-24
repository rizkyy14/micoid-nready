<?php 
require "assets/fpdf/fpdf.php";
require 'proses/panggil.php';

if (empty($_GET["id"])) {
    header("Location: ./");
    exit;
}

$id_order = strip_tags($_GET['id']);

// Ambil info customer dari pesanan
$stmtPesanan = $koneksi->prepare("SELECT * FROM pesanan WHERE id_order = ?");
$stmtPesanan->execute([$id_order]);
$pesanan = $stmtPesanan->fetch(PDO::FETCH_ASSOC);

if (!$pesanan) {
    die("Order tidak ditemukan.");
}

// Ambil detail pesanan beserta nama menu
$stmtDetail = $koneksi->prepare("
    SELECT dp.qty, dp.harga, m.nama_menu, m.gambar
    FROM detail_pesanan dp
    JOIN data_menu m ON dp.kode_menu = m.kode_menu
    WHERE dp.id_order = ?
");
$stmtDetail->execute([$id_order]);
$detail = $stmtDetail->fetchAll(PDO::FETCH_ASSOC);

// Buat PDF
$pdf = new FPDF();
$pdf->AddPage('P', 'A4');
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('Arial', '', 12);
$pdf->SetMargins(10, 10, 10);

/* --- Header --- */
$pdf->Image('../img/logo.png', 22, 17, 45, 36);
$pdf->SetFont('', '', 24);
$pdf->Text(94, 29, 'INVOICE PEMBAYARAN');
$pdf->Text(94, 41, 'MICO ID');
$pdf->SetFont('', '', 12);
$pdf->Text(94, 50, 'JL. Patriot, Medan, Sumatera Utara');
$pdf->SetLineWidth(1);
$pdf->Line(17, 60, 197, 60);

/* --- Info Customer --- */
$pdf->SetFont('', 'B', 12);
$pdf->Text(20, 70, 'Nama Customer:');
$pdf->SetFont('', '', 12);
$pdf->Text(60, 70, $pesanan['namacust']);

$pdf->SetFont('', 'B', 12);
$pdf->Text(20, 78, 'Alamat:');
$pdf->SetFont('', '', 12);
$pdf->Text(60, 78, $pesanan['address']);

$pdf->SetFont('', 'B', 12);
$pdf->Text(20, 86, 'No HP:');
$pdf->SetFont('', '', 12);
$pdf->Text(60, 86, $pesanan['nohp']);

$pdf->SetFont('', 'B', 12);
$pdf->Text(20, 94, 'Tanggal Order:');
$pdf->SetFont('', '', 12);
$pdf->Text(60, 94, $pesanan['tanggalOrder']);

/* --- Table Header --- */
$pdf->SetY(110);
$pdf->SetX(15);
$pdf->SetFont('', 'B', 12);
$pdf->Cell(10, 8, 'No', 1, 0, 'C');
$pdf->Cell(80, 8, 'Nama Menu', 1, 0, 'C');
$pdf->Cell(20, 8, 'Qty', 1, 0, 'C');
$pdf->Cell(35, 8, 'Harga', 1, 0, 'C');
$pdf->Cell(35, 8, 'Subtotal', 1, 1, 'C');

/* --- Table Content --- */
$pdf->SetFont('', '', 12);
$no = 1;
$total = 0;
foreach ($detail as $item) {
    $subtotal = $item['qty'] * $item['harga'];
    $total += $subtotal;
    $pdf->SetX(15);

    $pdf->Cell(10, 8, $no++, 1, 0, 'C');
    $pdf->Cell(80, 8, $item['nama_menu'], 1, 0);
    $pdf->Cell(20, 8, $item['qty'], 1, 0, 'C');
    $pdf->Cell(35, 8, 'Rp '.number_format($item['harga'],0,",","."), 1, 0, 'R');
    $pdf->Cell(35, 8, 'Rp '.number_format($subtotal,0,",","."), 1, 1, 'R');
}

/* --- Total --- */
$pdf->SetX(15);
$pdf->SetFont('', 'B', 12);
$pdf->Cell(145, 8, 'Total', 1, 0, 'R');
$pdf->Cell(35, 8, 'Rp '.number_format($total,0,",","."), 1, 1, 'R');

$pdf->Output('INVOICE_'.$id_order.'.pdf','I');
