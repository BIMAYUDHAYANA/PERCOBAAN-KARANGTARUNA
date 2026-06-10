<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] == 'admin') header("Location: login.php");
$menu = [["nama" => "Nasi Goreng", "harga" => 20000], ["nama" => "Mie Ayam", "harga" => 15000]];
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
    <h2>Daftar Menu</h2>
    <?php foreach ($menu as $item): ?>
        <div class="menu-item">
            <span><?php echo $item['nama']; ?> (Rp <?php echo number_format($item['harga']); ?>)</span>
            <form action="struk.php" method="POST">
                <input type="hidden" name="nama_menu" value="<?php echo $item['nama']; ?>"><input type="hidden" name="harga" value="<?php echo $item['harga']; ?>">
                <button type="submit" class="btn-beli">Beli</button>
            </form>
        </div>
    <?php endforeach; ?>
    <div class="nav-links"><a href="history.php">Riwayat</a><a href="logout.php" style="color:#ff2770;">Logout</a></div>
</div></body></html>