<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Gotong Sampah</title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

  <link href="static/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="static/plugin/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
  <link href="static/plugin/themify-icons/themify-icons.css" rel="stylesheet">
  <link href="static/css/style.css" rel="stylesheet">
  <link href="static/css/color/default.css" rel="stylesheet" id="color_theme">

</head>
<body data-spy="scroll" data-target="#navbar" data-offset="98">
  <header>
    <nav class="navbar header-nav navbar-expand-lg">
      <div class="container container-large">
        <a class="navbar-brand" href="#">
          <img class="light-logo" src="static/img/logo-light.svg" title="" alt="">
          <img class="dark-logo" src="static/img/logo.svg" title="" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbar">
          <ul class="navbar-nav ml-auto align-items-center">
          	<li><a class="nav-link" href="#">Home</a></li>
            <li><a class="nav-link" href="#about">About</a></li>
            <li><a class="nav-link" href="#enviheroes">Environtment Heroes</a></li>
            <li><a class="nav-link" href="#howitworks">How It Works</a></li>
            <li><a class="nav-link" href="#footer">Kontak Kami</a></li>

            <!-- session check for login button -->

            <?php 
              session_start();
              if(isset($_SESSION['username'])){
                $_SESSION['endLoginExpiration'] = time() + (2 * 60 * 60); 
                ?>
                <li><a class="nav-link-btn btn btn-theme-2nd m-25px-l md-m-0px-l" href="explore.php">Explore Donasi</a></li>
                <?php
              }else{
                ?>
                <li><a class="nav-link-btn btn btn-theme-2nd m-25px-l md-m-0px-l" href="login.php">LOG IN</a></li>
                <?php
              }


             ?>

          </ul>
        </div>


      </div>
    </nav> 
  </header>

  <main>
    
    <!-- Home Banner -->
    <section id="home" class="home-section theme-main home-banner">
      <div class="home-effect-bg"><img src="static/img/home-effect.svg" title="" alt="" ></div>
      <div class="container container-large">
        <div class="row align-items-center full-screen p-100px-tb sm-p-30px-b">
          <div class="col-lg-5 p-50px-t sm-p-0px-t sm-p-30px-b">
            <h1>&ldquo;GotongSampah.ID&rdquo;</h1>
            <p>GotongSampah.ID adalah platform peduli lingkungan yang menghubungkan mereka yang memiliki sampah non-organik dengan mitra GotongSampah.ID</p>
            <div class="btn-bar">
              <a class="btn btn-theme-2nd" href="login.php">Mulai Sekarang</a>
            </div>
          </div>
          <div class="col-lg-7 right-img md-m-30px-t">
            <img src="static/img/home-banner-main.svg" title="" alt="">
          </div>
        </div> 
      </div>
    </section>
  
    
    <!-- About Us -->
    <section class="p-50px-t section effect-bg" id="about">
      <div class="container">
        <div class="row justify-content-center m-45px-b md-m-25px-b">
          <div class="col-md-12">
            <div class="section-title text-center">
              <h6 class="theme-color">Kenapa GotongSampah.ID ?</h6>
              <h2 class="theme-after">Sampah Adalah Masalah Kita Bersama</h2>
              <p>Sampah anorganik adalah salah satu permasalahan terbesar dari sekian banyak masalah di sekitar kita. Salah satu cara mengelola sampah anorganik adalah dengan mengolahnya kembali menjadi produk baru. Gotongsampah hadir dengan tujuan membantu menyelesaikan permasalahan ini, tentu nya dengan peran  serta kalian semua !.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 m-15px-tb">
              <div class="feature-box text-center">
                <div class="icon">
                  <i class="ti-world icon-l border-radius yellow-bg"></i>
                </div>
                <h4>Survey Dunia</h4>
                <p>Indonesia adalah negara dengan peringkat kedua penyumbang sampah terbesar didunia.</p>
                
              </div> 
            </div> 

            <div class="col-lg-3 col-md-6 m-15px-tb">
              <div class="feature-box text-center">
                <div class="icon">
                  <i class="ti-user icon-l border-radius yellow-bg"></i>
                </div>
                <h4>Manusia</h4>
                <p>Banyak diantara kita yang memiliki sampah 3R berlebihan dan seringkali dibuang tanpa diolah kembali.</p>
              
              </div>
            </div>

            <div class="col-lg-3 col-md-6 m-15px-tb">
              <div class="feature-box text-center">
                <div class="icon">
                  <i class="ti-layers icon-l border-radius yellow-bg"></i>
                </div>
                <h4>Volume Sampah</h4>
                <p>Volume Sampah di Indonesia Tahun 2018 Diprediksi Mencapai 66,5 Juta Ton.</p>
            
              </div> 
            </div> 

            <div class="col-lg-3 col-md-6 m-15px-tb">
              <div class="feature-box text-center">
                <div class="icon">
                  <i class="ti-trash icon-l border-radius yellow-bg"></i>
                </div>
                <h4>Data Riset</h4>
                <p>Berdasarkan data riset CNN, 24 persen sampah di Indonesia masih tak terkelola.</p>
                
              </div>
            </div> 
          </div>
      </div>
    </section>
  

    <!-- Uraian -->
    <section id="urai" class="section gray-bg">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="side-title">
              <h6 class="theme-color">Lama Waktu Urai</h6>
              <h2>Berapa Lama ?</h2>
              <p>Berapa lama sampah sampah anorganik dapat diuraikan oleh tanah hingga hancur ?.</p>
              <div class="m-30px-t">
                <a class="btn btn-theme" href="#urai">Cek -></a>
              </div>
            </div>
          </div>
          <div class="col-md-6 sm-p-30px-t">
            <div class="count-box counter m-50px-l md-m-0px-l">
              <div class="row no-gutters">
               <div class="col-6">
                  <div class="counter-col">
                    <div class="counter-data">
                      <div class="count" data-to="400" data-speed="400">50 Th</div>
                      <h6>Botol plastik membutuhkan waktu sekitar 50-100 tahun supaya benar-benar terurai</h6>
                    </div>
                  </div> 
                </div>

                <div class="col-6">
                  <div class="counter-col">
                    <div class="counter-data">
                      <div class="count" data-to="400" data-speed="400">80 Th</div>
                      <h6>Kaleng softdrink membutuhkan waktu sekitar 80-100 tahun supaya benar-benar terurai</h6>
                    </div>
                  </div> 
                </div> 

                <div class="col-6">
                  <div class="counter-col">
                    <div class="counter-data">
                      <div class="count" data-to="400" data-speed="400">100 Th</div>
                      <h6>Baterai membutuhkan waktu sekitar 100 tahun supaya benar benar terurai</h6>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="counter-col">
                    <div class="counter-data">
                      <div class="count" data-to="400" data-speed="400">40 Th</div>
                      <h6>Kulit sepatu membutuhkan waktu sekitar 40 tahun supaya benar benar terurai</h6>
                    </div>
                  </div>
                </div> 

              </div> 
            </div>
          </div> 
        </div> 
      </div>
    </section>

    
    <!-- EnviHeroes -->
    <section id="enviheroes" class="section">
      <div class="container">
        <div class="row justify-content-center m-45px-b md-m-25px-b">
          <div class="col-md-10 col-lg-8 col-xl-7">
            <div class="section-title text-center">
             <h6 class="theme-color">Environtment Heroes</h6>
              <h2 class="theme-after">Siapa Environtment Heroes ?</h2>
              <p>Environtment Heroes adalah mereka yang turut ikut serta menjaga lingkungan dengan ikut bergabung dengan GotongSampah.ID</p>
            </div>
          </div>
        </div> 

        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 m-15px-tb">
            <div class="feature-box-01">
              <div class="icon">
                <i class="ti-thumb-up icon-m border-radius red-bg"></i>
              </div>
              <div class="feature-content">
                <h4>GIVER</h4>
                <p>GIVER adalah kamu dan mereka yang dengan sukarela mendonasikan sampah 3R mu ke GotongSampah.ID.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 m-15px-tb">
            <div class="feature-box-01">
              <div class="icon">
                <i class="ti-github icon-m border-radius blue-bg"></i>
              </div>
              <div class="feature-content">
                <h4>TRASH WARRIOR</h4>
                <p>TRASH WARRIOR adalah mereka yang dengan sukarela menjemput setiap donasi dari para GIVER.</p>
              </div>
            </div>
          </div> 

          <div class="col-lg-6 col-md-6 col-sm-6 m-15px-tb">
            <div class="feature-box-01">
              <div class="icon">
                <i class="ti-face-smile icon-m border-radius pink-bg"></i>
              </div>
              <div class="feature-content">
                <h4>PARTNER</h4>
                <p>PARTNER adalah mereka penampung donasi yang bekerja sama dengan GotongSampah.ID untuk menghasilkan sesuatu yang bernilai ekonomis dari donasi para GIVER.</p>
              </div>
            </div>
          </div> 

          <div class="col-lg-6 col-md-6 col-sm-6 m-15px-tb">
            <div class="feature-box-01">
              <div class="icon">
                <i class="ti-comments-smiley icon-m border-radius theme-main"></i>
              </div>
              <div class="feature-content">
                <h4>VOLUNTEER</h4>
                <p>VOLUNTEER adalah kamu dan mereka yang turut membantu operasional dan membagikan informasi seputar GotongSampah.ID.</p>
              </div>
            </div>
          </div> 

        </div> 
      </div> 
    </section>
    

    

    <!-- How It Works -->
    <section id="howitworks" class="section gray-bg">
      <div class="container">
        <div class="row justify-content-center m-60px-b sm-m-40px-b">
          <div class="col-md-10 col-lg-8 col-xl-7">
            <div class="section-title text-center">
              <h6 class="theme-color">HOW IT WORKS</h6>
              <h2 class="theme-after">HOW IT WORKS</h2>
              <img src="img/how.png" alt="">
            </div>
          </div>
        </div>
      </div> 
    </section>
  </main>
 

  <!-- Footer -->
  <footer class="footer footer-background">
    <section class="footer-section" id="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-4 sm-m-15px-tb md-m-30px-b">
            <h4 class="font-alt">Tentang Kami</h4>
            <p class="footer-text">GotongSampah.ID adalah platform peduli lingkungan yang menghubungkan mereka yang memiliki sampah non-organik dengan mitra GotongSampah.ID</p>
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a class="google" href="#"><i class="fab fa-google-plus-g"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
          </div> 

          <div class="col-6 col-md-4 col-lg-2 sm-m-15px-tb">
            <h4 class="font-alt">Kantor</h4>
            <p class="footer-text"><i class="fas fa-building"></i> Amikom</p>
            <p class="footer-text"><i class="fas fa-fa-map-marker-alt"></i> Jl. Ringroad Utara, Condong Catur, Sleman, Yogyakarta</p>
            <p class="footer-text"><i class="fas fa-envelope"></i> gotongsampah@gmail.com</p>
            <p class="footer-text"><i class="fas fa-phone"></i> (021) 798 000</p>
            <p class="footer-text"><i class="fas fa-fax"></i> (021) 798 000</p>
          </div> 

          <div class="col-6 col-md-4 col-lg-2 sm-m-15px-tb">

          </div>

          <div class="col-md-4 col-lg-4 sm-m-15px-tb">
            <h4 class="font-alt">Saran & Pertanyaan</h4>
            <p>Kirimkan Pertanyaan dan Saran Kamu Kepada Kami !.</p>
            <div class="subscribe-box m-20px-t">
              <input placeholder="Masukkan Email Kamu" class="form-control" type="text" name="demo">
              <button class="btn btn-theme"><i class="ti-arrow-right"></i></button>
            </div>
          </div>

        </div>
        
        <div class="footer-copy">
          <div class="row">
            <div class="col-12">
              <p>All © Copyright by GotongSampah.ID. All Rights Reserved.</p>
            </div>
          </div> 
        </div> 

      </div> 
    </section>
  </footer>

  <script src="static/js/jquery-3.2.1.min.js"></script>
  <script src="static/plugin/bootstrap/js/bootstrap.js"></script>
  <script src="static/js/custom.js"></script>
</body>
</html>