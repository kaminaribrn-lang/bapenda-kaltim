<!-- Form ini akan mengirim data langsung ke SIMPATOR -->
<form action="http://simpator.kaltimprov.go.id/cari.php" method="POST" target="_blank">
    
    <!-- Bagian Plat Nomor (Sesuaikan nama input dengan yang ada di source code SIMPATOR) -->
    <div style="margin-bottom: 10px;">
        <input type="text" id="kt" name="kt" placeholder="KT" value="KT" style="width: 50px;" required>
        <input type="text" id="nomor" name="nomor" placeholder="1234" style="width: 100px;" required>
        <input type="text" id="seri" name="seri" placeholder="ABC" style="width: 70px;" required>
    </div>

    <!-- Tombol ini berfungsi sebagai pemicu (trigger) -->
    <button type="submit" name="pkb" value="Cari" class="btn-modern">
        Cek Pajak di SIMPATOR
    </button>
</form>