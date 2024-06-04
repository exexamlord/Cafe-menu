<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sepet</title>
    <style>
        * {
            box-sizing: border-box;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 12%;
        }
        .box {
            width: calc(33.33% - 20px);
            padding: 20px;
            border: 2px solid #CDA45E;
            margin-bottom: 40px;
            
        }
       
        .box h2 {
            margin-top: 0;
        }
        .urun-listesi {
            list-style-type: none;
            padding: 0;
        }
        .urun-listesi li {
            margin-bottom: 5px;
        }
        .total-price {
            text-align: center;
            color: #CDA45E;
            font-size: 20px;
            margin-top: 20px;
        }
        .sil-button {
            display: block;
            margin: 0 auto;
            background-color: #CDA45E;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>

<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Meydan Park Gölhisar</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
    <!-- font  -->
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- CSS -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<header id="header" class="fixed-top d-flex align-items-cente">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.html">Meydan Park Cafe</a></h1>
      

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Anasayfa</a></li>
          
          <li><a class="nav-link scrollto" href="index.php">Menü</a></li>
          
          <li><a class="nav-link scrollto active" href="admin.php">ADMİN</a></li>
          
          
          
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <a href="admin.php" class="book-a-table-btn scrollto d-none d-lg-flex">Menü Düzenleme</a>
    
    </div>
  </header>


<div class="container">
<?php
session_start();
include "baglanti.php";

$toplam_masa_sayisi = 9;

// Her masa için kutucuk oluştur
for ($masa_no = 1; $masa_no <= $toplam_masa_sayisi; $masa_no++) {
    $sepet_adi = 'sepet_' . $masa_no;

    echo "<div class='box'>";
    echo "<h2>Masa $masa_no</h2>";

    if (!isset($_SESSION[$sepet_adi]) || empty($_SESSION[$sepet_adi])) {
        echo "<p>Sepetiniz Boş</p>";
    } else {
        $total_price = 0; // Toplam fiyat için değişken
       
       
        echo "<ul class='urun-listesi'>";
        foreach ($_SESSION[$sepet_adi] as $urun_id => $adet) {
            $sorgu = $db->prepare("SELECT * FROM menu WHERE id = :urun_id");
            $sorgu->bindParam(':urun_id', $urun_id);
            $sorgu->execute();
            $urun = $sorgu->fetch(PDO::FETCH_ASSOC);
            
            // Ürünleri listele
            $toplam_fiyat = $urun['menu_price'] * $adet;
            echo "<li>$adet adet - {$urun['menu_name']} - {$urun['menu_price']}TL - $toplam_fiyat TL</li>";
            
            // Toplam fiyatı güncelle
            $toplam_fiyat = $urun['menu_price'] * $adet;
            $total_price += $toplam_fiyat;
        }
        echo "</ul>";

        // Toplam fiyatı ve sepeti sil butonunu ekle
        echo "<p class='total-price'>Toplam Fiyat: $total_price TL</p>";
        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
        echo "<input type='hidden' name='masa_no' value='$masa_no'>";
        echo "<button type='submit' name='sil' class='sil-button'>Hesabı Al</button>";
        echo "</form>";
    }
    echo "</div>";
}

// Sepeti sil
if (isset($_POST['sil'])) {
    $masa_no = $_POST['masa_no'];
    $sepet_adi = 'sepet_' . $masa_no;
    unset($_SESSION[$sepet_adi]);
    echo "<meta http-equiv='refresh' content='0'>"; // Sayfayı yenile
}
?>
</div>


<div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- js bootstrap -->
  <script src="assets/vendor/aos/aos.js"></script> 
   <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script> 

</body>
</html>
