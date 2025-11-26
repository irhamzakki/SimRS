<?php
include_once("../library/koneksi.php"); // pastikan memakai $koneksi (mysqli)

# ----- PAGINATION -----
$row = 20;
$hal = isset($_GET['hal']) ? intval($_GET['hal']) : 0;

$pageSql = "SELECT * FROM kunjungan";
$pageQry = mysqli_query($koneksi, $pageSql) or die("Error paging: " . mysqli_error($koneksi));
$jml  = mysqli_num_rows($pageQry);
$max  = ceil($jml / $row);
?>

<a href="?menu=kunjungan_add" class="btn btn-primary btn-rect">
<i class='icon icon-white icon-plus'></i> Tambah Kunjungan</a><p>

<div class="panel panel-default">
	<div class="panel-heading">
		Daftar Kunjungan
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Kode Kunjungan</th>
						<th>Tanggal Kunjungan</th>
						<th>Nomor Pasien</th>
						<th>Kode Poliklinik</th>
						<th>Jam Kunjungan</th>
						<th width="90">Aksi</th>
					</tr>
				</thead>

				<tbody>
				<?php
				$kjgSql = "SELECT * FROM kunjungan ORDER BY kd_kunjungan DESC LIMIT $hal, $row";
				$kjgQry = mysqli_query($koneksi, $kjgSql) or die("Query Kunjungan salah: " . mysqli_error($koneksi));

				while ($kjg = mysqli_fetch_assoc($kjgQry)) { ?>
					<tr>
						<td><?= $kjg['kd_kunjungan']; ?></td>
						<td><?= htmlspecialchars($kjg['tgl_kunjungan']); ?></td>
						<td><?= htmlspecialchars($kjg['no_pasien']); ?></td>
						<td><?= htmlspecialchars($kjg['kd_poli']); ?></td>
						<td><?= htmlspecialchars($kjg['jam_kunjungan']); ?></td>
						<td>
						  <div class='btn-group'>
							<a href="?menu=kunjungan_del&aksi=hapus&nmr=<?= $kjg['kd_kunjungan']; ?>" 
								class="btn btn-xs btn-danger" title="Hapus Data Ini"
								onclick="return confirm('Yakin ingin menghapus data penting ini?')">
								<i class="icon-remove icon-white"></i></a>

							<a href="?menu=kunjungan_edit&aksi=edit&nmr=<?= $kjg['kd_kunjungan']; ?>" 
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
							echo "<li><a href='?menu=kunjungan&hal=$list'>$h</a></li>";
						}
						?>
						</ul>
					</td>
				</tr>

			</table>
		</div>
	</div>
</div>
