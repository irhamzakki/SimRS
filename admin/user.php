<?php
include_once("../library/koneksi.php");

// pagination
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;

$pageSql = "SELECT * FROM login";
$pageQry = mysqli_query($koneksi, $pageSql) or die ("Error paging: ".mysqli_error($koneksi));
$jml     = mysqli_num_rows($pageQry);
$max     = ceil($jml/$row);
?>

<!-- Button Tambah User -->
<a href="#myModal" class="btn btn-primary btn-rect" data-toggle="modal">
<i class='icon icon-white icon-plus'></i> Tambah User</a><p>

<?php
// tambah user
if (isset($_POST["user"])) {

    $usr = mysqli_real_escape_string($koneksi, $_POST["usr"]);
    $pas = mysqli_real_escape_string($koneksi, md5($_POST["pas"]));
    $nma = mysqli_real_escape_string($koneksi, $_POST["nma"]);
    $alt = mysqli_real_escape_string($koneksi, $_POST["alt"]);

    $insert = mysqli_query($koneksi, "INSERT INTO login (username, password, nama, alamat) 
                                      VALUES ('$usr', '$pas', '$nma', '$alt')");

    if($insert){
        echo "<meta http-equiv='refresh' content='0; url=?menu=user'>";
        echo "<center><div class='alert alert-success alert-dismissable'>
              <b>Berhasil menambah ke database!!</b></div></center>";
    } else {
        echo "<center><div class='alert alert-warning alert-dismissable'>
              <b>Gagal menambah ke database!!</b></div></center>";
    }
}
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Daftar User
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>Nama Lengkap</th>
						<th>Alamat</th>
						<th width="90">Aksi</th>
					</tr>
				</thead>
			<?php
				$usSql = "SELECT * FROM login ORDER BY kd_user DESC LIMIT $hal, $row";
				$usQry = mysqli_query($koneksi, $usSql) or die ("Query User salah : ".mysqli_error($koneksi));
				$nomor  = 1; 
				while ($us = mysqli_fetch_array($usQry)) {
			?>
				<tbody>
					<tr>
						<td><?php echo $nomor;?></td>
						<td><?php echo $us['username'];?></td>
						<td><?php echo $us['nama'];?></td>
						<td><?php echo $us['alamat'];?></td>
						<td>
						  <a href="?menu=user_del&aksi=hapus&nmr=<?php echo $us['kd_user']; ?>" 
						     class="btn btn-xs btn-danger" 
						     onclick="return confirm('Yakin akan menghapus user ini?')">
						      <i class="icon-remove icon-white"></i>
						  </a>
						</td>
					</tr>
				</tbody>
			<?php $nomor++; } ?>
					<tr>
						<td colspan="6" align="right">
						<?php
						for($h = 1; $h <= $max; $h++){
							$list[$h] = $row*$h-$row;
							echo "<ul class='pagination pagination-sm' style='display:inline;'>
							        <li><a href='?menu=user&hal=$list[$h]'>$h</a></li>
							      </ul>";
						}
						?>
						</td>
					</tr>
			</table>
		</div>
	</div>
</div>

<!-- modal tambah user -->
<div id="myModal" class="modal fade" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<h4>Tambah User</h4>
	</div>
	<div class="modal-body">
		<form method="post">
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="usr" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="pas" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Nama Lengkap</label>
				<input type="text" name="nma" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea name="alt" class="form-control"></textarea>
			</div>
			<button type="submit" name="user" class="btn btn-primary">Simpan</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		</form>
	</div>
</div>
</div>
</div>
