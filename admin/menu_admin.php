<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit();
}
include_once("../library/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin | SIRS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root{
        --sidebar-bg-light:#1e3c72;
        --sidebar-bg-dark:#111827;
        --sidebar-hover:#2563eb;
        --text-light:#f8f9fa;
        --text-dark:#111;
        --content-bg-light:#ffffff;
        --content-bg-dark:#1f2937;
    }

    body.light-mode {
        background: var(--content-bg-light);
        color: var(--text-dark);
    }
    body.dark-mode {
        background: var(--content-bg-dark);
        color: var(--text-light);
    }

    /* SIDEBAR */
    #sidebar {
        position: fixed; top:0; left:0;
        width: 230px; height:100vh;
        background: var(--sidebar-bg-light);
        transition: all .3s ease;
        overflow-y:auto; z-index:999;
    }
    #sidebar .brand {
        font-size: 20px;
        font-weight: 700;
        text-align: center;
        padding: 15px 0;
        margin-bottom: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    body.dark-mode #sidebar{
        background: var(--sidebar-bg-dark);
    }
    #sidebar a{
        color: #ecf0f1; padding: 12px 18px;
        display:block; font-weight:500;
    }
    #sidebar a:hover, #sidebar .active > a {
        background: rgba(255,255,255,0.18);
        border-left:4px solid #fff;
        color:#fff;
    }
    #sidebar i { margin-right:10px; }

    /* CONTENT */
    #content {
        margin-left: 235px; padding:20px; transition: .3s;
    }

    /* MOBILE */
    @media(max-width: 768px){
        #sidebar{left:-250px;}
        #sidebar.show{left:0;}
        #content{margin-left:0;}
    }

    body.dark-mode .card, body.dark-mode .panel, body.dark-mode .table{
        background:#374151 !important; color:#fff;
    }
</style>
</head>

<body>

<!-- Toggle Sidebar (Mobile) -->
<button class="btn btn-primary d-md-none mt-2 ml-2" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<!-- Toggle Dark Mode -->
<button class="btn btn-dark position-fixed" style="right:15px;top:10px;" onclick="toggleDarkMode()">
    <i class="fas fa-adjust"></i>
</button>

<!-- SIDEBAR NAVIGATION -->
<div id="sidebar">
    <div class="brand">SIMRS-IGM</div>
    <ul class="list-unstyled mt-4">
        <li class="active"><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="?menu=pasien"><i class="fas fa-users"></i> Pasien</a></li>
        <li><a href="?menu=laborat"><i class="fas fa-flask"></i> Laboratorium</a></li>
        <li><a href="?menu=tindakan"><i class="fas fa-hand-holding-medical"></i> Tindakan</a></li>
        <li><a href="?menu=obat"><i class="fas fa-capsules"></i> Obat-obatan</a></li>
        <li><a href="?menu=kunjungan"><i class="far fa-calendar-check"></i> Kunjungan</a></li>
        <li><a href="?menu=dokter"><i class="fas fa-user-md"></i> Dokter</a></li>
        <li><a href="?menu=poliklinik"><i class="far fa-hospital"></i> Poliklinik</a></li>
        <li><a href="?menu=rekam"><i class="fas fa-file-medical-alt"></i> Rekam Medis</a></li>
        <li><a href="?menu=user"><i class="fas fa-users-cog"></i> Daftar User</a></li>
        <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>

<!-- CONTENT AREA -->
<div id="content">
    <h2 class="mb-4"><i class="fas fa-hospital-user"></i> SIRS ADMIN</h2>
    <hr>

    <?php
    if(isset($_GET["menu"])){
        include_once("load.php");
    } else {
        
        // // ====== AMBIL DATA DARI DATABASE ======
        // include("../library/koneksi.php");
        // $query = mysqli_query($koneksi,"SELECT MONTH(tgl_daftar) AS bln, COUNT(*) AS total 
        //                                 FROM pasien GROUP BY MONTH(tgl_daftar)");
        // $bulan = [];
        // $total = [];
        // $namaBulan = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];

        // while($r = mysqli_fetch_array($query)){
        //     $bulan[] = $namaBulan[$r["bln"]-1];
        //     $total[] = $r["total"];
        // }
        // // ====== END DATA ======
        // ?>

        <div class='card p-4 mb-4'>
            <h4>Selamat datang, <b><?=$_SESSION['user'];?></b></h4>
            <p>Sistem Informasi Rumah Sakit (SIRS) bertujuan untuk mempermudah pengelolaan pelayanan rumah sakit mulai dari pasien, dokter, obat-obatan, laboratorium hingga rekam medis.</p>
            <p>Gunakan menu di samping untuk mengakses modul.</p>
        </div>

        <div class="card p-4">
            <h5><i class="fa fa-chart-line"></i> Grafik Perkembangan Pendaftaran Pasien</h5>
            <canvas id="grafikPasien" height="120"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('grafikPasien').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?=json_encode($bulan)?>,
                    datasets: [{
                        label: 'Jumlah Pendaftaran Pasien',
                        data: <?=json_encode($total)?>,
                        borderWidth: 3,
                        tension: 0.4,
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.2)',
                        pointStyle: 'circle',
                        pointRadius: 6,
                        pointHoverRadius: 9
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        </script>

    <?php } ?>
</div>


<!-- JAVASCRIPT -->
<script>
    function toggleSidebar(){
        document.getElementById('sidebar').classList.toggle('show');
    }
    function toggleDarkMode(){
        document.body.classList.toggle('dark-mode');
        document.body.classList.toggle('light-mode');
        localStorage.setItem("theme", document.body.classList.contains("dark-mode") ? "dark" : "light");
    }
    (function(){
        let theme = localStorage.getItem("theme");
        document.body.classList.add(theme === "dark" ? "dark-mode" : "light-mode");
    })();
</script>

</body>
</html>
