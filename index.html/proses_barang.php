<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "karangtaruna");

if (!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error());
}

// 1. Ambil file yang di-upload
$nama_file = $_FILES['bukti_bayar']['name'] ?? '';
$tmp_file = $_FILES['bukti_bayar']['tmp_name'] ?? '';
$folder_upload = "uploads/";

if (!file_exists($folder_upload)) {
    mkdir($folder_upload, 0777, true);
}

// Proses pemindahan file
$upload_ok = false;
if (!empty($nama_file) && move_uploaded_file($tmp_file, $folder_upload . $nama_file)) {
    $upload_ok = true;
}

// 2. Ambil data dari form
$resi = "RESI" . date("YmdHis") . rand(100, 999);
$pengirim = mysqli_real_escape_string($conn, $_POST['pengirim']);
$hppengirim = mysqli_real_escape_string($conn, $_POST['hppengirim']);
$alamat_pengirim = mysqli_real_escape_string($conn, $_POST['alamat_pengirim']);
$penerima = mysqli_real_escape_string($conn, $_POST['penerima']);
$hppenerima = mysqli_real_escape_string($conn, $_POST['hppenerima']);
$alamat_penerima = mysqli_real_escape_string($conn, $_POST['alamat_penerima']);
$barang = mysqli_real_escape_string($conn, $_POST['barang']);
$berat = (float)$_POST['berat'];
$biaya = $berat * 15000;
$kurir = $_POST['kurir'];
$layanan = $_POST['layanan'];
$catatan = mysqli_real_escape_string($conn, $_POST['catatan']);
$status = "Menunggu Pengiriman";

// 3. Simpan ke database
$sql = "INSERT INTO pengiriman_barang (resi, pengirim, hppengirim, alamat_pengirim, penerima, hppenerima, alamat_penerima, barang, berat, biaya, kurir, layanan, catatan, status, bukti_bayar) 
        VALUES ('$resi', '$pengirim', '$hppengirim', '$alamat_pengirim', '$penerima', '$hppenerima', '$alamat_penerima', '$barang', '$berat', '$biaya', '$kurir', '$layanan', '$catatan', '$status', '$nama_file')";

$sukses = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Pengiriman</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
        body { font-family: 'Inter', sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); text-align: center; width: 400px; border: 1px solid #eee; }
        .success-icon { font-size: 50px; margin-bottom: 20px; }
        h2 { color: #2d3436; margin-bottom: 10px; }
        .resi-box { background: #f8f9fa; padding: 15px; border-radius: 10px; font-size: 20px; font-weight: 600; color: #2196F3; margin: 20px 0; border: 2px dashed #2196F3; }
        .btn { display: inline-block; padding: 12px 30px; background: #2196F3; color: white; text-decoration: none; border-radius: 10px; font-weight: 600; transition: 0.3s; }
        .btn:hover { background: #1976D2; }
    </style>
</head>
<body>
    <div class="card">
        <?php if($sukses): ?>
            <div class="success-icon">✅</div>
            <h2>Pengiriman Dibuat!</h2>
            <p>Data Anda telah tersimpan dengan aman.</p>
            <div class="resi-box"><?php echo $resi; ?></div>
            <p>Total Biaya: <b>Rp <?php echo number_format($biaya, 0, ',', '.'); ?></b></p>
            <br>
            <a href="dashboard.php?page=barang" class="btn">Kembali ke Dashboard</a>
        <?php else: ?>
            <div class="success-icon">❌</div>
            <h2>Gagal Diproses</h2>
            <p><?php echo mysqli_error($conn); ?></p>
            <a href="dashboard.php" class="btn" style="background:#e74c3c;">Coba Lagi</a>
        <?php endif; ?>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>