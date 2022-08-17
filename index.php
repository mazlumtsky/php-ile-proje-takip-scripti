<?php
include 'header.php';
include 'islemler/islem.php';
$ayarsor = $db->prepare("SELECT * FROM kullanici");
$ayarsor->execute();
$ayarsor = $ayarsor->fetch(PDO::FETCH_ASSOC);
// VERİTABANINDAKİ VERİLERİ ÇEKTİK
?>
<div class="card shadow mt-0 ">
<div class="card-header">
    <div class="card-title mt-1">
        HOŞ GELDİN > <?php echo $ayarsor['kul_ad'] ?>,
    </div>
</div>
</div>

<div class="row mb-5 mx-1 mt-3">
    <?php
    $sayi = 0;
    $projesor = $db->prepare("SELECT * FROM projeekle WHERE proje_aktif = 0");
    $projesor->execute();
    $sayi=$projesor->rowCount();
    ?>
    <div class="col-md-3">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center"
                 <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-success text-uppercase mr-5 mb-1">Toplam <b>Proje </b> Sayısı
                     <i class="fas fa-calendar-check fa-2x text-gray-300 ml-4"></i>
                 </div>
                     <div class="col-auto">
                         <div class="h3  font-weight-bold text-gray-800 "><?php echo $sayi ?></div>
                     </div>
                 </div>
        </div>
    </div>
