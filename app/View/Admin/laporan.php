<?php
require_once __DIR__ . '/../../../vendor/autoload.php'; // Memuat autoload Composer

use Dompdf\Dompdf;
use Dompdf\Options;
function format_rupiah($angka) {
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}
// Initialize Dompdf with options
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);

$no = 1;
ob_clean();
ob_flush();
// Create HTML content
// Konten HTML untuk tabel
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Transaksi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Ambil</th>
                    <th scope="col">Jenis Kain</th>
                    <th scope="col">Berat</th>
                    <th scope="col">Bayar</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>';

// Sample data (dapat diganti dengan data dari model Anda)


$no = 1;
foreach ($model['data'] as $customer) {
    $html .= '<tr>';
    $html .= '<td>' . $no++ . '</td>';
    $html .= '<td>' . $customer['name'] . '</td>';
    $html .= '<td>' . $customer['order_date'] . '</td>';
    $html .= '<td>' . $customer['item_name'] . '</td>';
    $html .= '<td>' . $customer['quantity'] . '</td>';
    $html .= '<td>' . format_rupiah($customer['total_amount']). '</td>';
    $html .= '<td>' . $customer['status'] . '</td>';
    $html .= '</tr>';
}

$html .= '
            </tbody>
        </table>
    </div>
</body>
</html>
';

// Memuat konten HTML ke dalam Dompdf
$dompdf->loadHtml($html);

// (Optional) Pengaturan PDF
$dompdf->setPaper('A4', 'portrait'); // Ukuran kertas dan orientasi (portrait atau landscape)

// Render PDF (mengubah HTML menjadi PDF)
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("laporan.pdf", ["Attachment" => 0]);
?>