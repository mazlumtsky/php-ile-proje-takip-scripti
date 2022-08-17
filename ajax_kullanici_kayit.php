<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ajax alet  Link-->
    <script type="text/javascript" src="sweetalert2.all.min.js"></script>
    <!-- Bootstrap Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--Botstrap Link css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>kullanıcı kayıt</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 col-md-offset- mx-auto shadow-lg p-3 mt-5 mb-5 bg-white rounded text-center">

                <form action="ajax_kullanici_kayit.php" method="POST">
                    <div class="mb-3">
                        <h3>ÜYE KAYIT</h3>
                        <input type="text" name="name_surname" class="form-control mt-5" placeholder="Kullanıcı adı:">
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="E-posta:">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Şifre:">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm btn-block w-100 mb-2">Kayıt Ol</button>
                    <h6>Ya Da </h6> <hr>
                     <a href="ajax_kullanici_giris.php" class="btn btn-outline-primary btn-sm w-100">Giriş Yap</a>
            </div>
        </div>
    </div>
    </form>
</body>
<?php


require_once 'index3.php';
if ($_POST) {
    $ad_soyad = $_POST['name_surname'];
    $e_posta = $_POST['email'];
    $password = $_POST['password'];
    $passwordd = sha1(md5($password));

    if (!$ad_soyad || !$e_posta || !$password) {
        echo '<script>Swal.fire("Başarısız", "Gerkli alanları doldurun", "error"); </script>';
    } else {
        $var_mi = $db->prepare("SELECT email FROM uye_kayıt WHERE Email=:e");
        $var_mi->execute(array(':e' => $e_posta));

        if ($var_mi->rowCount()) {
            echo '<script>Swal.fire("Başarısız", "Böyle bir e-posta adresi zaten kayıtlı !!!", "error"); </script>';
        } else {
            $kayit = $db->prepare("INSERT INTO uye_kayıt SET Name=:n,Email=:e,Password=:p");
            $kayit->execute([':n' => $ad_soyad, ':e' => $e_posta, ':p' => $passwordd]);

            if ($kayit) {
                echo '<script>Swal.fire("Başarılı", "kayıdınız oluşturuldu", "success"); </script>';
            } else {
                echo '<script>Swal.fire("Başarısız", "Sonra tekrar deneyiniz", "error"); </script>';
            }
        }
    }
}

?>

</html>