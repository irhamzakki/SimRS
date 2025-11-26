<?php
session_start();

// include koneksi database
include_once("../library/koneksi.php");

// pastikan koneksi tersedia
if (!isset($koneksi) || !($koneksi instanceof mysqli)) {
    die("Koneksi database tidak tersedia. Periksa file koneksi.");
}

// Proses simpan ketika form dikirim
if (isset($_POST['lab'])) {

    // validasi input
    $no_rm = isset($_POST['no_rm']) ? trim($_POST['no_rm']) : '';
    $hasil = isset($_POST['hasil']) ? trim($_POST['hasil']) : '';
    $ket   = isset($_POST['ket']) ? trim($_POST['ket']) : '';

    if ($no_rm === '' || $hasil === '' || $ket === '') {
        $msg = "<div class='alert alert-warning'>Form tidak boleh kosong.</div>";
    } else {
        // Query insert
        $stmt = $koneksi->prepare("INSERT INTO laboratorium (no_rm, hasil_lab, ket) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $no_rm, $hasil, $ket);
            if ($stmt->execute()) {
                $stmt->close();
                header("Location: ?menu=laborat");
                exit;
            } else {
                $msg = "<div class='alert alert-danger'>Gagal menyimpan: " . htmlspecialchars($stmt->error) . "</div>";
                $stmt->close();
            }
        } else {
            $msg = "<div class='alert alert-danger'>Prepare statement gagal: " . htmlspecialchars($koneksi->error) . "</div>";
        }
    }
}

// Ambil data rekam medis untuk combobox
$rmResult = $koneksi->query("SELECT no_rm, tgl_pemeriksaan FROM rekam_medis ORDER BY tgl_pemeriksaan DESC");
if (!$rmResult) {
    die("Query rekam_medis gagal: " . $koneksi->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Tambah Laboratorium</title>
</head>
<body>

<div class="box">
    <header>
        <h5>Tambah Laboratorium</h5>
    </header>

    <div class="body">
        <?php if (!empty($msg)) echo $msg; ?>

        <form action="" method="post" class="form-horizontal">

            <div class="form-group">
                <label class="control-label col-lg-4">Tanggal Rekam Medis</label>
                <div class="col-lg-3">
                    <select name="no_rm" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <?php while ($row = $rmResult->fetch_assoc()) : ?>
                            <option value="<?= htmlspecialchars($row['no_rm']) ?>">
                                <?= htmlspecialchars($row['tgl_pemeriksaan']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-4">Hasil Laborat</label>
                <div class="col-lg-4">
                    <input type="text" name="hasil" required class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-4">Keterangan</label>
                <div class="col-lg-4">
                    <textarea name="ket" required class="form-control"></textarea>
                </div>
            </div>

            <div class="form-actions no-margin-bottom" style="text-align:center;">
                <input type="submit" name="lab" value="Simpan" class="btn btn-primary" />
            </div>

        </form>
    </div>
</div>

</body>
</html>
