<?php
include_once("../library/koneksi.php");

if(isset($_POST['simpan'])){
    $no_rm = $_POST['no_rm'];
    $nama  = $_POST['nama'];
    $umur  = $_POST['umur'];
    $jk    = $_POST['jk'];
    $alamat= $_POST['alamat'];

    mysqli_query($koneksi, "INSERT INTO pasien VALUES('$no_rm','$nama','$umur','$jk','$alamat')");
    echo "<script>alert('Data pasien berhasil ditambahkan');document.location='?menu=pasien';</script>";
}
?>

<h3>Tambah Pasien</h3>
<form method="POST">
    <div class="form-group">
        <label>No Rekam Medis</label>
        <input name="no_rm" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nama Pasien</label>
        <input name="nama" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Umur</label>
        <input name="umur" type="number" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select name="jk" class="form-control">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"></textarea>
    </div>
    <button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
    <a href="?menu=pasien" class="btn btn-danger">KEMBALI</a>
</form>
