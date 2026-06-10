<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "karangtaruna");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['konfirmasi'])) {
    $file_name = NULL;
    // Hanya proses upload jika pembayaran QRIS
    if ($_POST['pembayaran'] == 'QRIS' && !empty($_FILES["bukti"]["name"])) {
        if (!file_exists("uploads/")) mkdir("uploads/");
        $file_name = time() . "_" . basename($_FILES["bukti"]["name"]);
        move_uploaded_file($_FILES["bukti"]["tmp_name"], "uploads/" . $file_name);
    }
    
    $stmt = $conn->prepare("INSERT INTO pesanan (username, nama_menu, harga, nama_pelanggan, alamat, wa, metode_pembayaran, bukti_bayar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssss", $_SESSION['username'], $_POST['nama_menu'], $_POST['harga'], $_POST['nama_pelanggan'], $_POST['alamat'], $_POST['wa'], $_POST['pembayaran'], $file_name);
    $stmt->execute();
    
    echo "<div class='box'><h2>Pesanan Berhasil</h2><a href='dashboard.php'>Kembali ke Menu</a></div>";
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nama_menu'])) { ?>
    <div class="box">
        <form method="POST" enctype="multipart/form-data">
            <h2>Data Pembeli</h2>
            <input type="hidden" name="nama_menu" value="<?php echo $_POST['nama_menu']; ?>">
            <input type="hidden" name="harga" value="<?php echo $_POST['harga']; ?>">
            <input type="text" name="nama_pelanggan" placeholder="Nama" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <input type="number" name="wa" placeholder="Nomor WA" required>
            
            <select name="pembayaran" id="pembayaran" onchange="toggleBukti()">
                <option value="COD">COD</option>
                <option value="QRIS">QRIS</option>
            </select>
            
            <div id="divBukti" style="display:none;">
                <p style="font-size:0.8em; color:#888; margin-bottom:5px;">Upload Bukti QRIS:</p>
                <input type="file" name="bukti" accept="image/*">
            </div>
            
            <button type="submit" name="konfirmasi">Proses Pesanan</button>
        </form>
    </div>
    
    <script>
    function toggleBukti() {
        var p = document.getElementById("pembayaran").value;
        var d = document.getElementById("divBukti");
        d.style.display = (p === "QRIS") ? "block" : "none";
    }
    </script>
<?php } else { header("Location: dashboard.php"); } ?>
<link rel="stylesheet" href="style.css">