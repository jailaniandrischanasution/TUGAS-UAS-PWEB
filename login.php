<?php
session_start();
include ('config/conn.php');
$base_url= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url.= "://".$_SERVER['HTTP_HOST'];
$base_url.= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

if(isset($_POST['cek_login'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        $error = 'Harap isi username dan password';
    } else {
        $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE username=?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) != 0){
            $data = mysqli_fetch_array($result);
            if(password_verify($password, $data['password'])){
                $_SESSION['iduser'] = $data['id_users'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['fullname'] = $data['nama'];
                $_SESSION['level'] = $data['level'];
                header("Location:".$base_url);
                exit;
            } else {
                $error = 'Password anda salah';
            }
        } else {
            $error = 'Username tidak terdaftar';
        }
    }
    $_SESSION['error'] = $error;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Indomart</title>

    <!-- icon tab -->
    <link rel="icon" type="image/png" href="<?=$base_url;?>assets/img/Indomart.jpg">

    <!-- Custom fonts for this template-->
    <link href="<?=$base_url;?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=$base_url;?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background-color:rgb(6, 87, 87); /* Warna biru tua */
            font-family: 'Roboto', sans-serif;
        }

        .login-container {
            min-height: 100vh;
        }

        .card {
            border-radius: 1rem;
            border: 1px solid rgb(6, 87, 87); /* Border biru tua */
            font-weight: normal; /* Mengatur ketebalan font menjadi normal */
        }

        .login-image {
            max-width: 100%;
            height: auto;
        }

        .btn-login {
            background-color: rgb(6, 87, 87); /* Warna biru tua */
            border: none;
            border-radius: 50px;
            color: white; /* Teks putih */
        }

        .btn-login:hover {
            background-color: rgb(6, 87, 87); /* Warna biru tua gelap saat hover */
        }

        .form-control-user {
            border-radius: 50px;
            border: 1px solid rgb(6, 87, 87); /* Border biru tua */
        }
    </style>
</head>

<body>

    <div class="container d-flex align-items-center justify-content-center login-container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block text-center my-auto">
                                <img src="<?=$base_url;?>assets/img/Indomart.jpg" class="login-image" alt="Indomart Logo">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <?php if(isset($_SESSION['success'])):?>
                                    <div class="alert alert-success" role="alert"><?= $_SESSION['success']; ?></div>
                                    <?php endif; unset($_SESSION['success']);?>
                                    <?php if(isset($_SESSION['error'])):?>
                                    <div class="alert alert-danger" role="alert"><?= $_SESSION['error']; ?></div>
                                    <?php endif; unset($_SESSION['error']);?>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><b>SELAMAT DATANG</b></h1>
                                       
                                    </div>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                placeholder="Masukkan username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" placeholder="Masukkan password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block btn-login"
                                            name="cek_login"><b>Login</b></button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?=$base_url;?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=$base_url;?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?=$base_url;?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?=$base_url;?>assets/vendor/sweet-alert/sweetalert2.all.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?=$base_url;?>assets/js/sb-admin-2.min.js"></script>
    <script src="<?=$base_url;?>assets/js/demo/sweet-alert.js"></script>
</body>
</html>
</html>
</html>
</html>
</html>