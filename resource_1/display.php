<?php 
require_once("proses.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>DAFTAR DONASI</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style type="text/css">
		.wrapper {
		  position: relative;
		  overflow: hidden;
		}

		.wrapper:after {
		  content: '';
		  display: block;
		  padding-top: 100%;
		}

		.wrapper img {
		  width: auto;
		  height: 100%;
		  max-width: none;
		  position: absolute;
		  left: 50%;
		  top: 0;
		  transform: translateX(-50%);
		}
	</style>
</head>
<body>
	<div class="container">
  		<div class="row">
			<?php 
			 $SQL 	= "SELECT * from tbl_donasi";
			 $query = mysqli_query($con, $SQL);
			 while ($record=mysqli_fetch_array($query)) {
			 	echo '

			 	<div class="col-xs-6 col-md-4">
			      <div class="card" style="margin-bottom: 10%; ">
			        <div class="wrapper">
			        	<img class="card-img-top img-fluid" src="data:image;base64,' . $record['gambar_donasi'] . '">
			        </div>
			        <div class="card-body">
					    <h5 class="card-title"> '. $record['jenis_donasi'].' </h5>
					    <p class="card-text">'.$record['jumlah_donasi'].'</p>
					    <p class="card-text">'.$record['kondisi_donasi'].'</p>
					    <a href="detail.php?id='.$record['id_donasi'].'" class="btn btn-primary" style="margin: 0 auto; float: none;">DETAIL</a>
				  	</div>
			  		</div>
			  	</div>
			  	
				 ';
			  	}
			  ?>
		</div>
	</div> 
</body>
</html>
