<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Guthul SIRS | Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;

            /* Background Image + Gradient Overlay */
            background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), 
            url('img/gb.jpg'); /* Ganti nama gambar sesuai file kamu */
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        .login-card {
            width: 100%;
            max-width: 380px;
            padding: 30px;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.6s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        #logoimg {
            width: 95px; 
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-custom {
            border-radius: 10px;
        }
    </style>
</head>

<body>

<?php
session_start();
include_once("library/koneksi.php");

if(isset($_POST["login"])) {
    $user = $_POST["user"];
    $pass = md5($_POST["pass"]);

    if(!empty($user) && !empty($pass)) {
        $stmt = $koneksi->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if($data) {
            $_SESSION["user"] = $data["username"];
            header("Location: Admin/menu_admin.php");
            exit();
        } else {
            echo "<div class='position-fixed top-0 start-50 translate-middle-x mt-3 alert alert-danger shadow'><b>Username atau Password Salah!</b></div>";
        }
    }
}
?>

<div class="login-card text-center">
    <img src="img/logo.png" id="logoimg" alt="Logo">
    <h4 class="mb-3 fw-bold">Guthul SIRS</h4>
    <p class="text-muted">Silakan login untuk melanjutkan</p>

    <form method="post">
        <div class="mb-3">
            <input type="text" name="user" placeholder="Username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <input type="password" name="pass" placeholder="Password" class="form-control" required>
        </div>
        
        <button type="submit" name="login" class="btn btn-primary w-100 btn-custom">LOGIN</button>
        <button type="reset" class="btn btn-outline-danger w-100 mt-2 btn-custom">RESET</button>
    </form>
</div>

<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
