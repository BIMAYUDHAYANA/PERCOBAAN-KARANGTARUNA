<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// Hanya proses jika request-nya POST (dari form submit)
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: dashboard.php?page=makanan");
    exit();
}

$conn = mysqli_connect("localhost","root","","karangtaruna");

if(!$conn){
    die("Koneksi gagal : ".mysqli_connect_error());
}

$username = $_SESSION['username'];

$nama_menu = $_POST['nama_menu'] ?? '';
$harga = $_POST['harga'] ?? 0;
$nama_pelanggan = $_POST['nama_pelanggan'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$wa = $_POST['wa'] ?? '';
$metode = $_POST['metode_pembayaran'] ?? '';

// Validasi sederhana supaya tidak insert data kosong
if($nama_menu === '' || $nama_pelanggan === '' || $alamat === '' || $wa === '' || $metode === ''){
    die("Data pesanan tidak lengkap.");
}

$status = "Menunggu";

$stmt = $conn->prepare("INSERT INTO pesanan
(username,nama_menu,harga,nama_pelanggan,alamat,wa,metode_pembayaran,status)
VALUES(?,?,?,?,?,?,?,?)");

$stmt->bind_param(
    "ssisssss",
    $username,
    $nama_menu,
    $harga,
    $nama_pelanggan,
    $alamat,
    $wa,
    $metode,
    $status
);

if($stmt->execute()){

    echo "<script>
    alert('Pesanan berhasil dibuat');
    window.location='history.php';
    </script>";

}else{

    echo "Gagal menyimpan data : ".mysqli_error($conn);

}
?>