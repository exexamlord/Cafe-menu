<?php
// Veritabanı bağlantısını içe aktar
include "baglanti.php";

// POST ile gönderilen verileri al
$urun_id = $_POST['urun_id'];
$menu_name = $_POST['menu_name'];
$menu_price = $_POST['menu_price'];
$menu_ex = $_POST['menu_ex'];

// Güncelleme sorgusunu hazırla
$sorgu = $db->prepare("UPDATE menu SET menu_name = :menu_name, menu_price = :menu_price, menu_ex = :menu_ex WHERE id = :urun_id");

// Sorguyu parametrelerle birleştir
$sorgu->bindParam(':urun_id', $urun_id);
$sorgu->bindParam(':menu_name', $menu_name);
$sorgu->bindParam(':menu_price', $menu_price);
$sorgu->bindParam(':menu_ex', $menu_ex);

// Sorguyu çalıştır
$sorgu->execute();

// Kullanıcıyı yönlendir
header("Location: admin.php");

?>
