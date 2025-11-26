<?php
include_once("../library/koneksi.php");
$nmr = $_GET['nmr'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pasien WHERE no_rm='$nmr'"));

if(isset($_POST['update'])){
    mysqli_query($koneksi, "UPDATE pasien SET 
        nama='$_POST[nama]',
        umur='$_POST[umur]',
        jk='$_POST[jk]',
        alamat='$_POST[alamat]'
    WHERE no_rm='$nmr'");
    echo "<script>alert('Data pasien berhasil diperbarui');document.location='?menu=pasien';</script>";
}
?>

<h3>Edit Data Pasien</h3>
<form method="POST">
    <div class="form-group">
        <label>No RM</label>
        <input class="form-control" value="<?= $data['no_rm']; ?>" disabled>
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input name="nama" value="<?= $data['nama']; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Umur</label>
        <input name="umur" value="<?= $data['umur']; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select name="jk" class="form-control">
            <option <?= ($data['jk']=='L')?'selected':''; ?> value="L">Laki-laki</option>
            <option <?= ($data['jk']=='P')?'selected':''; ?> value="P">Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"><?= $data['alamat']; ?></textarea>
    </div>
    <button type="submit" name="update" class="btn btn-success">UPDATE</button>
    <a href="?menu=pasien" class="btn btn-danger">KEMBALI</a>
</form>
