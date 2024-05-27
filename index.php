<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  session_start();

  // URL'den masa numarasını al
  $masa_no = $_GET['id'] ?? '';

  // Masa numarasını session'a ata
  $_SESSION['masa_no'] = $masa_no;

  // Kullanıcıyı sepet sayfasına yönlendir
  
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
          <li><a class="nav-link scrollto active" href="/cafenew/index.php?id=<?php echo $masa_no; ?>">Anasayfa</a></li>
          
          <li><a class="nav-link scrollto" href="/cafenew/index.php?id=<?php echo $masa_no; ?>">Menü</a></li>
          
          
          
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <a href="/cafenew/sepet.php?id=<?php echo $masa_no; ?>" class="book-a-table-btn scrollto d-none d-lg-flex">Sepete Git</a>


    </div>
  </header>

  <!-- ======= center başlangıç ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Meydan Park Gölhisar'a<span> Hoşgeldiniz</span></h1>
          <h2>Gölhisar'ın Gözde Parkı</h2>

          <div class="btns">
            <a href="#menu" class="btn-menu animated fadeInUp scrollto">Menü Listesi</a>
            <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Rezervasyon</a>
          </div>
        </div>
        <div class="col-lg-4 d-flex align-items-center justify-content-center position-relative" data-aos="zoom-in" data-aos-delay="200">
          <a href="https://www.youtube.com/watch?v=UFnGSywbZtk" class="glightbox play-btn"></a>
        </div>

      </div>
    </div>
  </section><!-- bitiş -->

  

   

   
    <!-- ======= Menu  ======= -->
    <section id="menu" class="menu section-bg">
      <div class="container" data-aos="fade-up" id="yön12">

        <div class="section-title">
         
          <h2>Menu</h2>
          <p>Bugun Ne Denemek İstersiniz?</p>
        </div>

        <?php
           echo "<span>Masa Numaranız: {$masa_no}"; 
          ?>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul  id="menu-flters">
            <li data-filter="*" class="filter-active">Hepsi</li>
            <li data-filter=".filter-kahvalti">Kahvaltılar</li>
              <li data-filter=".filter-pizza">Pizzalar</li>
              
              
            </ul>
          </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

       

        <!-- manu begin  -->
        <?php  
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

          // Masa numarasına göre sepet adını belirleyin
          $sepet_adi = 'sepet_' . $masa_no;

          if (!empty($_POST["urun_id"]) && is_numeric($_POST["urun_id"])) {
              $urun_id = $_POST["urun_id"];
              if (!isset($_SESSION[$sepet_adi][$urun_id])) {
                  $_SESSION[$sepet_adi][$urun_id] = 1;
              } else {
                  $_SESSION[$sepet_adi][$urun_id]++;
              }
              echo "Ürün sepete eklendi"; // işlem kontrol sonra sil
          } else {
              echo "fail"; 
          }
        }



while ($degisken = $sorgu->fetch(PDO::FETCH_ASSOC)) {
    $filter_class = '';
    if ($degisken['kategori'] == 'kahvalti') {
        $filter_class = 'filter-kahvalti';
    } elseif ($degisken['kategori'] == 'pizza') {
        $filter_class = 'filter-pizza';
    }

    
    
   
    echo "<div class='col-lg-6 menu-item $filter_class'>";
    echo "<img src='verifoto/kahvaltifoto/{$degisken['id']}.jpg' class='menu-img' alt=''>";
    echo "<div class='menu-content'>";
    echo "<span>{$degisken['menu_name']}</span><span>{$degisken['menu_price']} ₺</span>";
    echo "<div id='hero.btn-menu'>";
    echo "<form method='post' action='/cafenew/index.php?id={$masa_no}'>";
    echo "<input type='hidden' name='urun_id' value='{$degisken['id']}'>";
      echo "<a>";
        echo "<button  style='background-color: #CDA45E' type='submit' class='butonekle'>Sepete Ekle</button>";
      echo "</a>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "<div class='menu-ingredients'>{$degisken['menu_ex']}</div>";
    echo "</div>";
}
?>

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