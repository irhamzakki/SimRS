<?php
error_reporting(0);
session_start();
include("../library/variabel.php");
if($_SESSION["user"]!="" && $_SESSION["pass"]!=""){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>SIRS Admin | G-Developer</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/theme.css" />
    <link rel="stylesheet" href="../css/MoneAdmin.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />
    <link rel="stylesheet" href="../css/datepicker.css" />
    <!-- END GLOBAL STYLES -->

    <style>
        body {
            background: #f4f6f9;
        }
        .page-content {
            padding: 70px 20px 20px 20px;
        }
        .card-custom {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body class="padTop53">

    <div id="wrap">
        <!-- HEADER -->
        <?php include_once("menu_atas.php");?>
        <!-- END HEADER -->
        
        <!-- MENU -->
        <?php include_once("menu_admin.php");?>
        <!-- END MENU -->

        <!-- PAGE CONTENT -->
        <div class="page-content container-fluid">
            <div class="card-custom">
                <h3 class="text-primary"><i class="fa fa-hospital-o"></i> Dashboard Sistem Informasi Rumah Sakit</h3>
                <p>Selamat datang di halaman administrasi. Gunakan menu di sebelah kiri untuk mengelola data rumah sakit.</p>
            </div>
        </div>
        <!-- END PAGE CONTENT -->

    </div>

    <!-- FOOTER -->
    <?php include_once("footer.php");?>
    <!-- END FOOTER -->

    <!-- GLOBAL SCRIPTS -->
    <script src="../js/jquery-2.0.3.min.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->

</body>
</html>

<?php
}else{
    header("Location:../index.php");
}
?>
