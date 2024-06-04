<!DOCTYPE html>
<html lang="en">
 <style>
    * {
  box-sizing: border-box;
}
.box {
  float: left;
  flex: 1;
  width: 33.33%; /* three boxes (use 25% for four, and 50% for two, etc) */
  padding: 50px; /* if you want space between the images */
  border: 3px rgb(218,165,32);
  border-style: double;
}
 </style>
<head>
    <?php
    session_start();
    ?>

  <!-- Baglanti deneme baslangic -->
  
  <!-- kahvalti baglanti -->
  <?php
  include "baglanti.php";
  $sorgu = $db->prepare("select * from menu");
  $sorgu->execute();
  ?>




  <!-- Baglanti deneme bitis -->



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
      <a href="#book-a-table" class="book-a-table-btn scrollto d-none d-lg-flex">Rezervasyon Yap</a>
    
    </div>
  </header>

  
   
    <!-- ======= Menu  ======= -->
    <section id="menu" class="menu section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>HESAP</h2>
        </div>
        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200"></div>
        </div>


<div class="box">
<form>
    <h1>Masa Numarası: 1</h1>
</form>      
<?php
$total_price = 0; // Toplam fiyatı saklamak için değişken

if (isset($_POST['remove_from_cart'])) {
    $urun_id = $_POST['urun_id'];

    if (isset($_SESSION['sepet'][$urun_id])) {
        unset($_SESSION['sepet'][$urun_id]);
    }
}

if (!isset($_SESSION['sepet']) || empty($_SESSION['sepet'])) {
    echo "<h1></h1>";
} else {
    echo "<div style='text-align: center; margin-top: 100px;'>";
    echo "<div style='margin: 0 auto; display: inline-block; '>";
    echo "<table style='margin-bottom: 10px;'>";
    echo "<thead><tr><th>Ürün Adı</th><th>Adet</th><th>Birim Fiyat</th><th>Toplam Fiyat</th></tr></thead>";
    echo "<tbody>";
    foreach ($_SESSION['sepet'] as $urun_id => $adet) {
        $sorgu = $db->prepare("SELECT * FROM menu WHERE id = :urun_id");
        $sorgu->bindParam(':urun_id', $urun_id);
        $sorgu->execute();
        $urun = $sorgu->fetch(PDO::FETCH_ASSOC);

        // Toplam fiyatı güncelle
        $toplam_fiyat = $urun['menu_price'] * $adet;
        $total_price += $toplam_fiyat;

        echo "<tr>";
        echo "<td>{$urun['menu_name']}</td>";
        echo "<td>{$adet}</td>";
        echo "<td>{$urun['menu_price']} ₺</td>";
        echo "<td>{$toplam_fiyat} ₺</td>";
        echo "<td>";
        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
        echo "<input type='hidden' name='urun_id' value='{$urun['id']}'>";
        echo "<button style='background-color: #CDA45E' type='submit' class='butonekle'>Sepetten Kaldır</button>";
        echo "<input type='hidden' name='remove_from_cart' value='1'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>"; // div kapanışı
    echo "</div>"; // div kapanışı

    // Toplam fiyatı göster
    echo "<p style='text-align: center; color:#CDA45E; font-size: 25px;'>Toplam Fiyat: {$total_price} ₺</p>";
}

?>
</div>








    </section><!-- menu bitiş -->

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




