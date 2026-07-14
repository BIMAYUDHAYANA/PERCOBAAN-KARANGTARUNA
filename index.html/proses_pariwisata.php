<?php
session_start();

// 1. TAMBAHKAN KONEKSI INI DI BAGIAN ATAS
$conn = mysqli_connect("localhost", "root", "", "karangtaruna");

// Cek jika koneksi gagal
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 2. Sekarang variabel $conn sudah ada, kode di bawah ini akan berjalan normal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nama_pemesan  = mysqli_real_escape_string($conn, $_POST['nama_pemesan']);
    $tanggal       = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $kendaraan     = mysqli_real_escape_string($conn, $_POST['kendaraan']);
    $jumlah_tiket  = (int)$_POST['jumlah_tiket'];
    $durasi        = (int)$_POST['durasi'];
    $total_biaya   = $durasi * 100000;
    $hp            = mysqli_real_escape_string($conn, $_POST['hp']);
    $catatan       = mysqli_real_escape_string($conn, $_POST['catatan']);

    $query = "INSERT INTO pesanan_pariwisata (nama_pemesan, tanggal, kendaraan, jumlah_tiket, hp, catatan, durasi, total_biaya) 
              VALUES ('$nama_pemesan', '$tanggal', '$kendaraan', '$jumlah_tiket', '$hp', '$catatan', '$durasi', '$total_biaya')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pemesanan tiket berhasil!'); window.location='dashboard.php?page=pariwisata';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>