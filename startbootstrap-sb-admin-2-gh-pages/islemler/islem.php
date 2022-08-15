<?php
include 'baglan.php';
ob_start();
session_start();



// AYARLAR KISMININ GÜNCELLENEMSİ
if (isset($_POST['ayarkaydet'])) {
    $ayarlarkaydet = $db->prepare("UPDATE kullanici SET 
       kul_ad=:site_sahibi");

    $ayarlarkaydet->execute(array(':site_sahibi' => $_POST['site_sahibi'])
    );
    if($ayarlarkaydet){
        echo header("refresh:1,../index.php");
    }
}
if (isset($_POST['ayarkaydet'])) {
    $ayarlarkaydet = $db->prepare("UPDATE ayarlar SET 
    site_baslik=:site_baslik,
    site_aciklama=:site_aciklama, 
    site_sahibi=:site_sahibi");

    $ayarlarkaydet->execute(
        array(

            ':site_baslik' => $_POST['site_baslik'],
            ':site_aciklama' => $_POST['site_aciklama'],
            ':site_sahibi' => $_POST['site_sahibi']

        )
    );
}

// OTURUM AÇMA
if (isset($_POST['oturumac'])) {

    $kullanicisor = $db->prepare(
        "SELECT * FROM kullanici WHERE
     kul_mail=:kul_mail 
     AND 
     kul_sifre=:kul_sifre AND kul_ad=:kul_ad"
    );

    $kullanicisor->execute(
        ([
            ':kul_ad'=> $_POST['kul_ad'],
            ':kul_mail' => $_POST['kul_mail'],
            ':kul_sifre' => $_POST['kul_sifre']
        ])
    );
    $sonuc = $kullanicisor->rowCount();
    if ($sonuc == 0) {
        header("location:../login.php?error");
    } else {
        header("location:../index.php");
        $_SESSION['kul_mail'] = $_POST['kul_mail'];

    }
}

// ÜYE KAYIT İŞLEMİ

if (isset($_POST['kayitOl'])) {
    $kul_ad = $_POST['kul_ad'];
    $kul_tel = $_POST['kul_tel'];
    $kul_mail = $_POST['kul_mail'];
    $kul_sifre = $_POST['kul_sifre'];

    if (!$kul_ad || !$kul_mail || !$kul_sifre) {
        header("location:../login2.php?error");
        header('refresh:3;../login2.php');
    } else {
        $var_mi = $db->prepare("SELECT kul_mail FROM kullanici WHERE kul_mail=:e");
        $var_mi->execute(array(':e' => $kul_mail));

        if ($var_mi->rowCount()) {
            header("location:../login2.php?mail_sorgu");
        } else {
            $kayit = $db->prepare(
                " INSERT INTO kullanici SET
                 
            kul_ad=:kul_ad,
            kul_tel=:kul_tel,
            kul_mail=:kul_mail,
            kul_sifre=:kul_sifre"
            );
            $kayit->execute([
                ':kul_ad' => $kul_ad,
                ':kul_tel' => $kul_tel,
                ':kul_mail' => $kul_mail,
                ':kul_sifre' => $kul_sifre
            ]);

            if ($kayit) {
                header("location:../login2.php?kayıt");
            } else {
                echo "sora tekrar deneyiniz";
            }
        }
    }
}
// PROJE EKLEME

if (isset($_POST['projeekle'])) {
    $proje_baslik = $_POST['proje_baslik'];
    $proje_teslim_tarihi = $_POST['proje_teslim_tarihi'];
    $proje_aciliyet = $_POST['proje_aciliyet'];
    $proje_durum = $_POST['proje_durum'];
    $proje_detay = $_POST['proje_detay'];

    if (!$proje_baslik || !$proje_teslim_tarihi || !$proje_detay) {
        header("location:../projeekle.php?projekontrol");
    } else {
        $projeekle = $db->prepare(" INSERT INTO projeekle SET 
        proje_baslik=:proje_baslik,
        proje_teslim_tarihi=:proje_teslim_tarihi,
        proje_aciliyet=:proje_aciliyet,
        proje_durum=:proje_durum,
        proje_detay=:proje_detay,
        proje_aktif=:proje_aktif,
        proje_dosya=:proje_dosya");

        $projeekle->execute(array(
            ':proje_baslik' => $_POST['proje_baslik'],
            ':proje_teslim_tarihi' => $_POST['proje_teslim_tarihi'],
            ':proje_aciliyet' => $_POST['proje_aciliyet'],
            ':proje_durum' => $_POST['proje_durum'],
            ':proje_detay' => $_POST['proje_detay'],
            ':proje_dosya'=> $_POST['proje_dosya'],
            ':proje_aktif' => 0,
        ));
          $deneme='../dosyalar';
          $dosya_yukle=$_FILES['proje_dosya']['tmp_name'];
          $sayi=rand(10000,999);
          $dosya_ismi=$sayi.$_FILES['proje_dosya']['name'];
           move_uploaded_file($dosya_yukle,"$deneme/$dosya_ismi");

        if ($projeekle) {
            header("location:../projeekle.php?projeekle");
            header("refresh:1,../projeler.php");
        } else {
            header("location:../projeekle.php?projeerror");
            exit;
        }
    }
}

// PPROJE GÜNCELLME
if (isset($_POST['projeduzenle'])) {
    $proje_baslik = $_POST['proje_baslik'];
    $proje_teslim_tarihi = $_POST['proje_teslim_tarihi'];
    $proje_aciliyet = $_POST['proje_aciliyet'];
    $proje_durum = $_POST['proje_durum'];
    $proje_detay = $_POST['proje_detay'];

    if (!$proje_baslik || !$proje_teslim_tarihi || !$proje_detay) {
        header("location:../projeduzenle.php?projekontrol");
    } else {
        $projeekle = $db->prepare("UPDATE projeekle SET 
           proje_baslik=:proje_baslik,
           proje_teslim_tarihi=:proje_teslim_tarihi,
           proje_aciliyet=:proje_aciliyet,
           proje_durum=:proje_durum,
           proje_detay=:proje_detay,
           proje_dosya=:proje_dosya,
           proje_aktif=:proje_aktif  WHERE proje_id=:proje_id");

        $projeekle->execute(array(
            ':proje_baslik' => $_POST['proje_baslik'],
            ':proje_teslim_tarihi' => $_POST['proje_teslim_tarihi'],
            ':proje_aciliyet' => $_POST['proje_aciliyet'],
            ':proje_durum' => $_POST['proje_durum'],
            ':proje_detay' => $_POST['proje_detay'],
            ':proje_id' => $_POST['proje_id'],
            ':proje_dosya'=>$_POST['proje_dosya'],
            ':proje_aktif' => 0,
        ));

        if ($projeekle) {
            header("location:../projeduzenle.php?guncelleme_basarili");
            header("location:../projeler.php");
        } else {
            header("location:../projeduzenle.php?projeerror");
            exit;
        }
    }
}
//  PROJE SİLME

if (isset($_GET['projesilme'])) {
    $proje_aktif = $db->prepare("UPDATE projeekle SET 
    proje_aktif=:proje_aktif WHERE proje_id=:proje_id");

    $proje_aktif->execute(array(
        ':proje_aktif' => 1,
        ':proje_id' => $_GET['projesilme']
    ));

    if ($proje_aktif) {
        header("location:../projeler.php");
    } else {
        echo "tekrar kontrol ediniz";
        exit;
    }
}

// SİPARİS EKLE
if (isset($_POST['siparisekle'])) {
    $musteri_isim = $_POST['musteri_isim'];
    $musteri_mail = $_POST['musteri_mail'];
    $musteri_tel = $_POST['musteri_tel'];
    $sip_baslik=$_POST['sip_baslik'];
    $sip_teslim_tarihi = $_POST['sip_teslim_tarihi'];
    $sip_aciliyet = $_POST['sip_aciliyet'];
    $sip_durum = $_POST['sip_durum'];
    $sip_detay = $_POST['sip_detay'];
    $sip_ucret = $_POST['sip_ucret'];


    if (
        !$musteri_isim || !$sip_teslim_tarihi || !$sip_detay ||
        !$sip_ucret || !$musteri_tel || !$musteri_mail
    ) {
        header("location:../siparisekle.php?sipkontrol");
    } else {
        $siparisekle = $db->prepare("INSERT INTO siparisekle SET 
        musteri_isim=:musteri_isim,
        musteri_mail=:musteri_mail,
        musteri_tel=:musteri_tel,
        sip_baslik=:sip_baslik,
        sip_teslim_tarihi=:sip_teslim_tarihi,
        sip_aciliyet=:sip_aciliyet,
        sip_durum=:sip_durum,
        sip_detay=:sip_detay,
        sip_ucret=:sip_ucret,
        sip_aktif=:sip_aktif");
        

        $siparisekle->execute(array(
            ':musteri_isim' => $_POST['musteri_isim'],
            ':musteri_mail' => $_POST['musteri_mail'],
            ':musteri_tel' => $_POST['musteri_tel'],
            ':sip_baslik' =>$_POST['sip_baslik'],
            ':sip_teslim_tarihi' => $_POST['sip_teslim_tarihi'],
            ':sip_aciliyet' => $_POST['sip_aciliyet'],
            ':sip_durum' => $_POST['sip_durum'],
            ':sip_detay' => $_POST['sip_detay'],
            ':sip_ucret' => $_POST['sip_ucret'],
            ':sip_aktif' => 0,
        ));
        
        

        if ($siparisekle) {
            header("location:../siparisekle.php?siparisekle");
            header("refresh:1,../siparisler.php"); 
        } else {
            header("location:../siparisekle.php?sipariserror");
            exit;
        }
    }
}

// SİPARİŞ GÜNCELLEME
if (isset($_POST['siparisduzenle'])) {
    $musteri_isim = $_POST['musteri_isim'];
    $musteri_mail = $_POST['musteri_mail'];
    $musteri_tel = $_POST['musteri_tel'];
    $sip_baslik=$_POST['sip_baslik'];
    $sip_teslim_tarihi = $_POST['sip_teslim_tarihi'];
    $sip_aciliyet = $_POST['sip_aciliyet'];
    $sip_durum = $_POST['sip_durum'];
    $sip_detay = $_POST['sip_detay'];
    $sip_ucret = $_POST['sip_ucret'];


    if (
        !$musteri_isim || !$sip_teslim_tarihi || !$sip_detay ||
        !$sip_ucret || !$musteri_tel || !$musteri_mail
    ) {
        header("location:../siparisduzenle.php?sipkontrol");
    } else {
        $siparisekle = $db->prepare("UPDATE siparisekle SET 
        musteri_isim=:musteri_isim, 
        musteri_mail=:musteri_mail,
        musteri_tel=:musteri_tel,
        sip_baslik=:sip_baslik,
        sip_teslim_tarihi=:sip_teslim_tarihi,
        sip_aciliyet=:sip_aciliyet,
        sip_durum=:sip_durum,
        sip_detay=:sip_detay,
        sip_ucret=:sip_ucret,
        sip_aktif=:sip_aktif WHERE sip_id=:sip_id");
        

        $siparisekle->execute(array(
            ':musteri_isim' => $_POST['musteri_isim'],
            ':musteri_mail' => $_POST['musteri_mail'],
            ':musteri_tel' => $_POST['musteri_tel'],
            ':sip_baslik' =>$_POST['sip_baslik'],
            ':sip_teslim_tarihi' => $_POST['sip_teslim_tarihi'],
            ':sip_aciliyet' => $_POST['sip_aciliyet'],
            ':sip_durum' => $_POST['sip_durum'],
            ':sip_detay' => $_POST['sip_detay'],
            ':sip_ucret' => $_POST['sip_ucret'],
            ':sip_id'=> $_POST['sip_id'],
            ':sip_aktif' => 0,
        ));

        if ($siparisekle) {
            header("location:../siparisduzenle.php?guncelleme_basarili");
        } else {
            header("location:../siprarisduzenle.php?siperror");
            exit;
        }
    }
}

// SİPARİŞ SİLME
if (isset($_GET['siparissilme'])) {
    $proje_aktif = $db->prepare("UPDATE siparisekle SET 
    sip_aktif=:sip_aktif WHERE sip_id=:sip_id");

    $proje_aktif->execute(array(
        ':sip_aktif' => 1,
        ':sip_id' => $_GET['siparissilme']
    ));

    if ($proje_aktif) {
        header("location:../siparisler.php");
    } else {
        echo "tekrar kontrol ediniz";
        exit;
    }
}