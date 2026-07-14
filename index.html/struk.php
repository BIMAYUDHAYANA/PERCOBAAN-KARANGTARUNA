<?php
session_start();
include 'koneksi.php';

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['konfirmasi'])) {
    $file_name = NULL;
    
    // Hanya proses upload jika pembayaran QRIS
    if ($_POST['pembayaran'] == 'QRIS' && !empty($_FILES["bukti"]["name"])) {
        if (!file_exists("uploads/")) mkdir("uploads/");
        $file_name = time() . "_" . basename($_FILES["bukti"]["name"]);
        move_uploaded_file($_FILES["bukti"]["tmp_name"], "uploads/" . $file_name);
    }
    
    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO pesanan (username, nama_menu, harga, nama_pelanggan, alamat, wa, metode_pembayaran, bukti_bayar, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Sedang Dimasak')");
    $stmt->bind_param("ssisssss", $_SESSION['username'], $_POST['nama_menu'], $_POST['harga'], $_POST['nama_pelanggan'], $_POST['alamat'], $_POST['wa'], $_POST['pembayaran'], $file_name);
    $stmt->execute();
    
    echo "<div class='box' style='text-align:center; padding:20px;'>
            <h2>✅ Pesanan Berhasil</h2>
            <p>Terima kasih, pesanan Anda sedang diproses.</p>
            <br>
            <a href='dashboard.php' style='padding:10px 20px; background:#ff5722; color:white; text-decoration:none; border-radius:5px;'>Kembali ke Menu</a>
          </div>";
} 
// Jika user baru masuk dari halaman fitur_makanan
else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nama_menu'])) { ?>
    <div class="box">
        <form method="POST" enctype="multipart/form-data">
            <h2>Data Pembeli</h2>
            <input type="hidden" name="nama_menu" value="<?php echo htmlspecialchars($_POST['nama_menu']); ?>">
            <input type="hidden" name="harga" value="<?php echo htmlspecialchars($_POST['harga']); ?>">
            
            <input type="text" name="nama_pelanggan" placeholder="Nama Lengkap" required>
            <input type="text" name="alamat" placeholder="Alamat Lengkap" required>
            <input type="number" name="wa" placeholder="Nomor WhatsApp" required>
            
            <label>Metode Pembayaran:</label>
            <select name="pembayaran" id="pembayaran" onchange="toggleBukti()" required>
                <option value="COD">Bayar di Tempat (COD)</option>
                <option value="QRIS">QRIS</option>
            </select>
            
            <div id="divBukti" style="display:none; margin:15px 0; text-align:center; padding:10px; border:1px solid #ddd; border-radius:8px;">
                <p><b>Scan QRIS Berikut:</b></p>
                <img src="qris.png" alt="QRIS" style="width:180px; margin:10px 0;">
                
                <p style="font-size:0.8em; color:#555;">Upload Bukti Transfer:</p>
                <input type="file" name="bukti" accept="image/*">
            </div>
            
            <button type="submit" name="konfirmasi" style="width:100%; padding:10px; background:#ff5722; color:white; border:none; border-radius:5px; cursor:pointer; margin-top:10px;">Proses Pesanan</button>
        </form>
    </div>
    
    <script>
    function toggleBukti() {
        var p = document.getElementById("pembayaran").value;
        var d = document.getElementById("divBukti");
        // Munculkan div jika metode QRIS dipilih
        d.style.display = (p === "QRIS") ? "block" : "none";
    }
    </script>
<?php } else { 
    header("Location: dashboard.php"); 
} ?>
<link rel="stylesheet" href="style.css">