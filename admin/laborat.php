<?php
include_once("../library/koneksi.php");

# =========================================
# PAGINATION (PEMBAGIAN HALAMAN)
# =========================================
$row = 20; // jumlah per halaman
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;

# Hitung total data
$pageQry = mysqli_query($koneksi, "SELECT * FROM laboratorium");
$jml     = mysqli_num_rows($pageQry);
$max     = ceil($jml / $row);

# Tampilkan data sesuai halaman
$labQry = mysqli_query($koneksi, "SELECT * FROM laboratorium ORDER BY kd_lab DESC LIMIT $hal, $row");
?>

<a href="?menu=laborat_add" class="btn btn-primary btn-rect">
    <i class='icon icon-white icon-plus'></i> Tambah Laboratorium
</a>

<p></p>

<div class="panel panel-default">
    <div class="panel-heading">
        Laboratorium
    </div>
    <div class="panel-body">
        <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="20">No</th>
                        <th width="160">Kode Laboratorium</th>
                        <th width="150">No Rekam Medis</th>
                        <th>Hasil Lab</th>
                        <th>Keterangan</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $hal + 1;
                    while ($lab = mysqli_fetch_array($labQry)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $lab['kd_lab']; ?></td>
                            <td><?= $lab['no_rm']; ?></td>
                            <td><?= $lab['hasil_lab']; ?></td>
                            <td><?= $lab['ket']; ?></td>
                            <td>
                                <div class='btn-group'>
                                    <a href="?menu=laborat_del&aksi=hapus&nmr=<?= $lab['kd_lab']; ?>" 
                                        class="btn btn-xs btn-danger" 
                                        onclick="return confirm('Yakin menghapus data ini?')">
                                        <i class="icon-remove icon-white"></i>
                                    </a>

                                    <a href="?menu=laborat_edit&aksi=edit&nmr=<?= $lab['kd_lab']; ?>" 
                                        class="btn btn-xs btn-info">
                                        <i class="icon-edit icon-white"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="6" align="right">
                            <?php
                            for ($h = 1; $h <= $max; $h++) {
                                $list  = $row * $h - $row;
                                $active = ($hal == $list) ? "class='btn btn-primary btn-sm'" : "class='btn btn-default btn-sm'";
                                echo "<a href='?menu=laborat&hal=$list' $active> $h </a> ";
                            }
                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>