</div>
    <?php
    $sayi = 0;
    $projesor = $db->prepare("SELECT * FROM projeekle WHERE proje_durum=:proje_durum AND proje_aktif = 0");
    $projesor->execute([':proje_durum'=>2]);
    $sayi=$projesor->rowCount();
    ?>
    <div class="col-md-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center"
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase ml-2 mr-5 " >Biten <b>Proje</b> Sayısı
                        <i class="fas fa-calendar-check fa-2x text-gray-300 ml-4"></i>
                </div>
                    <div class="col-auto">
                        <div class="h3  font-weight-bold text-gray-800 "><?php echo $sayi ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sayi = 0;
    $projesor = $db->prepare("SELECT * FROM projeekle WHERE proje_aciliyet=:proje_Aciliyet AND proje_aktif = 0");
    $projesor->execute([':proje_Aciliyet'=>0]);
    $sayi=$projesor->rowCount();
    ?>
    <div class="col-md-3">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center"
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase ml-2 mr-5">Acil <b>Proje</b> Sayısı </div>
                    <i class="fas fa-calendar-check fa-2x text-gray-300 ml-3"></i>
                    <div class="col-auto">
                        <div class="h3  font-weight-bold text-gray-800 "><?php echo $sayi ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sayi = 0;
    $projesor = $db->prepare("SELECT * FROM projeekle WHERE proje_aciliyet=:proje_aciliyet AND proje_aktif = 0");
    $projesor->execute([':proje_aciliyet'=>2]);
    $sayi=$projesor->rowCount();
    ?>
    <div class="col-md-3">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center"
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase ml-2 mr-5">Normal <b>Proje</b> Sayısı
                        <i class="fas fa-calendar-check fa-2x text-gray-300 ml-2"></i>
                    </div>
                    <div class="col-auto">
                        <div class="h3  font-weight-bold text-gray-800 "><?php echo $sayi ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Projeler-->
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Projeler</h3>
            </div>
            <div class="card-body">
                <!--PROJELERİM-->
                <?php if (isset($_GET['delete'])) { ?>
                    <script>
                        Swal.fire({
                            title: '',
                            text: "Silmek İstediğine Emin Misin ?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Evet',
                            cancelButtonText: 'İptal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = "islemler/islem.php?projesilme=<?= $_GET['delete'] ?>";
                                Swal.fire({
                                    title: "sil",
                                    text: "Projeniz Başarıyla Silindi",
                                    icon: 'success',
                                    timer: 5000
                                })
                            } else {
                                location.href = "index.php";
                            }
                        })
                    </script>

                <?php } ?>
                <table class="table table-light table-bordered" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Başlık</th>
                            <th>Bitiş Tarihi</th>
                            <th>Aciliyet</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sayi = 0;
                        $projesor = $db->prepare("SELECT * FROM projeekle WHERE proje_aktif = 0");
                        $projesor->execute();

                        while ($projecek = $projesor->fetch(PDO::FETCH_ASSOC)) {

                            // proje aciliyeti
                            if ($projecek['proje_aciliyet'] == 0) {
                                $proje_aciliyet = "Acil";
                                $proje_aciliyet_class = "text-danger";
                            } else if ($projecek['proje_aciliyet'] == 1) {
                                $proje_aciliyet = "Acelesi Yok";
                                $proje_aciliyet_class = "text-primary";
                            } else if ($projecek['proje_aciliyet'] == 2) {
                                $proje_aciliyet = "Normal";
                                $proje_aciliyet_class = "text-warning";
                            }
                            // proje durum
                            if ($projecek['proje_durum'] == 0) {
                                $proje_durum = "Yeni Başladı";
                                $proje_durum_class = "text-dark";
                            } else if ($projecek['proje_durum'] == 1) {
                                $proje_durum = "Devam Ediyor";
                                $proje_durum_class = "text-info";
                            } else if ($projecek['proje_durum'] == 2) {
                                $proje_durum = "Bitti";
                                $proje_durum_class = "text-success";
                            }
                            $sayi++ ?>
                            <tr>
                                <td><?php echo $sayi ?></td>
                                <td><?php echo $projecek['proje_baslik'] ?></td>
                                <td><?php echo $projecek['proje_teslim_tarihi'] ?></td>
                                <td class="<?= $proje_aciliyet_class ?>"><?php echo $proje_aciliyet ?></td>
                                <td class="<?= $proje_durum_class ?>"><?php echo  $proje_durum ?></td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <form action="projeduzenle.php" method="post">
                                            <input type="hidden" name="proje_id" value="<?php echo $projecek['proje_id'] ?>">
                                            <button type="submit" name="duzenleme" class="btn btn-sm btn-info btn-icon-split">
                                                <span class="icon text-white-60">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </button>
                                        </form>
                                        <form class="mx-2" action="?delete=<?php echo $projecek['proje_id'] ?>" method="POST">
                                            <input type="hidden" name="proje_id" value="<?php echo $projecek['proje_id'] ?>">
                                            <button type="submit" name="projesilme" value="<?php echo $projecek['proje_id'] ?>" class="btn btn-sm btn-danger btn-icon-split">
                                                <span class="icon text-white-60">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button>
                                        </form>
                                        <form action="proje.php" method="post">
                                            <input type="hidden" name="proje_id" value="<?php echo $projecek['proje_id'] ?>">
                                            <button type="submit" name="projebak" class="btn btn-sm btn-info btn-icon-split">
                                                <span class="icon text-white-60">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Siparişler-->
<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Siparişler</h3>
            </div>
            <div class="card-body">

                <table class="table table-light table-bordered" id="dataTableSiparis">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Başlık</th>
                            <th>Bitiş Tarihi</th>
                            <th>Aciliyet</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sayi = 0;
                        $sipsor = $db->prepare("SELECT * FROM siparisekle WHERE sip_aktif = 0");
                        $sipsor->execute();

                        while ($sipcek = $sipsor->fetch(PDO::FETCH_ASSOC)) {

                            // proje aciliyeti
                            if ($sipcek['sip_aciliyet'] == 0) {
                                $sip_aciliyet = "Acil";
                                $sip_aciliyet_class = "text-danger";
                            } else if ($sipcek['sip_aciliyet'] == 1) {
                                $sip_aciliyet = "Acelesi Yok";
                                $sip_aciliyet_class = "text-primary";
                            } else if ($sipcek['proje_aciliyet'] == 2) {
                                $sip_aciliyet = "Normal";
                                $sip_aciliyet_class = "text-warning";
                            }
                            // proje durum
                            if ($sipcek['sip_durum'] == 0) {
                                $sip_durum = "Yeni Başladı";
                                $sip_durum_class = "text-dark";
                            } else if ($sipcek['sip_durum'] == 1) {
                                $sip_durum = "Devam Ediyor";
                                $sip_durum_class = "text-info";
                            } else if ($sipcek['sip_durum'] == 2) {
                                $sip_durum = "Bitti";
                                $sip_durum_class = "text-success";
                            }
                            $sayi++ ?>
                            <tr>
                                <td><?php echo $sayi ?></td>
                                <td><?php echo $sipcek['sip_baslik'] ?></td>
                                <td><?php echo $sipcek['sip_teslim_tarihi'] ?></td>
                                <td class="<?= $sip_aciliyet_class ?>"><?php echo $sip_aciliyet ?></td>
                                <td class="<?= $sip_durum_class ?>"><?php echo  $sip_durum ?></td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <form action="siparisduzenle.php" method="post">
                                            <input type="hidden" name="sip_id" value="<?php echo $sipcek['sip_id'] ?>">
                                            <button type="submit" name="duzenleme" class="btn btn-sm btn-info btn-icon-split">
                                                <span class="icon text-white-60">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </button>
                                        </form>
                                        <form class="mx-2" action="?delete=<?php echo $sipcek['sip_id'] ?>" method="POST">
                                            <input type="hidden" name="sip_id" value="<?php echo $sipcek['sip_id'] ?>">
                                            <button type="submit" name="siparissilme" value="<?php echo $sipcek['sip_id'] ?>" class="btn btn-sm btn-danger btn-icon-split">
                                                <span class="icon text-white-60">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button>
                                        </form>
                                        <form action="proje.php" method="post">
                                            <input type="hidden" name="proje_id" value="<?php echo $projecek['proje_id'] ?>">
                                            <button type="submit" name="projebak" class="btn btn-sm btn-info btn-icon-split">
                                                <span class="icon text-white-60">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>


<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>
<script src="vendor/datatables/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/buttons.flash.min.js"></script>
<script src="vendor/datatables/jszip.min.js"></script>
<script src="vendor/datatables/pdfmake.min.js"></script>
<script src="vendor/datatables/vfs_fonts.js"></script>
<script src="vendor/datatables/buttons.html5.min.js"></script>
<script src="vendor/datatables/buttons.print.min.js"></script>

<script>
    var dataTables = $('#dataTable').DataTable({
        "ordering": true, //Tabloda sıralama özelliği gözüksün mü? true veya false
        "searching": true, //Tabloda arama yapma alanı gözüksün mü? true veya false
        "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
        "info": true,
    })

    var dataTables = $('#dataTableSiparis').DataTable({
        "ordering": true, //Tabloda sıralama özelliği gözüksün mü? true veya false
        "searching": true, //Tabloda arama yapma alanı gözüksün mü? true veya false
        "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
        "info": true,
    })
</script>