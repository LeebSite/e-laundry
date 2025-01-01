<?php

// memulai session
session_start();

// memanggil koneksi
include "include/koneksi.php";

// inisialisasi pesan error
$pesan_error = "";
$pesan_sukses = "";

// jika tombol register ditekan
if (isset($_POST['register'])) {
    $username = htmlentities(strip_tags(trim($_POST["username"])));
    $password = htmlentities(strip_tags(trim($_POST["password"])));
    $confirm_password = htmlentities(strip_tags(trim($_POST["confirm_password"])));

    // validasi input
    if ($password !== $confirm_password) {
        $pesan_error = "Password dan Konfirmasi Password tidak sama!";
    } else {
        // cek apakah username sudah ada
        $cek_username = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username'");
        if (mysqli_num_rows($cek_username) > 0) {
            $pesan_error = "Username sudah terdaftar, gunakan username lain.";
        } else {
            // hashing password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // insert data ke database
            $query = "INSERT INTO tb_users (username, userpass, level) VALUES ('$username', '$hashed_password', 'user')";

            if (mysqli_query($conn, $query)) {
                $pesan_sukses = "Registrasi berhasil! Silakan login.";
            } else {
                $pesan_error = "Registrasi gagal, silakan coba lagi.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <link rel="shortcut icon" href="assets/images/logo1234.png" type="image/png"/>
        <title>Registrasi Berbaju Laundry</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <style>
        .accountbg {
            background-image: url('assets/images/bglaundry.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    <body class="fixed-left">
        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mt-0 m-b-15">
                        <a href="register.php"><img src="assets/images/logo1234.png" width="200px"></a>
                    </h3>

                    <div class="p-3">
                        <h4 class="text-center mt-0 m-b-15">Registrasi e Laundry</h4>

                        <?php if ($pesan_error !== "") : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $pesan_error; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($pesan_sukses !== "") : ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $pesan_sukses; ?>
                            </div>
                        <?php endif; ?>

                        <form class="form-horizontal m-t-20" action="" method="POST">
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="text" required placeholder="Username" name="username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" required placeholder="Password" name="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" required placeholder="Konfirmasi Password" name="confirm_password">
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit" name="register">Registrasi</button>
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <a href="../page/user/login.php" class="btn btn-danger btn-block waves-effect waves-light">Kembali ke Login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>
</html>
