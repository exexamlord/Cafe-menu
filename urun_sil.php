<?php
include "baglanti.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "hata111";
    exit;
}


$urun_id = $_GET['id'];
$sorgu = $db->prepare("DELETE FROM menu WHERE id = :urun_id");
$sorgu->bindParam(':urun_id', $urun_id);


$sorgu->execute();


header("Location: admin.php");
exit();
?>
