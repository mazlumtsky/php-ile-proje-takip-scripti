<?php
// $host="localhost";
// $veritabani_ismi="kurs";
// $kullanici_adi="root";

try{
    $db=new PDO("mysql:host=localhost;dbname=kurs;charet=utf8","root","root");

}
  catch(PDOException $e){
    echo "veritabanı bağlantısı başarısız";
    echo $e->getMessage();
  }
?>