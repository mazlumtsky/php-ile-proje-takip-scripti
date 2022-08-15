<?php
include 'islemler/islem.php';
$ayarsor = $db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarsor = $ayarsor->fetch(PDO::FETCH_ASSOC);
// VERİTABANINDAKİ VERİLERİ ÇEKTİK
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script>

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="">
    <?php  if(isset($_GET['error'])){
            echo '<script>Swal.fire("Hatalı Giriş", "Lütfen gerkeli alanları doldurun", "error"); </script>';
          }?>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class=" ">
                    <div class="card-body p-5">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-6  mx-auto o-hidden border-0 shadow-lg mt-5">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><b>Giriş Yap</b></h1>
                                    </div>
                                    <form class="user" action="login.php" method="POST">
                                        <div class="form-group">
                                            <input name="kul_ad" style="border-radius:10px!important;;" type="text" class="form-control form-control-user " placeholder="Ad Soyad">
                                        </div>
                                        <div class="form-group">
                                            <input name="kul_mail" style="border-radius:10px!important;;" type="email" class="form-control form-control-user " placeholder="Email..">
                                        </div>
                                        <div class="form-group">
                                            <input name="kul_sifre" style="border-radius:10px!important;" type="password" class="form-control form-control-user" placeholder="Şifre">
                                        </div>

                                </div>
                                <button name="oturumac" style="border-radius:10px!important;" class="btn btn-primary btn-user btn-block ">
                                    Giriş Yap
                                </button>
                                <hr>
                                <div class="text-center mb-3">
                                    <h6 class="mb-4">Hesabın yok mu ? <a href="login2.php"> Üye Ol</a></h6>
                                    <a href="https://tr-tr.facebook.com/"><i class="fa fa-facebook-official mr-3" style="font-size:36px; color:#1877F2"></i></a> 
                                   <a href="https://www.instagram.com/"><i class="fa fa-instagram mr-3"         style="font-size:36px; color:#E1306C"></i></a> 
                                   <a href="https://www.linkedin.com/"><i class="fa fa-linkedin-square mr-3"   style="font-size:36px; color:#1666C5"></i></a>
                                   <a href="https://www.google.com/intl/tr/account/about/"><i class="fa fa-google-plus-square"     style="font-size:36px; color: #FBBC05"></i></a>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>