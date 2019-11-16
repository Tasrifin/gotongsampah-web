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
</head>
<body data-spy="scroll" data-target="#navbar" data-offset="98">
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
                <a href="#" class="dropdown-item"><i class="ti-user"></i> <?php echo $row['nama']; ?></a>
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
      
    <!-- Selamat Datang -->
    <section class="section" id="about">
      <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center">
             <h6 class="theme-color">SELAMAT DATANG<br><?php echo $row['nama']; ?> !</h6>
              <h2 class="theme-after">Riwayat <?php echo ($_table=="user")? "Donasi" : "Bermitra" ?> Kamu</p>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Donasi -->
    <section class="section">
      <div class="container">
        <div class="row">
            <?php 
            if ($_table == "user") {
              $id = $row['id_user'];
              $query2 = "SELECT * FROM donasi WHERE fkid_user = '$id' ORDER BY id_donasi DESC";
            }else
            {
              $id = $row['id_mitra'];
              $query2 = "SELECT * FROM donasi WHERE fkid_mitra = '$id' ORDER BY id_donasi DESC";
            }
            $sqlRun2 = mysqli_query($connect,$query2);
            
            if(mysqli_num_rows($sqlRun2) > 0)
            {
              //pick 1 image for show
              while ($data1 = mysqli_fetch_array($sqlRun2)) {
                $id_donasi = $data1['id_donasi'];
                $query3 = "SELECT * FROM gambar_donasi WHERE id_donasi = '$id_donasi' LIMIT 1";
                $sqlRun3 = mysqli_query($connect, $query3);
                if (mysqli_num_rows($sqlRun2) > 0) {
                  $data2 = mysqli_fetch_array($sqlRun3);
                  $gambarError = "img/error-404.png";
                  $gambar = $data2['gambar'];

                  echo '
                  <div class="col-xs-6 col-md-4">
                    <div class="card" style="margin-bottom: 10%; ">
                       <div class="wrapper">
                       '.(file_exists($gambar) ? '<img class="card-img-top img-fluid" src="'.$gambar.'" alt="Card image cap">' : '<img class="card-img-top img-fluid" src="'.$gambarError.'" alt="Card image cap">').'
                        </div>
                       <h4 class="card-title" style="margin-left:3%;">'.$data1['Judul_Donasi'].'</h4>
                      <div class="card-body">
                      <p class="card-text">'.$data1['informasi_donasi'].' </p>
                      <button class="btn btn-theme-yellow" data-toggle="modal" data-target="#detail_'.$data1['id_donasi'].'">Detail</button>          
                    </div>
                    </div>
                  </div>

                  ';
                }
                else
                {
                  echo "no pic";
                }

                //print_r($data1);

                echo'
            <!-- Modal -->
                  <div class="modal fade" id="detail_'.$data1['id_donasi'].'" tabindex="-1">';
                  

                  $query4 = "SELECT * FROM donasi WHERE id_donasi LIKE BINARY '".$data1['id_donasi']."'";
                  $sqlRun4 = mysqli_query($connect, $query4);
                  $data3 = mysqli_fetch_array($sqlRun4);

                  $query5 = "SELECT * FROM gambar_donasi WHERE id_donasi LIKE BINARY '".$data1['id_donasi']."'";
                  $sqlRun5 = mysqli_query($connect, $query5);
                  $data4 = mysqli_fetch_array($sqlRun5);

                  $id_user_donatur = $data3['fkid_user'];

                  $query6 = "SELECT * FROM user WHERE id_user LIKE BINARY '$id_user_donatur'";
                  $sqlRun6 = mysqli_query($connect, $query6);
                  $data5 = mysqli_fetch_array($sqlRun6);
                  

                  echo '
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Detail Donasi : #'.$data3['id_donasi'].'</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="card">
                            <div style="display: flex; justify-content: center;">
                              <img src="'.$data4['gambar'].'" style="height:40%;">                          
                            </div>
                            <h4 class="card-title" style="margin-left:3%;">'.$data3['Judul_Donasi'].'</h4>
                            <div class="card-body">
                              <p class="card-text">Jenis : '.$data3["jenis_donasi"].'</p>
                              <p class="card-text">Jumlah : '.$data3["jumlah_donasi"].' KG</p>
                              <p class="card-text">Informasi : '.$data3["informasi_donasi"].' </p>
                              <p class="card-text">Donatur : '.$data5["nama"].'</p>
                              <p class="card-text">Kontak : '.$data5["handphone"].'</p>
                              <p class="card-text">Alamat : '.$data5["alamat"].'</p>
                            </div>
                        </div>
                      </div>';

                      echo '
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        ';

                        if ($_table == "user") {
                          if ($data3['fkid_user'] == $row['id_user']) {
                            if ($data3['fkid_mitra'] === NULL) {
                              echo '
                              <button type="button" class="btn btn-theme-yellow" data-toggle="modal" data-target="#edit_'.$data3["id_donasi"].'" data-dismiss="modal"><i class="ti-pencil-alt"></i></button>
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus_'.$data3["id_donasi"].'" data-dismiss="modal"><i class="ti-trash"></i></button>
                              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#konfirmasi_'.$data3["id_donasi"].'" data-dismiss="modal">Konfirmasi</button>';
                            }else
                            {
                              echo '
                              <button type="button" class="btn btn-theme-yellow" data-toggle="modal" data-target="" data-dismiss="modal" disabled><i class="ti-pencil-alt"></i></button>
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="" data-dismiss="modal" disabled><i class="ti-trash"></i></button>
                              <button type="button" class="btn btn-success" data-toggle="modal" data-target="" data-dismiss="modal" disabled>Telah Diambil</button>';
                            }
                          }else{

                          }
                          
                        }
                        else
                        {
                          if ($data3['fkid_mitra'] === NULL) {
                              echo '
                              <a class="btn btn-success" data-dismiss="tel:'.$data5["handphone"].'" href="tel:'.$data5["handphone"].'"><i class="fas fa-phone"> Telepon</i></a>
                            <a class="btn btn-success" data-dismiss="callto:'.$data5["handphone"].'" href="mailto:'.$data5["email"].'"><i class="fas fa-envelope-square"> Email</i></a>';
                          }else{
                            echo '<a class="btn btn-danger" style="color:white" data-dismiss="modal">Donasi telah diambil</a>';
                          }
                                                 
                        }

                        
                        echo '                  

                      </div>
                    </div>
                  </div>
                </div>
            ';

            echo'
              <!-- Modal Konfirmasi -->
              <div class="modal fade" id="konfirmasi_'.$data3["id_donasi"].'" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="konfirmasi">Konfirmasi Pengambilan Donasi #'.$data3["id_donasi"].'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="form-group">
                        <label for="username" class="col-form-label">Username Mitra Penerima</label>
                        <input placeholder="Username Mitra Penerima" type="text" id="uname_mitra_konfirmasi'.$data3["id_donasi"].'" class="form-control" placeholder="Username Mitra Penerima" required>
                      </div>
                      <div class="form-group">
                        <label for="phone" class="col-form-label">Nomor Handphone Mitra Penerima</label>
                        <input type="number" id="hp_mitra_konfirmasi'.$data3["id_donasi"].'" class="form-control" placeholder="Nomor Handphone Mitra Penerima" required>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" onclick="konfirmasiDonasi('.$data3["id_donasi"].')" >Konfirmasi</button>
                  </div>
                </div>
              </div>
            </div>
            ';

            echo'
            <!-- Modal Hapus -->
            <div class="modal fade" id="hapus_'.$data3["id_donasi"].'" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">';
              if ($data3['fkid_user'] == $row['id_user']) {
                echo '
                  <div class="modal-header">
                    <h5 class="modal-title" id="hapus">Hapus Donasi #'.$data3["id_donasi"].'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ';
                    if ($data3['fkid_mitra'] === NULL) {
                      echo '
                      <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus data ini ?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">BATAL</button>
                        <button type="button" id="delData" class="btn btn-danger" onclick="hapusData('.$data3["id_donasi"].')">HAPUS</button>
                        </div>';

                      }else{
                      echo '
                      <div class="modal-body">
                        <p>Sampah telah diambil oleh Mitra, Data tidak dapat dihapus!</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">BATAL</button>
                        </div>
                        ';
                    }
              }
              else
              {
                echo '
                  <div class="modal-header">
                    <h5 class="modal-title" id="hapus">Tidak dapat mengakses donasi milik orang lain!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                      <p>Tidak dapat mengakses donasi milik orang lain!!</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">KELUAR</button>
                      </div>';
              }

                  echo '
                </div>
              </div>
            </div>
          
            ';

            echo'
              <!-- Modal Edit -->
              <div class="modal fade  bd-example-modal-lg" id="edit_'.$data3["id_donasi"].'">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="edit">Edit Data Donasi #'.$data3["id_donasi"].'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                  </div>
                  <div class="modal-body">
                    <form>
                    <div>
                        <label for="judul_donasi">Judul Donasi</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Judul donasi" id="judul_donasi'.$data3["id_donasi"].'" name="judul_donasi" value="'.$data3["Judul_Donasi"].'" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jenis_sampah">Jenis Sampah</label>
                        <select name="jenis_sampah" id="jenis_sampah'.$data3["id_donasi"].'" class="custom-select" required>';

                    if ($data3['jenis_donasi']=="Plastik") {
                      echo'                  
                          <option value="">Pilih</option>
                          <option value="Plastik" selected>Plastik</option>
                          <option value="Kertas">Kertas</option>
                          <option value="Botol">Botol</option>
                          <option value="Kaca">Kaca</option>
                          <option value="Besi">Besi</option>';
                    }else if ($data3['jenis_donasi']=="Kertas") {
                      echo'                  
                          <option value="">Pilih</option>
                          <option value="Plastik">Plastik</option>
                          <option value="Kertas" selected>Kertas</option>
                          <option value="Botol">Botol</option>
                          <option value="Kaca">Kaca</option>
                          <option value="Besi">Besi</option>';
                    }else if ($data3['jenis_donasi']=="Botol") {
                      echo'                  
                          <option value="">Pilih</option>
                          <option value="Plastik">Plastik</option>
                          <option value="Kertas">Kertas</option>
                          <option value="Botol" selected>Botol</option>
                          <option value="Kaca">Kaca</option>
                          <option value="Besi">Besi</option>';
                    }else if ($data3['jenis_donasi']=="Kaca") {
                      echo'                  
                          <option value="">Pilih</option>
                          <option value="Plastik">Plastik</option>
                          <option value="Kertas">Kertas</option>
                          <option value="Botol">Botol</option>
                          <option value="Kaca" selected>Kaca</option>
                          <option value="Besi">Besi</option>';
                    }else if ($data3['jenis_donasi']=="Besi") {
                      echo'                  
                          <option value="">Pilih</option>
                          <option value="Plastik">Plastik</option>
                          <option value="Kertas">Kertas</option>
                          <option value="Botol">Botol</option>
                          <option value="Kaca">Kaca</option>
                          <option value="Besi" selected>Besi</option>';
                    }
                    echo'
                        </select>
                    </div>

                    <div>
                        <label for="berat_sampah">Total Berat Sampah</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Berat Sampah" id="berat_sampah'.$data3["id_donasi"].'" name="berat_sampah" value="'.$data3["jumlah_donasi"].'" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Kg.</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi'.$data3["id_donasi"].'" class="form-control" rows="3" placeholder="Tuliskan deskripsi seperti : Kondisi sampah & informasi lainya " required>'.$data3["informasi_donasi"].'</textarea>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Penjemputan</label>
                        <textarea name="alamat" id="alamat'.$data3["id_donasi"].'" rows="0" class="form-control" placeholder="Alamat Lengkap" required>'.$data5["alamat"].'</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tlp">Nomor Telephone</label>
                        <input type="tel" class="form-control d-inline" id="tlp'.$data3["id_donasi"].'" name="tlp" placeholder="Nomor Telephone Yang Masih Aktif" value="'.$data5["handphone"].'" required>
                    </div>
                    
                    </form>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                  <button type="button" class="btn btn-success" onclick="updateDonasi('.$data3["id_donasi"].')">SIMPAN</button>
                  </div>
                </div>
              </div>
            </div>
            ';

            }
          }
          else
          {
          echo '

          <h5>Tidak Ada Data Donasi Sampah</h5>';
          }
            
            ?>

          


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