<?php
include_once("../library/koneksi.php");

# ======================================================
# PAGINATION (PEMBAGIAN HALAMAN)
# ======================================================
$row = 20;
$hal = isset($_GET['hal']) ? (int)$_GET['hal'] : 0;

# Hitung jumlah data
$pageSql = "SELECT * FROM poliklinik";
$pageQry = mysqli_query($koneksi, $pageSql) or die("Error paging : " . mysqli_error($koneksi));
$jml     = mysqli_num_rows($pageQry);
$max     = ceil($jml / $row);
?>
<a href="#myModal" class="btn btn-primary btn-rect" data-toggle="modal">
    <i class='icon icon-white icon-plus'></i> Tambah Poliklinik
</a>
<p>

<?php
# ======================================================
# PROSES PENAMBAHAN DATA
# ======================================================
if (isset($_POST["pol"])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $lantai = mysqli_real_escape_string($koneksi, $_POST["lnt"]);

    if (!empty($nama) && !empty($lantai)) {
        mysqli_query($koneksi, "INSERT INTO poliklinik (nm_poli, lantai) VALUES ('$nama', '$lantai')");
        echo "<meta http-equiv='refresh' content='0; url=?menu=poliklinik'>";
        echo "<center><div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <b>Berhasil menambah ke database!!</b>
              </div></center>";
    } else {
        echo "<center><div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <b>Nama dan Lantai Poliklinik tidak boleh kosong!</b>
              </div></center>";
    }
}

poli(); //memanggil function poli (modal input form)
?>

<div class="panel panel-default">
    <div class="panel-heading">
        Daftar Poliklinik
    </div>

    <div class="panel-body">
        <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="140">Kode Poliklinik</th>
                        <th>Nama Poliklinik</th>
                        <th>Lantai Poliklinik</th>
                        <th width="90">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    $poliSql = "SELECT * FROM poliklinik ORDER BY kd_poli DESC LIMIT $hal, $row";
                    $poliQry = mysqli_query($koneksi, $poliSql) or die("Query Poliklinik salah : " . mysqli_error($koneksi));

                    while ($poli = mysqli_fetch_array($poliQry)) {
                ?>
                    <tr>
                        <td><?= $poli['kd_poli']; ?></td>
                        <td><?= $poli['nm_poli']; ?></td>
                        <td><?= $poli['lantai']; ?></td>
                        <td>
                        <div class='btn-group'>
                            <a href="?menu=poliklinik_del&aksi=hapus&nmr=<?= $poli['kd_poli']; ?>" 
                               class="btn btn-xs btn-danger tipsy-kiri-atas" 
                               title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')">
                               <i class='icon-remove icon-white'></i></a>
                            
                            <a href="?menu=poliklinik_edit&aksi=edit&nmr=<?= $poli['kd_poli']; ?>" 
                               class="btn btn-xs btn-info tipsy-kiri-atas" title="Edit Data ini">
                               <i class='icon-edit icon-white'></i></a>
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
                            echo "<li><a href='?menu=poliklinik&hal=$list'>$h</a></li>";
                        }
                        ?>
                        </ul>
                    </td>
                </tr>

            </table>

        </div>
    </div>
</div>
<?php
function poli(){ ?>
<!-- Modal Tambah Poliklinik -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Poliklinik</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>

            <form method="post" action="">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Nama Poliklinik</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Contoh: Poli Umum">
                    </div>

                    <div class="form-group">
                        <label>Lantai</label>
                        <input type="number" name="lnt" class="form-control" required placeholder="Contoh: 2">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" name="pol" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php } ?>

