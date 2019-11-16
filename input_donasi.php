<?php 
session_start();
$_SESSION['current'] = "input_donasi.php";
$_SESSION['locationToGO'] = "";
$_SESSION['locationReturn'] = "login.php";
$_uname = $_SESSION['username'];

require_once("php/session.php");
require_once("php/connection.php"); 

$query1 = "SELECT * FROM user WHERE username LIKE BINARY '$_uname'";
$sqlRun1 = mysqli_query($connect, $query1);
$data1 = mysqli_fetch_array($sqlRun1);
if (mysqli_num_rows($sqlRun1) > 0) {
    $phone = $data1['handphone'];
    $address = $data1['alamat'];
}
?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Donasi</title>
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
                        <li><a class="nav-link" onclick="window.location = 'explore.php'"> &laquo; Kembali ke Beranda</a></li>         
                        </ul>
                      </div>
                    </div>
                </nav> 
              </header>
  
  <main>
    <section class="p-50px-t section" id="donasi">
            <div class="theme-main container mt-5 p-5 mb-5 rounded shadow-sm">
                    <h2 class="theme-after text-white">Donasikan Sampahmu Disini</h2>
                    <h4 class="text-white">Lengkapi Informasi Dibawah Ini Untuk Mulai Berdonasi!</h4>
                    <form action="php/controller.php" method="POST" style="border-top: 0.5px solid ghostwhite" class="pt-3 mt-3" enctype="multipart/form-data">
                    <div>
                        <label for="judul_donasi" class="text-white">Judul Donasi</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Judul donasi" id="judul_donasi" name="judul_donasi" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_sampah" class="text-white">Jenis Sampah</label>
                        <select name="jenis_sampah" id="jenis_sampah" class="custom-select" required>
                            <option value="0">Pilih</option>
                            <option value="Plastik">Plastik</option>
                            <option value="Kertas">Kertas</option>
                            <option value="Botol">Botol</option>
                            <option value="Kaca">Kaca</option>
                            <option value="Besi">Besi</option>
                        </select>
                    </div>
                    <div>
                        <label for="berat_sampah" class="text-white">Total Berat Sampah</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Berat Sampah" id="berat_sampah" name="berat_sampah" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Kg.</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="text-white">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Tuliskan deskripsi seperti : Kondisi sampah & informasi lainya " required></textarea>
                    </div>
                    <div class="form-group">
                        
                    <?php 
                    if ($address === NULL) {
                        echo'<label for="alamat" class="text-white">Alamat Penjemputan</label>
                        <textarea name="alamat" id="alamat" rows="0" class="form-control" placeholder="Alamat Lengkap" required></textarea>
                    </div>';
                    }else{
                        echo '<div class="form-group">
                        <label for="alamat" class="text-white">Alamat Penjemputan</label>
                        <textarea name="alamat" id="alamat" rows="0" class="form-control" placeholder="Alamat Lengkap" required>'.$address.'</textarea>
                    </div>
                        ';
                    }


                    if ($phone === NULL) {
                        echo '<div class="form-group">
                        <label for="tlp" class="text-white">Nomor Telephone</label>
                        <input type="tel" class="form-control d-inline" id="tlp" name="tlp" placeholder="Nomor Telephone Yang Masih Aktif" required>
                    </div>';
                    }else{
                     echo '<div class="form-group">
                        <label for="tlp" class="text-white">Nomor Telephone</label>
                        <input type="number" class="form-control d-inline" id="tlp" name="tlp" placeholder="Nomor Telephone Yang Masih Aktif" value="'.$phone.'" required>
                    </div>';
                    }
                    ?>
                    

                    <div>
                        <label for="input_foto" class="text-white">Upload Foto Sampahmu :</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="input_foto" accept="image/*" onchange="ShowImage(this)" required>
                            <label class="custom-file-label" for="customFile">Pilih file</label>
                        </div>
                        <div id="img"></div>
                    </div>
                    <button class="btn btn-light mt-3" type="button" onclick="window.location = 'explore.php'">Batal</button>
                    <button class="btn btn-theme-2nd mt-3" type="submit" name="submit" value="submit_inputDonasi">Tambahkan Donasi</button>
                    </form>
                </div>
                <script>
                function ShowImage(input) {
                        var element = document.getElementById('img');
                        var stage = true;
                        if (element.children.length === 5) {
                            stage = false;
                        }
                        if (input.files && input.files[0] && stage === true) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                document.getElementById('img').innerHTML = "<img src='"+e.target.result+"' width='100' height='50' class='img-thumbnail m-3'>";
                            };
                            reader.readAsDataURL(input.files[0]);
                        }else{
                            alert("Maksimum input 1 Gambar!");
                        }
                    }
                </script>
    </section>
    </main>
  <script src="static/js/jquery-3.2.1.min.js"></script>
  <script src="static/plugin/bootstrap/js/bootstrap.js"></script>
  <script src="static/js/custom.js"></script>

</body>
</html>