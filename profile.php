<?php 
session_start();
$_SESSION['current'] = "explore.php";
$_SESSION['locationToGO'] = "";
$_SESSION['locationReturn'] = "login.php";
require_once("php/session.php");
require_once("php/connection.php"); 
$_table = $_SESSION['loginType'];
$_uname = $_SESSION['username'];


$query = "SELECT * FROM $_table WHERE username LIKE BINARY '$_uname'";
$sqlRun = mysqli_query($connect, $query);
$row = mysqli_fetch_array($sqlRun, MYSQLI_ASSOC);
 ?>

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body onload="validate()" data-spy="scroll" data-target="#navbar" data-offset="98">
  <header>
    <nav class="navbar header-nav navbar-expand-lg">
      <div class="container container-large">
        <a class="navbar-brand" href="#">
          <img class="light-logo" src="static/img/logo.svg" title="" alt="" onclick="location.href='explore.php'">
          <img class="dark-logo" src="static/img/logo.svg" title="" alt="" onclick="location.href='explore.php'">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbar">
          <ul class="navbar-nav align-items-center">
          	<li><a class="nav-link" href="#">Home</a></li>         
            <?php
            //if for user or mitra
            if ($_SESSION['loginType'] == 'user') {
               ?>
               <li><a class="btn btn-theme-yellow" href="input_donasi.php">DONASI SEKARANG</a></li>
               <?php
             }else
             {
              //nothing to show
             }
             ?>
            <li class="nav-item dropdown">
              <div><a href="#" class="ti-user icon-s border-radius yellow-bg" data-toggle="dropdown" role="button"></a>
                <div class="dropdown-menu dropdown-menu-right scale-up"> 
                <?php 
                if ($row['nama']=== NULL) {
                  echo '<a href="#" class="dropdown-item"><i class="ti-user"></i> '.$row["username"].'</a>';
                }else
                {
                  echo '<a href="#" class="dropdown-item"><i class="ti-user"></i> '.$row["nama"].'</a>';
                }

                 ?>
                  <a href="history.php" class="dropdown-item"><i class="ti-wallet"></i> Riwayat <?php echo ($_table=="user")? "Donasi" : "Bermitra" ?></a>
                  <div class="dropdown-divider"></div> 
                    <a href="profile.php" class="dropdown-item">
                      <i class="ti-settings"></i> Pengaturan Akun
                    </a>
                    <div class="dropdown-divider"></div> 
                      <a href="php/logout.php" class="dropdown-item">
                        <i class="fa fa-power-off"></i> Logout
                      </a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
    </nav> 
  </header>
  
  <main>
      
    <!-- Profil -->

    <section id="editprofile" class="section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="side-title">
              <h6 class="theme-color">Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</h6>
              <h2><u>Pengaturan Akun</u></h2>
              <form>
              <div class="form-group row">
                  <label for="inputUsername" class="col-sm-2 col-form-label" >Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" readonly="readonly" value="<?php echo $row['username'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Nama User</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="<?php echo $row['nama'] ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $row['email'] ?>" required>
                  </div>
                </div>
                  <div class="form-group row">
                    <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea name="Alamat" id="Alamat" rows="0" class="form-control" placeholder="Alamat Lengkap" required><?php echo $row['alamat']; ?></textarea>
                    </div>
                  </div>
                <div class="form-group row">
                  <label for="inputTanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" value="<?php echo $row['tanggallahir'] ?>" required>
                  </div> 
                </div>
                <div class="form-group row">
                  <label for="inputHandphone" class="col-sm-2 col-form-label">Handphone</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="handphone" name="handphone" placeholder="Phone Number" value="<?php echo $row['handphone'] ?>" required>
                  </div>
                </div>
                <div class="row">
                  <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                  <div class="col-sm-10">
                    <?php 
                    if ($row['jeniskelamin'] == "Laki-Laki") {
                      echo '<div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gender" value="Laki-Laki" required="true" checked>
                      <label class="form-check-label" for="gender">
                        Laki-Laki
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gender" value="Perempuan" required="true" required="true">
                      <label class="form-check-label" for="gender" >
                        Perempuan
                      </label>
                    </div>';
                    }else{
                      echo '<div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gender" value="Laki-Laki" required="true">
                      <label class="form-check-label" for="gender" >
                        Laki-Laki
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gender" value="Perempuan" required="true" checked>
                      <label class="form-check-label" for="gender">
                        Perempuan
                      </label>
                    </div>';
                    }
                     ?>                    
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Password Lama</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password Lama" value="" required> 
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Password Baru</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputnewPassword" name="inputnewPassword" placeholder="Password Baru" value="" onKeyUp="validate()" required>
                    <span id="span2">Jika password tetap, isi dengan password yang saat ini digunakan <br></span>
                    <span id="span1" style="color : red; visibility: hidden;"></span>
                  </div>
                </div>                
                <div class="form-group row">
                  <div class="col-sm-2">
                    <input type="submit" class="form-control" id="submit" name="submit" value="SIMPAN">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-4">
            <div class="side-title ">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer footer-background">
    <section class="footer-section">
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

<script>
  function validate() {
  var pw1 = document.getElementById('inputPassword');
  var pw2 = document.getElementById('inputnewPassword');
  if (pw2.value.length < 8) {
    document.getElementById('span1').style.visibility = "visible";
    document.getElementById('span1').innerHTML = "Password Minimal 8 Digit";
    document.getElementById('submit').disabled = true;
  }
  else
  {
    document.getElementById('span1').style.visibility = "hidden";
    document.getElementById('submit').disabled = false;
    
  }
}

$(function(){
  $('form').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      type : 'POST',
      data : {
        submit : "submit_update_profile",
        username : $("#username").val(),
        nama : $("#name").val(),
        email : $("#email").val(), 
        alamat : $("#Alamat").val(),
        tanggallahir : $("#tanggallahir").val(),
        password : $("#inputnewPassword").val(),
        handphone : $("#handphone").val(), 
        jeniskelamin : $("#gender:checked").val()       
      },

      url : 'php/controller.php',
      success: function(data)
      {
        alert( data );
        location.reload();
      }
    });
  });
});

</script>