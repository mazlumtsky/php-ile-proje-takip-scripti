<?php include 'header.php';

if(isset($_POST['proje_id'])){
     $projesor=$db->prepare(" SELECT * FROM projeekle WHERE proje_id=:proje_id");
     $projesor->execute(array(':proje_id'=>$_POST['proje_id']));

     $projecek=$projesor->fetch(PDO::FETCH_ASSOC);
}else{
    header("location:projeler");
}

?>
<?php
$projenindetaymetni=$projecek['proje_detay'];
$dosyayolu=$projecek['proje_dosya']
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-dark ">Proje Güncellme</h3>
        </div>
        <div class="card-body">
            <form action="islemler/islem.php" method="POST">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="">Proje Başlığı</label>
                        <input type="text" name="proje_baslik" class="form-control" value="<?php echo $projecek['proje_baslik'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="">Teslim Tarihi</label>
                        <input type="date" name="proje_teslim_tarihi" class="form-control" value="<?php echo $projecek['proje_teslim_tarihi'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mt-3">
                        <label for="">Proje Aciliyeti</label>
                        <?= $projecek['proje_aciliyet']?>
                        <select name="proje_aciliyet" class="form-control">
                            <option <?php if($projecek['proje_aciliyet']== 0) {echo "selected";} ?> value="0">0- Acil</option>
                            <option <?php if($projecek['proje_aciliyet']== 1) {echo "selected";} ?> value="1">1- Acelesi Yok </option>
                            <option <?php if($projecek['proje_aciliyet']== 2) {echo "selected";} ?> value="2">2- Normal</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Proje Durumu</label>
                        <select name="proje_durum" class="form-control">
                            <option <?php if($projecek['proje_durum']== 0) {echo "selected";} ?>value="0">0- Yeni Başladı</option> 
                            <option <?php if($projecek['proje_durum']== 1) {echo "selected";} ?> value="1">1- Devam Ediyor</option>
                            <option <?php if($projecek['proje_durum']== 2) {echo "selected";} ?> value="2">2- Bitti</option>
                        </select>
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-md-8 mx-auto">
                        <input type="file" class="form-control" name="proje_dosya" id="projedosya" value="<?php echo $projecek['proje-dosya']?>" ">
                    </div>
                </div>
                    <input type="hidden" name="proje_id" value="<?php echo $_POST['proje_id'] ?>">
                <div class="form-row mt-3">
                    <label for="">Proje Detay</label>
                    <textarea name="proje_detay" cols="20" rows="5" class="form-control"><?php echo $projecek['proje_detay'] ?></textarea>
                </div>
                <button name="projeduzenle" type="submit" class="btn btn-primary mt-2">kaydet</button>
            </form>
        </div>
    </div>
</div>

<?php if (isset($_GET['projekontrol'])) {
    echo '<script>Swal.fire("Hatalı Giriş", "Lütfen gerkeli alanları doldurun", "error"); </script>';
} ?>
<?php 
if (isset($_GET['guncelleme_basarili'])){
    echo '<script>Swal.fire("Başarılı", "Güncelleme Gerçekleşti", "success"); </script>';
    header("refresh:1;../projeler.php");
}?>
<?php 
if (isset($_GET['projeerror'])) {
    echo '<script>Swal.fire("Error", "Sonra Tekrar Deneyiniz", "error"); </script>';
} ?>
<?php include 'footer.php' ?>
<?php
if (strlen($dosyayolu)>10) {?>
    <script>
        $(document).ready(function () {
            var url1='<?php echo $dosyayolu ?>'
            $("#projedosya").fileinput({
                'theme': 'explorer-fas',
                'showUpload': false,
                'showCaption': true,
                'showDownload': true,
                //	'initialPreviewAsData': true,
                allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
                initialPreview: [
                    '<img src="dosyalar/<?php echo $dosyayolu ?>" style="height:100px" class="file-preview-image" alt="Dosya" title="Dosya">'
                ],
                initialPreviewConfig: [
                    {downloadUrl: url1,
                        showRemove: false,
                    },
                ],
            });

        });
    </script>
<?php } else { ?>
    <script>
        $(document).ready(function () {
            $("#projedosya").fileinput({
                'theme': 'explorer-fas',
                'showUpload': false,
                'showCaption': true,
                'showDownload': true,
                //	'initialPreviewAsData': true,
                allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
            });

        });
    </script>
<?php } ?>




