<?php
include_once("../library/koneksi.php");

# ----- KONFIGURASI PAGINATION -----
$row = 20;
$hal = isset($_GET['hal']) ? intval($_GET['hal']) : 0;

$pageSql = "SELECT * FROM obat";
$pageQry = mysqli_query($koneksi, $pageSql) or die("Error paging: " . mysqli_error($koneksi));
$jml  = mysqli_num_rows($pageQry);
$max  = ceil($jml / $row);

# ----- PROSES INPUT -----
if (isset($_POST['obt'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $jml  = mysqli_real_escape_string($koneksi, $_POST["jml"]);
    $ukr  = mysqli_real_escape_string($koneksi, $_POST["ukr"]);
    $hrg  = mysqli_real_escape_string($koneksi, $_POST["hrg"]);

    if ($nama != "" && $jml != "" && $ukr != "" && $hrg != "") {

        $save = mysqli_query($koneksi, "INSERT INTO obat (nm_obat, jml_obat, ukuran, harga) VALUES ('$nama', '$jml', '$ukr', '$hrg')");

        if ($save) {
            echo "<meta http-equiv='refresh' content='0; url=?menu=obat'>";
            echo "<center><div class='alert alert-success alert-dismissable'>
                <b>✔ Berhasil menambah data obat!</b></div></center>";
        } else {
            echo "<center><div class='alert alert-danger alert-dismissable'>
                <b>✘ Gagal menyimpan data!</b></div></center>";
        }

    } else {
        echo "<center><div class='alert alert-warning alert-dismissable'>
            <b>⚠ Semua form wajib diisi!</b></div></center>";
    }
}
?>

<a href="#myModal" class="btn btn-primary btn-rect" data-toggle="modal">
<i class='icon icon-white icon-plus'></i> Tambah Obat</a><p>

<div class="panel panel-default">
	<div class="panel-heading">Daftar Obat</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th width="140">Kode Obat</th>
						<th>Nama Obat</th>
						<th>Jumlah</th>
						<th>Ukuran</th>
						<th>Harga (Rp.)</th>
						<th width="90">Aksi</th>
					</tr>
				</thead>

				<tbody>
				<?php
				$obtSql = "SELECT * FROM obat ORDER BY kd_obat DESC LIMIT $hal, $row";
				$obtQry = mysqli_query($koneksi, $obtSql) or die("Query Obat salah: " . mysqli_error($koneksi));

				while ($obat = mysqli_fetch_assoc($obtQry)) { ?>
					<tr>
						<td><?= $obat['kd_obat']; ?></td>
						<td><?= htmlspecialchars($obat['nm_obat']); ?></td>
						<td><?= htmlspecialchars($obat['jml_obat']); ?></td>
						<td><?= htmlspecialchars($obat['ukuran']); ?></td>
						<td align="right"><?= number_format($obat['harga'],0,",","."); ?></td>
						<td>
						  <div class='btn-group'>
							<a href="?menu=obat_del&aksi=hapus&nmr=<?= $obat['kd_obat']; ?>" 
								class="btn btn-xs btn-danger" title="Hapus Data Ini"
								onclick="return confirm('Yakin ingin menghapus data ini?')">
								<i class="icon-remove icon-white"></i></a> 

							<a href="?menu=obat_edit&aksi=edit&nmr=<?= $obat['kd_obat']; ?>" 
								class="btn btn-xs btn-info" title="Edit Data Ini">
								<i class="icon-edit icon-white"></i></a>
						  </div>
						</td>
					</tr>
				<?php } ?>
				</tbody>

				<tr>
					<td colspan="6" align="right">
					<ul class="pagination pagination-sm">
					<?php
					for ($h = 1; $h <= $max; $h++) {
						$list = $row * $h - $row;
						echo "<li><a href='?menu=obat&hal=$list'>$h</a></li>";
					}
					?>
					</ul>
					</td>
				</tr>

			</table>
		</div>
	</div>
</div>
