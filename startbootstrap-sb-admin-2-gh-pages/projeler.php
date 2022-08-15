<?php include 'header.php'?>



<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-dark ">Projeler</h3>
        </div>
        <div class="card-body">
            <!--Tablo filtreleme butonları mobilde gizlendiğinde gözükecek buton-->
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
                            location.href = "islemler/islem.php?projesilme=<?=$_GET['delete']?>";
                            Swal.fire({
                                title:"sil",
                                text:"Projeniz Başarıyla Silindi",
                                icon:'success',
                                timer:5000
                            })
                        }
                    })
                </script>

            <?php } ?>

            <div class="mobilgizle gizlemeyiac" style="margin-bottom: 10px;">
                <!--Tablo filtreleme butonları bölümü giriş-->
                <button type="button" id="hepsi" style="margin-bottom: 5px;" class="btn btn-sm btn-info btn-icon-split">
                    <span class="icon text-white-65">
                        <i class="fas fa-edit"></i>
                    </span>
                    <span class="text">Hepsi</span>
                </button>

                <button type="button" id="acil" style="margin-bottom: 5px;" class="btn btn-sm btn-danger btn-icon-split">
                    <span class="icon text-white-65">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text">Acil Olanlar</span>
                </button>

                <button type="button" id="normal" style="margin-bottom: 5px;" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon text-white-65">
                        <i class="fas fa-clock"></i>
                    </span>
                    <span class="text">Normal</span>
                </button>

                <button type="button" id="acelesiyok" style="margin-bottom: 5px;" class="btn btn-sm btn-warning btn-icon-split">
                    <span class="icon text-white-65">
                        <i class="fas fa-circle-notch"></i>
                    </span>
                    <span class="text">Önemsizler</span>
                </button>

                <button type="button" id="yeni" style="margin-bottom: 5px;" class="btn btn-sm btn-dark btn-icon-split">
                    <span class="icon text-white-65">
                        <i class="fas fa-hourglass-start"></i>
                    </span>
                    <span class="text">Yeni Başlananlar</span>
                </button>

                <button type="button" id="devam" style="margin-bottom: 5px;" class="btn btn-sm btn-info btn-icon-split">
                    <span class="icon text-white-65">
                        <i class="fas fa-sync-alt"></i>
                    </span>
                    <span class="text">Devam Edenler</span>
                </button>

                <button type="button" id="bitti" style="margin-bottom: 5px;" class="btn btn-sm btn-success btn-icon-split">
                    <span class="icon text-white-65">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Bitenler</span>
                </button>
                <!--Tablo filtreleme butonları bölümü çıkış-->

                <!--Tabloyu excel-pdf-csv olarak dışa aktarma butonlarının olduğu alan giriş-->
                <span class="dropdown no-arrow">
                    <button data-toggle="dropdown" aria-expanded="false" type="button" id="aktarmagizleme" style="margin-left: 4px; margin-bottom: 5px;" class="btn btn-sm btn-primary btn-icon-split dropdown-toggle"><span class="icon text-white-65"><i class="fas fa-file-export"></i></span><span class="text">Dışa Aktar</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="aktarmagizleme">
                        <a class="dropdown-item" href="#">
                            <button type="button" onclick="fnAction('copy');" title="asdsad" attr="Tabloyu Kopyala" class="btn btn-sm btn-icon-split btn-dark">
                                <span class="icon text-white-65">
                                    <i class="fas fa-copy"></i>
                                </span>
                                <span class="text">Kopyala</span>
                            </button>
                        </a>
                        <a class="dropdown-item" title="">
                            <button type="button" onclick="fnAction('excel');" attr="Excel Formatında Dışa Aktar" class="btn btn-sm btn-icon-split btn-success">
                                <span class="icon text-white-65">
                                    <i class="fas fa-file-excel"></i>
                                </span>
                                <span class="text">Excel</span>
                            </button>
                        </a>
                        <a class="dropdown-item" href="#">
                            <button type="button" onclick="fnAction('pdf');" attr="PDF Formatında Dışa Aktar" class="btn btn-sm btn-icon-split btn-danger">
                                <span class="icon text-white-65">
                                    <i class="fas fa-file-pdf"></i>
                                </span>
                                <span class="text">PDF</span>
                            </button>
                        </a>
                        <a class="dropdown-item" href="#">
                            <button type="button" onclick="fnAction('csv');" attr="CSV Formatında Dışa Aktar" class="btn btn-sm btn-icon-split btn-primary">
                                <span class="icon text-white-65">
                                    <i class="fas fa-file-csv"></i>
                                </span>
                                <span class="text">CSV</span>
                            </button>
                        </a>
                    </div>
                </span>
                <!--Tabloyu excel-pdf-csv olarak dışa aktarma butonlarının olduğu alan çıkış-->
            </div>
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
<?php include 'footer.php' ?>
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
        "ordering": true,  //Tabloda sıralama özelliği gözüksün mü? true veya false
        "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
        "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
        "info": true,
    })

</script>
