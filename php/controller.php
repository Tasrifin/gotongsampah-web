<?php 
require_once("connection.php"); 
session_start();
 
if(isset($_POST['submit']))
{
	$set = $_POST['submit'];
	/*testing only allowed!*/


	if ($set == "submit_login") {
		//echo "<pre>";
		//print_r($_POST);
		//echo "</pre>";
		$_username = $_POST['username'];
		$_password = md5($_POST['password']);
		$_loginType = $_POST['type_login'];
		// 0 mean mitra and 1 mean user
		if ($_loginType == 0) {
			//login mitra in here.
			$_table = "mitra";
			$_SESSION['loginType'] = "mitra";
			login($_table, $_username, $_password, $connect);
		}
		else if($_loginType == 1){
		//login user in here.
			$_table = "user";
			$_SESSION['loginType'] = "user";
			login($_table, $_username, $_password, $connect);
		}
	}
	else if ($set == "submit_signup") {
		$_signupType = $_POST['type_signup'];
		$_username	= $_POST['username'];
		$_email = $_POST['email'];
		$_password = md5($_POST['password']) ;
		if($_signupType == 0)
		{
			$_table = "mitra";
			signup($_table, $_username, $_email, $_password, $connect);
		}else if($_signupType == 1)
		{
			$_table = "user";
			signup($_table, $_username, $_email, $_password, $connect);
		}
	}
	else if($set == "submit_inputDonasi"){
		//echo "asdasdasasd";
			$imageSum = count($_FILES['image']['name']);
			$checker1 = 0;
			$errno = "File tidak dapat di-upload, error :";

			/*debug start
			echo "<pre>";
			print_r($_POST);
			print_r($_FILES);
			echo "</pre>";
			debug end*/
			
				if ($_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/jpg" || $_FILES['image']['type'] == "image/png" || $_FILES['image']['type'] == "image/gif") 
				{
					$checker1++;
				}
				else
				{
					$errno .= "\\nFile gambar tidak sesuai extensi yang diperbolehkan!";
				}
			

			if ($checker1 > 0) {
				$uname = $_SESSION['username'];
				$query1 = "SELECT * FROM user WHERE username LIKE BINARY '$uname'";
				$sqlRun1 = mysqli_query($connect, $query1);
				$data1 = mysqli_fetch_array($sqlRun1);
				if (mysqli_num_rows($sqlRun1) > 0) {
					//echo "id user = ".$data1['id_user']; //di echo buat melihat data tok.
					//pick post-ed variable
					$_judulSampah = $_POST['judul_donasi'];
					$_jenisSampah = $_POST['jenis_sampah'];
					$_beratSampah = $_POST['berat_sampah'];
					$_deskripsi = $_POST['deskripsi'];
					$_alamat = $_POST['alamat'];
					$_tlp = $_POST['tlp'];
					$_idUser = $data1['id_user'];
					$_keypicker = time().generateRandomString();



					if ($data1['alamat'] == $_alamat) {
						# code...
					}else
					{
						$queryUpdate = "UPDATE `user` SET `alamat` = '$_alamat' where id_user ='$_idUser'";
						$sqlRunUpdate = mysqli_query($connect, $queryUpdate);
					}

					if ($data1['handphone'] == $_tlp) {
						
					}
					else{
						$queryUpdate = "UPDATE `user` SET `handphone` = '$_tlp' where id_user ='$_idUser'";
						$sqlRunUpdate = mysqli_query($connect, $queryUpdate);
					}

					

					$query2 = "INSERT INTO `donasi`(`Judul_Donasi`, `fkid_user`, `jenis_donasi`, `jumlah_donasi`, `informasi_donasi`, `keypicker`) VALUES ('$_judulSampah','$_idUser', '$_jenisSampah', '$_beratSampah', '$_deskripsi', '$_keypicker')";
					$sqlRun2 = mysqli_query($connect, $query2);
					if (mysqli_affected_rows($connect) > 0) {
						//echo "status = good<br>";

						$query3 = "SELECT id_donasi FROM donasi WHERE informasi_donasi LIKE BINARY '$_deskripsi' AND keypicker LIKE BINARY '$_keypicker'";
						$sqlRun3 = mysqli_query($connect, $query3);
						$data3 = mysqli_fetch_array($sqlRun3);
						if (mysqli_num_rows($sqlRun3) > 0) {
							//echo "sukses ke2";
							$id_donasi = $data3['id_donasi'];
							
							$filename = $_FILES["image"]["name"];
							$filetmp = $_FILES["image"]["tmp_name"];
							$filetype = $_FILES["image"]["type"];
							$fileData = pathinfo(basename($_FILES["image"]["name"]));
							$extension = $fileData["extension"];
							$filename = time().generateRandomString().'.'.$extension;
							$filepath = "../img/".$filename;
							$filetmp = compressImage($filetmp,$filepath,60);
							$newfilepath = "img/".$filename;

							move_uploaded_file($filetmp, $filepath);
							$query4 = "INSERT INTO `gambar_donasi`(`id_donasi`, `gambar`) VALUES ('$id_donasi','$newfilepath')";
							$sqlRun4 = mysqli_query($connect, $query4);
							if (mysqli_affected_rows($connect) > 0) {
								?>
								<script>
									alert("Upload donasi berhasil!");
									window.location = "../explore.php"
								</script>
								<?php
							}else{
								?>
								<script>
								alert("Gagal upload data");
								window.history.back();
								</script>
								<?php
								echo "gagal bosss 4";
							}
							
					}else
					{
						?>
						<script>
						alert("Gagal upload data 3");
						window.history.back();
						</script>
						<?php
						echo "gagal bosss";
					}
					}else{
						?>
						<script>
						alert("Gagal upload data 2");
						window.history.back();
						</script>
						<?php
						echo "gagal bosss";
					}
				}else{
					?>
					<script>
					alert("Gagal upload data 1");
					window.history.back();
					</script>
					<?php
					echo "gagal bosss";
				}
			}
			else
			{
				?>
				<script>
				alert("<?php echo "$errno" ?>");
				window.history.back();
				</script>
				<?php
				echo $errno;
			}
	}
	else if ($set == "submit_delete_donasi") {
		$_idDonasi = $_POST['id_donasi'];
		$queryDelete = "DELETE FROM `donasi` WHERE id_donasi = '$_idDonasi'";
		if (mysqli_query($connect,$queryDelete)) {
			echo "Data donasi berhasil dihapus!";
		}else{
			echo "Data donasi gagal dihapus!";
		}
	}
	else if ($set == "submit_konfirm_donasi") {
		$id_donasi = $_POST['id_donasi'];
		$uname_mitra = $_POST['uname_mitra'];
		$hp_mitra = $_POST['hp_mitra'];
		$ecount = 0;

		if (strlen($uname_mitra)>0) {
			$ecount++;
		}else
		{			
			echo "Silahkan isi Username Mitra!\n";
		}

		if (strlen($hp_mitra)>0) {
			$ecount++;
		}
		else
		{			
			echo "Silahkan isi No.HP Mitra";
		}

		if ($ecount == 2) {
			$queryCheckMitra = "SELECT * FROM mitra WHERE username LIKE BINARY '$uname_mitra' AND handphone LIKE BINARY '$hp_mitra'";
			$sqlRunCheckMitra = mysqli_query($connect, $queryCheckMitra);
			$dataMitra = mysqli_fetch_array($sqlRunCheckMitra);
			if (mysqli_num_rows($sqlRunCheckMitra) > 0) {
				$idMitra = $dataMitra['id_mitra'];
				$queryUpdateDonasi = "UPDATE `donasi` SET `fkid_mitra`= '$idMitra' WHERE id_donasi = '$id_donasi'";
				$sqlRunUpdateDonasi = mysqli_query($connect,$queryUpdateDonasi);
				if (mysqli_affected_rows($connect) > 0) {
					echo "Data donasi berhasil dikonfirmasi pengambilannya!";
					$ecount++;
					
				}else{
					echo "Data donasi gagal dikonfirmasi pengambilannya!";
				}
			}
			else
			{
				echo "Username dan Handphone Mitra Tidak Sesuai!";
			}

		}
	}
	else if ($set == "submit_update_donasi") {
		$uname = $_SESSION['username'];
		$query1 = "SELECT * FROM user WHERE username LIKE BINARY '$uname'";
		$sqlRun1 = mysqli_query($connect, $query1);
		$data1 = mysqli_fetch_array($sqlRun1);
		if (mysqli_num_rows($sqlRun1) > 0) {
			//echo "id user = ".$data1['id_user']; //di echo buat melihat data tok.
			//pick post-ed variable
			$_idDonasi = $_POST['id_donasi'];
			$_judulSampah = $_POST['judul_donasi'];
			$_jenisSampah = $_POST['jenis_sampah'];
			$_beratSampah = $_POST['berat_sampah'];
			$_deskripsi = $_POST['deskripsi'];
			$_alamat = $_POST['alamat'];
			$_tlp = $_POST['tlp'];
			$_idUser = $data1['id_user'];
			$ecount = 0;



			if ($data1['alamat'] == $_alamat) {
				$ecount++;
			}else
			{
				$queryUpdate = "UPDATE `user` SET `alamat` = '$_alamat' where id_user ='$_idUser'";
				$sqlRunUpdate = mysqli_query($connect, $queryUpdate);
				if (mysqli_affected_rows($connect)>0) {
					$ecount++;
				}
			}

			if ($data1['handphone'] == $_tlp) {
				$ecount++;
			}
			else{
				$queryUpdate = "UPDATE `user` SET `handphone` = '$_tlp' where id_user ='$_idUser'";
				$sqlRunUpdate = mysqli_query($connect, $queryUpdate);
				if (mysqli_affected_rows($connect)>0) {
					$ecount++;
				}
			}

			if ($ecount == 2) {
				$queryUpdate = "UPDATE `donasi` SET `Judul_Donasi`='$_judulSampah',`jenis_donasi`='$_jenisSampah',`jumlah_donasi`='$_beratSampah',`informasi_donasi`='$_deskripsi' WHERE id_donasi = '$_idDonasi'";
				$sqlRunUpdate = mysqli_query($connect, $queryUpdate);
				if (mysqli_affected_rows($connect)>0) {
					echo "Update Berhasil!";
				}else{
					echo "Update Data Donasi Gagal!";
				}
			}else{
				echo "Update Data Donasi Gagal!";
			}
		}
	}
	else if ($set == "submit_update_profile") {
		$type = $_SESSION['loginType'];
		$username = $_POST['username'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$tanggallahir = $_POST['tanggallahir'];
		$password = md5($_POST['password']);
		$handphone = $_POST['handphone'];
		$jeniskelamin = $_POST['jeniskelamin'];

		$queryUpdate = "UPDATE $type SET `email`='$email',`nama`='$nama',`handphone`='$handphone',`password`='$password',`tanggallahir`='$tanggallahir',`jeniskelamin`='$jeniskelamin',`alamat`='$alamat' WHERE username LIKE BINARY '$username'";
		$sqlRunUpdate = mysqli_query($connect,$queryUpdate);
		if (mysqli_affected_rows($connect)>0) {
			echo "Data berhasil di update!";
		}else{
			echo "Data gagal di update!";
		}
	}
}
else
{
	?>
	<script>
		alert("Tidak dapat mengakses file");
		window.location = "../explore.php"
	</script>
	<?php
}


//function
function login ($table , $_uname, $_pwd, $connect)
{
	$query = "SELECT * FROM $table WHERE username LIKE BINARY '$_uname' AND password LIKE BINARY '$_pwd'";
	$sqlRun = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($sqlRun, MYSQLI_ASSOC);

	$count = mysqli_num_rows($sqlRun);
	if ($count == 1) {
		//set the session properties
		$_SESSION['username'] = $_uname;
		$_SESSION['startLoginExpiration'] = time();
		//login session expiration = 2 hours, so (2 * 60 * 60)
		$_SESSION['endLoginExpiration'] = $_SESSION['startLoginExpiration'] + (2 * 60 * 60);

		echo "Login Sukses!";
	}
	else
	{
		die(header("HTTP/1.0 400 Bad Request"));
	}
}

function signup ($table, $_username, $_email, $_password, $connect)
{
	$ec = 0;
	$query1 = "SELECT * FROM $table WHERE username LIKE BINARY '$_username'";
	$sqlRun1 = mysqli_query($connect,$query1);
	if (mysqli_num_rows($sqlRun1) > 0) {
		
		echo "Username telah terdaftar, silahkan menggunakan username lain! \n";
		$ec++;
	}

	$query1 = "SELECT * FROM $table WHERE email LIKE BINARY '$_email'";
	$sqlRun1 = mysqli_query($connect,$query1);
	if (mysqli_num_rows($sqlRun1) > 0) {
		
		echo "Email telah terdaftar, silahkan menggunakan email lain! \n";
		$ec++;
	}

	if ($ec == 0) {
		$query = "INSERT INTO `$table`(`username`, `email`, `password`) VALUES ('$_username', '$_email','$_password')";
		$sqlRun = mysqli_query($connect, $query);
		if (mysqli_affected_rows($connect) > 0) {
			echo "Registrasi akun berhasil";
			$_SESSION['username'] = $_username;
			$_SESSION['startLoginExpiration'] = time();
			//login session expiration = 2 hours, so (2 * 60 * 60)
			$_SESSION['endLoginExpiration'] = $_SESSION['startLoginExpiration'] + (2 * 60 * 60);
			$_SESSION['loginType'] = $table;
		}
	}
}

function generateRandomString($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function compressImage($source, $destination, $quality) {

  $info = getimagesize($source);

  if ($info['mime'] == 'image/jpeg') 
    $image = imagecreatefromjpeg($source);

  elseif ($info['mime'] == 'image/gif') 
    $image = imagecreatefromgif($source);

  elseif ($info['mime'] == 'image/png') 
    $image = imagecreatefrompng($source);

  imagejpeg($image, $destination, $quality);


}
?> 