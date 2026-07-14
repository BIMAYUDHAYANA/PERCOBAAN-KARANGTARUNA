<h2>Pemesanan Tiket Pariwisata</h2>
<hr><br>

<form action="proses_pariwisata.php" method="POST">

<div class="form-group">
    <label>Nama Lengkap (Sesuai Akun)</label>
    <input type="text" name="nama_pemesan" value="<?php echo $_SESSION['username']; ?>" readonly required>
</div>

<div class="form-group">
    <label>Tanggal Kunjungan</label>
    <input type="date" name="tanggal" required>
</div>

<div class="form-group">
    <label>Jenis Kendaraan</label>
    <select name="kendaraan" required>
        <option value="pickup">Mobil Pick-up</option>
        <option value="pribadi">Mobil Pribadi</option>
    </select>
</div>

<div class="form-group">
    <label>Jumlah orang</label>
    <input type="number" name="jumlah_tiket" min="1" required>
</div>

<div class="form-group">
    <label>Durasi Perjalanan (Hari)</label>
    <input type="number" name="durasi" id="durasi" min="1" required placeholder="Masukkan jumlah hari">
</div>

<div class="form-group">
    <label>Estimasi Biaya (Rp 100.000 / hari) PEMBAYARAN COD</label>
    <input type="text" id="total_harga" readonly placeholder="Total biaya akan muncul di sini" style="background: #eee;">
</div>

<div class="form-group">
    <label>Nomor HP/WhatsApp</label>
    <input type="text" name="hp" required>
</div>

<div class="form-group">
    <label>Catatan Tambahan</label>
    <textarea name="catatan" placeholder="Masukkan jam keberangkatan atau request lainnya..."></textarea>
</div>

<button type="submit" class="btn-kirim">
    🎟️ Pesan Tiket Sekarang
</button>

</form>

<script>
// Script perhitungan otomatis biaya
document.getElementById('durasi').oninput = function() {
    var durasi = this.value;
    if(durasi > 0) {
        var total = durasi * 100000;
        document.getElementById('total_harga').value = "Rp " + total.toLocaleString('id-ID');
    } else {
        document.getElementById('total_harga').value = "";
    }
};
</script>