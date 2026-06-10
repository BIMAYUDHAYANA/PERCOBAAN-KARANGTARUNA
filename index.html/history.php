<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "karangtaruna");
$query = mysqli_query($conn, "SELECT * FROM pesanan WHERE username='".$_SESSION['username']."' ORDER BY tanggal DESC");
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
    <h2>Riwayat Anda</h2>
    <?php while($row = mysqli_fetch_assoc($query)): ?>
        <div class="menu-item" style="flex-direction:column; align-items:flex-start;">
            <b><?php echo $row['nama_menu']; ?></b>
            <span><?php echo $row['metode_pembayaran']; ?> | <?php echo $row['tanggal']; ?></span>
        </div>
    <?php endwhile; ?>
    <a href="dashboard.php">Kembali</a>
</div></body></html>