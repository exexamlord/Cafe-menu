<?php 
try {
    $db = new PDO("mysql:host=localhost;dbname=cafedb;charset=utf8","root","");
    echo "Baglanti basarili";
} catch (PDOException $e) {
    echo $e->getMessage();
    echo"basarisiz";
}
?>