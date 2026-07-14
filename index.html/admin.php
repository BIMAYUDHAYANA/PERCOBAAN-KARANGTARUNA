<?php
session_start();

// Validasi admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "karangtaruna");

if (!$conn) {
    die("Koneksi database gagal : " . mysqli_connect_error());
}

// =========================
// Total Pendapatan Makanan
// =========================
$totalMakanan = 0;

$cekPesanan = mysqli_query($conn,"SHOW TABLES LIKE 'pesanan'");

if(mysqli_num_rows($cekPesanan)>0){

    $hasil = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT SUM(harga) AS total
    FROM pesanan
    "));

    $totalMakanan = $hasil['total'] ?? 0;
}


// =========================
// Total Pendapatan Barang
// =========================
$totalBarang = 0;

$cekBarang = mysqli_query($conn,"SHOW TABLES LIKE 'pengiriman_barang'");

if(mysqli_num_rows($cekBarang)>0){

    /*
       Ganti nama kolom "biaya"
       jika pada tabel Anda
       namanya ongkir / total_harga / tarif
    */

    $hasil = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT SUM(biaya) AS total
    FROM pengiriman_barang
    "));

    $totalBarang = $hasil['total'] ?? 0;
}
// =========================
// Total Pendapatan Pariwisata
// =========================
$totalWisata = 0;
$cekWisata = mysqli_query($conn,"SHOW TABLES LIKE 'pesanan_pariwisata'");

if(mysqli_num_rows($cekWisata) > 0){
    // Asumsi: harga tiket dikali jumlah_tiket. 
    // Sesuaikan nama kolom harga jika ada di tabel pesanan_pariwisata
    $hasil = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah_tiket * 50000) AS total FROM pesanan_pariwisata")); 
    $totalWisata = $hasil['total'] ?? 0;
}

// =========================
// Total Keseluruhan
// =========================

$totalSemua = $totalMakanan + $totalBarang + $totalWisata;

$page = $_GET['page'] ?? '';

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
<meta http-equiv="refresh" content="3">

<style>
    .status-select{
    border:none;
    padding:8px 12px;
    border-radius:20px;
    color:white;
    font-weight:bold;
    cursor:pointer;
    min-width:190px;
}

.menunggu{
    background:#ff9800;
}

.ambil{
    background:#03A9F4;
}

.perjalanan{
    background:#3F51B5;
}

.selesai{
    background:#4CAF50;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#f5f5f5;
}

.container{
    display:flex;
    min-height:100vh;
}

.sidebar{
    width:280px;
    background:#2196F3;
    color:white;
    padding:20px;
}

.profile{
    text-align:center;
    margin-bottom:25px;
    padding-bottom:20px;
    border-bottom:1px solid rgba(255,255,255,.3);
}

.avatar{
    width:90px;
    height:90px;
    border-radius:50%;
    background:white;
    color:#2196F3;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:40px;
    font-weight:bold;
    margin-bottom:10px;
}

.menu{
    display:flex;
    flex-direction:column;
    gap:10px;
}

.menu a{
    color:white;
    text-decoration:none;
    background:rgba(255,255,255,.15);
    padding:12px;
    border-radius:10px;
    transition:.3s;
}

.menu a:hover{
    background:white;
    color:#2196F3;
}

.logout{
    display:block;
    margin-top:20px;
    background:#f44336;
    color:white;
    text-align:center;
    padding:12px;
    border-radius:10px;
    text-decoration:none;
}

.content{
    flex:1;
    padding:25px;
}

