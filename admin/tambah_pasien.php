<?php
session_start();
include_once("../library/koneksi.php");

// PROSES SIMPAN DATA PASIEN
if (isset($_POST["pasien"])) {
    $nama   = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $jk     = mysqli_real_escape_string($koneksi, $_POST["jk"]);
    $agama  = mysqli_real_escape_string($koneksi, $_POST["agama"]);
    $alamat = mysqli_real_escape_string($koneksi, $_POST["alamat"]);
    $tgl    = mysqli_real_escape_string($koneksi, $_POST["tgl"]);
    $usia   = mysqli_real_escape_string($koneksi, $_POST["usia"]);
    $nomor  = mysqli_real_escape_string($koneksi, $_POST["nomor"]);
    $kk     = mysqli_real_escape_string($koneksi, $_POST["kk"]);
    $hub_kel= mysqli_real_escape_string($koneksi, $_POST["hub_kel"]);

    $simpan = mysqli_query($koneksi, "INSERT INTO pasien SET 
                nm_pasien='$nama',
                j_kel='$jk',
                agama='$agama',
                alamat='$alamat',
                tgl_lhr='$tgl',
                usia='$usia',
                no_tlp='$nomor',
                nm_kk='$kk',
                hub_kel='$hub_kel'
            ");

    if ($simpan) {
        $_SESSION['pesan'] = ['Berhasil menyimpan data pasien!', 'success'];
    } else {
        $_SESSION['pesan'] = ['Gagal menyimpan ke database!', 'danger'];
    }

    echo "<meta http-equiv='refresh' content='0; url=?menu=pasien'>";
    exit;
}
?>

<?php
// MENAMPILKAN ALERT JIKA ADA
if (isset($_SESSION['pesan'])) {
    echo "<div class='alert alert-{$_SESSION['pesan'][1]} alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <b>{$_SESSION['pesan'][0]}</b>
          </div>";
    unset($_SESSION['pesan']);
}
?>

<div class="box">
	<header><h5>Tambah Data Pasien</h5></header>
	<div class="body">

<form action="" method="post" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-lg-4">Nama Pasien</label>
        <div class="col-lg-4">
            <input type="text" name="nama" autofocus required class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-4">Jenis Kelamin</label>
        <div class="col-lg-2">
            <select name="jk" class="form-control">
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-4">Agama</label>
        <div class="col-lg-4">
            <select name="agama" class="form-control">
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-4">Alamat</label>
        <div class="col-lg-4">
            <textarea class="form-control" name="alamat" required></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-4">Tanggal Lahir</label>
        <div class="col-lg-2">
            <input type="date" class="form-control" name="tgl" required />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-4">Usia</label>
        <div class="col-lg-2">
            <input type="number" required name="usia" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-4">Nomor Telepon</label>
        <div class="col-lg-4">
            <input type="text" required name="nomor" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-4">Nama Kepala Keluarga</label>
        <div class="col-lg-4">
            <input type="text" required name="kk" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-4">Hubungan Keluarga</label>
        <div class="col-lg-3">
            <select name="hub_kel" class="form-control">
                <option value="Anak Kandung">Anak Kandung</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
    </div>

    <div class="form-actions no-margin-bottom" style="text-align:center;">
        <input type="submit" name="pasien" value="Simpan" class="btn btn-primary" />
        <a href="?menu=pasien" class="btn btn-default">Batal</a>
    </div>
</form>

	</div>
</div>
