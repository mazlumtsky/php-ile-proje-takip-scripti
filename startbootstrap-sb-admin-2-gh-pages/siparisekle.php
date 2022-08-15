<?php include 'header.php' ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-dark ">Sipariş Ekleme</h3>
        </div>
        <div class="card-body">
            <form action="islemler/islem.php" method="POST">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="">İsim Soyisim</label>
                        <input type="text" name="musteri_isim" class="form-control" placeholder="Müşterinizin İsmi">
                    </div>
                    <div class="col-md-6">
                        <label for="">Mail Adresi</label>
                        <input type="mail" name="musteri_mail" class="form-control" placeholder="Müşterinizin Mail Adresi">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Telefon Numarası</label>
                        <input type="number" name="musteri_tel" class="form-control" placeholder="Müşterinizin Telefon Numarasını Giriniz">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Sipariş Başlığı</label>
                        <input type="text" name="sip_baslik" class="form-control" placeholder="Siparişinizin Başlığını Giriniz">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mt-3">
                        <label for="">Sipariş Aciliyeti</label>
                        <select name="sip_aciliyet" class="form-control">
                            <option value="0">Acil</option>
                            <option value="1">Acelesi yok</option>
                            <option value="2">Normal</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Sipariş Durumu</label>
                        <select name="sip_durum" class="form-control">
                            <option value="0">Yeni Başladı</option>
                            <option value="1">Devam Ediyor</option>
                            <option value="2">Bitti</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Teslim Tarihi</label>
                        <input type="date" name="sip_teslim_tarihi" class="form-control" placeholder="Sipariş başlığını giriniz...">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Ücret(TL)</label>
                        <input type="text" name="sip_ucret" class="form-control" placeholder="Sipariş ücretini giriniz...">
                    </div>
                </div>
                <div class="form-row mt-3">
                    <label for="">Sipariş Detay</label>
                    <textarea name="sip_detay" id="" cols="20" rows="5" class="form-control"></textarea>
                </div>
                <button name="siparisekle" type="submit" class="btn btn-primary mt-2">kaydet</button>
            </form>
        </div>
    </div>
</div>
<?php if (isset($_GET['sipkontrol'])) {
    echo '<script>Swal.fire("Hatalı Giriş", "Lütfen gerkeli alanları doldurun", "error"); </script>';
} ?>
<?php if (isset($_GET['siparisekle'])) {
    echo '<script>Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Projeniz Başarı ile Kayıt Edilidi",
        showConfirmButton: false,
        timer: 2000
      });</script>';
    header("refresh:1;../siparisler.php");
} ?>
<?php if (isset($_GET['sipariserror'])) {
    echo '<script>Swal.fire("Error", "Sonra tekrar deneyiniz", "error"); </script>';
} ?>
<?php include 'footer.php' ?>