.card{
    background:white;
    border-radius:15px;
    padding:25px;
    min-height:90vh;
    box-shadow:0 0 15px rgba(0,0,0,.08);
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table th,
table td{
    border:1px solid #ddd;
    padding:12px;
    text-align:left;
}

table th{
    background:#2196F3;
    color:white;
}

.dashboard-box{
    background:#4CAF50;
    color:white;
    padding:20px;
    border-radius:12px;
    font-size:22px;
    width:350px;
}

.status{
    padding:6px 12px;
    border-radius:20px;
    color:white;
    font-size:13px;
}

.menunggu{
    background:#ff9800;
}

.dikirim{
    background:#2196F3;
}

.selesai{
    background:#4CAF50;
}

</style>

</head>

<body>

<div class="container">

<div class="sidebar">

<div class="profile">

<div class="avatar">
<?php echo strtoupper(substr($_SESSION['username'],0,1)); ?>
</div>

<h3><?php echo htmlspecialchars($_SESSION['username']); ?></h3>

<p>Administrator</p>

</div>

<div class="menu">

<a href="admin.php">📊 Dashboard</a>

<a href="admin.php?page=makanan">🍔 Pesanan Makanan</a>

<a href="admin.php?page=barang">📦 Pengiriman Barang</a>
<a href="admin.php?page=pariwisata">🏖️ Tiket Pariwisata</a>

<a href="admin.php?page=user">👥 Data User</a>

</div>

<a href="logout.php" class="logout">Logout</a>

</div>

<div class="content">

<div class="card">

<?php
if($page==""){
?>
    <h2>Dashboard Admin</h2>
    <br>
    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <!-- Pendapatan Makanan -->
        <div class="dashboard-box" style="background: #4CAF50;">
            Total Pendapatan Makanan
            <br><br>
            <b>Rp <?php echo number_format($totalMakanan); ?></b>
        </div>

        <!-- Pendapatan Barang -->
        <div class="dashboard-box" style="background: #2196F3;">
            Total Pendapatan Barang
            <br><br>
            <b>Rp <?php echo number_format($totalBarang); ?></b>
        </div>

        <!-- Pendapatan Pariwisata -->
        <div class="dashboard-box" style="background: #ff9800;">
            Total Pendapatan Wisata
            <br><br>
            <b>Rp <?php echo number_format($totalWisata); ?></b>
        </div>
    </div>

    <!-- Total Keseluruhan -->
    <div class="dashboard-box" style="background: #f44336; margin-top: 20px; width: 100%; max-width: 1100px;">
        Total Pendapatan Keseluruhan
        <br>
        <b>Rp <?php echo number_format($totalSemua); ?></b>
    </div>
<?php

}

elseif($page=="makanan"){

echo "<h2>Pesanan Makanan</h2>";

$q=mysqli_query($conn,"SELECT * FROM pesanan ORDER BY id DESC");

echo "<table>";

echo "<tr>
<th>User</th>
<th>Nama Pemesan</th>
<th>Menu</th>
<th>Harga</th>
<th>Metode Bayar</th>
<th>Status</th>
<th>Bukti Bayar</th>
</tr>";

while($r=mysqli_fetch_assoc($q)){

    // Kolom yang benar sesuai tabel "pesanan":
    // username, nama_menu, harga, nama_pelanggan, alamat, wa, metode_pembayaran, status
    $bukti = !empty($r['bukti_bayar'])
             ? "<a href='uploads/".$r['bukti_bayar']."' target='_blank'>Lihat</a>"
             : "-";

    echo "<tr>
        <td>{$r['username']}</td>
        <td>{$r['nama_pelanggan']}</td>
        <td>{$r['nama_menu']}</td>
        <td>Rp ".number_format($r['harga'])."</td>
        <td>{$r['metode_pembayaran']}</td>
        <td>{$r['status']}</td>
        <td>{$bukti}</td>
    </tr>";

}

echo "</table>";

}

elseif($page=="barang"){

echo "<h2>Pengiriman Barang</h2>";

$cek=mysqli_query($conn,"SHOW TABLES LIKE 'pengiriman_barang'");

if(mysqli_num_rows($cek)==0){

echo "<br><b>Tabel pengiriman_barang belum dibuat.</b>";

}else{

$q=mysqli_query($conn,"SELECT * FROM pengiriman_barang ORDER BY id DESC");

if(mysqli_num_rows($q)==0){

echo "<br>Belum ada data pengiriman barang.";

}else{

echo "<table>";

echo "<tr>
<th>No Resi</th>
<th>Pengirim</th>
<th>Barang</th>
<th>Biaya</th>
<th>Bukti</th>
<th>Status</th>
</tr>";

while($r=mysqli_fetch_assoc($q)){

    $status = $r['status'];
    // Penentuan class warna status
    $class = ($status=="Menunggu Pengiriman") ? "menunggu" : 
             (($status=="Ambil Barang") ? "ambil" : 
             (($status=="Dalam Perjalanan") ? "perjalanan" : "selesai"));

    // Menampilkan link bukti bayar
    $bukti = !empty($r['bukti_bayar']) 
             ? "<a href='uploads/".$r['bukti_bayar']."' target='_blank'>Lihat</a>" 
             : "-";

    echo "<tr>
    <td>{$r['resi']}</td>
    <td>{$r['pengirim']}</td>
    <td>{$r['barang']}</td>
    <td>Rp ".number_format($r['biaya'])."</td>
    <td>{$bukti}</td>
    <td>
        <form action='update_status.php' method='POST'>
            <input type='hidden' name='id' value='{$r['id']}'>
            <select name='status' class='status-select {$class}' onchange='this.form.submit()'>
                <option value='Menunggu Pengiriman' ".($status=="Menunggu Pengiriman"?"selected":"").">📦 Menunggu Pengiriman</option>
                <option value='Ambil Barang' ".($status=="Ambil Barang"?"selected":"").">🚚 Ambil Barang</option>
                <option value='Dalam Perjalanan' ".($status=="Dalam Perjalanan"?"selected":"").">🛻 Dalam Perjalanan</option>
                <option value='Barang Sampai Tujuan' ".($status=="Barang Sampai Tujuan"?"selected":"").">✅ Barang Sampai Tujuan</option>
            </select>
        </form>
    </td>
    </tr>";
}

echo "</table>";
}
}
}
elseif($page=="pariwisata"){
    echo "<h2>Pesanan Tiket Pariwisata</h2>";
    $q = mysqli_query($conn, "SELECT * FROM pesanan_pariwisata ORDER BY id DESC");

    echo "<table>
            <tr>
                <th>User</th>
                <th>Tanggal</th>
                <th>Kendaraan</th>
                <th>Tiket</th>
                <th>HP</th>
                <th>Total Biaya</th>
            </tr>";

    while($r = mysqli_fetch_assoc($q)){
        echo "<tr>
                <td>{$r['nama_pemesan']}</td>
                <td>{$r['tanggal']}</td>
                <td>{$r['kendaraan']}</td>
                <td>{$r['jumlah_tiket']}</td>
                <td>{$r['hp']}</td>
        <td>Rp " . number_format($r['total_biaya']) . "</td>
              </tr>";
    }
    echo "</table>";
}
elseif($page=="user"){

echo "<h2>Data User</h2>";

$q=mysqli_query($conn,"SELECT * FROM users");

echo "<table>";

echo "<tr>
<th>ID</th>
<th>Username</th>
<th>Role</th>
</tr>";

while($r=mysqli_fetch_assoc($q)){

echo "<tr>
<td>".$r['id']."</td>
<td>".htmlspecialchars($r['username'])."</td>
<td>".htmlspecialchars($r['role'])."</td>
</tr>";

}

echo "</table>";

}

?>

</div>

</div>

</div>

</body>
</html>