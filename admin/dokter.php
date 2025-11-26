<?php
include_once("../library/koneksi.php");

# ======================================================
# PAGINATION (PEMBAGIAN HALAMAN)
# ======================================================
$row = 20;
$hal = isset($_GET['hal']) ? (int)$_GET['hal'] : 0;

# Hitung jumlah data
$pageSql = "SELECT * FROM dokter";
$pageQry = mysqli_query($koneksi, $pageSql) or die("Error paging : " . mysqli_error($koneksi));
$jml     = mysqli_num_rows($pageQry);
$max     = ceil($jml / $row);
?>
<a href="?menu=dokter_add" class="btn btn-primary btn-rect">
    <i class='icon icon-white icon-plus'></i> Tambah Dokter
</a>
<p>

<div class="panel panel-default">
    <div class="panel-heading">
        Daftar Dokter
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Kode Dokter</th>
                        <th>Nama Dokter</th>
                        <th>Spesialis/Keterangan</th>
                        <th width="90">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $dokSql = "SELECT * FROM dokter ORDER BY kd_dokter DESC LIMIT $hal, $row";
                    $dokQry = mysqli_query($koneksi, $dokSql) or die("Query Dokter salah : " . mysqli_error($koneksi));
                    while ($dok = mysqli_fetch_array($dokQry)) {
                ?>
                    <tr>
                        <td><?= $dok['kd_dokter']; ?></td>
                        <td><?= $dok['nm_dokter']; ?></td>
                        <td></td>
                        <td>
                        <div class='btn-group'>
                            <a href="?menu=dokter_del&aksi=hapus&nmr=<?= $dok['kd_dokter']; ?>" 
                               class="btn btn-xs btn-danger tipsy-kiri-atas" 
                               title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')">
                               <i class="icon-remove icon-white"></i></a>
                            
                            <a href="?menu=dokter_edit&aksi=edit&nmr=<?= $dok['kd_dokter']; ?>" 
                               class="btn btn-xs btn-info tipsy-kiri-atas" title="Edit Data ini">
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
                            echo "<li><a href='?menu=dokter&hal=$list'>$h</a></li>";
                        }
                        ?>
                        </ul>
                    </td>
                </tr>

            </table>

        </div>
    </div>
</div>
