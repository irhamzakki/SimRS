<?php
include('../library/koneksi.php');

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_pasien.xls");

echo "<h3>DATA PASIEN KLINIK</h3>";
echo "<table border='1' cellspacing='0' cellpadding='5'>
<tr style='background:#ccc;'>
    <th>No</th>
    <th>No Pasien</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>No. Telepon</th>
</tr>";

$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY no_pasien ASC");
while ($data = mysqli_fetch_array($query)) {
    echo "<tr>
            <td>{$no}</td>
            <td>{$data['no_pasien']}</td>
            <td>{$data['nm_pasien']}</td>
            <td>{$data['j_kel']}</td>
            <td>{$data['alamat']}</td>
            <td>{$data['no_tlp']}</td>
        </tr>";
    $no++;
}
echo "</table>";
?>
