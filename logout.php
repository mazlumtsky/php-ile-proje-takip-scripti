<?php

include 'islemler/islem.php';

session_start();
session_destroy(); //
header('location: login.php');

?>