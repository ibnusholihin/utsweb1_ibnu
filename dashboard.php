<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode   = $_POST['kode']   ?? '';
    $nama   = $_POST['nama']   ?? '';
    $harga  = (int)($_POST['harga']   ?? 0);
    $qty    = (int)($_POST['jumlah']  ?? 0);  

    $lineTotal   = $harga * $qty;
    $grandtotal  = $lineTotal;

    if ($grandtotal == 0) {
        $d = "0%";
        $diskon = 0;
    } elseif ($grandtotal < 50000) {
        $d = "5%";
        $diskon = 0.05 * $grandtotal;
    } elseif ($grandtotal <= 100000) {
        $d = "10%";
        $diskon = 0.10 * $grandtotal;
    } else {
        $d = "15%";
        $diskon = 0.15 * $grandtotal;
    }

    $totalbayar = $grandtotal - $diskon;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #f0f8ff, #e6e6fa);
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        p {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .logout-btn {
            display: block;
            margin: 0 auto 20px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .logout-btn:hover {
            background-color: #d32f2f;
        }
        .shopping-list {
            margin: 20px 0;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        .item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }
        .item:last-child {
            border-bottom: none;
        }
        .summary {
            margin-top: 20px;
            padding: 10px;
            background: #e8f5e8;
            border-radius: 5px;
            text-align: center;
        }
        .summary p {
            margin: 5px 0;
            font-weight: bold;
        }
        form div {
            margin-bottom: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>--POLGAN MART--</h1>
        <p>SELAMAT DATANG TUAN <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <a href="logout.php"><button class="logout-btn">Logout</button></a>
        
        <form method="post">
            <div>
                <label>Kode Barang</label><br>
                <input type="text" name="kode" value="<?php echo htmlspecialchars($_POST['kode'] ?? ''); ?>">
            </div>
            <div>
                <label>Nama Barang</label><br>
                <input type="text" name="nama" value="<?php echo htmlspecialchars($_POST['nama'] ?? ''); ?>">
            </div>
            <div>
                <label>Harga</label><br>
                <input type="number" name="harga" min="0" value="<?php echo htmlspecialchars($_POST['harga'] ?? ''); ?>">
            </div>
            <div>
                <label>Jumlah</label><br>
                <input type="number" name="jumlah" min="1" value="<?php echo htmlspecialchars($_POST['jumlah'] ?? 1); ?>">
            </div>
            <div style="margin-top:8px;">
                <button type="submit">Kirim</button>
            </div>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Daftar Pembelian</h2>
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Harga (Rp)</th>
                    <th>Jumlah</th>
                    <th>Total Baris (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($kode); ?></td>
                    <td><?php echo htmlspecialchars($nama); ?></td>
                    <td style="text-align:right;"><?php echo number_format($harga, 0, ',', '.'); ?></td>
                    <td style="text-align:center;"><?php echo htmlspecialchars($qty); ?></td>
                    <td style="text-align:right;"><?php echo number_format($lineTotal, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align:right;"><strong>Subtotal</strong></td>
                    <td style="text-align:right;"><?php echo number_format($grandtotal, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;"><strong>Diskon (<?php echo htmlspecialchars($d); ?>)</strong></td>
                    <td style="text-align:right;"><?php echo number_format($diskon, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;"><strong>Total Bayar</strong></td>
                    <td style="text-align:right;"><?php echo number_format($totalbayar, 0, ',', '.'); ?></td>
                </tr>
            </tfoot>
        </table>
        <?php endif; ?>
    </div>
</body>
</html>