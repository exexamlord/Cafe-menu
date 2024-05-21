<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Baglanti deneme baslangic -->
  
  <!-- kahvalti baglanti -->
  
  
  <?php

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "bilinmeyen hata";   //hata vermece
    exit;
}


include "baglanti.php";

// veritabanı çağır
$urun_id = $_GET['id'];
$sorgu = $db->prepare("SELECT * FROM menu WHERE id = :urun_id");
$sorgu->bindParam(':urun_id', $urun_id);
$sorgu->execute();
$urun = $sorgu->fetch(PDO::FETCH_ASSOC);

// hata 2
if (!$urun) {
    echo "Ürün bulunamadı.";
    exit;
}
?>




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

 
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-center justify-content-md-between">

      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-phone d-flex align-items-center"><span>telefon numarası</span></i>
        <i class="bi bi-clock d-flex align-items-center ms-4"><span>çalışma saatleri</span></i>
      </div>

      
    </div>
  </div>

  
  <header id="header" class="fixed-top d-flex align-items-cente">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.html">Meydan Park Cafe</a></h1>
      

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Anasayfa</a></li>
          
          <li><a class="nav-link scrollto" href="#menu">Menü</a></li>
          
          
          
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <a href="#book-a-table" class="book-a-table-btn scrollto d-none d-lg-flex">Rezervasyon Yap</a>

    </div>
  </header>

    <!-- ======= Menu  ======= -->
    <section id="menu" class="menu section-bg">
      <div class="container" data-aos="fade-up" id="yön12">

      
      
      
      <div class="section-title" style='margin-top: 100px;' >
          <h2>Admin Panel</h2>
          <p>Ürün Düzenle</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100" >
          <div class="col-lg-12 d-flex justify-content-center">
          
         



          <!-- form baslangic.................................................................................................... -->
          <form action="urun_guncelle.php" method="post" style="width: 500px;">
            <input type="hidden" name="urun_id" style="width: 100%;" value="<?php echo $urun['id']; ?>">
            <label for="menu_name">Ürün Adı:</label><br>
            <input type="text" id="menu_name" name="menu_name" style="width: 100%;" value="<?php echo $urun['menu_name']; ?>"><br>
            <label for="menu_price">Fiyatı:</label><br>
            <input type="text" id="menu_price" name="menu_price" style="width: 100%;" value="<?php echo $urun['menu_price']; ?>"><br>
            <label for="menu_ex">Açıklama:</label><br>
            <textarea id="menu_ex" name="menu_ex" style="width: 100%;"><?php echo $urun['menu_ex']; ?></textarea><br>
            <input type="submit" value="Güncelle">
          </form>


        <!-- form bitis............................................................................................................ -->


        
          </div>

          <!-- Form düzenleme ve silme baslangic...................................................................................... -->

        <?php
        
        echo "<h2>Ürünler</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Ürün Adı</th><th>Fiyatı</th><th>Açıklama</th><th>İşlemler</th></tr>";
        
        while ($degisken = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$degisken['menu_name']}</td>";
            echo "<td>{$degisken['menu_price']}</td>";
            echo "<td>{$degisken['menu_ex']}</td>";
            echo "<td><a href='urun_duzenle.php?id={$degisken['id']}'>Düzenle</a> | <a href='urun_sil.php?id={$degisken['id']}' onclick='return confirm(\"Bu ürünü silmek istediğinizden emin misiniz?\")'>Sil</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        
          ?>

        <!-- form düzenleme ve silme bitis.............................................................................................  -->
        </div>

        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">
     


        
        

        



      </div>
      </div>
    </section>
        <!-- menu bitiş ................................................................................................... -->

    

    

            


    

    

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row justify-content-md-center">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Meydan Park Cafe</h3>
              <p>
                Çeşme, Cumhuriyet Myd.  <br>
                Gölhisar/Burdur<br><br>
                <strong>Telefon</strong> +4948948<br>
                <strong>Email:</strong> i@yyyy.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
               
                
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Hızlı Linkler</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Anasayfa</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Menü</a></li>
              
            </ul>
          </div>

          

         

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Meydan Park Cafe</span></strong>. All Rights Reserved
      </div>
      
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  
  
  

  
  
  <script src="main1.js"></script>
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