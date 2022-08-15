<?php include 'header.php';

$ayarsor=$db->prepare("SELECT * FROM kullanici");
$ayarsor->execute();
$ayarsor=$ayarsor->fetch(PDO::FETCH_ASSOC);
// VERİTABANINDAKİ VERİLERİ ÇEKTİK

$ayarsor=$db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarsor=$ayarsor->fetch(PDO::FETCH_ASSOC);

      ?>


<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="text-dark">Ayarlar</h3>
        </div>
        <div class="card-body">
            <form action="islemler/islem.php" method="POST" accept-charset="utf-8">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="">Sitenin Başlığını Giriniz</label>
                        <input type="text" name="site_baslik" class="form-control" value="<?php echo $ayarsor['site_baslik'] ?>">
                    </div>
                </div>

                <div class="form-row my-3">
                    <div class="col-md-6">
                        <label for="">Sitenin Açıklamasını Giriniz</label>
                        <input type="text" name="site_aciklama" class="form-control" value="<?php echo $ayarsor['site_aciklama'] ?>">
                    </div>
                </div>

                <div class="form-row my-3">
                    <div class="col-md-6">
                        <label for="">Site Sahibi</label>
                        <input type="text" name="site_sahibi" class="form-control" value="<?php echo $ayarsor['kul_ad']  ?>">
                    </div>
                </div>
                <button type="submit" name="ayarkaydet" class="btn btn-primary" >Kaydet</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>