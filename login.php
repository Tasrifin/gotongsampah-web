<?php 
session_start();
$_SESSION['current'] = "login.php";
$_SESSION['locationToGO'] = "explore.php";
$_SESSION['locationReturn'] = "login.php";
require_once("php/session.php");
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="static/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/plugin/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="static/plugin/themify-icons/themify-icons.css" rel="stylesheet">
    <link href="static/css/style.css" rel="stylesheet">
    <link href="static/css/color/default.css" rel="stylesheet" id="color_theme">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Masuk ke Gotong Sampah</title>
</head>

<body class="bg-light">
    <div class="container bg-white mx-auto mt-5 shadow" border-radius: 25px;">
        <div class="row" style="height: 550px;">
            <div class="col-sm-4 p-5 text-left theme-main" style="height:100%; border-radius: 25px 0px 0px 25px">
                <h3 class="leads text-white">Masuk ke GotongSampah.ID</h3>
                <div class="display-4 text-white font-weight-light small">GotongSampah.ID adalah platform peduli lingkungan yang menghubungkan mereka yang memiliki sampah non-organik dengan
                mitra GotongSampah.ID</div>
                <h4 class="mt-5 lead text-white">Belum punya akun? <a href="signup.php" class="text-warning">Daftar</a></h4>
                <img src="static/img/home-banner-main.svg" class="mx-auto" style="width: 300px; height: auto;">
            </div>
            <div class="col-sm-8 p-3">
                <form>
                    <div class="form-group">
                        <label for="type_login">Login Sebagai</label>
                        <select name="type_login" id="type_login" class="custom-select" required>
                            <option value="0">MITRA</option>
                            <option value="1">Pengguna</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Username* </label>
                        <input class="form-control" type="text" id="username" placeholder="Masukan Username" name="username"  required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password* </label>
                        <input class="form-control" type="password" id="password" placeholder="Masukan Password" name="password"  required>
                    </div>
                    <p class="small">Dengan login, Anda setuju dengan <a href="#">syarat, ketentuan dan kebijakan
                            privasi dari Lumpang</a></p>
                    <div class="text-center">
                        <button type="button" class="btn btn-light" style="border-radius:25px;" onclick="location.href='index.php'">Batal</button>
                        <button type="submit" class="btn btn-theme-2nd " style="border-radius:25px;" value="submit_login" id="submit" name="submit">Masuk</button>
                    </div>
                    </form>
                    <div class="form-inline mt-5">
                        <label class="mr-3 col-sm-12">Atau Daftar Dengan : </label>
                        <button type="button" class="btn btn-light mt-sm-3 col-sm-6" style="border-radius:25px;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><i
                                class="fab fa-facebook-f pr-2 text-center" style="font-size:20px;color: #5770A6;"> </i>
                            Facebook</button>
                        <button type="button" class="btn btn-light mt-sm-3 col-sm-6" style="border-radius:25px;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><i
                                class="fab fa-google pr-2 text-center" style="font-size:20px;color: #E06555;"> </i> Google</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
$(function(){
  $('form').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      type : 'POST',
      data : {
        submit : $("#submit").val(),
        username : $("#username").val(),
        password : $("#password").val(),
        type_login : $("#type_login").val()
      },

      url : 'php/controller.php',
      success: function(data)
      {
        alert(data);
        window.location = "explore.php";
      },
    error:function(data){
        alert("Gagal Login!");
    }
    });

  });
});
</script>