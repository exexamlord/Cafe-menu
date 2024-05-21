


<?php
// Veritabanı bağlantısı
include "baglanti.php";

// Formdan gelen verileri al
$menu_name = $_POST['menu_name'];
$menu_price = $_POST['menu_price'];
$menu_ex = $_POST['menu_ex'];
$menu_category = $_POST['kategori'];

// Veritabanına ekleme sorgusu
$sorgu2 = $db->prepare("INSERT INTO menu (menu_name, menu_price, menu_ex, kategori) VALUES (:menu_name, :menu_price, :menu_ex, :kategori)");
$sorgu2->bindParam(':menu_name', $menu_name);
$sorgu2->bindParam(':menu_price', $menu_price);
$sorgu2->bindParam(':menu_ex', $menu_ex);
$sorgu2->bindParam(':kategori', $menu_category);

// Sorguyu çalıştır ve başarılıysa kullanıcıyı bilgilendir
if ($sorgu2->execute()) {
    echo "Yeni yemek başarıyla eklendi.";
} else {
    echo "Yemek eklenirken bir hata oluştu.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="admin.php"> Yeni Yemek ekle</a>
</body>
</html>