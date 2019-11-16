<?php 
require_once 'proses.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>DONASI SAMPAH</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="col-md-10">
			<h3>DONASI SAMPAH</h3>
			<hr>
			<form action="insert.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<input type="text" name="jenis" value="" placeholder="Sampah Jenis Apa ?" class="form-control" required>	
				</div>

				<div class="form-group">
					<input type="text" name="jumlah" value="" placeholder="Dalam Satuan Kilogram" class="form-control" required>	
				</div>

				<div class="form-group">
					<input type="text" name="kondisi" value="" placeholder="Kondisi & Informasi Tambahan" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="text" name="alamat" value="" placeholder="Alamat Lengkap Pengambilan" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="text" name="kontak" value="" placeholder="Kontak yang Bisa Dihubungi" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="img">
						<span class="badge bagde-dark">Upload Foto Sampahmu : </span>
					</label>
					<input type="file" class="form-control" name="image" required="">
				</div>	
				<button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
							
		</div>
	</div>
	
</body>
</html>
 <?php 
mysqli_close($con);
  ?>