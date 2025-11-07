<?php
session_start();

// Jika belum login, arahkan kembali ke login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Data produk
$kode_barang  = ["B01", "B02", "B03", "B04", "B05"];
$nama_barang  = ["Susu", "coca cola", "Roti", "aqua", "biskuit"];
$harga_barang = [15000, 10000, 12000, 8000, 6000];

// Data belanja acak
$beli = [];
$grandtotal = 0;

for ($i = 0; $i < 5; $i++) {
    $index = rand(0, count($kode_barang) - 1);
    $jumlah = rand(1, 5);
    $total = $harga_barang[$index] * $jumlah;
    $grandtotal += $total;

    $beli[] = [
        "kode" => $kode_barang[$index],
        "nama" => $nama_barang[$index],
        "harga" => $harga_barang[$index],
        "jumlah" => $jumlah,
        "total" => $total
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - POLGAN MART</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F5F6FDFF;
            margin: 0;
            padding: 0;
        }

        /* ===== HEADER STYLE ===== */
        header {
            background-color: #F5F6FDFFF;
            color: Black;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Bagian kiri: logo + teks */
        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Logo PM dalam persegi biru */
        .logo {
            background-color: #007bff; /* Biru solid */
            color: white;
            font-weight: bold;
            font-size: 22px;
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px; /* sedikit melengkung di sudut */
            box-shadow: 0 3px 6px rgba(0,0,0,0.3);
            border: 2px solid #0056b3;
            font-family: 'Arial Black', sans-serif;
        }

        .logo-text {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* Kanan: selamat datang + logout */
        .user-info {
            text-align: right;
            line-height: 1.5;
        }

        .user-info p {
            margin: 0;
            font-weight: bold;
        }

        .logout-btn {
            display: inline-block;
            margin-top: 5px;
            color: #110806FF;
            text-decoration: none;
            font-weight: bold;
        }

        .logout-btn:hover {
            text-decoration: underline;
        }

        /* ===== BODY CONTENT ===== */
        .container {
            width: 80%;
            margin: 30px auto;
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        h2, h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #273c75;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f2f6;
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 18px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<header>
    <!-- Kiri: logo + nama toko -->
    <div class="logo-container">
        <div class="logo">PM</div>
        <div class="logo-text">--POLGAN MART--</div>
    </div>

    <!-- Kanan: selamat datang + logout -->
    <div class="user-info">
        <p>Selamat Datang, <b>Admin</b></p>
        <a class="logout-btn" href="logout.php">Logout</a>
    </div>
</header>

<div class="container">
    <h3>Daftar Pembelian</h3>

    <table>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>

        <?php foreach ($beli as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item["kode"]) ?></td>
            <td><?= htmlspecialchars($item["nama"]) ?></td>
            <td>Rp <?= number_format($item["harga"], 0, ',', '.') ?></td>
            <td><?= $item["jumlah"] ?></td>
            <td>Rp <?= number_format($item["total"], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <p class="total">Total Belanja: 
        <span style="color:#0A0301FF;">Rp <?= number_format($grandtotal, 0, ',', '.') ?></span>
    </p>
</div>

</body>
</html>
