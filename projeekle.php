<?php include 'header.php' ?>
    <link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
    <script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
    <script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-dark ">Proje Ekle</h3>
        </div>
        <div class="card-body">
            <form action="islemler/islem.php" method="POST">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="">Proje Başlığı</label>
                        <input type="text" name="proje_baslik" class="form-control" placeholder="Projenzin başlığını giriniz...">
                    </div>
                    <div class="col-md-6">
                        <label for="">Teslim Tarihi</label>
                        <input type="date" name="proje_teslim_tarihi" class="form-control" placeholder="Projenzin başlığını giriniz...">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mt-3">
                        <label for="">Proje Aciliyeti</label>
                        <select name="proje_aciliyet" class="form-control">
                            <option value="0">Acil</option>
                            <option value="1">Acelesi yok</option>
                            <option value="2">Normal</option>
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="">Proje Durumu</label>
                        <select name="proje_durum" class="form-control">
                            <option value="0">Yeni Başladı</option>
                            <option value="1">Devam Ediyor</option>
                            <option value="2">Bitti</option>
                        </select>
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-md-8 mx-auto">
                        <input type="file" class="form-control" name="proje_dosya" id="proje_dosya" ">
                    </div>
                </div>
                <div class="form-row mt-3">
                    <label for="">Proje Detay</label>
                    <textarea name="proje_detay" id="" cols="20" rows="5" class="form-control"></textarea>
                </div>
                <button name="projeekle" type="submit" class="btn btn-primary mt-2">kaydet</button>
            </form>
        </div>
    </div>
</div>

<?php if (isset($_GET['projekontrol'])) {
    echo '<script>Swal.fire("Hatalı Giriş", "Lütfen gerkeli alanları doldurun", "error"); </script>';
} ?>
<?php if (isset($_GET['projeekle'])) {
    echo '<script>Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Projeniz Başarı ile Kayıt Edilidi",
        showConfirmButton: false,
        timer: 2000
      });</script>';
    header("refresh:3;../projeler.php");
} ?>
<?php if (isset($_GET['projeerror'])) {
    echo '<script>Swal.fire("Error", "Sonra tekrar deneyiniz", "error"); </script>';
} ?>
<?php include 'footer.php' ?>
<script>
    $(document).ready(function () {

        $("#proje_dosya").fileinput({
            'theme': 'explorer-fas',
            'showUpload': false,
            'showCaption': true,
            showDownload: true,
            allowedFileExtensions: ["jpg", "png", "jpeg","mp4","zip","rar"],
        });
    });
</script>
