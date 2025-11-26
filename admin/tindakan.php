<?php
include_once("../library/koneksi.php");

# ----- PAGINATION SETTINGS -----
$row = 20;
$hal = isset($_GET['hal']) ? intval($_GET['hal']) : 0;

# Hitung jumlah data
$pageSql = "SELECT * FROM tindakan";
$pageQry = mysqli_query($koneksi, $pageSql) or die("Error paging: " . mysqli_error($koneksi));
$jml 	 = mysqli_num_rows($pageQry);
$max 	 = ceil($jml / $row);

# ----- PROSES INPUT -----
if (isset($_POST['tdk'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $ket  = mysqli_real_escape_string($koneksi, $_POST["ket"]);

    if (!empty($nama) && !empty($ket)) {
        $save = mysqli_query($koneksi, "INSERT INTO tindakan (nm_tindakan, ket) VALUES ('$nama', '$ket')");
        if ($save) {
            echo "<meta http-equiv='refresh' content='0; url=?menu=tindakan'>";
            echo "<center><div class='alert alert-success alert-dismissable'>
                <b>✔ Berhasil menambah ke database!</b></div></center>";
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
<i class='icon icon-white icon-plus'></i> Tambah Tindakan</a><p>

<div class="panel panel-default">
	<div class="panel-heading">Daftar Tindakan</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th width="140">Kode Tindakan</th>
						<th>Nama Tindakan</th>
						<th>Keterangan</th>
						<th width="90">Aksi</th>
					</tr>
				</thead>

				<tbody>
				<?php
				$tndSql = "SELECT * FROM tindakan ORDER BY kd_tindakan DESC LIMIT $hal, $row";
				$tndQry = mysqli_query($koneksi, $tndSql) or die("Query tindakan salah : " . mysqli_error($koneksi));

				while ($tindakan = mysqli_fetch_assoc($tndQry)) { ?>
					<tr>
						<td><?= $tindakan['kd_tindakan']; ?></td>
						<td><?= htmlspecialchars($tindakan['nm_tindakan']); ?></td>
						<td><?= htmlspecialchars($tindakan['ket']); ?></td>
						<td>
						  <div class='btn-group'>
						     <a href="?menu=tindakan_del&aksi=hapus&nmr=<?= $tindakan['kd_tindakan']; ?>" 
								class="btn btn-xs btn-danger" 
								title="Hapus Data Ini" 
								onclick="return confirm('Yakin ingin menghapus data ini?')">
								<i class="icon-remove icon-white"></i></a>

						     <a href="?menu=tindakan_edit&aksi=edit&nmr=<?= $tindakan['kd_tindakan']; ?>" 
								class="btn btn-xs btn-info" 
								title="Edit Data Ini">
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
						echo "<li><a href='?menu=tindakan&hal=$list'>$h</a></li>";
					}
					?>
					</ul>
					</td>
				</tr>

			</table>
		</div>
	</div>
</div>
