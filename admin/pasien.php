<?php
include_once("../library/koneksi.php");

# =========================================
# PAGINATION / PEMBAGIAN HALAMAN
# =========================================
$row = 20; // jumlah data per halaman
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;

# Hitung total data
$pageQry = mysqli_query($koneksi, "SELECT * FROM pasien");
$jml     = mysqli_num_rows($pageQry);
$max     = ceil($jml/$row);

# Query tampil data dengan limit
$query = mysqli_query($koneksi, "SELECT * FROM pasien LIMIT $hal, $row");
?>

<a href="?menu=tambah_pasien" class="btn btn-primary btn-rect">
    <i class='icon icon-white icon-plus'></i> Tambah Pasien
</a>
<a href="export/export_pasien_pdf.php" target="_blank" class="btn btn-danger btn-rect">
    <i class='icon icon-white icon-file'></i> Export PDF
</a>

<a href="export/export_pasien_excel.php" target="_blank" class="btn btn-success btn-rect">
    <i class='icon icon-white icon-list-alt'></i> Export Excel
</a>
<p>

<div class="panel panel-default">
    <div class="panel-heading">
        Daftar Pasien
    </div>
    <div class="panel-body">
        <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Pasien</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $hal + 1;
                    while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['no_pasien']; ?></td>
                        <td><?= $data['nm_pasien']; ?></td>
                        <td><?= $data['j_kel']; ?></td>
                        <td><?= $data['alamat']; ?></td>
                        <td><?= $data['no_tlp']; ?></td>
                        <td>
                            <div class='btn-group'>
                                <a href="?menu=hapus_pasien&aksi=hapus&nmr=<?= $data['no_pasien']; ?>" 
                                   class="btn btn-xs btn-danger" 
                                   onclick="return confirm('Yakin menghapus data pasien ini?')">
                                    <i class="icon-remove icon-white"></i>
                                </a>
                                <a href="?menu=edit_pasien&aksi=edit&nmr=<?= $data['no_pasien']; ?>" 
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
                        <td colspan="7" align="right">
                        <?php
                        for($h = 1; $h <= $max; $h++){
                            $list = $row * $h - $row;
                            $active = ($hal == $list) ? "class='btn btn-primary btn-sm'" : "class='btn btn-default btn-sm'";
                            echo "<a href='?menu=pasien&hal=$list' $active> $h </a> ";
                        }
                        ?>
                        </td>
                    </tr>
                </tfoot>

            </table>

        </div>
    </div>
</div>
