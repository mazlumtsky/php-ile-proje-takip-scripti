<?php include 'header.php';

if(isset($_POST['sip_id'])){
     $siparissor=$db->prepare(" SELECT * FROM siparisekle WHERE sip_id=:sip_id");
     $siparissor->execute(array(':sip_id'=>$_POST['sip_id']));

     $sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);
}

?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-dark ">Sipariş Güncelleme</h3>
        </div>
        <div class="card-body">
            <form action="islemler/islem.php" method="POST">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="">İsim Soyisim</label>
                        <input type="text" name="musteri_isim" class="form-control" value="<?php echo $sipariscek['musteri_isim'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="">Mail Adresi</label>
                        <input type="mail" name="musteri_mail" class="form-control" value="<?php echo $sipariscek['musteri_mail'] ?>">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Telefon Numarası</label>
                        <input type="number" name="musteri_tel" class="form-control" value="<?php echo $sipariscek['musteri_tel'] ?>">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Sipariş Başlığı</label>
                        <input type="text" name="sip_baslik" class="form-control" value="<?php echo $sipariscek['sip_baslik'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mt-3">
                        <label for="">Sipariş Aciliyeti</label>
                        <select name="sip_aciliyet" class="form-control">
                            <option <?php if($sipariscek['sip_aciliyet']== 0) {echo "selected";} ?> value="0">0- Acil</option> 
                            <option <?php if($sipariscek['sip_aciliyet']== 1) {echo "selected";} ?> value="1">1- Acelesi Yok</option>
                            <option <?php if($sipariscek['sip_aciliyet']== 2) {echo "selected";} ?> value="2">2- Normal</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Sipariş Durumu</label> 
                        <select name="sip_durum" class="form-control">
                            <option <?php if($sipariscek['sip_durum']== 0) {echo "selected";} ?> value="0">0- Yeni Başladı</option> 
                            <option <?php if($sipariscek['sip_durum']== 1) {echo "selected";} ?> value="1">1- Devam Ediyor</option>
                            <option <?php if($sipariscek['sip_durum']== 2) {echo "selected";} ?> value="2">2- Bitti</option>
                        </select>
                    </div>
                    <input type="hidden" name="sip_id" value="<?php echo $_POST['sip_id'] ?>">
                    <div class="col-md-6 mt-3">
                        <label for="">Teslim Tarihi</label>
                        <input type="date" name="sip_teslim_tarihi" class="form-control" value="<?php echo $sipariscek['sip_teslim_tarihi'] ?>">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Ücret(TL)</label>
                        <input type="text" name="sip_ucret" class="form-control" value="<?php echo $sipariscek['sip_ucret'] ?>">
                    </div>
                </div>
                <div class="form-row mt-3">
                    <label for="">Sipariş Detay</label>
                    <textarea name="sip_detay" id="" cols="20" rows="5" class="form-control" value=""><?php echo $sipariscek['sip_detay'] ?></textarea>
                </div>
                <button name="siparisduzenle" type="submit" class="btn btn-primary mt-2">kaydet</button>
            </form>
        </div>
    </div>
</div>

<?php if (isset($_GET['sipkontrol'])) {
    echo '<script>Swal.fire("Hatalı Giriş", "Lütfen gerkeli alanları doldurun", "error"); </script>';
} ?>
<?php 
if (isset($_GET['guncelleme_basarili'])){
    echo '<script>Swal.fire("Başarılı", "Güncelleme Gerçekleşti", "success"); </script>';
    header("refresh:1;../siparisler.php");
}?>
<?php 
if (isset($_GET['siperror'])) {
    echo '<script>Swal.fire("Error", "Sonra Tekrar Deneyiniz", "error"); </script>';
} ?>
<?php include 'footer.php' ?>




