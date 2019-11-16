<?php 
session_start();
$_SESSION['current'] = "signup.php";
$_SESSION['locationToGO'] = "explore.php";
$_SESSION['locationReturn'] = "signup.php";
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
    <title>Daftar Akun Gotong Sampah</title>
</head>

<body class="bg-light" ng-app="myApp">
    <div class="container bg-white mx-auto mt-5 shadow" style="height:80%; border-radius: 25px;">
        <div class="row" style="height: 650px;">
            <div class="col-sm-4 p-5 text-left theme-main" style="height:100%; border-radius: 25px 0px 0px 25px">
                <h3 class="leads text-white">Sangat Mudah Untuk Mendaftar!</h3>
                <div class="display-4 text-white font-weight-light small">Dengan mendaftar kamu akan berkontribusi
                    untuk mengurangi permasalahan sampah di Indonesia</div>
                <h4 class="mt-5 lead text-white">Sudah punya akun? <a href="login.php" class="text-warning">Masuk</a></h4>
                <img src="static/img/home-banner-main.svg" class="mx-auto" style="width: 300px; height: auto;">
            </div>
            <div class="col-sm-8 p-3">
                <form>
                    <div class="form-group">
                        <label for="username">Username* </label>
                        <input class="form-control" type="text" id="username" name="username" placeholder="Masukan Username" required="">
                    </div>
                    <div class="form-group">
                        <label for="email">Email* </label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Masukan Email" required="">
                    </div>
                    <div class="form-group">
                        <label for="password">Password* </label>
                        <input class="form-control" type="password" id="password" name="password" onKeyUp="validate()" placeholder="Masukan Password" required="">                    
                    </div>
                    <div class="form-group">
                        <label for="password">Retype Password* </label>
                        <input class="form-control" type="password" id="repassword" onKeyUp="validate()" placeholder="Masukan Ulang Password" required="">
                    </div>
                    <span id="span1" style="color : red; visibility: hidden;"></span>
                    <div class="form-group">
                        <label for="type_signup">Daftar Sebagai</label>
                        <select name="type_signup" id="type_signup" class="custom-select" name="type_signup" required>
                            <option value="0">MITRA</option>
                            <option value="1">Pengguna</option>
                        </select>
                    </div>
                    <p class="small">Dengan mendaftar, Anda setuju dengan <a href="#">syarat, ketentuan dan kebijakan privasi dari GOTONG SAMPAH</a></p>
                    <div class="text-center">
                    <button type="button" class="btn btn-light" style="border-radius:25px;" onclick="location.href='index.php'">Batal</button>
                    <button type="submit" id="submit" name="submit" class="btn btn-theme-2nd" name="submit" value="submit_signup" style="border-radius:25px;" disabled>Daftar</button>
                    </div>
                </form>
                <div class="form-inline mt-3">
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
      function validate() {
      var pw1 = document.getElementById('password');
      var pw2 = document.getElementById('repassword');
      if (pw1.value.length < 8) {
        document.getElementById('span1').style.visibility = "visible";
        document.getElementById('span1').innerHTML = "Password Minimal 8 Digit";
        document.getElementById('submit').disabled = true;
      }
      else
      {
        document.getElementById('span1').style.visibility = "hidden";
        if (pw1.value == pw2.value) {
          document.getElementById('span1').style.visibility = "hidden";
          document.getElementById('submit').disabled = false;
        }else{
          document.getElementById('span1').style.visibility = "visible";
          document.getElementById('span1').innerHTML = "Password Tidak Sama!";
          document.getElementById('submit').disabled = true;
        }
      }
    }

    $(function(){
      $('form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
          type : 'POST',
          data : {
            submit : $("#submit").val(),
            username : $("#username").val(),
            email : $("#email").val(),
            password : $("#password").val(),
            type_signup : $("#type_signup").val()
          },

          url : 'php/controller.php',
          success: function(data)
          {
            alert(data);
            if (data == "Registrasi akun berhasil") {
                window.location = "explore.php";
            }else{
                location.reload();
            }
            
          }
        });

      });
    });    
</script>