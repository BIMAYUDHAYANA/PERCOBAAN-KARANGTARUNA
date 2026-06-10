<?php
session_start();
if ($_SESSION['role'] != 'admin') header("Location: login.php");
$conn = mysqli_connect("localhost", "root", "", "karangtaruna");
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(harga) as total FROM pesanan"))['total'] ?? 0;
$query = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY tanggal DESC");
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="style.css"></head>
<body><div class="box" style="width:500px;">
    <h2>Panel Admin</h2>
    <div style="background:#45f3ff; color:#000; padding:20px; border-radius:8px; text-align:center;">Total Pendapatan: <b>Rp <?php echo number_format($total); ?></b></div>
    <?php while($row = mysqli_fetch_assoc($query)): ?>
        <div class="menu-item" style="flex-direction:column; align-items:flex-start;">
            <b><?php echo $row['nama_menu']; ?> - <?php echo $row['username']; ?></b>
            <span><?php echo $row['nama_pelanggan']; ?> | <?php echo $row['metode_pembayaran']; ?></span>
            <span>Bukti: <?php echo !empty($row['bukti_bayar']) ? "<a href='uploads/".$row['bukti_bayar']."' target='_blank'>Lihat</a>" : "-"; ?></span>
        </div>
    <?php endwhile; ?>
    <a href="logout.php" style="margin-top:20px; color:#ff2770;">Logout</a>
</div></body></html>